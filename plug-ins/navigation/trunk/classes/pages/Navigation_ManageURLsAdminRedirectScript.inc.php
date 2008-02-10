<?php
class
	Navigation_ManageURLsAdminRedirectScript
extends
	Database_CRUDAdminRedirectScript
{
	public function
		add_something()
	{
		$this->set_required_fields_in_session_array();
		
		if ($this->check_that_all_required_fields_have_been_set()) {
			$dbh = DB::m();
			
			$href = mysql_real_escape_string($_POST['href'], $dbh);
			
			/*
			 * Validate the href.
			 *
			 * TO DO!
			 *
			 * Implement a url validator in the input validation module.
			 */
			if (
				preg_match('/^[\w]+$/', $href)
				||
				TRUE
			) {
				$title = mysql_real_escape_string($_POST['title'], $dbh);
				
				$stmt = <<<SQL
INSERT INTO
	hpi_navigation_urls
SET
	href = '$href',
	title = '$title'
SQL;
				
				mysql_query($stmt, $dbh);
				
				$this->clear_form();
			} else {
				throw new Database_CRUDException("'$href' is not a validate HREF!");
			}
		}
	}
	
	public function
		edit_something()
	{
		$this->set_required_fields_in_session_array();
		
		if ($this->check_that_all_required_fields_have_been_set()) {
			$dbh = DB::m();
			
			$href = mysql_real_escape_string($_POST['href'], $dbh);
			
			/*
			 * Validate the href.
			 *
			 * TO DO!
			 *
			 * Implement a url validator in the input validation module.
			 */
			if (
				preg_match('/^[\w]+$/', $href)
				||
				TRUE
			) {
				$title = mysql_real_escape_string($_POST['title'], $dbh);
				
				#print_r($_GET); exit;
				
				$id = mysql_real_escape_string($_GET['id'], $dbh);
				
				$stmt = <<<SQL
UPDATE
	hpi_navigation_urls
SET
	href = '$href',
	title = '$title'
WHERE
	id = $id
SQL;
				
				#echo $stmt; exit;
				
				mysql_query($stmt, $dbh);
				
				$this->clear_form();
			} else {
				throw new Database_CRUDException("'$href' is not a validate HREF!");
			}
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
	hpi_navigation_urls
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
	hpi_navigation_urls
SQL;

		mysql_query($stmt, $dbh);
	}
	
	protected function
		get_admin_crud_manager_class_name()
	{
		return 'Navigation_URLsCRUDManager';
	}
	
	protected function
		get_required_fields()
	{
		return explode(' ', 'href title');
	}
}
?>