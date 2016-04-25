<?php
include 'library.php';
$connected = mysqli_connect($SERVER, $USERNAME, $PASSWORD, $DATABASE); 

session_start();
$user = "";

if (isset($_SESSION["started"])) { 
	$user = $_SESSION['started'];
}
?>

<HTML>
<head>
	<h4 align = "center" id="titleName"> Travel Guide </h4>
	<title> Travel Guide </title>

	<a href="login.php">Log In / Sign up Here</a>

	<div id="navbar">
	<nav>
  	  <ul>
	    <li>
	      <a href="index.html">Flights</a>
	    </li>
	    <li>
	      <a href="indexHotel.html">Hotels</a>
	    </li>
	    <li>
	      <a href="indexCruise.html">Cruises</a>
	    </li>
	    <li>
	      <a href="indexLocal.html">Local Transportation</a>
	    </li>
	    <li>
	      <a href="indexTTD.html">Things To Do</a>
	    </li>
	    <li>
	      <a href="indexFeedback.php">Feedback</a>
	    </li>
	  </ul>
	</nav>
	</div>
	<link rel = "stylesheet" type = "text/css" href = "indexcss.css"/>
	<body>

<?php
if ($user != "") {
	echo "<div class=\"login-page\">";

	echo "<form class =\"form\" method=\"POST\" action=\"settings.php\">";
	echo "<h2> Welcome " . $user . "! </h2>" ;
	echo "Change your username";
	echo "<input type=\"text\" name=\"username\" placeholder=\"new username\">";

	echo "Change your password" . "<br/>";
	echo "<input type=\"text\" name=\"password\" placeholder=\"new password\">";
	echo "<input type=\"submit\" name=\"password-submit\" value=\"Submit\" id=\"submitButton\">";
	//echo "</form>";

	//echo "<form class =\"form\" method=\"POST\" action=\"settings.php\">";
	echo "<input type=\"submit\" name=\"delete-submit\" value=\"Delete Your Account\" id=\"deleteButton\">";
	echo "</form>";
	echo "</div>"; //close <div login-page>

	$user = mysql_escape_string($user);

	if (!empty($_POST['username-submit'])) {
		$username = $_POST['username'];
		$username = mysql_escape_string($username);

		$query = "UPDATE users SET username='$username' WHERE username='$user'";
		$result = $connected->query($query);

		$_SESSION['started'] = $username;
		$user = $username;
		echo "Your username has been changed";

	} else if(!empty($_POST['password-submit'])) {
		$password = $_POST['password'];
		$password = mysql_escape_string($password);

		$query = "UPDATE users SET password='$password' WHERE username='$user'";
		$result = $connected->query($query);
		echo "Your password has been changed";
	} else if(!empty($_POST['delete-submit'])) {
		$query = "DELETE FROM users WHERE username='$user'";
		$result = $connected->query($query);
		session_destroy();
	}
} else { //user has not logged in
	echo "Please log in to view your settings";
}
?>

</body>
</head>

</HTML> 