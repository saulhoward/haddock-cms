<?php
/**
 * Database_SQLOrderByClauseFieldSubClause
 *
 * @copyright 2008-03-26, RFI
 */

class
	Database_SQLOrderByClauseFieldSubClause
extends
	Database_SQLSubClause
{
	private $field_name;
	private $direction;
	private $table_name;
	
	public function
		__construct(
			$field_name,
			$direction,
			$table_name = NULL
		)
	{
		$this->field_name = $field_name;
		$this->direction = $direction;
		$this->table_name = $table_name;
	}
	
	public function
		get_as_string()
	{
		$str .= '';
		
		$str .= ' ';
		
		if (isset($this->table_name)) {
			$str .= $this->table_name . '.';
		}
		
		$str .= $this->field_name;
		
		$str .= ' ';
		
		$str .= $this->direction;
		
		$str .= ' ';
		
		return $str;
	}
}
?>