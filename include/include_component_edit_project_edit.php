<?php
class EditProj {
	public function MenuProj() {
        global $db;
		require_once('include/login/auth.php');
		
		$id		= 	(int)$_REQUEST['edit'];
		
		$query = "SELECT projects_data.projects_data_project_id, projects_data.projects_data_quantity, projects_data.projects_data_project_id, projects_data.projects_data_component_id, projects.project_id, projects.project_name FROM projects_data, projects WHERE projects_data.projects_data_project_id = projects.project_id AND projects_data.projects_data_component_id = '$id' LIMIT 1";
	 
		$result = $db->query($query);// or die(mysql_error());
		
		while($row = $db->fetch_assoc($result)){
					echo $row['project_name'];
				echo '</td>';
				echo '<td><input name="projquantedit[';
					echo $row['project_id'];
				echo ']" type="text" class="small" value="';
					echo $row['projects_data_quantity'];
				echo '" /></td>';
				echo '<td>';
				//echo '<button class="button white small" name="orderquant_increase" type="submit"><span class="icon medium roundPlus"></span></button>';
				//echo '<button class="button white small" name="orderquant_decrease" type="submit"><span class="icon medium roundMinus"></span></button>';
			echo '</td>';
			echo '</tr>';
		}
		
		$query1 = "SELECT projects_data.projects_data_project_id, projects_data.projects_data_quantity, projects_data.projects_data_project_id, projects_data.projects_data_component_id, projects.project_id, projects.project_name FROM projects_data, projects WHERE projects_data.projects_data_project_id = projects.project_id AND projects_data.projects_data_component_id = '$id' LIMIT 1,18446744073709551615";
	 
		$result1 = $db->query($query1);// or die(mysql_error());
		
		while($row1 = $db->fetch_assoc($result1)){
			echo '<tr>';
				echo '<td></td>';
				echo '<td></td>';
				echo '<td></td>';
				echo '<td>';
					echo $row1['project_name'];
				echo '</td>';
				echo '<td><input name="projquantedit[';
					echo $row1['project_id'];
				echo ']" type="text" class="small" value="';
					echo $row1['projects_data_quantity'];
				echo '" /></td>';
				echo '<td>';
					//echo '<button class="button white small" name="orderquant_increase" type="submit"><span class="icon medium roundPlus"></span></button>';
					//echo '<button class="button white small" name="orderquant_decrease" type="submit"><span class="icon medium roundMinus"></span></button>';
				echo '</td>';
			echo '</tr>';
			
		}
		
		if ($db->count($result) == 0) {
			echo '</td>';
			echo '<td></td>';
			echo '<td></td>';
			echo '</tr>';
		}
	}
}
