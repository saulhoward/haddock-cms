<?php
/**
 * Polls_ManageQuestionsAdminRedirectScript
 *
 * @copyright RFI, 2007-12-30
 */

/**
 * DEPRECATED
 *
 * This has been replaced with the simple crud manager code.
 */
class
	Polls_ManageQuestionsAdminRedirectScript
extends
	Database_CRUDAdminRedirectScript
{
	public function
		add_something()
	{
		$this->set_required_fields_in_session_array();
		
		if ($this->check_that_all_required_fields_have_been_set()) {
			$dbh = DB::m();
			
			$question = mysql_real_escape_string($_POST['question'], $dbh);
			
			$stmt = <<<SQL
INSERT INTO
	hpi_polls_questions
SET
	question = '$question'
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
			
			$question = mysql_real_escape_string($_POST['question'], $dbh);
			
			$id = mysql_real_escape_string($_GET['id'], $dbh);
			
			$stmt = <<<SQL
UPDATE
	hpi_polls_questions
SET
	question = '$question'
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
	hpi_polls_questions
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
	hpi_polls_questions
SQL;

		mysql_query($stmt, $dbh);
	}
	
	protected function
		get_admin_crud_manager_class_name()
	{
		return 'Polls_QuestionsCRUDManager';
	}
	
	protected function
		get_required_fields()
	{
		return explode(' ', 'question');
	}
}
?>