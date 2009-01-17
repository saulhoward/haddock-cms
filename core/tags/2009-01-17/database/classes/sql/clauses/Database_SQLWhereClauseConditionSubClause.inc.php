<?php
/**
 * Database_SQLWhereClauseConditionSubClause
 *
 * @copyright 2008-03-25, RFI
 */

abstract class
	Database_SQLWhereClauseConditionSubClause
extends
	Database_SQLClause
{
	private $field_name;
	private $table_name;
	private $conjunction;
	private $negated;
	
	public function
		__construct(
			$field_name,
			$table_name = NULL,
			$conjunction = NULL,
			$negated = NULL
		)
	{
		$this->field_name = $field_name;
		$this->table_name = $table_name;
		
		if (isset($conjunction)) {
			$this->conjunction = $conjunction;
		} else {
			$this->conjunction = 'AND';
		}
		
		if (isset($negated)) {
			$this->negated = $negated;
		} else {
			$this->negated = FALSE;
		}
	}
	
	public function 
		get_field_name()
	{
		return $this->field_name;
	}

	public function 
		set_field_name($field_name)
	{
		$this->field_name = $field_name;
	}

	public function 
		get_table_name()
	{
		return $this->table_name;
	}

	public function 
		set_table_name($table_name)
	{
		$this->table_name = $table_name;
	}

	public function 
		get_conjunction()
	{
		return $this->conjunction;
	}

	public function 
		set_conjunction($conjunction)
	{
		$this->conjunction = $conjunction;
	}

	public function 
		is_negated()
	{
		return $this->negated;
	}

	public function 
		set_negated($negated)
	{
		$this->negated = $negated;
	}
	
	abstract protected function
		get_value_string();
	
	public function
		get_as_string()
	{
		$str = '';
		
		if ($this->is_negated()) {
			$str .= ' NOT( ';
		}
		
		if (isset($this->table_name)) {
			$str .= $this->table_name . '.';
		}
		
		$str .= $this->field_name;
		
		$str .= $this->get_value_string();
		
		if ($this->is_negated()) {
			$str .= ' ) ';
		}
		
		return $str;
	}
}
?>