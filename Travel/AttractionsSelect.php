<!DOCTYPE html>
<table id = "myAttractions">
    <br/><h1>Things to Do<h1>
    <tr align = center>
        <th>Category</th><th>Name</th><th>Type</th><th>Price</th><th>Location</th>
    </tr>
<?php 
	include_once('./library.php'); 
	$con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE); 
	// Check connection 
	if (mysqli_connect_errno()) { 
		echo("Can't connect to MySQL Server. Error code: " . mysqli_connect_error()); 
		return null; 
	} 
	// Form the SQL query (a SELECT query)
	$dest = $_POST["destination"];
	$category = $_POST["category"];
	if($category == "food"){
		$sql= "SELECT * FROM restaurants WHERE destination LIKE '%" . $dest . "%' ORDER BY name"; 
		$result = mysqli_query($con,$sql); 
		// Print the data from the table row by row 
		while($row = mysqli_fetch_array($result)) { 
			$name = $row['name'];
			$type = $row['cuisine'];
			$price = $row['price'];
			$address = $row['address'];
			echo "<td>Food</td>";
			echo "<td>$name</td>"; 
			echo "<td>$type</td>"; 
			echo "<td>$$price</td>";
			echo "<td>$address</td>";  
			echo "</tr>";
		} 
	}else if ($category == "tour"){
		$sql= "SELECT * FROM tours WHERE destination LIKE '%" . $dest . "%' ORDER BY name"; 
		$result = mysqli_query($con,$sql); 
		// Print the data from the table row by row 
		while($row = mysqli_fetch_array($result)) { 
			$name = $row['name'];
			$type = $row['type'];
			$price = $row['price'];
			$address = $row['destination'];
			echo "<td>Tour</td>";
			echo "<td>$name</td>"; 
			echo "<td>$type</td>"; 
			echo "<td>$$price</td>";
			echo "<td>$address</td>";  
			echo "</tr>";
		} 
	}else{
		if($category == NULL){
			$sql= "SELECT * FROM attractions WHERE destination LIKE '%" . $dest . "%' ORDER BY name"; 
			$result = mysqli_query($con,$sql); 
			// Print the data from the table row by row 
			while($row = mysqli_fetch_array($result)) { 
				$name = $row['name'];
				$type = $row['type'];
				$price = $row['price'];
				$address = $row['address'];
				echo "<td>Attraction</td>";
				echo "<td>$name</td>"; 
				echo "<td>$type</td>"; 
				echo "<td>$$price</td>";
				echo "<td>$address</td>";  
				echo "</tr>";
			} 
			$sql= "SELECT * FROM tours WHERE destination LIKE '%" . $dest . "%' ORDER BY name"; 
			$result = mysqli_query($con,$sql); 
			// Print the data from the table row by row 
			while($row = mysqli_fetch_array($result)) { 
				$name = $row['name'];
				$type = $row['type'];
				$price = $row['price'];
				$address = $row['destination'];
				echo "<td>Tour</td>";
				echo "<td>$name</td>"; 
				echo "<td>$type</td>"; 
				echo "<td>$$price</td>";
				echo "<td>$address</td>";  
				echo "</tr>";
			} 
			$sql= "SELECT * FROM restaurants WHERE destination LIKE '%" . $dest . "%' ORDER BY name"; 
			$result = mysqli_query($con,$sql); 
			// Print the data from the table row by row 
			while($row = mysqli_fetch_array($result)) { 
				$name = $row['name'];
				$type = $row['cuisine'];
				$price = $row['price'];
				$address = $row['address'];
				echo "<td>Food</td>";
				echo "<td>$name</td>"; 
				echo "<td>$type</td>"; 
				echo "<td>$$price</td>";
				echo "<td>$address</td>";  
				echo "</tr>";
			} 
		}else{
			$sql= "SELECT * FROM attractions WHERE destination LIKE '%" . $dest . "%' AND type='". $category ."' ORDER BY name"; 
			$result = mysqli_query($con,$sql); 
			// Print the data from the table row by row 
			while($row = mysqli_fetch_array($result)) { 
				$name = $row['name'];
				$type = $row['type'];
				$price = $row['price'];
				$address = $row['address'];
				echo "<td>$category</td>"; 
				echo "<td>$name</td>"; 
				echo "<td>$type</td>"; 
				echo "<td>$$price</td>";
				echo "<td>$address</td>";  
				echo "</tr>";
			} 
		}
	}

	mysqli_close($db_connection); 
?> 
</table>
</html>