<?php
	require "dbutil.php";
	$db = DbUtil::loginConnection();
	
	$stmt = $db->stmt_init();

	$stringDest = $_GET['destination'];
	$stringDepartMonth = $_GET['departMonth'];

	echo "<table border=1><th>Company</th><th>Going To</th><th>Departing From</th><th>Departing Date</th><th>Returning Date</th><th>Price</th><th>Duration</th>\n";

	if($stringDepartMonth == NULL){
		if($stmt->prepare("select * from cruises where (destination_city like ? OR destination_state like ? OR destination_country like ?) ORDER BY company") or die(mysqli_error($db))) {
			$stringDest = '%' . $_GET['destination'] . '%';
			$stmt->bind_param('sss', $stringDest, $stringDest, $stringDest);
			$stmt->execute();
			$stmt->bind_result($ID, $duration, $company, $destination_city, $destination_state, $destination_country, $departing_city, $departing_state, $departing_country, $price, $departing, $returning);
			while($stmt->fetch()) {
				$destination =  $destination_city . " " . $destination_state . " " . $destination_country;
				$departing_loc = $departing_city . " " . $departing_state . " " . $departing_country;
				echo "<tr><td>$company</td><td>$destination</td><td>$departing_loc</td><td>$departing</td><td>$returning</td><td>$price</td><td>$duration</td></tr>";
			}
		}
		echo "</table>";
	
		$stmt->close();
	}else{
		if($stmt->prepare("select * from cruises where (destination_city like ? OR destination_state like ? OR destination_country like ?) AND MONTH(departing)=? ORDER BY company") or die(mysqli_error($db))) {
			$stringDest = '%' . $_GET['destination'] . '%';
			$stmt->bind_param('ssss', $stringDest, $stringDest, $stringDest, $stringDepartMonth);
			$stmt->execute();
			$stmt->bind_result($ID, $duration, $company, $destination_city, $destination_state, $destination_country, $departing_city, $departing_state, $departing_country, $price, $departing, $returning);
			while($stmt->fetch()) {
				$destination =  $destination_city . " " . $destination_state . " " . $destination_country;
				$departing_loc = $departing_city . " " . $departing_state . " " . $departing_country;
				echo "<tr><td>$company</td><td>$destination</td><td>$departing_loc</td><td>$departing</td><td>$returning</td><td>$price</td><td>$duration</td></tr>";
			}
		}
		echo "</table>";
	
		$stmt->close();
	}
