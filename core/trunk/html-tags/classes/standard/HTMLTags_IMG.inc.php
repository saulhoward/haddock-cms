<?php
/**
 * HTMLTags_IMG
 *
 * RFI & SANH 2006-11-29
 */

//require_once PROJECT_ROOT . '/haddock/html-tags/classes/HTMLTags_TagWithoutContent.inc.php';
//require_once PROJECT_ROOT . '/haddock/html-tags/classes/HTMLTags_URL.inc.php';

class
	HTMLTags_IMG
extends
	HTMLTags_TagWithoutContent
{
	public function
		__construct()
	{
		parent::__construct('img');
	}
	
	public function
		set_src(HTMLTags_URL $href)
	{
		$this->set_attribute_str('src', $href->get_as_string());
	}
	
	/**
	 * Set the ALT attribute.
	 *
	 * Should this be a requirement for IMG tags?
	 *
	 * Are there any other tags that should have ALT set?
	 *
	 * How can we share code?
	 *
	 * Interfaces and delegation perhaps.
	 */
	public function
		set_alt($alt_text)
	{
		$this->set_attribute_str('alt', $alt_text);
	}
}
?>