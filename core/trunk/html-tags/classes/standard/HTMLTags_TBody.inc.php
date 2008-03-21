<?php
/**
 * HTMLTags_TBody
 *
 * @copyright 2006-11-29, RFI
 */

#require_once PROJECT_ROOT . '/haddock/html-tags/classes/HTMLTags_TagWithContent.inc.php';

class
	HTMLTags_TBody
extends
	HTMLTags_TagWithContent
{
	public function
		__construct(
			$content = NULL
		)
	{
		parent::__construct('tbody', $content);
	}
}
?>