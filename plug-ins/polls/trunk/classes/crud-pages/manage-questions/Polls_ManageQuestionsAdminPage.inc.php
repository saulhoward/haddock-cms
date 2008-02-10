<?php
/**
 * Polls_ManageQuestionsAdminPage
 *
 * @copyright RFI, 2007-12-30
 */

/**
 * DEPRECATED
 *
 * This has been replaced with the simple crud manager code.
 */
class
	Polls_ManageQuestionsAdminPage
extends
	Database_CRUDAdminPage
{
	protected function
		get_admin_crud_manager_class_name()
	{
		return 'Polls_QuestionsCRUDManager';
	}
	
	protected function
		get_data_table_fields()
	{
		return array(
			array(
				'col_name' => 'question',
#				'filter' => '$str = stripcslashes($str); if (strlen($str) > 50) { $str = substr($str, 0, 50); $str .= \'...\'; } return $str;'
				'filter' => 'return Strings_SimpleFilters::truncate_with_ellipsis($str);'
			)
	 	);
	}
	
	protected function
		get_matching_query_from_clause()
	{
		return <<<SQL
FROM
	hpi_polls_questions
	
SQL;

	}
	
	protected function
		render_add_something_form_ol()
	{
		$acm = $this->get_admin_crud_manager();
		
		echo "<ol>\n";
		
		$this->render_add_something_form_li_textarea('question');

		echo "</ol>\n";
	}
	
	protected function
		render_edit_something_form_ol()
	{
		$acm = $this->get_admin_crud_manager();
		
		echo "<ol>\n";
		
		$this->render_edit_something_form_li_textarea('question');
		
		echo "</ol>\n";
	}
	
	protected function
		get_add_something_title()
	{
		return 'Add a Question';
	}
	
	protected function
		get_body_div_header_heading_content()
	{
		return 'Manage Questions';
	}
}
?>