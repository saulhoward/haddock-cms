<?php
/**
 * Database_SQLSelectQuery
 *
 * @copyright 2006-11-24, RFI
 */

#require_once PROJECT_ROOT
#    . '/haddock/database/classes/sql-statements/'
#    . 'Database_SQLStatement.inc.php';
#
#require_once PROJECT_ROOT
#    . '/haddock/database/classes/sql-statements/'
#    . 'Database_SQLStatementWithWhereClause.inc.php';
#
#require_once PROJECT_ROOT
#    . '/haddock/database/classes/sql-statements/'
#    . 'Database_AddConditionsToWhereClauseBehaviour.inc.php';

class
	Database_SQLSelectQuery
extends
	Database_SQLStatement
implements
	Database_SQLStatementWithWhereClause
{
	private $selected_items_clause;
	
	private $tables;
	
	private $where_clause;
	
	private $order_by_clause;
	
	private $limit_clause;
	
	protected function
		set_behaviours()
	{
		$this->add_behaviour(
			'add_conditions_to_where_clause',
			new Database_AddConditionsToWhereClauseBehaviour($this)
		);
	}
	
	public function
		get_selected_items_clause()
	{
		if (!isset($this->selected_items_clause)) {
			$this->selected_items_clause
				= new Database_SQLStatementSelectedItemsClause();
		}
		
		return $this->selected_items_clause;
	}
	
	public function
		add_table(Database_Table $table)
	{
		if (!is_array($this->tables)) {
			$this->tables = array();
		}
		
		$this->tables[] = $table;
	}
	
	public function
		get_where_clause()
	{
		if (!isset($this->where_clause)) {
			$this->where_clause = new Database_SQLStatementWhereClause();
		}
		
		return $this->where_clause;
	}
	
	public function
		add_conditions_to_where_clause(
			$conditions
		)
	{
		$this->run_behaviour(
			'add_conditions_to_where_clause',
			$conditions
		);
	}
	
	public function
		get_order_by_clause()
	{
		if (!isset($this->order_by_clause)) {
			$this->order_by_clause = new Database_SQLStatementsOrderByClause();
		}
		
		return $this->order_by_clause;
	}
	
	public function
		get_limit_clause()
	{
		if (!isset($this->limit_clause)) {
			$this->limit_clause = new Database_SQLStatementsLimitClause();
		}
		
		return $this->limit_clause;
	}
	
	protected function
		assemble()
	{
		$this->str = 'SELECT ';
		
		#$this->str .= ' * ';
		
		$selected_items_clause = $this->get_selected_items_clause();
		
		$this->str .= $selected_items_clause->get_as_string();
		
		$this->str .= ' FROM ';
		
		/*
		 * The table references.
		 */
		if (
			!is_array($this->tables)
			and (count($this->tables) < 1)
		) {
			throw new Exception('No table added to SQL SELECT statement!');
		}
		
		$first = TRUE;
		foreach ($this->tables as $table) {
			if ($first) {
				$first = FALSE;
			} else {
				$this->str .= ' , ';
			}
			
			$this->str .= ' ' . $table->get_name() . ' ';
		}
		
		/*
		 * The WHERE clause.
		 */
		$where_clause = $this->get_where_clause();
		
		$this->str .= $where_clause->get_as_string();
		
		/*
		 * The ORDER BY clause.
		 */
		$order_by_clause = $this->get_order_by_clause();
		
		$this->str .= $order_by_clause->get_as_string();
		
		/*
		 * The LIMIT clause.
		 */
		$limit_clause = $this->get_limit_clause();
		
		$this->str .= $limit_clause->get_as_string();
	}
}
?>