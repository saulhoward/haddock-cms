<?php
class
	Polls_VotingRedirectScript
extends
	PublicHTML_RedirectScript
{
	public function
		do_actions()
	{
		
		#print_r($_GET);
		
		if (isset($_GET['answer_id'])) {
			$dbh = DB::m();
			
			$answer_id = mysql_real_escape_string($_GET['answer_id'], $dbh);
			
			$session_id = session_id();
			
			$remote_address = $_SERVER['REMOTE_ADDR'];
			$http_user_agent = $_SERVER['HTTP_USER_AGENT'];
			
			$stmt = <<<SQL
INSERT INTO
	hpi_polls_votes
SET
	answer_id = $answer_id,
	submitted = NOW(),
	remote_address = '$remote_address',
	session_id = '$session_id',
	http_user_agent = '$http_user_agent'
SQL;

			mysql_query($stmt, $dbh);
		}
		
		#exit;
	}
}
?>