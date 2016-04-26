<?php
session_start();
$logout = "";
if(isset($_SESSION['started'])) {
	session_destroy();
	$logout = true;
} else {
	$logout = false;
}

?>

<HTML>
<head>
  <h4 align = "center" id="titleName"> Travel Guide </h4>
  <title> Travel Guide </title>
  <a href="settings.php"> My Account </a>
  <link rel = "stylesheet" type = "text/css" href = "indexcss.css"/>
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

  <?php
  if ($logout == true) {
  	echo "You were logged out!";
  } else if ($logout == false) {
  	echo "You were never logged in. Try logging in.";
  }
  ?>

</head>
</HTML>