<?php
class ShoplistPrice {
	public function ShoplistPriceSum() {
	    global $db;
		require_once('login/auth.php');

		$owner          = $_SESSION['SESS_MEMBER_ID'];
		$GetPersonal    = $db->query("SELECT currency FROM members WHERE member_id = ".$owner."");
		$personal       = $db->fetch_assoc($GetPersonal);

		$GetDataComponentsAll = "SELECT price,order_quantity FROM data WHERE owner = ".$owner." AND order_quantity > 0 ORDER by name ASC";

		$sql_exec = $db->query($GetDataComponentsAll);
		while($showDetails = $db->fetch_assoc($sql_exec)) {
	
			$price      = $showDetails['price'];
			$quantity   = $showDetails['order_quantity'];
			$product    = $price * $quantity;
			$sum[]      = $product;
			
		}
		if (isset($sum)) {
			echo array_sum($sum);
			echo ' ';
			echo $personal['currency'];
		}
		else {
			echo '0';
			echo ' ';
			echo $personal['currency'];
		}
	}
}
