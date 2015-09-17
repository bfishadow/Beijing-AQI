<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta id="viewport" name="viewport" content="width=384,initial-scale=0.83,minimum-scale=0.83,maximum-scale=1.0">
<link href="icon060.png" rel="apple-touch-icon" />
<link href="icon076.png" rel="apple-touch-icon" sizes="76x76" />
<link href="icon120.png" rel="apple-touch-icon" sizes="120x120" />
<link href="icon152.png" rel="apple-touch-icon" sizes="152x152" />

<title>Beijing Air</title>
	<style>
	*  {font-size:12px; font-family:Arial;}
	h1 {font-size:26px; text-align:center; padding-top:8px; padding-bottom:8px;}
	h2 {font-size:16px; text-align:center;}
	</style>
</head>
<body style="width:380px; padding:2px; margin:0px;">
<?php

	// Start Copy and Paste
	// My functions
	function getBetween($str ,$start, $end) { //getBetween: get the sub string
		$content = strstr( $str, $start ); 
		$content = substr( $content, strlen( $start ), strpos( $content, $end ) - strlen( $start ) ); 
		return $content; 
	}

	function getAPL($AQI){ //getAPL: get air polution level description
		$StrAPL = "n/a";
		if ($AQI < 0) {
			$StrAPL = "n/a";
		} elseif ($AQI < 50) {
			$StrAPL = "Good";
		} elseif ($AQI < 100) {
			$StrAPL = "Moderate";
		} elseif ($AQI < 150) {
			$StrAPL = "Unhealthy for Sensitive Groups";
		} elseif ($AQI < 200) {
			$StrAPL = "Unhealthy";
		} elseif ($AQI < 300) {
			$StrAPL = "Very Unhealthy";
		} elseif ($AQI < 500) {
			$StrAPL = "Hazardous";
		} elseif ($AQI > 499) {
			$StrAPL = "Beyond Index";
		} else {
			$StrAPL = "n/a";
		}
		return $StrAPL;
	}

	function getAQIColor($AQI){ //getAQIColor: get color code set for differenct level
		$StrAQIColor = "color:#FFFFFF;background:#000000;";		//Error
		if ($AQI < 0) {
			$StrAQIColor = "color:#FFFFFF;background:#000000;";	//Error
		} elseif ($AQI < 50) {
			$StrAQIColor = "color:#000000;background:#00E400;";	//Good
		} elseif ($AQI < 100) {
			$StrAQIColor = "color:#000000;background:#FFFF00;";	//Moderate
		} elseif ($AQI < 150) {
			$StrAQIColor = "color:#FFFFFF;background:#FF7E00;";	//Unhealthy for Sensitive Groups
		} elseif ($AQI < 200) {
			$StrAQIColor = "color:#FFFFFF;background:#FF0000;";	//Unhealthy
		} elseif ($AQI < 300) {
			$StrAQIColor = "color:#FFFFFF;background:#99004C;";	//Very Unhealthy
		} elseif ($AQI < 500) {
			$StrAQIColor = "color:#FFFFFF;background:#4C0026;";	//Hazardous
		} elseif ($AQI > 500) {
			$StrAQIColor = "color:#FFFFFF;background:#575757;";	//Beyond Index (aka Crazy Bad)
		} else {
			$StrAQIColor = "color:#FFFFFF;background:#000000;";
		}
		return $StrAQIColor;
	}

	// Get data from local cache
	$StrFilename = "data.txt";
	$objFile = fopen($StrFilename, "r");
	$xml = fread($objFile, filesize($StrFilename));
	fclose($objFile);

	// Break the xml data into an array
	$ArrAQI = split("<item>", $xml);

	// Print latest AQI
	$StrLastUpdate = getBetween($ArrAQI[1], '<title>', '</title>');
	$StrLatestAQI  = getBetween($ArrAQI[1], '<AQI>'  , '</AQI>');

	echo "<h1 style=\"".getAQIColor($StrLatestAQI)."\">".$StrLatestAQI." / ".getAPL($StrLatestAQI)."</h1>\n";
	echo "<em>Last update: ".$StrLastUpdate." CST</em><br /><br />\n";

	// Print last 24h AQI chart
	echo "<strong>24 hours</strong><br />\n\n";
	echo "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"380\">\n";
	for ($i = 1; $i <= 24; $i++) {
		$StrTime   = strtotime(getBetween($ArrAQI[$i], '<title>', '</title>'));
		$StrAQI    = getBetween($ArrAQI[$i], '<AQI>'  , '</AQI>');
		$intAQI    = intval($StrAQI);
		$intLength = abs($intAQI/1);
		if ($intLength > 330 ) {
			$intLength = 330;
		}

		echo "<tr>\n";
		echo "	<td width=\"50\">".date('g A', $StrTime)."</td>\n";
		echo "	<td width=\"330\"><div style=\"".getAQIColor($StrAQI)."width:".$intLength."px;\">".$StrAQI."</div></td>\n";
		echo "</tr>\n";
	}
	echo "</table>\n\n";

	// Wrap up
	echo "Server Time: <em>".date('m/d/Y g:i:s A')."</em><br />\n";

	// Debug - Start
	// Debug - End
	// End of Copy and Paste
?>
</body>
</html>