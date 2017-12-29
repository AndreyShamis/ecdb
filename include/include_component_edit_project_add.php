<?php
class AddMenuProj {
	public function MenuProj() {
        global $db;
		require_once('include/login/auth.php');
		
		$owner	=	$_SESSION['SESS_MEMBER_ID'];
		$id		= 	(int)$_REQUEST['edit'];
		
		echo '<option class="main_category" value=""> - Project - </option>';
		
		$GetDataProject = "SELECT * FROM projects WHERE project_owner = '$owner'";
		$sql = $db->query($GetDataProject);
		
		while($row1 = $db->fetch_assoc($sql)){
		
			$query1 = "SELECT projects_data.projects_data_project_id, projects_data.projects_data_component_id FROM projects_data RIGHT JOIN projects ON projects.project_id = projects_data.projects_data_project_id WHERE projects.project_owner = '$owner'";
	 
			$result1 = $db->query($query1);
			
			echo '<option value="';
			echo $row1['project_id'];
			echo '"';
			
			while($row2 = $db->fetch_assoc($result1)){
				if ($row2['projects_data_component_id'] == $id && $row2['projects_data_project_id'] == $row1['project_id']){
					echo 'disabled="disabled"';
				}
				else {
					echo '';
				}
			}
			
			if(isset($_POST['submit'])) {
				if(isset($_POST['project'])) {
					if($row1['project_id'] == $_POST['project']) {
						echo ' selected ';
					}
				}
			}
			echo '>';
			echo $row1['project_name'];
			echo '</option>';
		}
	}
}
