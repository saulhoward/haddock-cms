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
#implements
#	Database_SQLStatementWithWhereClause
{
	#private $selected_items_clause;
	
	private $select_clause;
	
	#private $tables;
	
	private $from_clause;
	
	private $where_clause;
	
	private $order_by_clause;
	
	private $limit_clause;
	
	#protected function
	#	set_behaviours()
	#{
	#	$this->add_behaviour(
	#		'add_conditions_to_where_clause',
	#		new Database_AddConditionsToWhereClauseBehaviour($this)
	#	);
	#}
	
	/*
	 * -------------------------------------------------
	 * Functions to do with the SELECT clause.
	 * -------------------------------------------------
	 */
	
	#public function
	#	get_selected_items_clause()
	#{
	#	if (!isset($this->selected_items_clause)) {
	#		$this->selected_items_clause
	#			= new Database_SQLStatementSelectedItemsClause();
	#	}
	#	
	#	return $this->selected_items_clause;
	#}
	
	public function
		get_select_clause()
	{
		if (!isset($this->select_clause)) {
			$this->select_clause = new Database_SQLSelectClause();
		}
		
		return $this->select_clause;
	}
	
	/**
	 * Adds a field to the select clause.
	 *
	 * This function is not really necessary but might make things
	 * a little more convenient.
	 */
	public function
		add_field_str_to_select_clause(
			$name,
			$table_name = NULL,
			$alias = NULL
		)
	{
		$select_clause = $this->get_select_clause();
		
		$select_clause->add_field_str(
			$name,
			$table_name,
			$alias
		);
	}
	
	#public function
	#	add_table(Database_Table $table)
	#{
	#	if (!is_array($this->tables)) {
	#		$this->tables = array();
	#	}
	#	
	#	$this->tables[] = $table;
	#}
	
	/*
	 * -------------------------------------------------
	 * Functions to do with the FROM clause.
	 * -------------------------------------------------
	 */
	
	public function
		get_from_clause()
	{
		if (!isset($this->from_clause)) {
			$this->from_clause = new Database_SQLFromClause();
		}
		
		return $this->from_clause;
	}
	
	#public function
	#	add_from_clause_table_reference(
	#		Database_SQLFromClauseTableReference $from_clause_table_reference
	#	)
	#{
	#	$from_clause = $this->get_from_clause();
	#	
	#	$from_clause->add_table_reference($from_clause_table_reference);
	#}
	
	public function
		set_from_clause_table_name($table_name)
	{
		$from_clause = $this->get_from_clause();
		
		$from_clause->set_table_name($table_name);
	}
	
	public function
		add_from_clause_inner_join(
			$joining_table,
			$joining_field,
			$condition_table,
			$condition_field
		)
	{
		$from_clause = $this->get_from_clause();
		
		$from_clause->add_inner_join(
			$joining_table,
			$joining_field,
			$condition_table,
			$condition_field
		);
	}
	
	public function
		add_from_clause_left_join(
			$joining_table,
			$joining_field,
			$condition_table,
			$condition_field
		)
	{
		$from_clause = $this->get_from_clause();
		
		$from_clause->add_left_join(
			$joining_table,
			$joining_field,
			$condition_table,
			$condition_field
		);
	}
	
	/*
	 * -------------------------------------------------
	 * Functions to do with the WHERE clause.
	 * -------------------------------------------------
	 */
	
	public function
		get_where_clause()
	{
		if (!isset($this->where_clause)) {
			$this->where_clause = new Database_SQLWhereClause();
		}
		
		return $this->where_clause;
	}
	
	#public function
	#	add_conditions_to_where_clause(
	#		$conditions
	#	)
	#{
	#	$this->run_behaviour(
	#		'add_conditions_to_where_clause',
	#		$conditions
	#	);
	#}
	
	public function
		add_where_clause_str_literal_and_condition(
			$literal_value,
			$field_name,
			$table_name = NULL
		)
	{
		$where_clause = $this->get_where_clause();
		
		$where_clause->add_str_literal_and_condition_str(
			$literal_value,
			$field_name,
			$table_name
		);
	}
	
	/*
	 * -------------------------------------------------
	 * Functions to do with the ORDER BY clause.
	 * -------------------------------------------------
	 */
	
	public function
		get_order_by_clause()
	{
		if (!isset($this->order_by_clause)) {
			$this->order_by_clause = new Database_SQLOrderByClause();
		}
		
		return $this->order_by_clause;
	}
	
	public function
		add_order_by_clause_field(
			$field_name,
			$direction,
			$table_name = NULL
		)
	{
		$order_by_clause_field = $this->get_order_by_clause();
		
		$order_by_clause_field->add_field_str(
			$field_name,
			$direction,
			$table_name
		);
	}
	
	/*
	 * -------------------------------------------------
	 * Functions to do with the LIMIT clause.
	 * -------------------------------------------------
	 */
	
	public function
		get_limit_clause()
	{
		if (!isset($this->limit_clause)) {
			$this->limit_clause = new Database_SQLLimitClause();
		}
		
		return $this->limit_clause;
	}
	
	/*
	 * -------------------------------------------------
	 * Functions to do with putting it all together.
	 * -------------------------------------------------
	 */
	
	/**
	 * Puts the SELECT statement together.
	 *
	 * The SELECT and FROM clauses must have been
	 * set by the time that this function is called.
	 *
	 * If the WHERE, ORDER BY or LIMIT clauses have not been set,
	 * then nothing happens with them.
	 */
	protected function
		assemble()
	{
		$this->str ='';
		
		#$this->str = 'SELECT ';
		#
		##$this->str .= ' * ';
		#
		#$selected_items_clause = $this->get_selected_items_clause();
		#
		#$this->str .= $selected_items_clause->get_as_string();
		
		#$this->str .= ' FROM ';
		
		/*
		 * The SELECT clause.
		 */
		$select_clause = $this->get_select_clause();
		
		$this->str .= $select_clause->get_as_string();
		
		#/*
		# * The table references.
		# */
		#if (
		#	!is_array($this->tables)
		#	and (count($this->tables) < 1)
		#) {
		#	throw new Exception('No table added to SQL SELECT statement!');
		#}
		#
		#$first = TRUE;
		#foreach ($this->tables as $table) {
		#	if ($first) {
		#		$first = FALSE;
		#	} else {
		#		$this->str .= ' , ';
		#	}
		#	
		#	$this->str .= ' ' . $table->get_name() . ' ';
		#}
		
		/*
		 * The FROM clause.
		 */
		$from_clause = $this->get_from_clause();
		
		$this->str .= $from_clause->get_as_string();
		
		/*
		 * The WHERE clause.
		 */
		if (isset($this->where_clause)) {
			$where_clause = $this->get_where_clause();
			
			$this->str .= $where_clause->get_as_string();
		}
		
		/*
		 * The ORDER BY clause.
		 */
		if (isset($this->order_by_clause)) {
			$order_by_clause = $this->get_order_by_clause();
			
			$this->str .= $order_by_clause->get_as_string();
		}
		
		/*
		 * The LIMIT clause.
		 */
		if (isset($this->limit_clause)) {
			$limit_clause = $this->get_limit_clause();
			
			$this->str .= $limit_clause->get_as_string();
		}
	}
}
?>