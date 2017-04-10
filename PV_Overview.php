<?php
// Setup Database Connection
echo "<h1>Übersicht Photovoltaik</h1>";
if (!class_exists('myDB')) {include "DBConnect.php";}
$db = new myDB("PV");

if (!is_null($db) ) {
	$orderField = "day";
	$orderDir = "DESC";
	$sql = "
		SELECT t1.day, 
			t1.Stromverbrauch, 
			t1.Produktion, ,
			t1.Einspeisung, 
			t1.Eigenverbrauch, 
			(	select RateValue 
				from T_Rates 
				where RateType = 'Ertrag_je_kWH' 
					and DateFrom <= t1.day 
					and (DateTo >= t1.day OR DateTo is NULL)
			)*Einspeisung/1000 as Ertrag_Einspeisung, 
			(
				select RateValue 
				from T_Rates 
				where RateType = 'Kosten_je_kWH' 
					and DateFrom <= t1.day 
					and (DateTo >= t1.day OR DateTo isNULL)
			)*Eigenverbrauch/1000 as Ertrag_Eigennutzung 
		FROM `V_OVERVIEW` t1
		ORDER BY " . $orderField . " " . $orderDir;
	$result = mysqli_query($db->con, $sql);
	$list = array();

	echo "
	<table>
	<tr>
		<th>Tag</th>
		<th>Verbrauch</th>
		<th>Produktion</th>
		<th>Einspeisung</th>
		<th>Eigenverbrauch</th>
		<th>Ertrag Eingennutzung</th>
		<th>Ertrag Einspeisung</th>
		<th>Gesamtertrag</th>
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
			echo "<td>" . $row['Eigenverbrauch'] . "</td>";
			echo "<td>" . $row['Ertrag_Eingennutzung'] . "</td>";
			echo "<td>" . $row['Ertrag_Einspeisung'] . "</td>";
			echo "<td>" . ($row['Ertrag_Eingennutzung'] + $row['Ertrag_Einspeisung']) . "</td>";
	}

	echo "</table>";
//	}*/
}
?>
