<?php
	require "dbutil.php";
	$db = DbUtil::loginConnection();
	
	$stmt = $db->stmt_init();

	$stringTo = $_GET['travelTo'];
	$stringFrom = $_GET['travelFrom'];
	$stringType = $_GET['type'];

	echo "<table border=1><th>Category</th><th>Travel To</th><th>Travel From</th><th>Type</th><th>Price</th>\n";

	if($stringType == NULL){
		if($stmt->prepare("select * from public_trans where destination like ? AND departing_loc like ? ORDER BY type") or die(mysqli_error($db))) {
			$stringTo2 = '%' . $_GET['travelTo'] . '%';
			$stringFrom = '%' . $_GET['travelFrom'] . '%';
			$stmt->bind_param('ss', $stringTo2, $stringFrom);
			$stmt->execute();
			$stmt->bind_result($type, $ID, $price, $duration, $destination, $departing_loc);
			while($stmt->fetch()) {
				echo "<tr><td>Public Transportation</td><td>$destination</td><td>$departing_loc</td><td>$type</td><td>$price</td></tr>";
			}
		}
		if($stmt->prepare("select * from car_rentals where location like ?") or die(mysqli_error($db))) {
			$stringFrom = '%' . $_GET['travelFrom'] . '%';
			$stmt->bind_param('s', $stringFrom);
			$stmt->execute();
			$stmt->bind_result($company, $price, $model, $location, $ID);
			while($stmt->fetch()) {
				echo "<tr><td>Car Rental</td><td>$stringTo</td><td>$location</td><td>$model</td><td>$price</td></tr>";
			}
		}
	}else if ($stringType=="Car Rental"){
		if($stmt->prepare("select * from car_rentals where location like ?") or die(mysqli_error($db))) {
			$stringFrom = '%' . $_GET['travelFrom'] . '%';
			$stmt->bind_param('s', $stringFrom);
			$stmt->execute();
			$stmt->bind_result($company, $price, $model, $location, $ID);
			while($stmt->fetch()) {
				echo "<tr><td>Car Rental</td><td>$stringTo</td><td>$location</td><td>$model</td><td>$price</td></tr>";
			}
		}
	}else{
		if($stmt->prepare("select * from public_trans where destination like ? AND departing_loc like ? AND type=? ORDER BY type") or die(mysqli_error($db))) {
			$stringTo = '%' . $_GET['travelTo'] . '%';
			$stringFrom = '%' . $_GET['travelFrom'] . '%';
			$stmt->bind_param('sss', $stringTo, $stringFrom, $stringType);
			$stmt->execute();
			$stmt->bind_result($type, $ID, $price, $duration, $destination, $departing_loc);
			while($stmt->fetch()) {
				echo "<tr><td>Public Transportation</td><td>$destination</td><td>$departing_loc</td><td>$type</td><td>$price</td></tr>";
			}
		}
	}
	echo "</table>";
	$stmt->close();
	$db->close();
?>
