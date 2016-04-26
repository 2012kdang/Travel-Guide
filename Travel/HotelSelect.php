<?php
	require "dbutil.php";
	$db = DbUtil::loginConnection();
	
	$stmt = $db->stmt_init();

	$stringLoc = $_GET['location'];
	$stringRating = $_GET['rating'];
	if (!empty($stringLoc)) {
		echo "<table><th>Name</th><th>Rating</th><th>Address</th><th>Phone Number</th><th>Price Per Night</th>\n";

		if($stringRating == NULL){
			if($stmt->prepare("select * from hotels where (city like ? OR state like ? or country like ?) ORDER BY name") or die(mysqli_error($db))) {
				$stringLoc = '%' . $_GET['location'] . '%';
				$stmt->bind_param('sss', $stringLoc, $stringLoc, $stringLoc);
				$stmt->execute();
				$stmt->bind_result($name, $rating, $phone_num, $price, $street, $city, $state, $country);
				while($stmt->fetch()) {
					$address = $street . " " . $city . " " . $state . " " . $country;
					echo "<tr><td>$name</td><td>$rating</td><td>$address</td><td>$phone_num</td><td>$price</td></tr>";
				}
			}
		}else{
			if($stmt->prepare("select * from hotels where (city like ? OR state like ? or country like ?) AND rating=? ORDER BY name") or die(mysqli_error($db))) {
				$stringLoc = '%' . $_GET['location'] . '%';
				$stmt->bind_param('ssss', $stringLoc, $stringLoc, $stringLoc, $stringRating);
				$stmt->execute();
				$stmt->bind_result($name, $rating, $phone_num, $price, $street, $city, $state, $country);
				while($stmt->fetch()) {
					$address = $street . " " . $city . " " . $state . " " . $country;
					echo "<tr><td>$name</td><td>$rating</td><td>$address</td><td>$phone_num</td><td>$price</td></tr>";
				}
			}
		}
		echo "</table>";
		$stmt->close();
	} else {
		echo "<script type='text/javascript'>alert('You did not fill out one of the required fields. Try again.');</script>";
	}
	$db->close();
?>