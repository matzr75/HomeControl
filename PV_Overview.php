<?php
// Setup Database Connection
echo "<h1>Übersicht Photovoltaik</h1>";
if (!class_exists('myDB')) {include "DBConnect.php";}
$db = new myDB("PV");

if (!is_null($db) ) {
	$orderField = "day";
	$orderDir = "DESC";
	$sql = "
		SELECT day,
			Stromverbrauch,
			Produktion,
			Einspeisung,
			Eigenverbrauch, 
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
					and (DateTo >= t1.day OR DateTo is NULL)
			)*Eigenverbrauch/1000 as Ertrag_Eigennutzung 
		FROM `V_OVERVIEW` t1
		ORDER BY " . $orderField . " " . $orderDir;
	echo $sql;
	echo $result = mysqli_query($db->con, $sql);
	$list = array();
echo $result;
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
<!--		<th>Gesamtertrag</th>-->
	</tr>";

	echo "<tr><td>1</td>";
	echo "<td>2</td>";
	echo "<td>3</td>";
	echo "<td>4</td>";
	echo "<td>5</td>";
	echo "<td>6</td>";
	echo "<td>7</td></tr>";
	while($row = mysqli_fetch_array($result))
	{
	//	$List[$row['Time']] = $row['value'];
		echo "<tr>";
			echo "<td>" . $row['day'] . "</td>";
			echo "<td>" . $row['Stromverbrauch'] . "</td>";
			echo "<td>" . $row['Produktion'] . "</td>";
			echo "<td>" . $row['Einspeisung'] . "</td>";
			echo "<td>" . $row['Eigenverbrauch'] . "</td>";
			echo "<td>" . $row['Ertrag_Eigennutzung'] . "</td>";
			echo "<td>" . $row['Ertrag_Einspeisung'] . "</td>";
//			echo "<td>" . ($row['Ertrag_Eingennutzung'] + $row['Ertrag_Einspeisung']) . "</td>";
		echo "</tr>";
	}

	echo "</table>";
}
?>
