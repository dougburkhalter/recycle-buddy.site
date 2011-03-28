<?php

//Define access info as constants; items are the same on both production server & Doug's test server
DEFINE ('DB_USER', 'itjustwe_recycle');
DEFINE ('DB_PASSWORD', 'CSC424');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'itjustwe_recyclebuddy');

//Make a connection
$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die('Could not connect to MySQL: ' . mysqli_connect_error());
?>