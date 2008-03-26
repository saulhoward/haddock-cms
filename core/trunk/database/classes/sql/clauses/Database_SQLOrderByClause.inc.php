<?php
/**
 * Database_SQLOrderByClause
 *
 * @copyright Clear Line Web Design, 2007-02-20
 */

class
    Database_SQLOrderByClause
extends
	Database_SQLClause
{
	/*
	 * An array of Database_SQLOrderByClauseFieldSubClause objects.
	 */
	private $fields;
	
	public function
		__construct()
	{
		$this->fields = array();
	}
	
    public function
		get_as_string()
	{
		$str = '';
		
		$str .= ' ORDER BY ';
		
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
	
	public function
		add_field_str(
			$field_name,
			$direction,
			$table_name = NULL
		)
	{
		$this->add_field(
			new Database_SQLOrderByClauseFieldSubClause(
				$field_name,
				$direction,
				$table_name
			)
		);
	}
	
	public function
		add_field(
			Database_SQLOrderByClauseFieldSubClause $field
		)
	{
		$this->fields[] = $field;
	}
}
?>
