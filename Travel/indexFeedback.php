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

if($user != "admin") { //display feedback form if user is not admin
	echo "<div id=\"form-main\">";
	
	echo "<form class=\"form\" name=\"feedback\" method=\"POST\" action=\"indexFeedback.php\">";
	echo "<h2 align=\"center\"> Feedback</h2>";
	//USERNAME
	echo "<p class=\"name\">";
	echo "<input name=\"username\" type=\"text\" placeholder=\"Username\" id=\"name\" />";
	
	//SUBJECT
	echo "<p class=\"email\">";
	//echo "<input type=\"text\" name=\"subject\">" . "<br/>" . "</p>";	
	echo "<input name=\"subject\" type=\"text\" id=\"email\" placeholder=\"Subject\" />";

	//COMMENTS
	echo "<p class=\"text\">";
	echo "<textarea name=\"feedback\" rows=\"5\" cols=\"40\" id=\"comment\" placeholder=\"Comment\"></textarea>";
	//echo "<textarea name=\"feedback\" rows=\"5\" cols=\"40\"> </textarea>" . "<br/>";
	echo "</p>";

	//SUBMIT
	echo "<div class=\"submit\">";
	echo "<input type=\"submit\" name=\"feedback-submit\" value=\"Submit\" id=\"submitButton\">" . "<br/>";
	echo "<div class=\"ease\"></div>";

	echo "</form>";
	echo "</div>"; //close <div> form-main

} else {
	echo "The feedback of all the users are displayed here.";

	echo "<form name=\"download\" method=\"POST\" action=\"downloadxml.php\">";
	echo "<input type=\"submit\" name=\"download-feedback\" value=\"Download as XML\">" . "<br/>";
	echo "</form>";

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
    echo "</table>";

}

//get contents of form
if (!empty($_POST['feedback-submit'])) {
	$username = $_POST['username'];
	$subject = $_POST['subject'];
	$feedback = $_POST['feedback'];

	$username = mysql_escape_string($username);
    $subject = mysql_escape_string($subject);
    $feedback = mysql_escape_string($feedback);

    $query = "INSERT INTO feedback VALUES ('id_feedback', '$username', '$subject', '$feedback')"; 
	$result = $connected->query($query) or die ("Invalid insert " . $connected->error); 

	echo "Thanks for submitting feedback!";
} 
	
?>

</body>
</head>

</HTML> 