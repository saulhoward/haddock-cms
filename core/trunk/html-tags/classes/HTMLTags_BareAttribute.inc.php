<?php
/**
 * HTMLTags_BareAttribute
 *
 * @copyright 2006-11-27, Robert Impey
 */

class
	HTMLTags_BareAttribute
extends
	HTMLTags_Attribute
{
	public function
		get_as_string()
	{
		return $this->get_name();
	}
}
?>