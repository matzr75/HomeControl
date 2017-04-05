
<!-- <html> 
<head>
<link href="Reinagl.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="Navigation">
	 <?//php include("OHlog_Navigation.php");?>
</div>
<div id="Content">-->
<?php
echo "Hello World<br>";
echo "item = " . $_POST["item"]
if (isset($_POST["item"]))
{
	$table = "Item" . $_POST["item"];

	// Setup Database Connection
	if (!class_exists('myDB')) {include "DBConnect.php";}
	$db = new myDB("openHAB");

	if (!is_null($db) ) {
		$result = mysqli_fetch_row(mysqli_query($db->con,"Select ItemName FROM Items WHERE ItemId = ".$_POST["item"]));
		echo"<h1>" . $result[0] . "</h1>";
		$orderField = "Time";
		$orderDir = "DESC";
		$result = mysqli_query($db->con,"SELECT Time, value FROM " . $table . " ORDER BY " . $orderField . " " . $orderDir);
		$list = array();

		echo "
		<table>
			<colgroup>
    			<col width='200'>
	    		<col width='150'>
  			</colgroup>
		<tr>
			<th>Zeit</th>
			<th>Wert</th>
		</tr>";

		while($row = mysqli_fetch_array($result))
		{
			$List[$row['Time']] = $row['value'];
			echo "<tr>";
				echo "<td>" . $row['Time'] . "</td>";
				echo "<td>" . $row['value'] . "</td>";
		}

	echo "</table>";
	}
}
?>
<!-- </div>

</body>
</html> -->
