<?php
	require "dbutil.php";
	$db = DbUtil::loginConnection();
	
	$stmt = $db->stmt_init();

	$stringLoc = $_GET['location'];
	$stringRating = $_GET['rating'];

	echo "<table border=1><th>Name</th><th>Rating</th><th>Address</th><th>Phone Number</th><th>Price Per Night</th>\n";

	if($stringRating == NULL){
		if($stmt->prepare("select * from hotels where location like ? ORDER BY name") or die(mysqli_error($db))) {
			$stringLoc = '%' . $_GET['location'] . '%';
			$stmt->bind_param('s', $stringLoc);
			$stmt->execute();
			$stmt->bind_result($name, $rating, $address, $phone_num, $price, $location);
			while($stmt->fetch()) {
				echo "<tr><td>$name</td><td>$rating</td><td>$address</td><td>$phone_num</td><td>$price</td></tr>";
			}
		}
	}else{
		if($stmt->prepare("select * from hotels where location like ? AND rating=? ORDER BY name") or die(mysqli_error($db))) {
			$stringLoc = '%' . $_GET['location'] . '%';
			$stmt->bind_param('ss', $stringLoc, $stringRating);
			$stmt->execute();
			$stmt->bind_result($name, $rating, $address, $phone_num, $price, $location);
			while($stmt->fetch()) {
				echo "<tr><td>$name</td><td>$rating</td><td>$address</td><td>$phone_num</td><td>$price</td></tr>";
			}
		}
	}
	echo "</table>";
	$stmt->close();
	$db->close();
?>