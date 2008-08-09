<?php
/**
 * HTMLTags_Input
 *
 * @copyright 2006-11-27, Robert Impey
 */

class
	HTMLTags_Input
extends
	HTMLTags_TagWithoutContent
implements
	HTMLTags_InputTag
{
	public function
		__construct()
	{
		parent::__construct('input');
	}
	
	public function
		set_value($value)
	{
		$this->set_attribute_str('value', $value);
	}
}
?>