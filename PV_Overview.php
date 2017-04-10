<?php
// Setup Database Connection
echo "<h1>Übersicht Photovoltaik</h1>";
if (!class_exists('myDB')) {include "DBConnect.php";}
$db = new myDB("PV");

if (!is_null($db) ) {
	$result = mysqli_fetch_row(mysqli_query($db->con, "SELECT max(DateTime) FROM T_PowerLog"));
	echo "<div style='text-align: right; font-size: 75%; font-style:italic'>last Update: " . $result[0];

	$result_week = mysqli_fetch_row(mysqli_query($db->con, "SELECT 'Diese Woche', sum(Stromverbrauch), sum(Produktion), sum(Einspeisung), sum(Eigenverbrauch), sum(Einsparung_Eigennutzung), sum(Ertrag_Einspeisung) FROM V_OVERVIEW_Income WHERE day >= curdate() - INTERVAL DAYOFWEEK(curdate())-2 DAY"));
	$result_month = mysqli_fetch_row(mysqli_query($db->con, "SELECT 'Dieser Monat', sum(Stromverbrauch), sum(Produktion), sum(Einspeisung), sum(Eigenverbrauch), sum(Einsparung_Eigennutzung), sum(Ertrag_Einspeisung) FROM  V_OVERVIEW_Income where month(day) = month(curdate())"));
	
	$orderField = "day";
	$orderDir = "DESC";
	$sql = "SELECT day, Stromverbrauch, Produktion, Einspeisung, Eigenverbrauch, Ertrag_Einspeisung, Einsparung_Eigennutzung FROM V_OVERVIEW_Income ORDER BY " . $orderField . " " . $orderDir;
	if( !($result = mysqli_query($db->con, $sql))) {
		echo "Query FAILED !!!";
	} 

	echo "
	<table>
	<tr>
		<th>Tag</th>
		<th>Verbrauch<br>[kWh]</th>
		<th>Produktion<br>[kWh]</th>
		<th>Einspeisung<br>[kWh]</th>
		<th>Eigenverbrauch<br>[kWh]</th>
		<th>Ertrag Eingennutzung<br>[€]</th>
		<th>Ertrag Einspeisung<br>[€]</th>
		<th>Gesamtertrag<br>[€]</th>
	</tr>

	<tr>
		<td style='text-align: left'>$result_week[0]</td>
		<td style='text-align: right'>" . number_format($result_week[1]/1000, 1) . "</td>
		<td style='text-align: right'>" . number_format($result_week[2]/1000, 1) . "</td>
		<td style='text-align: right'>" . number_format($result_week[3]/1000, 1) . "</td>
		<td style='text-align: right'>" . number_format($result_week[4]/1000, 1) . "</td>
		<td style='text-align: right'>" . number_format($result_week[5], 2) . "</td>
		<td style='text-align: right'>" . number_format($result_week[6], 2) . "</td>
		<td style='text-align: right'>" . number_format(($result_week[5] + $result_week[6]), 2) . "</td>
	</tr>
	<tr>
		<td style='text-align: left'>$result_month[0]</td>
		<td style='text-align: right'>" . number_format($result_month[1]/1000, 1) . "</td>
		<td style='text-align: right'>" . number_format($result_month[2]/1000, 1) . "</td>
		<td style='text-align: right'>" . number_format($result_month[3]/1000, 1) . "</td>
		<td style='text-align: right'>" . number_format($result_month[4]/1000, 1) . "</td>
		<td style='text-align: right'>" . number_format($result_month[5], 2) . "</td>
		<td style='text-align: right'>" . number_format($result_month[6], 2) . "</td>
		<td style='text-align: right'>" . number_format(($result_month[5] + $result_month[6]), 2) . "</td>
	</tr>
	<tr><td colspan='8'></td></tr>";

	while($row = mysqli_fetch_array($result))
	{
		echo "<tr>";
			echo "<td>" . $row['day'] . "</td>";
			echo "<td style='text-align: right'>" . number_format($row['Stromverbrauch']/1000, 1) . "</td>";
			echo "<td style='text-align: right'>" . number_format($row['Produktion']/1000, 1) . "</td>";
			echo "<td style='text-align: right'>" . number_format($row['Einspeisung']/1000, 1) . "</td>";
			echo "<td style='text-align: right'>" . number_format($row['Eigenverbrauch']/1000, 1) . "</td>";
			echo "<td style='text-align: right'>" . number_format($row['Einsparung_Eigennutzung'], 2) . "</td>";
			echo "<td style='text-align: right'>" . number_format($row['Ertrag_Einspeisung'], 2) . "</td>";
			echo "<td style='text-align: right'>" . number_format(($row['Einsparung_Eigennutzung'] + $row['Ertrag_Einspeisung']), 2) . "</td>";
		echo "</tr>";
	}

	echo "</table>";
}
?>
