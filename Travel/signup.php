<?php
session_start();

include 'library.php';

$connected = mysqli_connect($SERVER, $USERNAME, $PASSWORD, $DATABASE); 
$emailFlag = false; ?>

<HTML>
<head>
	<h4 align = "center" id="titleName"> Travel Guide </h4>
	<title> Travel Guide </title>
	<a href="login.php"> Login</a>
	<a href="settings.php"> My Account </a>
	<div class = "right"> 
		<a href="signout.php"> Log Out </a>
	</div>
	
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
	<input type = "text" name = "username" placeholder = "email"> <br/>
	<input type = "password" name = "password" placeholder = "password"> <br/>
	<input type="submit" name = "signup-submit" value = "Submit" id="submitButton">
	<p class="message">Already registered? <a href="login.php">Sign In</a></p>
</form>
</div>
</div>

<?php

if (!empty($_POST['signup-submit'])) {
	//$email = $_POST['email'];
	$email = $_POST['username']; //changed username to email 
	$password = $_POST['password'];
	$message = "You did not fill in one of the inputs. Try again.";

	if(!empty($email) && !empty($password)) {
		$query = "SELECT username FROM users";
		$result = $connected->query($query);

		if ($result->num_rows > 0) { //if # rows > 0
	        while($row = $result->fetch_assoc()) {
	        	if ($row['username'] == $email) { 
	        		$emailFlag = true; 
	        	}
	        }
	    } else { 
	        echo "There are 0 results";
	    }
	    if($emailFlag == true) {
	    	$message = "This email is already in use";
	    } else {
	      	//$username = mysql_escape_string($username);
	    	$password = mysql_escape_string($password);
	    	$password = hash('sha256', rtrim($password)); 
	    	$email = mysql_escape_string($email);
	    	$feedback = '0';
	    	$feedback = mysql_escape_string($feedback);
	    	$query = "INSERT INTO users VALUES ('$password', '$email', '$feedback')"; 
			$result = $connected->query($query) or die ("Invalid insert."); 
			$message = "You have successfully created an account. You are now logged in.";
			//$message = $result;
			$_SESSION['started'] = $email; 
	      	if ($email == "admin") {
	        	$_SESSION['started'] = "admin";
	      	}
    	}
	
	}

	echo "<script type='text/javascript'>alert('$message');</script>";
} 
?>
	</body>
</head>

</HTML> 

