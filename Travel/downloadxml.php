<?php
header('Content-type: text/xml');
header('Content-Disposition: attachment; filename="feedbackDownload.xml"');
include 'library.php';
$connected = mysqli_connect($SERVER, $USERNAME, $PASSWORD, $DATABASE); 

$query = "SELECT * FROM feedback";
	$result = $connected->query($query);

	$string = "<form>";
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
    $xml = new SimpleXMLElement($string);

    ob_clean(); 
	//print($xml->asXML());

	$dom = new DOMDocument('1.0');
	$dom->preserveWhiteSpace = false;
	$dom->formatOutput = true;
	$dom->loadXML($xml->asXML());
	echo $dom->saveXML();

?>