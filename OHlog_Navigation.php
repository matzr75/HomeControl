<html>
<body>
<h1>HomeControl Log</h1>
<br>
<br>

<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);

	echo"<form action='OHlog.php' method='post'>";

        // Setup Database Connection
        if (!class_exists('myDB')) {include "DBConnect.php";}
        $db2 = new myDB("openHAB");

        if (!is_null($db2) ) {
                $result = mysqli_query($db2->con,"SELECT ItemName, ItemId FROM Items ORDER BY ItemName");
                $list = array();
	}

        echo "Item Liste<br>";
        echo "<select name='item' onchange='this.form.submit();'>
        	<option value=''>Auswahl...</option>";

        while($row = mysqli_fetch_array($result))
        {
               echo "<option value=".$row['ItemId'].">".$row['ItemName']."</option>";
         }
        echo"</select>";
	echo"</form>";
?>
</body>
</html>
