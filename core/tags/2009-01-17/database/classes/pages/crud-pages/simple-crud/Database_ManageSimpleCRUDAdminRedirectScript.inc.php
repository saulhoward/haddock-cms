<?php
class
	Database_ManageSimpleCRUDAdminRedirectScript
extends
	Database_CRUDAdminRedirectScript
{
	public function
		add_something()
	{
		$this->set_required_fields_in_session_array();
		
		if ($this->check_that_all_required_fields_have_been_set()) {
			$dbh = DB::m();
			
			$acm = $this->get_admin_crud_manager();
			
			$table_name = $acm->get_table_name();
			
			$set_clause = $acm->get_set_clause();
			
			$question = mysql_real_escape_string($_POST['question'], $dbh);
			
			$stmt = <<<SQL
INSERT INTO
	$table_name
	
$set_clause

SQL;
				
			mysql_query($stmt, $dbh);
			
			$this->clear_form();
		}
	}
	
	public function
		edit_something()
	{
		$this->set_required_fields_in_session_array();
		
		if ($this->check_that_all_required_fields_have_been_set()) {
			$dbh = DB::m();
			
			$acm = $this->get_admin_crud_manager();
			
			$table_name = $acm->get_table_name();
			
			$set_clause = $acm->get_set_clause();
			
			$id = mysql_real_escape_string($_GET['id'], $dbh);
			
			$stmt = <<<SQL
UPDATE
	$table_name
	
$set_clause

WHERE
	id = $id
SQL;
				
			#echo $stmt; exit;
			
			mysql_query($stmt, $dbh);
			
			$this->clear_form();
		}
	}
		
	public function
		delete_something()
	{
		$dbh = DB::m();
		
		$acm = $this->get_admin_crud_manager();
		
		$table_name = $acm->get_table_name();
		
		$id = mysql_real_escape_string($_GET['id'], $dbh);
		
		$stmt = <<<SQL
DELETE
FROM
	$table_name
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
		
		$acm = $this->get_admin_crud_manager();
		
		$table_name = $acm->get_table_name();
		
		$stmt = <<<SQL
TRUNCATE TABLE
	$table_name
SQL;

		mysql_query($stmt, $dbh);
	}
	
	protected function
		get_admin_crud_manager_class_name()
	{
		return 'Database_SimpleCRUDManager';
	}
	
	protected function
		get_required_fields()
	{
		$acm = $this->get_admin_crud_manager();
		return $acm->get_required_fields();
	}
}
?>