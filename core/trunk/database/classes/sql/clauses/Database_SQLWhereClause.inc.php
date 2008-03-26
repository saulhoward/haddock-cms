<?php
/**
 * Database_SQLWhereClause
 *
 * @copyright Clear Line Web Design, 2007-02-20
 */

class
    Database_SQLWhereClause
extends
	Database_SQLClause
{
	/*
	 * An array of Database_SQLWhereClauseConditionSubClause objects.
	 */
	private $conditions;
	
	public function
		__construct()
	{
		$this->conditions = array();
	}
	
	public function
		add_condition(
			Database_SQLWhereClauseConditionSubClause $condition
		)
	{
		$this->conditions[] = $condition;
	}
	
	public function
		add_str_literal_and_condition_str(
			$literal_value,
			$field_name,
			$table_name
		)
	{
		$this->add_condition(
			new Database_SQLWhereClauseConditionSubClause(
				"'$literal_value'",
				$field_name,
				$table_name,
				'=',
				'AND'
			)
		);
	}
	
    public function
		get_as_string()
	{
		$str = '';
		
		$str .= ' WHERE ';
		
		$first = TRUE;
		foreach ($this->conditions as $condition) {
			if ($first) {
				$first = FALSE;
			} else {
				$str .= ' ' . $condition->get_conjunction() . ' ';
			}
			
			$str .= ' ' . $condition->get_as_string() . ' ';
		}
		
		return $str;
	}
}
?>