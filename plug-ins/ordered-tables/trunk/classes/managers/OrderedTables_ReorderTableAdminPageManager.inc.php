<?php
class
	OrderedTables_ReorderTableAdminPageManager
{
	private $xml_config_file_name;
	
	private $simple_xml_element;
	#private $dom_document;
	
	private $table_name;
	
	private $key_fields;
	
	private $ordering_fields;
	
	private $display_fields;
	
	private $top_links;
	
	public function
		__construct($xml_config_file_name)
	{
		$this->xml_config_file_name = $xml_config_file_name;
		
		$this->simple_xml_element
			= simplexml_load_file($this->xml_config_file_name);
		
		#foreach ($this->simple_xml_element->table->attributes() as $k => $v) {
		#	if ($k == 'name') {
		#		$this->table_name = $v;
		#	}
		#}
		
		#$this->dom_document = new DOMDocument();
		#$this->dom_document->load($this->xml_config_file_name);
		
		/*
		 * Get the table name.
		 */
		
		$this->table_name = (string)$this->simple_xml_element->table['name'];
		
		/*
		 * Get the names of the key fields.
		 */
		$this->key_fields = array();
		
		foreach ($this->simple_xml_element->table->{'key-fields'}->field as $field) {
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
		
		/*
		 * Get the order by field and direction.
		 */
		$this->ordering_fields = array();
		
		foreach ($this->simple_xml_element->table->ordering->field as $field) {
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
		
		/*
		 * Get the fields to display.
		 */
		
		$this->display_fields = array();
		
		foreach ($this->simple_xml_element->table->display->field as $field) {
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
		
		/*
		 * Get the links for the top of the page.
		 */
		
		$this->top_links = array();
		
		foreach ($this->simple_xml_element->{'top-links'}->link as $top_link) {
			$this->top_links = array(
				'title' => (string)$top_link['title'],
				'url' => (string)$top_link['url']
			);
		}
		
		#print_r($this);
	}
}
?>