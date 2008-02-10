<?php
class
	Polls_AnswersCRUDManager
extends
	Database_CRUDAdminManager
{
	public function
		get_admin_page_class_name()
	{
		return 'Polls_ManageAnswersAdminPage';
	}
	
	public function
		get_admin_redirect_script_class_name()
	{
		return 'Polls_ManageAnswersAdminRedirectScript';
	}
	
	public function
		get_query_for_something()
	{
		if ($key_values = $this->get_key_values_from_get_vars()) {
			$id = $key_values['id'];
			
			return <<<SQL
SELECT
	*
FROM
	hpi_polls_answers
WHERE
	id = $id
SQL;

		}
	}
}
?>