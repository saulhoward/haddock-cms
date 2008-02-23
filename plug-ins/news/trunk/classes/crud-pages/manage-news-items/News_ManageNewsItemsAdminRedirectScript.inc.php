<?php
/**
 * News_ManageNewsItemsAdminRedirectScript
 *
 * @copyright RFI, 2007-01-08
 */

class
	News_ManageNewsItemsAdminRedirectScript
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
			$item = mysql_real_escape_string($_POST['item'], $dbh);
			
			$stmt = <<<SQL
INSERT INTO
	hpi_news_items
SET
	title = '$title',
	item = '$item',
	submitted = NOW()
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
			
			$title = mysql_real_escape_string($_POST['title'], $dbh);
			$item = mysql_real_escape_string($_POST['item'], $dbh);
			
			$id = mysql_real_escape_string($_GET['id'], $dbh);
			
			$stmt = <<<SQL
UPDATE
	hpi_news_items
SET
	title = '$title',
	item = '$item'
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
		
		$id = mysql_real_escape_string($_GET['id'], $dbh);
		
		$stmt = <<<SQL
DELETE
FROM
	hpi_news_items
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
	hpi_news_items
SQL;

		mysql_query($stmt, $dbh);
	}
	
	protected function
		get_admin_crud_manager_class_name()
	{
		return 'News_NewsItemsCRUDManager';
	}
	
	protected function
		get_required_fields()
	{
		return explode(' ', 'title item');
	}
}
?>