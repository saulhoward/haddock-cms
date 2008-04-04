<?php
/**
 * HTMLTags_Attribute
 *
 * @copyright 2006-11-27, RFI
 */

abstract class
	HTMLTags_Attribute
{
	private $name;
	
	public function
		__construct($name)
	{
		$this->name = $name;
	}
	
	public function
		get_name()
	{
		return $this->name;
	}
	
	abstract public function
		get_as_string();
}
?>