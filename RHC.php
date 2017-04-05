<html>
<head>
<link href="Reinagl.css" rel="stylesheet" type="text/css">
</head>
<body>
<script>
function loadDoc(itemName) {
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("Content").innerHTML = this.responseText;
    }
  };
  xhttp.open("POST", "OHlog.php?item=" + itemName, true);
  xhttp.send();
}

</script>
<div id="Navigation">
	<?php
	include("RHC_Navigation.php");
	/*echo"<form action='OHlog.php' method='post'>";
        // Setup Database Connection
        if (!class_exists('myDB')) {include "DBConnect.php";}
        $db2 = new myDB("openHAB");
        if (!is_null($db2) ) {
                $result = mysqli_query($db2->con,"SELECT ItemName, ItemId FROM Items ORDER BY ItemName");
                $list = array();
	}
	echo "<table>
		<tr><td><button name='PV' type='button' onclick='this.form.submit();'>Photovoltaik Übersicht</button>
		</td></tr>
		<tr><td>OpenHAB Log:<br>
        		<select name='OH_item' onchange='this.form.submit();'>
	        	<option value=''>Auswahl...</option>";
		
        		while($row = mysqli_fetch_array($result))
        		{
               			echo "<option value=".$row['ItemId'].">".$row['ItemName']."</option>";
         		}
        		echo"</select>";
		echo "</td></tr>
		<tr><td><button name='Status' type='button' onclick='this.form.submit();'>Server Status</button>
		</td></tr>
		</table>";
	echo"</form>";	*/	
	?>
</div>
<div id="Content">

</div>

</body>
</html>
