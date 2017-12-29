<?php
require_once "../Class_DB.php";
$q = strtolower($_REQUEST["q"]);
if (!$q) return;

$sql = "select DISTINCT name as name from data where name LIKE '%$q%' ";
$rsd = $db->query($sql);
while($rs = $db->fetch_assoc($rsd)) {
	$cname = $rs['name'];
	echo "$cname\n";
}
