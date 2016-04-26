
<?php
	require "dbutil.php";
	$db = DbUtil::loginConnection();
	
	$stmt = $db->stmt_init();

	$stringDest = $_GET['searchDestination'];
	$stringType = $_GET['searchCategory'];

	echo "<table border=1><th>Category</th><th>Name</th><th>Type</th><th>Price</th><th>Location</th>\n";

	if($stringType==NULL){
		if($stmt->prepare("select * from attractions where city like ? OR country like ? OR state like ?") or die(mysqli_error($db))) {
			$stringDest = '%' . $_GET['searchDestination'] . '%';
			$stmt->bind_param('sss', $stringDest, $stringDest, $stringDest);
			$stmt->execute();
			$stmt->bind_result($type, $price, $name, $street, $city, $country, $state);
			while($stmt->fetch()) {
				$address = $street . " " . $city . " " . $state . " " . $country;
				echo "<tr><td>Attraction</td><td>$name</td><td>$type</td><td>$price</td><td>$address</td></tr>";
			}
		}
		if($stmt->prepare("select * from restaurants where city like ? OR country like ? OR state like ?") or die(mysqli_error($db))) {
			$stringDest = '%' . $_GET['searchDestination'] . '%';
			$stmt->bind_param('sss', $stringDest, $stringDest, $stringDest);
			$stmt->execute();
			$stmt->bind_result($name, $cuisine, $price, $rating, $street, $city, $state, $country);
			while($stmt->fetch()) {
				$address = $street . " " . $city . " " . $state . " " . $country;
				echo "<tr><td>Food</td><td>$name</td><td>$cuisine</td><td>$price</td><td>$address</td></tr>";
			}
		}
		if($stmt->prepare("select * from tours where city like ? OR country like ? OR state like ?") or die(mysqli_error($db))) {
			$stringDest = '%' . $_GET['searchDestination'] . '%';
			$stmt->bind_param('sss', $stringDest, $stringDest, $stringDest);
			$stmt->execute();
			$stmt->bind_result($price, $type, $rating, $name, $city, $country, $state);
			while($stmt->fetch()) {
				$address = $city . " " . $state . " " . $country;
				echo "<tr><td>Tour</td><td>$name</td><td>$type</td><td>$price</td><td>$address</td></tr>";
			}
		}
		echo "</table>";
	
		$stmt->close();
	}else if($stringType=="Food"){
		if($stmt->prepare("select * from restaurants where city like ? OR country like ? OR state like ?") or die(mysqli_error($db))) {
			$stringDest = '%' . $_GET['searchDestination'] . '%';
			$stmt->bind_param('sss', $stringDest,$stringDest,$stringDest);
			$stmt->execute();
			$stmt->bind_result($name, $cuisine, $price, $rating, $street, $city, $state, $country);
			while($stmt->fetch()) {
				$address = $street . " " . $city . " " . $state . " " . $country;
				echo "<tr><td>Food</td><td>$name</td><td>$cuisine</td><td>$price</td><td>$address</td></tr>";
			}
		}
		echo "</table>";
	
		$stmt->close();
	}else if($stringType=="Tour"){
		if($stmt->prepare("select * from tours where city like ? OR country like ? OR state like ?") or die(mysqli_error($db))) {
			$stringDest = '%' . $_GET['searchDestination'] . '%';
			$stmt->bind_param('sss', $stringDest, $stringDest, $stringDest);
			$stmt->execute();
			$stmt->bind_result($price, $type, $rating, $name, $city, $country, $state);
			while($stmt->fetch()) {
				$address = $city . " " . $state . " " . $country;
				echo "<tr><td>Tour</td><td>$name</td><td>$type</td><td>$price</td><td>$address</td></tr>";
			}
		}
		echo "</table>";
	
		$stmt->close();
	}else{
		if($stmt->prepare("select * from attractions where (country like ? OR state like ? OR city like ?) AND type=?") or die(mysqli_error($db))) {
			$stringDest = '%' . $_GET['searchDestination'] . '%';
			$stringType = $_GET['searchCategory'];
			$stmt->bind_param('ssss', $stringDest, $stringDest, $stringDest, $stringType);
			$stmt->execute();
			$stmt->bind_result($type, $price, $name, $street, $city, $country, $state);
			while($stmt->fetch()) {
				$address = $street . " " . $city . " " . $state . " " . $country;
				echo "<tr><td>Attraction</td><td>$name</td><td>$type</td><td>$price</td><td>$address</td></tr>";
			}
		}
		echo "</table>";
	
		$stmt->close();
	}
	
	$db->close();


?>