<?php
/**
 * Polls_QuestionsCRUDManager
 *
 * @copyright RFI, 2007-12-30
 */

/**
 * DEPRECATED
 *
 * This has been replaced with the simple crud manager code.
 */
class
	Polls_QuestionsCRUDManager
extends
	Database_CRUDAdminManager
{
	public function
		get_admin_page_class_name()
	{
		return 'Polls_ManageQuestionsAdminPage';
	}
	
	public function
		get_admin_redirect_script_class_name()
	{
		return 'Polls_ManageQuestionsAdminRedirectScript';
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
	hpi_polls_questions
WHERE
	id = $id
SQL;

		}
	}
}
?>