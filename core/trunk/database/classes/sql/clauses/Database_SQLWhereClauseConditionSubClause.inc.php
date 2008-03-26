<?php
/**
 * Database_SQLWhereClauseConditionSubClause
 *
 * @copyright 2008-03-25, RFI
 */

class
	Database_SQLWhereClauseConditionSubClause
extends
	Database_SQLClause
{
	private $value;
	private $field_name;
	private $table_name;
	private $operator;
	private $conjunction;
	private $negated;
	
	public function
		__construct(
			$value,
			$field_name,
			$table_name,
			$operator = '=',
			$conjunction = 'AND',
			$negated = FALSE
		)
	{
		$this->value = $value;
		$this->field_name = $field_name;
		$this->table_name = $table_name;
		$this->operator = $operator;
		$this->conjunction = $conjunction;
		$this->negated = $negated;
	}
	
	public function
		get_conjunction()
	{
		return $this->conjunction;
	}
	
	public function
		get_as_string()
	{
		$str = '';
		
		if ($this->negated) {
			$str .= ' NOT( ';
		}
		
		if (isset($this->table_name)) {
			$str .= $this->table_name . '.';
		}
		
		$str .= $this->field_name;
		
		$str .= ' ' . $this->operator . ' ';
		
		$str .= $this->value;
		
		if ($this->negated) {
			$str .= ' ) ';
		}
		
		return $str;
	}
}
?>