<?php
/**
 * HTMLTags_TD
 *
 * @copyright 2006-11-29, RFI
 */

#require_once PROJECT_ROOT . '/haddock/html-tags/classes/HTMLTags_TagWithContent.inc.php';

class
	HTMLTags_TD
extends
	HTMLTags_TagWithContent
{
	public function
		__construct(
			$content = NULL
		)
	{
		parent::__construct('td', $content);
	}
}
?>