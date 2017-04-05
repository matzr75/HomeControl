<html>
<body>
<h1>HomeControl Log</h1>
<br>
<br>

<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);

	echo"<form>";

        // Setup Database Connection
        if (!class_exists('myDB')) {include "DBConnect.php";}
        $db2 = new myDB("openHAB");

        if (!is_null($db2) ) {
                $result = mysqli_query($db2->con,"SELECT ItemName, ItemId FROM Items ORDER BY ItemName");
                $list = array();
	}

	echo "<table>
		<tr><td><button name='PV' type='button' onclick=''>Photovoltaik Übersicht</button>
		</td></tr>
		<tr><td>OpenHAB Log:<br>
        		<select name='OH_item' onchange='loadDoc(''' OHlog.php?item=''' + this.value)'>
	        	<option value=''>Auswahl...</option>";
		
        		while($row = mysqli_fetch_array($result))
        		{
               			echo "<option value=".$row['ItemId'].">".$row['ItemName']."</option>";
         		}
        		echo"</select>";
		echo "</td></tr>
		<tr><td><button name='Status' type='button' onclick=loadDoc('Status.php')>Server Status</button>
		</td></tr>
		</table>";
	echo"</form>";
?>
</body>
</html>
