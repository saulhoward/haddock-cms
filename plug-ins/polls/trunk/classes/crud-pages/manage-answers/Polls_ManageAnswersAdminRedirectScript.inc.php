<?php
class
	Polls_ManageAnswersAdminRedirectScript
extends
	Database_CRUDAdminRedirectScript
{
	public function
		add_something()
	{
		$this->set_required_fields_in_session_array();
		
		if ($this->check_that_all_required_fields_have_been_set()) {
			$dbh = DB::m();
			
			$question_id = mysql_real_escape_string($_POST['question_id'], $dbh);
			$answer = mysql_real_escape_string($_POST['answer'], $dbh);
			
			$stmt = <<<SQL
INSERT INTO
	hpi_polls_answers
SET
	question_id = $question_id,
	answer = '$answer'	
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
			
			$question_id = mysql_real_escape_string($_POST['question_id'], $dbh);
			$answer = mysql_real_escape_string($_POST['answer'], $dbh);			
			
			$id = mysql_real_escape_string($_GET['id'], $dbh);
			
			$stmt = <<<SQL
UPDATE
	hpi_polls_answers
SET
	question_id = $question_id,
	answer = '$answer'	
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
	hpi_polls_answers
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
	hpi_polls_answers
SQL;

		mysql_query($stmt, $dbh);
	}
	
	protected function
		get_admin_crud_manager_class_name()
	{
		return 'Polls_AnswersCRUDManager';
	}
	
	protected function
		get_required_fields()
	{
		return explode(' ', 'question_id answer');
	}
}
?>