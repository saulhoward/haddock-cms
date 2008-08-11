<?php
/**
 * Database_SQLFromClauseJoinSubSubClause
 *
 * @copyright 2008-03-25, RFI
 */

class
	Database_SQLFromClauseJoinSubSubClause
extends
	Database_SQLSubClause
{
	private $type;
	private $joining_table;
	private $joining_field;
	private $condition_table;
	private $condition_field;
	
	public function
		__construct(
			$type,
			$joining_table,
			$joining_field,
			$condition_table,
			$condition_field
		)
	{
		$this->type = $type;
		$this->joining_table = $joining_table;
		$this->joining_field = $joining_field;
		$this->condition_table = $condition_table;
		$this->condition_field = $condition_field;
	}
	
	public function
		get_as_string()
	{
		$str = '';
		
		$str .= ' ' . $this->type . ' ';
		
		$str .= ' JOIN ';
		
		$str .= $this->joining_table;
		
		$str .= ' ON ';
		
		$str .= $this->joining_table . '.' . $this->joining_field;
		
		$str .= ' = ';
		
		$str .= $this->condition_table . '.' . $this->condition_field;
		
		$str .= ' ';
		
		return $str;
	}
}
?>