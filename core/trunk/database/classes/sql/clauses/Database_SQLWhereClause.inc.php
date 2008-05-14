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
			new Database_SQLWhereClauseBinaryOperatorConditionSubClause(
				"'$literal_value'",
				$field_name,
				$table_name,
				'=',
				'AND'
			)
		);
	}
	
	/**
	 * This causes the query to only find rows where this column
	 * is in the future.
	 */
	public function
		add_exclusively_future_column(
			$field_name,
			$table_name = NULL
		)
	{
		$this->add_condition(
			new Database_SQLWhereClauseBinaryOperatorConditionSubClause(
				'NOW()',
				$field_name,
				$table_name,
				'>',
				'AND'
			)
		);
	}
	
	public function
		add_exclusively_past_column(
			$field_name,
			$table_name = NULL
		)
	{
		$this->add_condition(
			new Database_SQLWhereClauseBinaryOperatorConditionSubClause(
				'NOW()',
				$field_name,
				$table_name,
				'<',
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