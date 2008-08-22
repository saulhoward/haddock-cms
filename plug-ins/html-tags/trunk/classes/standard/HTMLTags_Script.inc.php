<?php
/**
 * HTMLTags_Script
 *
 * @copyright 2006-11-29, RFI
 */

class
	HTMLTags_Script
extends
	HTMLTags_TagWithContent
{
	public function
		__construct($content = NULL)
	{
		parent::__construct('script', $content);
	}
}
?>