<?php
/**
 * OrderedTables_ReorderRowsHTMLTable
 *
 * @copyright 2008-03-17, RFI
 */

class
	OrderedTables_ReorderRowsHTMLTable
extends
	HTMLTags_Table
{
	private $key_fields;
	
	private $column_titles;
	
	private $row_data;
	
	private $base_redirect_script_url;
	
	public function
		__construct()
	{
		parent::__construct();
		
		$this->set_attribute_str('id', 'reorder_rows');
		
		$this->column_titles = array();
		
		$this->row_data = array();
	}
	
	protected function
		get_content()
	{
		$content = new HTMLTags_TagContent();
		
		$content->append_tag($this->get_thead());
		
		$content->append_tag($this->get_tbody());
		
		return $content;
	}
	
	protected function
		get_thead()
	{
		$thead = new HTMLTags_THead();
		
		$thead->append_tag_to_content($this->get_heading_tr());
		
		return $thead;
	}
	
	protected function
		get_heading_tr()
	{
		$heading_tr = new HTMLTags_TR();
		
		/*
		 * Append the column headings for the data in the table.
		 */
		$column_titles = $this->get_column_titles();
		
		foreach ($column_titles as $column_title) {
			$heading_tr->append_tag_to_content(new HTMLTags_TH($column_title));
		}
		
		/*
		 * Append the column heading for the action columns.
		 */
		$action_columns_heading = new HTMLTags_TH('Reorder');
		
		$action_columns_heading->set_attribute_str('colspan', 2);
		
		$heading_tr->append_tag_to_content($action_columns_heading);
		
		return $heading_tr;
	}
	
	protected function
		get_column_titles()
	{
		if (count($this->column_titles) < 1) {
			throw new Exception('There needs to be at least one column title!');
		}
		
		return $this->column_titles;
	}
	
	public function
		add_column_title($column_title)
	{
		$this->column_titles[] = $column_title;
	}
	
	protected function
		get_tbody()
	{
		$tbody = new HTMLTags_TBody();
		
		$data_trs = $this->get_data_trs();
		
		foreach ($data_trs as $data_tr) {
			$tbody->append_tag_to_content($data_tr);
		}
		
		return $tbody;
	}
	
	protected function
		get_data_trs()
	{
		$data_trs = array();
		
		$key_fields = $this->get_key_fields();
		
		$base_redirect_script_url = $this->get_base_redirect_script_url();
		
		foreach ($this->row_data as $row_datum) {
			echo 'print_r($row_datum):' . "\n";
			print_r($row_datum);
			
			$data_tr = new HTMLTags_TR();
			
			/*
			 * Make TDs for the row datum elements.
			 */
			foreach ($row_datum as $rde) {
				$td = new HTMLTags_TD($rde);
				
				$data_tr->append_tag_to_content($td);
			}
			
			/*
			 * Make TDs for links to the redirect script to move the row up or down.
			 */
			$current_data_row_brsu = clone $base_redirect_script_url;
			
			foreach ($key_fields as $key_field) {
				$current_data_row_brsu->set_get_variable(
					$key_field,
					$row_datum[$key_field]
				);
			}
			
			foreach (explode(' ', 'up down') as $direction) {
				$td = new HTMLTags_TD();
				
				/*
				 * Make the link text.
				 */
				$link_text = 'Shift' . ucfirst($direction);
				
				$current_shirt_direction_rsu = clone $current_data_row_brsu;
				
				$current_shirt_direction_rsu->set_get_variable('direction', $direction);
				
				$shift_a = new HTMLTags_A($link_text);
				$shift_a->set_href($current_shirt_direction_rsu);
				
				$td->append_tag_to_content($shift_a);
				
				$data_tr->append_tag_to_content($td);
			}
			
			$data_trs[] = $data_tr;
		}
		
		return $data_trs;
	}
	
	public function
		add_row_data($row_data)
	{
		$this->row_data = $row_data;
	}
	
	protected function
		get_base_redirect_script_url()
	{
		if (!isset($this->base_redirect_script_url)) {
			throw new Exception("The base redirect script URL must be set!");
		}
		
		return $this->base_redirect_script_url;
	}
	
	public function
		set_base_redirect_script_url(
			HTMLTags_URL $base_redirect_script_url
		)
	{
		$this->base_redirect_script_url = $base_redirect_script_url;
	}
	
	protected function
		get_key_fields()
	{
		if (!isset($this->key_fields)) {
			throw new Exception("The key fields must be set!");
		}
		
		return $this->key_fields;
	}
	
	public function
		set_key_fields($key_fields)
	{
		$this->key_fields = $key_fields;
	}
}
?>