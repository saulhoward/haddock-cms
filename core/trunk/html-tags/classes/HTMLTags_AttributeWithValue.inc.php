<?php
/**
 * HTMLTags_AttributeWithValue
 *
 * @copyright 2006-11-27, RFI
 */

class
	HTMLTags_AttributeWithValue
extends
	HTMLTags_Attribute
{
	private $value;
	
	public function
		__construct(
			$name,
			$value
		)
	{
		parent::__construct($name);
		$this->value = $value;
	}
	
	public function
		get_value()
	{
		return $this->value;
	}
	
	public function
		get_as_string()
	{
		$name_value_string = '';
		
		$name_value_string .= $this->get_name();
		
		$name_value_string .= ' = ';
		
		$name_value_string .= '"';
		$name_value_string .= $this->get_value();
		$name_value_string .= '"';
		
		return $name_value_string;
	}
}
?>