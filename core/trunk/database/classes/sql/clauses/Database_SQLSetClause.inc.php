<?php
/**
 * Database_SQLSetClause
 *
 * @copyright 2007-02-20, RFI
 */

class
    Database_SQLSetClause
extends
	Database_SQLClause
{
    private $fields;
	
	public function
		__construct()
	{
		$this->fields = array();
	}
	
	public function
		add_field(
			Database_SQLUpdateClauseFieldSubClause $field
		)
	{
		$this->fields[] = $field;
	}
	
	public function
		get_as_string()
	{
		$str = ' SET ';
		
		$first = TRUE;
		foreach ($this->fields as $field) {
			if ($first) {
				$first = FALSE;
			} else {
				$str .= ' , ';
			}
			
			$str .= $field->get_as_string();
		}
		
		return $str;
	}
}
?>