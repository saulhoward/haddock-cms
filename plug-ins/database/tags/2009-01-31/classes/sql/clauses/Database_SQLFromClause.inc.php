<?php
/**
 * Database_SQLFromClause
 *
 * @copyright 2008-03-24, RFI
 */

/**
 * Builds a FROM clause
 * 
 * See
 *	http://dev.mysql.com/doc/refman/5.0/en/join.html
 */
class
	Database_SQLFromClause
extends
	Database_SQLClause
{
	/*
	 * An array of Database_SQLFromClauseTableReference objects.
	 */
	private $table_references;
	
	public function
		__construct()
	{
		$this->table_references = array();
	}
	
	public function
		add_table_reference(
			Database_SQLFromClauseTableReference $table_reference
		)
	{
		$this->table_references[] = $table_reference;
	}
	
	public function
		get_as_string()
	{
		$str .= ' FROM ';
		
		$first = TRUE;
		foreach ($this->table_references as $tr) {
			if ($first) {
				$first = FALSE;
			} else {
				$str .= ' , ';
			}
			
			$str .= $tr->get_as_string();
		}
		
		$str .= ' ';
		
		return $str;
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with the first table reference.
	 *
	 * The majority of FROM clauses only have one.
	 * ----------------------------------------
	 */
	
	private function
		get_first_table_reference()
	{
		if (count($this->table_references) == 0) {
			$this->add_table_reference(new Database_SQLFromClauseTableReference());
		}
		
		return $this->table_references[0];
	}
	
	public function
		set_table_name($table_name)
	{
		$first_table_reference = $this->get_first_table_reference();
		
		$first_table_reference->set_table_name($table_name);
	}
	
	public function
		add_inner_join(
			$joining_table,
			$joining_field,
			$condition_table,
			$condition_field
		)
	{
		$first_table_reference = $this->get_first_table_reference();
		
		$first_table_reference->add_inner_join(
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
		$first_table_reference = $this->get_first_table_reference();
		
		$first_table_reference->add_left_join(
			$joining_table,
			$joining_field,
			$condition_table,
			$condition_field
		);
	}
}
?>