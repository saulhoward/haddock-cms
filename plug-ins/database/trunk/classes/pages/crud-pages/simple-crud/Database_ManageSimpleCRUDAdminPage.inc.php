<?php
class
	Database_ManageSimpleCRUDAdminPage
extends
	Database_CRUDAdminPage
{
	protected function
		get_admin_crud_manager_class_name()
	{
		return 'Database_SimpleCRUDManager';
	}
	
	protected function
		get_data_table_fields()
	{
		$acm = $this->get_admin_crud_manager();
		
		return $acm->get_data_table_fields();
	}
	
	protected function
		get_current_base_url()
	{
		$acm = $this->get_admin_crud_manager();
		$url = parent::get_current_base_url();
		$url->set_get_variable('file', $acm->get_file_name());
		return $url;
	}
	
	protected function
		get_redirect_script_url()
	{
		$url = $this->get_current_url_just_file();
		
		$url->set_get_variable('oo-page');
		$url->set_get_variable('page-class', $this->get_redirect_script_class_name());
		
		$acm = $this->get_admin_crud_manager();
		
		$url->set_get_variable('file', $acm->get_file_name());
		
		$cbu = $this->get_current_base_url();
		
		$cbu_str = $cbu->get_as_string();
		
		$url->set_get_variable('return_to', urlencode($cbu_str));
		
		return $url;
	}
	
	protected function
		get_action_url_for_content(
			$get_var_content,
			$identifiers
		)
	{
		$url = parent::get_action_url_for_content(
			$get_var_content,
			$identifiers
		);
		
		$acm = $this->get_admin_crud_manager();
		
		$url->set_get_variable('file', $acm->get_file_name());
		
		return $url;
	}
	
	protected function
		get_matching_query_from_clause()
	{
		$acm = $this->get_admin_crud_manager();
		
		$table_name = $acm->get_table_name();
		
		return <<<SQL
FROM
	$table_name
	
SQL;

	}
	
	protected function
		render_add_something_form_ol()
	{
		$acm = $this->get_admin_crud_manager();
		
		$field_assocs = $acm->get_field_assocs();
		
		echo "<ol>\n";
		
		foreach ($field_assocs as $fa) {
			switch ($fa['input_type']) {
				case 'it':
					$this->render_add_something_form_li_text_input($fa['col_name']);
					break;
				case 'ta':
					$this->render_add_something_form_li_textarea($fa['col_name']);
					break;
			}
		}
		
		echo "</ol>\n";
	}
	
	protected function
		render_edit_something_form_ol()
	{
		$acm = $this->get_admin_crud_manager();
		
		$field_assocs = $acm->get_field_assocs();
		
		echo "<ol>\n";
		
		foreach ($field_assocs as $fa) {
			switch ($fa['input_type']) {
				case 'it':
					$this->render_edit_something_form_li_text_input($fa['col_name']);
					break;
				case 'ta':
					$this->render_edit_something_form_li_textarea($fa['col_name']);
					break;
			}
		}
		
		echo "</ol>\n";
	}
	
	protected function
		get_add_something_title()
	{
		$acm = $this->get_admin_crud_manager();
		return $acm->get_add_something_title();
	}
	
	protected function
		get_body_div_header_heading_content()
	{
		$acm = $this->get_admin_crud_manager();
		return $acm->get_body_div_header_heading_content();
	}
}
?>