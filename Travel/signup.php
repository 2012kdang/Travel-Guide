<?php
session_start();

include 'library.php';

$connected = mysqli_connect($SERVER, $USERNAME, $PASSWORD, $DATABASE); 
$login = false;
$emailFlag = false; ?>

<HTML>
<head>
	<h4 align = "center" id="titleName"> Travel Guide </h4>
	<title> Travel Guide </title>
	
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

<div id="login-page">
<div class="form">
<h2 align="center"> Sign-Up </h2>
<form  class="login-form" name = "signup" method = "POST" action="signup.php">
	<input type = "text" name = "email" placeholder = "email"> <br/>
	<input type = "text" name = "username" placeholder = "username"> <br/>
	<input type = "text" name = "password" placeholder = "password"> <br/>
	<input type="submit" name = "signup-submit" value = "Submit" id="submitButton">
	<p class="message">Already registered? <a href="login.php">Sign In</a></p>
</form>
</div>
</div>

<?php

if (!empty($_POST['signup-submit'])) {
	$email = $_POST['email'];
	$username = $_POST['username'];
	$password = $_POST['password'];

	$query = "SELECT email FROM users";
	$result = $connected->query($query);

	if ($result->num_rows > 0) { //if # rows > 0
        while($row = $result->fetch_assoc()) {
        	if ($row['email'] == $email) { 
        		$emailFlag = true; 
        	}
        }
    } else { 
        echo "There are 0 results";
    }
    if($emailFlag == true) {
    	echo "This email is already in use";
    } else {
      $username = mysql_escape_string($username);
    	$password = mysql_escape_string($password);
    	$email = mysql_escape_string($email);
    	$query = "INSERT INTO users VALUES ('$username', '$password', '$email')"; 
		  $result = $connected->query($query); 
		  echo "You have successfully created an account";
    }

	echo $email;
	
} 
?>
	</body>
</head>

</HTML> 

