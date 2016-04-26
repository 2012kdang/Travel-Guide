<?php 
	require "dbutil.php";
	$db = DbUtil::loginConnection();
	
	$stmt = $db->stmt_init();

	$stringFlyingFrom = $_GET['flyingFrom'];
	$stringFlyingTo = $_GET['flyingTo'];
	$stringDepartDate = $_GET['departDate'];
	$stringReturnDate = $_GET['returnDate'];
	// Form the SQL query (a SELECT query)

	echo "<table><th>Airline</th><th>Flying From</th><th>Flying To</th><th>Departing Information</th><th>Returning Information</th><th>Price</th><th>Duration</th>\n";

	if($stringDepartDate == NULL && $stringReturnDate == NULL){
		if($stmt->prepare("select * from plane_tickets where (destination_city like ? OR destination_state like ? OR destination_country like ?) AND (departing_city like ? OR departing_state like ? OR departing_country like ?) ORDER by airline") or die(mysqli_error($db))) {
			$stringFlyingFrom = '%'.$_GET['flyingFrom'].'%';
			$stringFlyingTo = '%'.$_GET['flyingTo'].'%';
			$stmt->bind_param('ssssss', $stringFlyingTo, $stringFlyingTo, $stringFlyingTo, $stringFlyingFrom, $stringFlyingFrom,$stringFlyingFrom);
			$stmt->execute();
			$stmt->bind_result($ID, $destination_city, $destination_state, $destination_country, $price, $airline, $duration, $departing_date, $returning_date, $departing_city, $departing_state, $departing_country);
			while($stmt->fetch()) {
				$destination = $destination_city . " " . $destination_state . " " . $destination_country;
				$departing_loc = $departing_city . " " . $departing_state . " " . $departing_country;
				echo "<tr><td>$airline</td><td>$departing_loc</td><td>$destination</td><td>$departing_date</td><td>$returning_date</td><td>$price</td><td>$duration</td></tr>";
			}
		}
		echo "</table>";
	
		$stmt->close();
	}else if($stringDepartDate == NULL && $stringReturnDate){
		if($stmt->prepare("select * from plane_tickets where (destination_city like ? OR destination_state like ? OR destination_country like ?) AND (departing_city like ? OR departing_state like ? OR departing_country like ?) AND returning_date like ? ORDER by airline") or die(mysqli_error($db))) {
			$stringFlyingFrom = '%'.$_GET['flyingFrom'].'%';
			$stringFlyingTo = '%'.$_GET['flyingTo'].'%';
			$stringReturnDate = '%' . $_GET['returnDate'] . '%';
			$stmt->bind_param('sssssss', $stringFlyingTo, $stringFlyingTo, $stringFlyingTo, $stringFlyingFrom, $stringFlyingFrom, $stringFlyingFrom, $stringReturnDate);
			$stmt->execute();
			$stmt->bind_result($ID, $destination_city, $destination_state, $destination_country, $price, $airline, $duration, $departing_date, $returning_date, $departing_city, $departing_state, $departing_country);
			while($stmt->fetch()) {
				$destination = $destination_city . " " . $destination_state . " " . $destination_country;
				$departing_loc = $departing_city . " " . $departing_state . " " . $departing_country;
				echo "<tr><td>$airline</td><td>$departing_loc</td><td>$destination</td><td>$departing_date</td><td>$returning_date</td><td>$price</td><td>$duration</td></tr>";
			}
		}
		echo "</table>";
	
		$stmt->close();
	}else if($stringReturnDate == NULL && $stringDepartDate){
		if($stmt->prepare("select * from plane_tickets where (destination_city like ? OR destination_state like ? OR destination_country like ?) AND (departing_city like ? OR departing_state like ? OR departing_country like ?) AND departing_date like ? ORDER by airline") or die(mysqli_error($db))) {
			$stringFlyingFrom = '%'.$_GET['flyingFrom'].'%';
			$stringFlyingTo = '%'.$_GET['flyingTo'].'%';
			$stringDepartDate = '%' . $_GET['departDate'] . '%';
			$stmt->bind_param('sssssss', $stringFlyingTo, $stringFlyingTo, $stringFlyingTo, $stringFlyingFrom, $stringFlyingFrom, $stringFlyingFrom, $stringDepartDate);
			$stmt->execute();
			$stmt->bind_result($ID, $destination_city, $destination_state, $destination_country, $price, $airline, $duration, $departing_date, $returning_date, $departing_city, $departing_state, $departing_country);
			while($stmt->fetch()) {
				$destination = $destination_city . " " . $destination_state . " " . $destination_country;
				$departing_loc = $departing_city . " " . $departing_state . " " . $departing_country;
				echo "<tr><td>$airline</td><td>$departing_loc</td><td>$destination</td><td>$departing_date</td><td>$returning_date</td><td>$price</td><td>$duration</td></tr>";
			}
		}
		echo "</table>";
	
		$stmt->close();
	}else{
		if($stmt->prepare("select * from plane_tickets where (destination_city like ? OR destination_state like ? OR destination_country like ?) AND (departing_city like ? OR departing_state like ? OR departing_country like ?) AND returning_date like ? AND departing_date like ? ORDER by airline") or die(mysqli_error($db))) {
			$stringFlyingFrom = '%'.$_GET['flyingFrom'].'%';
			$stringFlyingTo = '%'.$_GET['flyingTo'].'%';
			$stringReturnDate = '%' . $_GET['returnDate'] . '%';
			$stringDepartDate = '%' . $_GET['departDate'] . '%';
			$stmt->bind_param('ssssssss', $stringFlyingTo, $stringFlyingTo, $stringFlyingTo, $stringFlyingFrom, $stringFlyingFrom, $stringFlyingFrom, $stringReturnDate, $stringDepartDate);
			$stmt->execute();
			$stmt->bind_result($ID, $destination_city, $destination_state, $destination_country, $price, $airline, $duration, $departing_date, $returning_date, $departing_city, $departing_state, $departing_country);
			while($stmt->fetch()) {
				$destination = $destination_city . " " . $destination_state . " " . $destination_country;
				$departing_loc = $departing_city . " " . $departing_state . " " . $departing_country;
				echo "<tr><td>$airline</td><td>$departing_loc</td><td>$destination</td><td>$departing_date</td><td>$returning_date</td><td>$price</td><td>$duration</td></tr>";
			}
		}
		echo "</table>";
	
		$stmt->close();
	}

	$db->close();
?>