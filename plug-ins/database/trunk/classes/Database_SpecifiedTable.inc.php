<?php
/**
 * Database_SpecifiedTable
 *
 * @copyright 2008-06-12, RFI
 */

class
	Database_SpecifiedTable
{
	private $name;
	
	private $fields;
	
	private $indexes;
	
	public function 
		__construct(
			$name
		)
	{
		$this->name = $name;
		
		$this->fields = array();
		
		$this->indexes = array();
	}

	public function 
		get_name()
	{
		return $this->name;
	}
	
	public function
		has_field($field_name)
	{
		return isset($this->fields[$field_name]);
	}
	
	public function
		get_field_type($field_name)
	{
		if ($this->has_field($field_name)) {
			return $this->fields[$field_name]['type'];
		} else {
			throw new ErrorHandling_SprintfException(
				'No field called \'%s\'!',
				array(
					$field_name
				)
			);
		}
	}
	
	public function
		add_field_type(
			$field_name,
			$type
		)
	{
		$this->fields[$field_name]['type'] = $type;
	}
	
	public function
		add_index(
			$index_name,
			$column_name,
			$non_unique
		)
	{
		$this->indexes[$index_name] = array(
			'column_name' => $column_name,
			'non_unique' => $non_unique
		);
	}
	
	public function
		get_create_statement()
	{
		$create_statement = '';
		
		$create_statement .= 'CREATE TABLE IF NOT EXISTS ';
		
		$create_statement .= $this->get_name();
		
		return $create_statement;
	}
}
?>