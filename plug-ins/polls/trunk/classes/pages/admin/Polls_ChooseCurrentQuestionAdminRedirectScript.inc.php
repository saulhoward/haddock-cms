<?php
class
	Polls_ChooseCurrentQuestionAdminRedirectScript
extends
	Admin_RestrictedRedirectScript
{
	public function
		do_actions()
	{
		if (isset($_GET['question_id'])) {
			$dbh = DB::m();
			
			$stmt = <<<SQL
UPDATE
	hpi_polls_questions
SET
	current = 'No'
SQL;
			
			mysql_query($stmt, $dbh);
			
			$question_id = mysql_real_escape_string($_GET['question_id'], $dbh);
			
			$stmt = <<<SQL
UPDATE
	hpi_polls_questions
SET
	current = 'Yes'
WHERE
	id = $question_id
SQL;
			
			mysql_query($stmt, $dbh);
			
		}
	}
}
?>