<?php
/**
 * News_ManageNewsItemsAdminPage
 *
 * @copyright RFI 2008-01-08
 */

class
	News_ManageNewsItemsAdminPage
extends
	Database_CRUDAdminPage
{
	protected function
		get_admin_crud_manager_class_name()
	{
		return 'News_NewsItemsCRUDManager';
	}
	
	protected function
		get_data_table_fields()
	{
		return array(
			array(
				'col_name' => 'submitted'
			),
			array(
				'col_name' => 'title'
			),
			array(
				'col_name' => 'item',
				'filter' => '$str = stripcslashes($str); if (strlen($str) > 50) { $str = substr($str, 0, 50); $str .= \'...\'; } return $str;'
			)
	 	);
	}
	
	protected function
		get_matching_query_from_clause()
	{
		return <<<SQL
FROM
	hpi_news_items
	
SQL;

	}
	
	protected function
		render_add_something_form_ol()
	{
		$acm = $this->get_admin_crud_manager();
		
		echo "<ol>\n";
		
		$this->render_add_something_form_li_text_input('title');
		$this->render_add_something_form_li_textarea('item');
		
		echo "</ol>\n";
	}
	
	protected function
		render_edit_something_form_ol()
	{
		$acm = $this->get_admin_crud_manager();
		
		echo "<ol>\n";
		
		$this->render_edit_something_form_li_text_input('title');
		$this->render_edit_something_form_li_textarea('item');
		
		echo "</ol>\n";
	}
	
	protected function
		get_add_something_title()
	{
		return 'Add a News Item';
	}
	
	protected function
		get_body_div_header_heading_content()
	{
		return 'Manage News Items';
	}
}
?>