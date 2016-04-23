<?php 
	require "dbutil.php";
	$db = DbUtil::loginConnection();
	
	$stmt = $db->stmt_init();

	$stringFlyingFrom = $_GET['flyingFrom'];
	$stringFlyingTo = $_GET['flyingTo'];
	$stringDepartDate = $_GET['departDate'];
	$stringReturnDate = $_GET['returnDate'];
	// Form the SQL query (a SELECT query)

	echo "<table border=1><th>Airline</th><th>Flying From</th><th>Flying To</th><th>Departing Information</th><th>Returning Information</th><th>Price</th><th>Duration</th>\n";

	if($stringDepartDate == NULL && $stringReturnDate == NULL){
		if($stmt->prepare("select * from plane_tickets where destination like ? AND departing_loc like ? ORDER by airline") or die(mysqli_error($db))) {
			$stringFlyingFrom = '%'.$_GET['flyingFrom'].'%';
			$stringFlyingTo = '%'.$_GET['flyingTo'].'%';
			$stmt->bind_param('ss', $stringFlyingTo, $stringFlyingFrom);
			$stmt->execute();
			$stmt->bind_result($destination, $price, $airline, $duration, $departing_date, $returning_date, $departing_loc);
			while($stmt->fetch()) {
				echo "<tr><td>$airline</td><td>$departing_loc</td><td>$destination</td><td>$departing_date</td><td>$returning_date</td><td>$price</td><td>$duration</td></tr>";
			}
		}
		echo "</table>";
	
		$stmt->close();
	}else if($stringDepartDate == NULL && $stringReturnDate){
		if($stmt->prepare("select * from plane_tickets where destination like ? AND departing_loc like ? AND returning_date like ? ORDER by airline") or die(mysqli_error($db))) {
			$stringFlyingFrom = '%'.$_GET['flyingFrom'].'%';
			$stringFlyingTo = '%'.$_GET['flyingTo'].'%';
			$stringReturnDate = '%' . $_GET['returnDate'] . '%';
			$stmt->bind_param('sss', $stringFlyingTo, $stringFlyingFrom, $stringReturnDate);
			$stmt->execute();
			$stmt->bind_result($destination, $price, $airline, $duration, $departing_date, $returning_date, $departing_loc);
			while($stmt->fetch()) {
				echo "<tr><td>$airline</td><td>$departing_loc</td><td>$destination</td><td>$departing_date</td><td>$returning_date</td><td>$price</td><td>$duration</td></tr>";
			}
		}
		echo "</table>";
	
		$stmt->close();
	}else if($stringReturnDate == NULL && $stringDepartDate){
		if($stmt->prepare("select * from plane_tickets where destination like ? AND departing_loc like ? AND departing_date like ? ORDER by airline") or die(mysqli_error($db))) {
			$stringFlyingFrom = '%'.$_GET['flyingFrom'].'%';
			$stringFlyingTo = '%'.$_GET['flyingTo'].'%';
			$stringDepartDate = '%' . $_GET['departDate'] . '%';
			$stmt->bind_param('sss', $stringFlyingTo, $stringFlyingFrom, $stringDepartDate);
			$stmt->execute();
			$stmt->bind_result($destination, $price, $airline, $duration, $departing_date, $returning_date, $departing_loc);
			while($stmt->fetch()) {
				echo "<tr><td>$airline</td><td>$departing_loc</td><td>$destination</td><td>$departing_date</td><td>$returning_date</td><td>$price</td><td>$duration</td></tr>";
			}
		}
		echo "</table>";
	
		$stmt->close();
	}else{
		if($stmt->prepare("select * from plane_tickets where destination like ? AND departing_loc like ? AND returning_date like ? AND departing_date like ? ORDER by airline") or die(mysqli_error($db))) {
			$stringFlyingFrom = '%'.$_GET['flyingFrom'].'%';
			$stringFlyingTo = '%'.$_GET['flyingTo'].'%';
			$stringReturnDate = '%' . $_GET['returnDate'] . '%';
			$stringDepartDate = '%' . $_GET['departDate'] . '%';
			$stmt->bind_param('ssss', $stringFlyingTo, $stringFlyingFrom, $stringReturnDate, $stringDepartDate);
			$stmt->execute();
			$stmt->bind_result($destination, $price, $airline, $duration, $departing_date, $returning_date, $departing_loc);
			while($stmt->fetch()) {
				echo "<tr><td>$airline</td><td>$departing_loc</td><td>$destination</td><td>$departing_date</td><td>$returning_date</td><td>$price</td><td>$duration</td></tr>";
			}
		}
		echo "</table>";
	
		$stmt->close();
	}

	$db->close();
?>