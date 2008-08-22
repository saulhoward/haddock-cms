<?php
/**
 * HTMLTags_MetaWithNameAndContent
 *
 * @copyright 2007-08-29, RFI
 */

class
	HTMLTags_MetaWithNameAndContent
extends
	HTMLTags_Meta
{
	public function
		__construct($name, $content)
	{
		parent::__construct();
		
		$this->set_attribute_str('name', $name);
		
		$this->set_attribute_str('content', $content);
	}
}
?>