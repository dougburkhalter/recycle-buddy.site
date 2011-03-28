<?php
require_once('mysqli.inc.php');
$q = "SELECT tipText FROM tips ORDER BY RAND() LIMIT 1";
$r = @mysqli_query($dbc, $q);
$data = mysqli_fetch_array($r);
echo $data[0];

mysqli_free_result($r);
mysqli_close($dbc);
?>