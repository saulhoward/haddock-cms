<?php
/**
 * Database_SQLUpdateClause
 *
 * @copyright 2008-05-14, RFI
 */

/**
 * The UPDATE clause is the first part of an UPDATE
 * statement.
 */
class
	Database_SQLUpdateClause
extends
	Database_SQLClause
{
	private $table_name;

	public function 
		__construct(
			$table_name
		)
	{
		$this->table_name = $table_name;
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
		get_as_string()
	{
		return 'UPDATE ' . $this->get_table_name() . ' ';
	}
}
?>