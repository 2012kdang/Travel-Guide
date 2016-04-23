<?php
include 'library.php';

$connected = mysqli_connect($SERVER, $USERNAME, $PASSWORD, $DATABASE); 
$login = false;
$emailFlag = false;

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

if (!empty($_POST['login-submit'])) {
   	$username = $_POST['username'];
	$password = $_POST['password'];

	$query = "SELECT * FROM users";
	$result = $connected->query($query);

	if ($result->num_rows > 0) { //if # rows > 0
         while($row = $result->fetch_assoc()) {
            if ($row['username'] == $username && $row['password'] == $password) { 
               $login = true;
            }
         }
      } else { 
         echo "There are 0 results";
      }

    if ($login == true) {
    	echo "congrats u logged in";
    } else {
    	echo "try again";
    }

}
?>