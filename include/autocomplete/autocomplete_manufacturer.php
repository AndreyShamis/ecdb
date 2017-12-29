<?php
require_once "../Class_DB.php";
$q = strtolower($_REQUEST["q"]);
if (!$q) return;

$sql = "SELECT DISTINCT(manufacturer) FROM data 
          WHERE manufacturer LIKE '%$q%'";
$rsd = $db->query($sql);
while($rs = $db->fetch_assoc($rsd)) {
	$manufacturer = $rs['manufacturer'];
	echo "$manufacturer\n";
}
