<?php
class
	Navigation_ManageNodesAdminRedirectScript
extends
	Database_CRUDAdminRedirectScript
{
	public function
		add_something()
	{
		$this->set_required_fields_in_session_array();
		
		if ($this->check_that_all_required_fields_have_been_set()) {
			$dbh = DB::m();
			
					   $tree_id = mysql_real_escape_string($_POST['tree_id'], $dbh);
						$url_id = mysql_real_escape_string($_POST['url_id'], $dbh);
					$sort_order	= mysql_real_escape_string($_POST['sort_order'], $dbh);
			$open_in_new_window = mysql_real_escape_string($_POST['open_in_new_window'], $dbh);
			
			$stmt = <<<SQL
INSERT INTO
	hpi_navigation_nodes
SET
				 added = NOW(),
			   tree_id = $tree_id,
				url_id = $url_id,
			 parent_id = 0,
			sort_order = '$sort_order',
	open_in_new_window = '$open_in_new_window'
	
SQL;
			
			mysql_query($stmt, $dbh);
			
			if ($err = mysql_error($dbh)) {
				throw new Database_CRUDException($err);
			}
			
			$this->clear_form();
		}
	}
	
	public function
		edit_something()
	{
		$this->set_required_fields_in_session_array();
		
		if ($this->check_that_all_required_fields_have_been_set()) {
			$dbh = DB::m();
			
			$id = mysql_real_escape_string($_GET['id'], $dbh);
			
					   $tree_id = mysql_real_escape_string($_POST['tree_id'], $dbh);
						$url_id = mysql_real_escape_string($_POST['url_id'], $dbh);
					 $parent_id = mysql_real_escape_string($_POST['parent_id'], $dbh);
					$sort_order	= mysql_real_escape_string($_POST['sort_order'], $dbh);
			$open_in_new_window = mysql_real_escape_string($_POST['open_in_new_window'], $dbh);
			
			$stmt = <<<SQL
UPDATE
	hpi_navigation_nodes
SET
			   tree_id = $tree_id,
				url_id = $url_id,
			 parent_id = $parent_id,
			sort_order = '$sort_order',
	open_in_new_window = '$open_in_new_window'
WHERE
	id = $id
SQL;
				
			#echo $stmt; exit;
			
			mysql_query($stmt, $dbh);
			
			if ($err = mysql_error($dbh)) {
				throw new Database_CRUDException($err);
			}
			
			$this->clear_form();
		}
	}
		
	public function
		delete_something()
	{
		$dbh = DB::m();
		
		$id = mysql_real_escape_string($_GET['id'], $dbh);
		
		$stmt = <<<SQL
DELETE
FROM
	hpi_navigation_nodes
WHERE
	id = $id
SQL;
		
		#echo $stmt; exit;
		
		mysql_query($stmt, $dbh);
	}
		
	public function
		delete_everything()
	{
		$dbh = DB::m();
		
		$stmt = <<<SQL
TRUNCATE TABLE
	hpi_navigation_nodes
SQL;

		mysql_query($stmt, $dbh);
	}
	
	protected function
		get_admin_crud_manager_class_name()
	{
		return 'Navigation_TreesCRUDManager';
	}
	
	protected function
		get_required_fields()
	{
		return explode(' ', 'tree_id url_id sort_order open_in_new_window');
	}
}
?>