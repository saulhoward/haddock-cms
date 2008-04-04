<?php
/**
 * HTMLTags_HiddenInput
 *
 * @copyright 2008-04-04, RFI
 */

/**
 * Hidden inputs are used to set additional values in forms
 * that are hidden from the user.
 */
class
	HTMLTags_HiddenInput
extends
	HTMLTags_Input
{
	public function
		__construct($name, $value)
	{
		parent::__construct();
		
		$this->set_attribute_str('type', 'hidden');
		$this->set_attribute_str('name', $name);
		$this->set_attribute_str('value', $value);
	}
}
?>