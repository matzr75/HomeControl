
<?php
	echo "<h1>Server Status</h1>";
	// get IP address
	$externalContent = file_get_contents('http://checkip.dyndns.com/');
	preg_match('/Current IP Address: \[?([:.0-9a-fA-F]+)\]?/', $externalContent, $m);
	$externalIp = $m[1];

	// check HDD parameters
	$df_main = disk_free_space("/");
	$df_main_pct = ($df_main / disk_total_space("/")) * 100;
	$df_main = $df_main / 1024 ** 3;
	$df_daten = disk_free_space("/media/daten");
	$df_daten_pct = $df_daten / (disk_total_space("/media/daten")) * 100;
	$df_daten = $df_daten / 1024 ** 3;
	// RAID1 still missing....

	// get openHAB logfile
	$openHABlog = file("/var/log/openhab2/openhab.log");

	// Show content	
	echo "Externe IP: " . $externalIp . "<br><br>";
	echo "Freier Plattenplatz auf '/': " . number_format($df_main, 1, ",", ".") . "GB (" . number_format($df_main_pct, 1) . "%)<br>";
	echo "Freier Plattenplatz auf '/daten': " . number_format($df_daten, 1, ",", ".") . "GB (" . number_format($df_daten_pct, 1) . "%)<br><br>";
	
	echo "Current PHP version: " . phpversion() . "<br><br>";

	$logLength = count($openHABlog);
	for($i = $logLength; $i > ($logLength - 50); $i--) {
		$logLine = $openHABlog[$i];
		if (strpos($logLine, "[ERROR]")>0) {
			echo "<log class='ERROR'>";
		} elseif (strpos($logLine, "[WARN")>0) {
			echo "<log class='WARNING'>";
		} else {
			echo "<log class='INFO'>";
		}
		echo $logLine . "</log><br>";
	}

?>