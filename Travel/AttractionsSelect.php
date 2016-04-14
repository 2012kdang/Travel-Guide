<!DOCTYPE html>
<table id = "myAttractions">
    <br/><h1>Attractions<h1>
    <tr align = center>
        <th>Name</th><th>Type</th><th>Price</th><th>Address</th>
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
	$sql= "SELECT * FROM attractions ORDER BY name"; 
	$result = mysqli_query($con,$sql); 
	// Print the data from the table row by row 
	while($row = mysqli_fetch_array($result)) { 
		$name = $row['name'];
		$type = $row['type'];
		$price = $row['price'];
		$address = $row['address'];
		echo "<td>$name</td>"; 
		echo "<td>$type</td>"; 
		echo "<td>$$price</td>";
		echo "<td>$address</td>";  
		echo "</tr>";
	} 
	mysqli_close($db_connection); 
?> 
</table>
</html>