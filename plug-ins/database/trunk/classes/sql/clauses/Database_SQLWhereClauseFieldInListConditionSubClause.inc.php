<?php
/**
 * Database_SQLWhereClauseFieldInListConditionSubClause
 *
 * @copyright 2008-05-14, RFI
 */

class
	Database_SQLWhereClauseFieldInListConditionSubClause
extends
	Database_SQLWhereClauseConditionSubClause
{
	private $values;
	
	public function
		__construct(
			$field_name,
			$table_name = NULL,
			$conjunction = NULL,
			$negated = NULL
		)
	{
		parent
			::__construct(
				$field_name,
				$table_name,
				$conjunction,
				$negated
			);
		
		$this->values = array();
	}
	
	public function
		add_value(
			$value
		)
	{
		$this->values[] = $value;
	}
	
	protected function
		get_value_string()
	{
		echo __METHOD__ . "\n";
		
		#print_r($this->values); exit;
		
		$str .= ' IN (';
		
		$first = TRUE;
		foreach ($this->values as $value) {
			if ($first) {
				$first = FALSE;
			} else {
				$str .= ' , ';
			}
			
			$str .= $value;
		}
		
		$str .= ' ) ';
		
		#echo 'strlen($str): ' . strlen($str) . "\n"; exit;
		
		return $str;
	}
}
?>