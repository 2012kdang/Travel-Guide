<?php
	
	require "dbutil.php";
	$db = DbUtil::loginConnection();
	
	$stmt = $db->stmt_init();
	$stringTo = $_GET['travelTo'];
	$stringFrom = $_GET['travelFrom'];
	$stringType = $_GET['type'];

	echo "<table border=1><th>Category</th><th>Travel To</th><th>Travel From</th><th>Type</th><th>Price</th>\n";

	if($stringType == NULL){
		if($stmt->prepare("select * from public_trans where (destination_city like ? OR destination_state like ? OR destination_country like ?) AND (departing_city like ? OR departing_state like ? OR departing_country like ?) ORDER BY type") or die(mysqli_error($db))) {
			$stringTo2 = '%' . $_GET['travelTo'] . '%';
			$stringFrom = '%' . $_GET['travelFrom'] . '%';
			$stmt->bind_param('ssssss', $stringTo2, $stringTo2, $stringTo2, $stringFrom, $stringFrom, $stringFrom);
			$stmt->execute();
			$stmt->bind_result($type, $ID, $price, $duration, $destination_city, $destination_state, $destination_country, $departing_city, $departing_state, $departing_country);
			while($stmt->fetch()) {
				$destination = $destination_city . " " . $destination_state . " " . $destination_country;
				$departing_loc = $departing_city . " " . $departing_state . " " . $departing_country;
				echo "<tr><td>Public Transportation</td><td>$destination</td><td>$departing_loc</td><td>$type</td><td>$price</td></tr>";
			}
		}
		if($stmt->prepare("select * from car_rentals where (city like ? OR state like ? OR country like ?) ORDER by model") or die(mysqli_error($db))) {
			$stringFrom = '%' . $_GET['travelFrom'] . '%';
			$stmt->bind_param('sss', $stringFrom, $stringFrom, $stringFrom);
			$stmt->execute();
			$stmt->bind_result($company, $price, $model, $city, $state, $country, $ID);
			while($stmt->fetch()) {
				$location = $city . " " . $state . " " . $country;
				echo "<tr><td>Car Rental</td><td>$stringTo</td><td>$location</td><td>$model</td><td>$price</td></tr>";
			}
		}
	}else if ($stringType=="Car Rental"){
		if($stmt->prepare("select * from car_rentals where (city like ? OR state like ? OR country like ?) ORDER by model") or die(mysqli_error($db))) {
			$stringFrom = '%' . $_GET['travelFrom'] . '%';
			$stmt->bind_param('sss', $stringFrom, $stringFrom, $stringFrom);
			$stmt->execute();
			$stmt->bind_result($company, $price, $model, $city, $state, $country, $ID);
			while($stmt->fetch()) {
				$location = $city . " " . $state . " " . $country;
				echo "<tr><td>Car Rental</td><td>$stringTo</td><td>$location</td><td>$model</td><td>$price</td></tr>";
			}
		}
	}else{
		if($stmt->prepare("select * from public_trans where (destination_city like ? OR destination_state like ? OR destination_country like ?) AND (departing_city like ? OR departing_state like ? OR departing_country like ?) AND type=? ORDER BY type") or die(mysqli_error($db))) {
			$stringTo = '%' . $_GET['travelTo'] . '%';
			$stringFrom = '%' . $_GET['travelFrom'] . '%';
			$stmt->bind_param('sssssss', $stringTo, $stringTo, $stringTo, $stringFrom, $stringFrom, $stringFrom, $stringType);
			$stmt->execute();
			$stmt->bind_result($type, $ID, $price, $duration, $destination_city, $destination_state, $destination_country, $departing_city, $departing_state, $departing_country);
			while($stmt->fetch()) {
				$destination = $destination_city . " " . $destination_state . " " . $destination_country;
				$departing_loc = $departing_city . " " . $departing_state . " " . $departing_country;
				echo "<tr><td>Public Transportation</td><td>$destination</td><td>$departing_loc</td><td>$type</td><td>$price</td></tr>";
			}
		}
	}
	echo "</table>";
	$stmt->close();
	$db->close();
?>
