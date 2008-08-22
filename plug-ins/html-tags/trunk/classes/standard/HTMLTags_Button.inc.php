<?php
/**
 * HTMLTags_Button
 *
 * @copyright 2008-04-07, RFI
 */

class
	HTMLTags_Button
extends
	HTMLTags_TagWithContent
{
	public function
		__construct(
			$content = NULL
		)
	{
		parent::__construct(
			'button',
			$content
		);
	}
}
?>