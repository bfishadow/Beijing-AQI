<?php
	do {
		// Get data from US Embassy in Beijing
		//
		// All data sources are:
		// http://www.stateair.net/web/rss/1/1.xml Beijing
		// http://www.stateair.net/web/rss/1/2.xml Chengdu
		// http://www.stateair.net/web/rss/1/3.xml Guangzhou
		// http://www.stateair.net/web/rss/1/4.xml Shanghai
		// http://www.stateair.net/web/rss/1/5.xml Shenyang

		// echo "Fetching data...<br />\n";
		$url = "http://www.stateair.net/web/rss/1/1.xml"; // Change the data source if you want
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$xml = curl_exec($ch);
		curl_close($ch);
	} while (strlen($xml) < 1000);

	// echo "Data reday, ".strlen($xml)." bytes.<br />\n";
	// echo "Writing...<br />\n";

	// Write the data into local cache
	$objFile = fopen('data.txt', 'w');
	fwrite($objFile, $xml);
	fclose($objFile);

	// echo "Done!<br />\n";
?>