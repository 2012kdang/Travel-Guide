
<?php
	require "dbutil.php";
	$db = DbUtil::loginConnection();
	
	$stmt = $db->stmt_init();

	$stringDest = $_GET['searchDestination'];
	$stringType = $_GET['searchCategory'];

	echo "<table border=1><th>Category</th><th>Name</th><th>Type</th><th>Price</th><th>Location</th>\n";

	if($stringType==NULL){
		if($stmt->prepare("select * from attractions where destination like ?") or die(mysqli_error($db))) {
			$stringDest = '%' . $_GET['searchDestination'] . '%';
			$stmt->bind_param('s', $stringDest);
			$stmt->execute();
			$stmt->bind_result($type, $price, $name, $address, $destination);
			while($stmt->fetch()) {
				echo "<tr><td>Attraction</td><td>$name</td><td>$type</td><td>$price</td><td>$address</td></tr>";
			}
		}
		if($stmt->prepare("select * from restaurants where destination like ?") or die(mysqli_error($db))) {
			$stringDest = '%' . $_GET['searchDestination'] . '%';
			$stmt->bind_param('s', $stringDest);
			$stmt->execute();
			$stmt->bind_result($name, $address, $cuisine, $price, $rating, $destination);
			while($stmt->fetch()) {
				echo "<tr><td>Food</td><td>$name</td><td>$cuisine</td><td>$price</td><td>$address</td></tr>";
			}
		}
		if($stmt->prepare("select * from tours where destination like ?") or die(mysqli_error($db))) {
			$stringDest = '%' . $_GET['searchDestination'] . '%';
			$stmt->bind_param('s', $stringDest);
			$stmt->execute();
			$stmt->bind_result($destination, $price, $type, $rating, $name);
			while($stmt->fetch()) {
				echo "<tr><td>Tour</td><td>$name</td><td>$type</td><td>$price</td><td>$destination</td></tr>";
			}
		}
		echo "</table>";
	
		$stmt->close();
	}else if($stringType=="Food"){
		if($stmt->prepare("select * from restaurants where destination like ?") or die(mysqli_error($db))) {
			$stringDest = '%' . $_GET['searchDestination'] . '%';
			$stmt->bind_param('s', $stringDest);
			$stmt->execute();
			$stmt->bind_result($name, $address, $cuisine, $price, $rating, $destination);
			while($stmt->fetch()) {
				echo "<tr><td>Food</td><td>$name</td><td>$cuisine</td><td>$price</td><td>$address</td></tr>";
			}
		}
		echo "</table>";
	
		$stmt->close();
	}else if($stringType=="Tour"){
		if($stmt->prepare("select * from tours where destination like ?") or die(mysqli_error($db))) {
			$stringDest = '%' . $_GET['searchDestination'] . '%';
			$stmt->bind_param('s', $stringDest);
			$stmt->execute();
			$stmt->bind_result($destination, $price, $type, $rating, $name);
			while($stmt->fetch()) {
				echo "<tr><td>Tour</td><td>$name</td><td>$type</td><td>$price</td><td>$destination</td></tr>";
			}
		}
		echo "</table>";
	
		$stmt->close();
	}else{
		if($stmt->prepare("select * from attractions where destination like ? AND type=?") or die(mysqli_error($db))) {
			$stringDest = '%' . $_GET['searchDestination'] . '%';
			$stringType = $_GET['searchCategory'];
			$stmt->bind_param('ss', $stringDest, $stringType);
			$stmt->execute();
			$stmt->bind_result($type, $price, $name, $address, $destination);
			while($stmt->fetch()) {
				echo "<tr><td>Attraction</td><td>$name</td><td>$type</td><td>$price</td><td>$address</td></tr>";
			}
		}
		echo "</table>";
	
		$stmt->close();
	}
	
	$db->close();


?>