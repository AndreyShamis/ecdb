<?php
class AddMenuProj {
	public function MenuProj() {
        global $db;
		require_once('include/login/auth.php');
		
		$owner	=	$_SESSION['SESS_MEMBER_ID'];
		
		$ProjectNameQuery = "SELECT * FROM projects WHERE project_owner = ".$owner." ORDER by project_name ASC";
		$sql_exec_projname = $db->query($ProjectNameQuery);

		echo '<option class="main_category" value="">';
		echo ' - Project - ';
		echo '</option>';
		
		while ($Project = $db->fetch_assoc($sql_exec_projname)) {
			echo '<option value="';
			echo $Project['project_id'];
			echo '"';
			if(isset($_POST['submit'])) {
				if(isset($_POST['project'])) {
					if($Project['project_id'] == $_POST['project']) {
						echo ' selected ';
					}
				}
			}
			echo '>';
			echo $Project['project_name'];
			echo '</option>';
		}
	}
}
