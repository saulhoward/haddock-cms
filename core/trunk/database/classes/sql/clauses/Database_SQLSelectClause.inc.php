<?php
/**
 * Database_SQLSelectClause
 *
 * @copyright 2008-03-24, RFI
 */

class
	Database_SQLSelectClause
extends
	Database_SQLClause
{
	/*
	 * An array of Database_SQLSelectClauseFieldSubClause objects.
	 */
	private $fields;
	
	public function
		__construct()
	{
		$this->fields = array();
	}
	
	public function
		add_field(
			Database_SQLSelectClauseFieldSubClause $field
		)
	{
		$this->fields[] = $field;
	}
	
	public function
		add_field_str(
			$name,
			$table_name = NULL,
			$alias = NULL
		)
	{
		$field = new Database_SQLSelectClauseFieldSubClause(
			$name,
			$table_name,
			$alias
		);
		
		$this->add_field($field);
	}
	
	public function
		get_as_string()
	{
		$str = 'SELECT ';
		
		if (count($this->fields) == 0) {
			#throw new Exception('Please add some fields to the select query!');
			
			$str .= ' * ';
			
		} else {
			#$str = 'SELECT ';
			
			$first = TRUE;
			foreach ($this->fields as $field) {
				if ($first) {
					$first = FALSE;
				} else {
					$str .= ' , ';
				}
				
				$str .= $field->get_as_string();
			}
			
			#return $str;
		}
		
		return $str;
	}
}
?>