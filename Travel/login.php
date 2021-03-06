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
<div class="login-page">
<div class="form">
<h2 align="center"> Log-In </h2>
<form class="login-form" name = "login" method = "POST" action="login.php">
  <input type = "text" name = "username" placeholder="username"> 
  <input type = "password" name = "password" placeholder="password"> 
  <input id="submitButton" type="submit" name = "login-submit" value = "Submit">
  <p class="message">Not registered? <a href="signup.php">Create an account</a></p>
</form>

</div>

<?php
if (!empty($_POST['login-submit'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $password = hash('sha256', rtrim($password));
  $message = "";
  $message = "You did not fill out an input. Try again.";
  if(!empty($_POST['username']) && !empty($_POST['password'])) {
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
        $message = "You have successfully logged in.";
        //differentiate the admin
        $_SESSION['started'] = $username; 
        if ($username == "admin") {
          $_SESSION['started'] = "admin";
        }
      } else {
        $message = "Your username or password was incorrect.";
      }
  } 
  echo "<script type='text/javascript'>alert('$message');</script>";
} 

?>