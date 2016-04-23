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

	<a href="login.html">Log In / Sign up Here</a>
	<a href="settings.php"> My Account </a>

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

if($user != "admin") {
	echo "Feedback" . "<br/>";
	echo "<form name=\"feedback\" method=\"POST\" action=\"indexFeedback.php\">";

	echo "Username" . "<br/>";
	echo "<input type=\"text\" name=\"username\">" . "<br/>";

	echo "Subject" . "<br/>";
	echo "<input type=\"text\" name=\"subject\">" . "<br/>";	

	echo "Comments" . "<br/>";
	echo "<textarea name=\"feedback\" rows=\"5\" cols=\"40\"> </textarea>" . "<br/>";
	echo "<br/>";

	echo "<input type=\"submit\" name=\"feedback-submit\" value=\"Submit\">" . "<br/>";
	echo "</form>";
} else {
	echo "The feedback of all the users are displayed here.";

	$query = "SELECT * FROM feedback";
	$result = $connected->query($query);

	echo "<table style=\"width:100%\">";
	echo "<tr>";
	echo "<td>Username</td> <td>Subject</td> <td>Feedback</td>";
	echo "</tr>";
	if ($result->num_rows > 0) { //if # rows > 0
    	while($row = $result->fetch_assoc()) {
    		echo "<tr>";
    		echo "<td>" . $row['username'] . "</td>";
    		echo "<td>" . $row['subject'] . "</td>";
    		echo "<td>" . $row['feedback'] . "</td>";
    		echo "</tr>";
    	}
    }

}

//get contents of form
if (!empty($_POST['feedback-submit'])) {
	$username = $_POST['username'];
	$subject = $_POST['subject'];
	$feedback = $_POST['feedback'];

	$username = mysql_escape_string($username);
    $subject = mysql_escape_string($subject);
    $feedback = mysql_escape_string($feedback);

    $query = "INSERT INTO feedback VALUES ('$username', '$subject', '$feedback')"; 
	$result = $connected->query($query); 

	echo "You have successfully submitted feedback";
} 
	
?>

</body>
</head>

</HTML> 