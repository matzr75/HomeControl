<?php
// Setup Database Connection
if (!class_exists('myDB')) {include "DBConnect.php";}
$db = new myDB("PV");

if (!is_null($db) ) {
	$orderField = "Day";
	$orderDir = "DESC";
	$result = mysqli_query($db->con,"SELECT day, Stromverbrauch, Produktion, Einspeisung, Eigenverbrauch FROM V_OVERVIEW ORDER BY " . $orderField . " " . $orderDir);
	$list = array();

	echo "
	<table>
	<tr>
		<th>Tag</th>
		<th>Verbrauch</th>
		<th>Produktion</th>
		<th>Einspeisung</th>
		<th>Eigenverbrauch</th>
	</tr>";

	while($row = mysqli_fetch_array($result))
	{
	//	$List[$row['Time']] = $row['value'];
		echo "<tr>";
			echo "<td>" . $row['day'] . "</td>";
			echo "<td>" . $row['Stromverbrauch'] . "</td>";
			echo "<td>" . $row['Produktion'] . "</td>";
			echo "<td>" . $row['Einspeisung'] . "</td>";
			echo "<td>" . $row['Eigenverbrauch'] . "</td>";
	}

	echo "</table>";
	}
}
?>
