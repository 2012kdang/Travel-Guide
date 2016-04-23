<?php
	require "dbutil.php";
	$db = DbUtil::loginConnection();
	
	$stmt = $db->stmt_init();

	$stringDest = $_GET['destination'];
	$stringDepartMonth = $_GET['departMonth'];

	echo "<table border=1><th>Company</th><th>Going To</th><th>Departing From</th><th>Departing Date</th><th>Returning Date</th><th>Price</th><th>Duration</th>\n";

	if($stringDepartMonth == NULL){
		if($stmt->prepare("select * from cruises where destination like ? ORDER BY company") or die(mysqli_error($db))) {
			$stringDest = '%' . $_GET['destination'] . '%';
			$stmt->bind_param('s', $stringDest);
			$stmt->execute();
			$stmt->bind_result($duration, $company, $destination, $departing_loc, $price, $departing, $returning);
			while($stmt->fetch()) {
				echo "<tr><td>$company</td><td>$destination</td><td>$departing_loc</td><td>$departing</td><td>$returning</td><td>$price</td><td>$duration</td></tr>";
			}
		}
		echo "</table>";
	
		$stmt->close();
	}else{
		if($stmt->prepare("select * from cruises where destination like ? AND MONTH(departing)=? ORDER BY company") or die(mysqli_error($db))) {
			$stringDest = '%' . $_GET['destination'] . '%';
			$stmt->bind_param('ss', $stringDest, $stringDepartMonth);
			$stmt->execute();
			$stmt->bind_result($duration, $company, $destination, $departing_loc, $price, $departing, $returning);
			while($stmt->fetch()) {
				echo "<tr><td>$company</td><td>$destination</td><td>$departing_loc</td><td>$departing</td><td>$returning</td><td>$price</td><td>$duration</td></tr>";
			}
		}
		echo "</table>";
	
		$stmt->close();
	}
