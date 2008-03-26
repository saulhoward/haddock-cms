<?php
/**
 * OrderedTables_FetchAllRowsSelectQuery
 *
 * @copyright 2008-03-19, RFI
 */

class
	OrderedTables_FetchAllRowsSelectQuery
{
	private $select_clause;
	
	private $from_clause;
	
	private $order_by_clause;
	
	public function
		__construct()
	{
		$this->select_clause = new OrderedTables_FARSSelectClause();
		
		$this->from_clause = new OrderedTables_FARSFromClause();
		
		$this->order_by_clause = new OrderedTables_FARSOrderByClause();
	}
	
	public function
		add_select_clause_field($name)
	{
		$this->select_clause->add_field($name);
	}
	
	protected function
		get_select_clause()
	{
		return $this->select_clause;
	}
	
	public function
		get_as_string()
	{
		$query = '';
		
		#$key_fields = $this->get_key_fields();
		#
		##print_r($key_fields);
		#
		#$display_fields = $this->get_display_fields();
		#
		##print_r($display_fields);
		#
		#$table_name = $this->get_table_name();
		#
		#$ordering_fields = $this->get_ordering_fields();
		
		#print_r($ordering_fields);
		
		/*
		 * The select clause.
		 */
		
		#$select_fields = array();
		#
		#foreach ($key_fields as $key_field) {
		#	$select_fields[] = $key_field;
		#}
		#
		#foreach ($display_fields as $display_field) {
		#	$select_fields[] = $display_field['name'];
		#}
		#
		##print_r($select_fields);
		#
		#$select_fields = array_unique($select_fields);
		#
		##print_r($select_fields);
		#
		#$query .= 'SELECT ';
		#
		#$first = TRUE;
		#foreach ($select_fields as $select_field) {
		#	if ($first) {
		#		$first = FALSE;
		#	} else {
		#		$query .= ' , ';
		#	}
		#	
		#	$query .= ' ' . $select_field . ' ';
		#}
		#
		
		$select_clause = $this->get_select_clause();
		
		$query .= $select_clause->get_as_string();
		
		/*
		 * The from clause.
		 */
		
		$query .= ' FROM ' . $table_name . ' ';
		
		/*
		 * The order by clause.
		 */
		
		$query .= ' ORDER BY ';
		
		$first = TRUE;
		foreach ($ordering_fields as $of) {
			if ($first) {
				$first = FALSE;
			} else {
				$query .= ' , ';
			}
			
			$query .= ' ' . $of['name'] . ' ' . $of['direction'] . ' ';
		}
		
		#echo $query;
		
		return $query;
	}
}
?>