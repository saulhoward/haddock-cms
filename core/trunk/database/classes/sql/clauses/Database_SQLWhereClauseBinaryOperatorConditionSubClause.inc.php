<?php
/**
 * Database_SQLWhereClauseBinaryOperatorConditionSubClause
 *
 * @copyright 2008-05-14, RFI
 */

class
	Database_SQLWhereClauseBinaryOperatorConditionSubClause
extends
	Database_SQLWhereClauseConditionSubClause
{
	private $value;
	private $operator;
	
	public function
		__construct(
			$value,
			$field_name,
			$table_name = NULL,
			$operator = NULL,
			$conjunction = NULL,
			$negated = NULL
		)
	{
		parent::__construct(
			$field_name,
			$table_name,
			$conjunction,
			$negated
		);
		
		$this->value = $value;
		
		if (isset($operator)) {
			$this->operator = $operator;
		} else {
			$this->operator = '=';
		}
	}
	
	public function 
		get_value()
	{
		return $this->value;
	}

	public function 
		set_value($value)
	{
		$this->value = $value;
	}

	public function 
		get_operator()
	{
		return $this->operator;
	}

	public function 
		set_operator($operator)
	{
		$this->operator = $operator;
	}
	
	protected function
		get_value_string()
	{
		$str .= ' ' . $this->get_operator() . ' ';
		
		$str .= $this->get_value();
		
		return $str;
	}
	
	#public function
	#	get_as_string()
	#{
	#	$str = '';
	#	
	#	if ($this->negated) {
	#		$str .= ' NOT( ';
	#	}
	#	
	#	if (isset($this->table_name)) {
	#		$str .= $this->table_name . '.';
	#	}
	#	
	#	$str .= $this->field_name;
	#	
	#	$str .= ' ' . $this->operator . ' ';
	#	
	#	$str .= $this->value;
	#	
	#	if ($this->negated) {
	#		$str .= ' ) ';
	#	}
	#	
	#	return $str;
	#}
}
?>