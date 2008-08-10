<?php
/**
 * HTMLTags_Noscript
 *
 * @copyright 2007-03-08, RFI
 */

class
	HTMLTags_Noscript
extends
	HTMLTags_TagWithContent
{
	public function
		__construct($content = NULL)
	{
		parent::__construct('noscript', $content);
	}
}
?>