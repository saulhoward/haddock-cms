<?php
/**
 * HTMLTags_TR
 *
 * @copyright 2006-11-29, RFI
 */

#require_once PROJECT_ROOT . '/haddock/html-tags/classes/HTMLTags_TagWithContent.inc.php';

class
	HTMLTags_TR
extends
	HTMLTags_TagWithContent
{
	public function
		__construct($content = null)
	{
		parent::__construct('tr', $content);
	}
}
?>