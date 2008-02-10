<?php
class
	Navigation_ManageTreesAdminRedirectScript
extends
	Database_CRUDAdminRedirectScript
{
	public function
		add_something()
	{
		$this->set_required_fields_in_session_array();
		
		if ($this->check_that_all_required_fields_have_been_set()) {
			$dbh = DB::m();
			
			$title = mysql_real_escape_string($_POST['title'], $dbh);
			
			$stmt = <<<SQL
INSERT INTO
	hpi_navigation_trees
SET
	title = '$title',
	added = NOW()
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
			
			$title = mysql_real_escape_string($_POST['title'], $dbh);
			
			#print_r($_GET); exit;
			
			$id = mysql_real_escape_string($_GET['id'], $dbh);
			
			$stmt = <<<SQL
UPDATE
	hpi_navigation_trees
SET
	title = '$title'
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
	hpi_navigation_trees
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
	hpi_navigation_trees
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
		return explode(' ', 'title');
	}
}
?>