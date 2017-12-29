<?php
class NameHead {

	public function Head() {
		global $db;
		require_once('include/login/auth.php');
		$owner = $_SESSION['SESS_MEMBER_ID'];

		if(isset($_REQUEST['subcat'])) {
			$headcat = (int)$_REQUEST['subcat'];

			if ($headcat < 999) {
				$cat = substr($headcat, -3, 1);
			}
			else {
				$cat = substr($headcat, -4, 2);
			}
		}

		$CategoryName = "SELECT * FROM category_head ORDER by name ASC";
		$sql_exec_catname = $db->query($CategoryName);

		echo '<li>';
		echo '<a href="."';
		if(empty($_REQUEST['cat']) && empty($_REQUEST['subcat'])){
			echo ' class="selected"';
		}
		else{
			echo ' class="isComponents"';
		}
		echo '>';
		echo "All";
		echo '</a></li> ';

		while ($ShowDetailsCatname = $db->fetch_assoc($sql_exec_catname)) {
			echo '<li>';
			echo '<a href="category.php?cat=';
			echo $ShowDetailsCatname['id'];
			echo '" ';

			// Makes the head category "selected" when that category is viewed.
			if(isset($_REQUEST['cat'])) {
				$cat = (int)$_REQUEST['cat'];
				if ($ShowDetailsCatname['id'] == $cat) {
					echo 'class="selected"';
				}
			}

			// Makes the head category "selected" when a sub category of that category is viewed.
			if(isset($_REQUEST['subcat'])) {
				$headcat = (int)$_REQUEST['subcat'];

				if ($headcat < 999) {
					$cat = substr($headcat, -3, 1);
				}
				else {
					$cat = substr($headcat, -4, 2);
				}

				if ($cat == $ShowDetailsCatname['id']) {
					echo 'class="selected"';
				}
			}

			// Shows if component exists in category.
			$sql_exec_component_catname = $db->query("SELECT category FROM data WHERE owner = $owner"); // Get the category ID from all components.
			while($showDetailsComponentCatname = $db->fetch_assoc($sql_exec_component_catname)) {

				// Converts components sub category id to it's head category id.
				$component_cat = $showDetailsComponentCatname['category'];
				if ($component_cat < 999) {
					$comp_cat = substr($component_cat, -3, 1);
				}
				else {
					$comp_cat = substr($component_cat, -4, 2);
				}

				if($ShowDetailsCatname['id'] == $comp_cat){ // Compare current category ID with components category ID.
					echo 'class="isComponents"'; // What should be echoed if components exists in category?
					break; // We only need one component to be in this category for this to be true.
				}
			}

			echo '>';
				echo $ShowDetailsCatname['name'];
			echo '</a></li> ';
		}
	}
}
