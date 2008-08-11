<?php
/**
 * Database_SQLSelectClauseFieldSubClause
 *
 * @copyright 2008-03-24, RFI
 */

class
	Database_SQLSelectClauseFieldSubClause
extends
	Database_SQLSubClause
{
	private $name;
	private $table_name;
	private $alias;
	
	public function
		__construct(
			$name,
			$table_name = NULL,
			$alias = NULL
		)
	{
		$this->name = $name;
		$this->table_name = $table_name;
		$this->alias = $alias;
	}
	
	public function
		get_as_string()
	{
		$str = ' ';
		
		if (isset($this->table_name)) {
			$str .= $this->table_name . '.';
		}
		
		$str .= $this->name;
		
		if (isset($this->alias)) {
			$str .= ' AS ' . $this->alias;
		}
		
		$str .= ' ';
		
		return $str;
	}
}
?>