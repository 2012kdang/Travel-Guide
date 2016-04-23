
<?php
	require "dbutil.php";
	$db = DbUtil::loginConnection();
	
	$stmt = $db->stmt_init();

	$stringDest = $_GET['searchDestination'];
	$stringType = $_GET['searchCategory'];

	if($stmt->prepare("select * from attractions where destination like ? AND type like ?") or die(mysqli_error($db))) {
		$stringDest = '%' . $_GET['searchDestination'] . '%';
		$stringType = '%' . $_GET['searchCategory'] . '%';
		$stmt->bind_param('ss', $stringDest, $stringType);
		$stmt->execute();
		$stmt->bind_result($type, $price, $name, $address, $destination);
		echo "<table border=1><th>Category</th><th>Name</th><th>Type</th><th>Price</th><th>Location</th>\n";
		while($stmt->fetch()) {
			echo "<tr><td>Attraction</td><td>$name</td><td>$type</td><td>$price</td><td>$address</td></tr>";
		}
		echo "</table>";
	
		$stmt->close();
	}
	
	$db->close();


?>