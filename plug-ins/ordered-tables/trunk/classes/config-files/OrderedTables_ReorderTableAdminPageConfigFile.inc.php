<?php
/**
 * OrderedTables_ReorderTableAdminPageConfigFile
 *
 * @copyright 2008-03-17, RFI
 */

/**
 * Extracts the data from the XML file that specifies
 * how to reorder the rows in a table.
 */
class
	OrderedTables_ReorderTableAdminPageConfigFile
extends
	FileSystem_XMLFile
{
	/**
	 * The name of this file relative to the document root
	 * when this class is used by a script run on a web server.
	 */
	private $server_file_name;
	
	private $simple_xml_element;
	
	private $table_name;
	
	private $key_fields;
	
	private $ordering_fields;
	
	private $display_fields;
	
	private $top_links;
	
	public function
		get_server_file_name()
	{
		return $this->server_file_name;
	}
	
	public function
		set_server_file_name($server_file_name)
	{
		$this->server_file_name = $server_file_name;
	}
	
	/**
	 * Get the table name.
	 */
	public function
		get_table_name()
	{
		if (!isset($this->table_name)) {
			$sxe = $this->get_simple_xml_element();
			
			$this->table_name = (string)$sxe->table['name'];
		}
		
		return $this->table_name;
	}
	
	/**
	 * Get the names of the key fields.
	 */
	public function
		get_key_fields()
	{
		if (!isset($this->key_fields)) {
			$this->key_fields = array();
			
			$sxe = $this->get_simple_xml_element();
			
			foreach ($sxe->table->{'key-fields'}->field as $field) {
				#print_r($field);
				
				$this->key_fields[] = (string)$field['name'];
			}
			
			/*
			 * If the key_fields array hasn't been set, use the default
			 * values.
			 */
			if (count($this->key_fields) < 1) {
				$this->key_fields = array('id');
			}
		}
		
		return $this->key_fields;
	}
	
	/**
	 * Get the order by field and direction.
	 */
	public function
		get_ordering_fields()
	{
		if (!isset($this->ordering_fields)) {
			$this->ordering_fields = array();
			
			$sxe = $this->get_simple_xml_element();
			
			foreach ($sxe->table->ordering->field as $field) {
				$this->ordering_fields[] = array(
					'name' => (string)$field['name'],
					'direction' => (string)$field['direction']
				);
			}
			
			if (count($this->ordering_fields) < 1) {
				$this->ordering_fields = array(
					array(
						'name' => 'sort_order',
						'direction' => 'ASC'
					)
				);
			}
		}
		
		return $this->ordering_fields;
	}
	
	/**
	 * Get the fields to display.
	 */
	public function
		get_display_fields()
	{
		if (!isset($this->display_fields)) {
			$this->display_fields = array();
			
			$sxe = $this->get_simple_xml_element();
			
			foreach ($sxe->table->display->field as $field) {
				#print_r($field);
				
				$display_field['name'] = (string)$field['name'];
				
				foreach (explode(' ', 'title filter') as $attribute_name) {
					if (isset($field[$attribute_name])) {
						$display_field[$attribute_name] = (string)$field[$attribute_name];
					}
				}
				
				$this->display_fields[] = $display_field;
			}
			
			if (count($this->display_fields) < 1) {
				$this->display_fields = array(
					array(
						'name' => 'id'
					)
				);
			}
		}
		
		#print_r($this->display_fields);
		
		return $this->display_fields;
	}
	
	public function
		get_display_field_titles()
	{
		$display_field_titles = array();
		
		foreach ($this->get_display_fields() as $df) {
			if (isset($df['title'])) {
				$display_field_titles[] = $df['title'];
			} else {
				$display_field_titles[]
					= Formatting_ListOfWordsHelper
						::capitalise_delimited_string(
							$df['name'],
							'_'
						);
			}
		}
		
		return $display_field_titles;
	}
	
	/**
	 * Get the links for the top of the page.
	 */
	public function
		get_top_links()
	{
		if (!isset($this->top_links)) {
			$this->top_links = array();
			
			$sxe = $this->get_simple_xml_element();
			
			foreach ($sxe->{'top-links'}->link as $top_link) {
				$this->top_links[] = array(
					'title' => (string)$top_link['title'],
					'url' => (string)$top_link['url']
				);
			}
		}
		
		return $this->top_links;
	}
	
	/**
	 * Returns the select query that will be used to fetch the
	 * rows from the database.
	 *
	 * This query is generated from the values in the file.
	 *
	 * Will we ever want to set this explicitly in the file?
	 */
	public function
		get_select_query()
	{
		$query = '';
		
		$key_fields = $this->get_key_fields();
		
		#print_r($key_fields);
		
		$display_fields = $this->get_display_fields();
		
		#print_r($display_fields);
		
		$table_name = $this->get_table_name();
		
		$ordering_fields = $this->get_ordering_fields();
		
		#print_r($ordering_fields);
		
		/*
		 * The select clause.
		 */
		
		$select_fields = array();
		
		foreach ($key_fields as $key_field) {
			$select_fields[] = $key_field;
		}
		
		foreach ($display_fields as $display_field) {
			$select_fields[] = $display_field['name'];
		}
		
		#print_r($select_fields);
		
		$select_fields = array_unique($select_fields);
		
		#print_r($select_fields);
		
		$query .= 'SELECT ';
		
		$first = TRUE;
		foreach ($select_fields as $select_field) {
			if ($first) {
				$first = FALSE;
			} else {
				$query .= ' , ';
			}
			
			$query .= ' ' . $select_field . ' ';
		}
		
		/*
		 * The from clause.
		 */
		
		$query .= ' FROM ' . $table_name . ' ';
		
		/*
		 * The order by clause.
		 */
		
		$query .= ' ORDER BY ';
		
		$first = TRUE;
		foreach ($ordering_fields as $of) {
			if ($first) {
				$first = FALSE;
			} else {
				$query .= ' , ';
			}
			
			$query .= ' ' . $of['name'] . ' ' . $of['direction'] . ' ';
		}
		
		#echo $query;
		
		return $query;
	}
}
?>