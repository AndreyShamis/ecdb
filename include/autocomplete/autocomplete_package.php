<?php
require_once "../Class_DB.php";;
$q = strtolower($_GET["q"]);
if (!$q) return;

$sql = "select DISTINCT package as package from data where package LIKE '%$q%' ";
$rsd = $db->query($sql);
while($rs = $db->fetch_assoc($rsd)) {
	$cname = $rs['package'];
	echo "$cname\n";
}
