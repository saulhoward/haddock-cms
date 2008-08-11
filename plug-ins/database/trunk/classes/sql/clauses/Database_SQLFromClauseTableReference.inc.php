<?php
/**
 * Database_SQLFromClauseTableReference
 *
 * @copyright 2008-03-24, RFI
 */

class
	Database_SQLFromClauseTableReference
extends
	Database_SQLClause
{
	private $table_name;
	
	/*
	 * An array of Database_SQLFromClauseJoinSubSubClause objects.
	 */
	private $joins;
	
	public function
		set_table_name($table_name)
	{
		$this->table_name = $table_name;
	}
	
	public function
		get_table_name()
	{
		if (!isset($this->table_name)) {
			throw new Exception('Please set the table name!');
		}
		
		return $this->table_name;
	}
	
	public function
		__construct()
	{
		$this->joins = array();
	}
	
	private function
		add_join(
			Database_SQLFromClauseJoinSubSubClause $join
		)
	{
		$this->joins[] = $join;
	}
	
	private function
		add_join_str(
			$type,
			$joining_table,
			$joining_field,
			$condition_table,
			$condition_field
		)
	{
		$this->add_join(
			new Database_SQLFromClauseJoinSubSubClause(
				$type,
				$joining_table,
				$joining_field,
				$condition_table,
				$condition_field
			)
		);
	}
	
	public function
		add_inner_join(
			$joining_table,
			$joining_field,
			$condition_table,
			$condition_field
		)
	{
		$this->add_join_str(
			'INNER',
			$joining_table,
			$joining_field,
			$condition_table,
			$condition_field
		);
	}
	
	public function
		add_left_join(
			$joining_table,
			$joining_field,
			$condition_table,
			$condition_field
		)
	{
		$this->add_join_str(
			'LEFT',
			$joining_table,
			$joining_field,
			$condition_table,
			$condition_field
		);
	}
	
	public function
		get_as_string()
	{
		$str = '';
		
		$str .= ' ' . $this->get_table_name() . ' ';
		
		foreach ($this->joins as $join) {
			$str .= ' ' . $join->get_as_string() . ' ';
		}
		
		return $str;
	}
}
?>