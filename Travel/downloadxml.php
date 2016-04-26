<?php
header('Content-type: text/xml');
header('Content-Disposition: attachment; filename="feedbackDownload.xml"');
include 'library.php';
$connected = mysqli_connect($SERVER, $USERNAME, $PASSWORD, $DATABASE); 

$query = "SELECT * FROM feedback";
$result = $connected->query($query);
    
    $string = "<info>";
	$string .= "<form>";
	echo "<table style=\"width:100%\">";
	echo "<tr>";
	echo "<td>Username</td> <td>Subject</td> <td>Feedback</td>";
	echo "</tr>";
	if ($result->num_rows > 0) { //if # rows > 0
    	while($row = $result->fetch_assoc()) {
    		$string .= '<feedback>';
    		echo "<tr>";
    		echo "<td>" . $row['username'] . "</td>";
    		echo "<td>" . $row['subject'] . "</td>";
    		echo "<td>" . $row['feedback'] . "</td>";
    		echo "</tr>";

    		$string .= '<username>' . $row['username'] . '</username>';
    		$string .= '<subject>' . $row['subject'] . '</subject>';
    		$string .= '<comment>' . $row['feedback'] . '</comment>';

    		$string .= '</feedback>';
    	}
    }
    $string .= "</form>";
    echo "</table>";

    echo "<table style=\"width:100%\">";
    $string .= "<usersList>";
    echo "<tr>";
    echo "<td>Username</td> <td>Email</td>";
    echo "</tr>";
    $query = "SELECT username, email FROM users";
    $result = $connected->query($query);
    if ($result->num_rows > 0) { //if # rows > 0
        while($row = $result->fetch_assoc()) {
            $string .= "<user>";
            echo "<tr>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "</tr>";
            $string .= "<username>" . $row['username'] . "</username>";
            $string .= "<email>" . $row['email'] . "</email>";
            $string .= "</user>";
        }
    }
    
    $string .= "</usersList>";
    echo "</table>";
    
    echo "<table stype=\"width:100%\">";
    $string .= "<attractionsList>";
    echo "<tr>";
    echo "<td>Type</td> <td>Price</td> <td>Name</td> <td>Street</td> <td>City</td> <td>Country</td>";
    echo "</tr>";

    $query = "SELECT * FROM attractions";
    $result = $connected->query($query);
    if ($result->num_rows > 0) { //if # rows > 0
        while($row = $result->fetch_assoc()) {
            $string .= "<attraction>";
            echo "<tr>";
            echo "<td>" . $row['type'] . "</td>";
            echo "<td>" . $row['price'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['street'] . "</td>";
            echo "<td>" . $row['city'] . "</td>";
            echo "<td>" . $row['country'] . "</td>";
            //echo "<td>" . $row['state'] . "</td>";
            echo "</tr>";
            $string .= "<type>" . $row['type'] . "</type>";
            $string .= "<price>" . $row['price'] . "</price>";
            $string .= "<name>" . $row['name'] . "</name>";
            $string .= "<street>" . $row['street'] . "</street>";
            $string .= "<city>" . $row['city'] . "</city>";
            $string .= "<country>" . $row['country'] . "</country>";
            //$string .= "<state>" . $row['state'] . "</state>";
            $string .= "</attraction>";
        }
    }

    $string .= "</attractionsList>";
    echo "</table>"; 

    $string .= "</info>";

    $xml = new SimpleXMLElement($string);

    ob_clean(); 
	//print($xml->asXML());

	$dom = new DOMDocument('1.0');
	$dom->preserveWhiteSpace = false;
	$dom->formatOutput = true;
	$dom->loadXML($xml->asXML());
	echo $dom->saveXML();

?>