<?php
class
	Navigation_ManageTreesAdminPage
extends
	Database_CRUDAdminPage
{
	protected function
		get_admin_crud_manager_class_name()
	{
		return 'Navigation_TreesCRUDManager';
	}
	
	protected function
		get_data_table_fields()
	{
		return array(
			array(
				'col_name' => 'title'
			),
			array(
				'col_name' => 'added'
			)
	 	);
	}
	
	protected function
		get_matching_query_from_clause()
	{
		return <<<SQL
FROM
	hpi_navigation_trees
	
SQL;

	}
	
	protected function
		render_add_something_form_ol()
	{
		echo "<ol>\n";
		
		$this->render_add_something_form_li_text_input('title');
		
		echo "</ol>\n";
	}
	
	protected function
		render_edit_something_form_ol()
	{
		echo "<ol>\n";
		
		$this->render_edit_something_form_li_text_input('title');
		
		echo "</ol>\n";
	}
	
	protected function
		get_add_something_title()
	{
		return 'Add a Tree';
	}
	
	protected function
		get_body_div_header_heading_content()
	{
		return 'Manage Trees';
	}
}
?>