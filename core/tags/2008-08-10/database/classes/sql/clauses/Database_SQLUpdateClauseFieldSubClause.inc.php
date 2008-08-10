<?php
/**
 * Database_SQLUpdateClauseQuotedValueFieldSubClause
 *
 * @copyright 2008-05-14, RFI
 */

class
	Database_SQLUpdateClauseFieldSubClause
extends
	Database_SQLSubClause
{
	private $field_name;
	private $value;

	public function 
		__construct(
			$field_name,
			$value
		)
	{
		$this->field_name = $field_name;
		$this->value = $value;
	}

	public function 
		get_field_name()
	{
		return $this->field_name;
	}

	public function 
		set_field_name($field_name)
	{
		$this->field_name = $field_name;
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
	
	protected function
		get_value_for_string()
	{
		return $this->get_value();
	}
	
	public function
		get_as_string()
	{
		return $this->get_field_name() . ' = ' . $this->get_value_for_string();
	}
}
?>