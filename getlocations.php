<?php


	//Distance Calculation SQL
	//31.3296966, -89.2954820 - USM
	//$lat = 31.3296966;
	//$lon = -89.2954820;
	//$distance = 17;
	//$sql = "SELECT zip_code, ( 3959 * acos( cos( radians($lat) ) * cos( radians( lat ) ) * cos( radians( lon) - radians($lon) ) + sin( radians($lat) ) * sin( radians( lat ) ) ) ) AS distance FROM zip_code HAVING distance < $distance ORDER BY distance";
	
	//Select state_prefix from zip_code where state_name = "Mississippi" limit 0,1
	
	
	//Do generic processing, App selection is mostly for output
	require('mysqli.inc.php');
	$Materials	= $_POST[Materials];
	$CityState	= $_POST[CityState];
	$ZipCode	= $_POST[ZipCode];
	if (!isset($ZipCode) || $ZipCode == null) {
		$CSArray = explode(" ", $CityState);
		$State = array_pop($CSArray);
		$City = str_replace(',', '', implode(" ", $CSArray));
		$q = "SELECT zip_code FROM zip_code WHERE (city = '$City') AND (state";
		if (strlen($State) == 2) {
			$q .= "_prefix";
		} else {
			$q .= "_name";
		}
		$q .= " = '$State') LIMIT 1";
		$r = @mysqli_query($dbc, $q);
		$data = mysqli_fetch_array($r);
		$ZipCode = $data[0];
		mysqli_free_result($r);
	}
	if (!isset($ZipCode) || $ZipCode == null) { //Still no zip code, can't do a search.
		exit("We don't have any results for that area at this time (or it is not a valid location).");
	}
	$q = "SELECT zip_code, lat, lon from zip_code WHERE zip_code = $ZipCode";
	$r = @mysqli_query($dbc, $q);
	$location = mysqli_fetch_array($r, MYSQLI_ASSOC);
	mysqli_free_result($r);
	$distance = 17; //how far away we want to search
	if (!isset($location['lat'])) { //wasn't a valid zip code, not in database
		exit("Please input a valid location.");
	}
	$q = "SELECT zip_code, ( 3959 * acos( cos( radians($location[lat]) ) * cos( radians( lat ) ) * cos( radians( lon) - radians($location[lon]) ) + sin( radians($location[lat]) ) * sin( radians( lat ) ) ) ) AS distance FROM zip_code HAVING distance < $distance ORDER BY distance";
	$r = @mysqli_query($dbc, $q);
	while ($data = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
		$localzips[] = $data['zip_code'];
	}
	if (!isset($localzips))
		exit("That seems to be an invalid location.");
	mysqli_free_result($r);
	
	if ($Materials == "Any" || !isset($Materials))
		$Materials = "*";
	else if (!is_array($Materials))
		$Materials = explode(',', $Materials);
	
	// SELECT DISTINCT location, address, city, state, zip, phone FROM places AS p INNER JOIN types AS t ON p.placeNum = t.placeNum WHERE (p.zip = '39401' OR p.zip = '39402' OR p.zip = '39406') AND (t.typeName = 'Paper' OR t.typeName = 'Aluminum' OR t.typeName = 'test')
	$q = "SELECT DISTINCT location, address, city, state, zip, phone FROM places AS p INNER JOIN types AS t ON p.placeNum = t.placeNum WHERE (";
	for ($i = 0; $i < count($localzips); $i++) {
		$q .= "p.zip = '$localzips[$i]'";
		if ($i < count($localzips) - 1)
			$q .= " OR ";
	}
	if (isset($Materials) && is_array($Materials)) {
		$q .= ") AND (";
		for ($i = 0; $i < count($Materials); $i++) {
			$q .= "t.typeName = '$Materials[$i]'";
			if ($i < count($Materials) - 1)
				$q .= " OR ";
		}
	}
	$q .= ")";
	//$q = "SELECT * FROM `places` LIMIT 0, 30 ";
	$r = @mysqli_query($dbc, $q);
	
	$App = $_POST['App'];
	//$App = "Android"; //makes for easier testing, remove when ready
	switch ($App) {
		case "Android":
			//Is Android app
			if (mysqli_num_rows($r) == 0) {
				echo "Sorry, no centers found in the area.";
			} else {
			
				while ($data = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
					echo $data['location'] .PHP_EOL. $data['address'] .PHP_EOL. $data['city'] .", ". $data['state'] ." ". $data['zip'] .PHP_EOL. $data['phone'] .PHP_EOL . PHP_EOL;
				}
			}
			break;
		case "Website":
			//Is website
			if (mysqli_num_rows($r) == 0) {
				echo "<strong>Sorry, no recycling centers were found in the area. Please try another location.</strong>";
			} else {
				echo "<strong>These are the recycling centers in the area capable of recycling at least one chosen material:</strong>";
				while ($data = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
					echo '<p><a href="http://maps.google.com/maps?q=';
					echo urlencode($data['address'] . " " . $data['city'] . " " . $data['state'] . " " . $data['zip']);
					echo '">' . $data['location'] . '<br />' . $data['address'] . '<br />' . $data['city'] . ', ' . $data['state'] . ' ' . $data['zip'] . '</a><br />' . $data['phone'] . '</p>';
				}
			}
			break;
		//Can add cases for iOS, Windows Phone, mobile site, etc as needed
		default:
			//Not reporting an app, or isn't supported by file
			echo "Sorry, this isn't a supported platform at this time.";
	}
	
	mysqli_free_result($r);
	mysqli_close($dbc);
?>