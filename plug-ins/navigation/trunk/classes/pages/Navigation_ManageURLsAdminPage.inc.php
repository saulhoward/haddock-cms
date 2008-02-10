<?php
/**
 * Navigation_ManageURLsAdminPage
 *
 * @copyright RFI 2007-12-29
 */

class
	Navigation_ManageURLsAdminPage
extends
	Database_CRUDAdminPage
{
	protected function
		get_admin_crud_manager_class_name()
	{
		return 'Navigation_URLsCRUDManager';
	}
	
	protected function
		get_data_table_fields()
	{
		return array(
			array(
				'col_name' => 'href',
				'title' => 'HREF'
				,
				'filter' => '$href= $str; $str = "<a href=\"$href\">$href</a>"; return $str;'
			),
			array(
				'col_name' => 'title'
			)
	 	);
	}
	
	protected function
		render_add_something_form_ol()
	{
		echo "<ol>\n";
		
		$this->render_add_something_form_li_text_input('href', 'HREF');
		$this->render_add_something_form_li_text_input('title');
		
		echo "</ol>\n";
	}
	
	protected function
		render_edit_something_form_ol()
	{
		echo "<ol>\n";
		
		$this->render_edit_something_form_li_text_input('href', 'HREF');
		$this->render_edit_something_form_li_text_input('title');
		
		echo "</ol>\n";
	}
	
	protected function
		get_matching_query_from_clause()
	{
		return <<<SQL
FROM
	hpi_navigation_urls
	
SQL;

	}
	
	protected function
		get_edit_something_title()
	{
		return 'Edit this HREF';
	}
	
	protected function
		get_body_div_header_heading_content()
	{
		return 'Manage URLs';
	}
	
	protected function
		get_default_order_by()
	{
		return 'title';
	}
	
	protected function
		get_add_something_form_name()
	{
		return 'add_new_url_form';
	}
	
	protected function
		get_edit_something_form_name()
	{
		return 'edit_db_page_form';
	}
}
?>