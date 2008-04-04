<?php
/**
 * HTMLTags_TextArea
 *
 * @copyright 2006-11-27, RFI
 */

class
	HTMLTags_TextArea
extends
	HTMLTags_TagWithContent
implements
	HTMLTags_InputTag
{
	public function
		__construct(
			$content = NULL
		)
	{
		parent::__construct('textarea', $content);
	}
	
	public function
		set_value($value)
	{
		$this->append_str_to_content($value);
	}
}
?>