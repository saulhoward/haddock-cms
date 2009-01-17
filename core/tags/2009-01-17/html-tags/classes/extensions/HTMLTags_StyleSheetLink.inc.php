<?php
/**
 * HTMLTags_StyleSheetLink
 *
 * @copyright Clear Line Web Design, 2008-02-05
 */

class
	HTMLTags_StyleSheetLink
extends
	HTMLTags_Link
{
	public function
		__construct(
			$href,
			$media = NULL,
			$rel = NULL,
			$type = NULL
		)
	{
		parent::__construct();
		
		if (!isset($media)) {
			$media = 'screen';
		}
		if (!isset($rel)) {
			$rel = 'stylesheet';
		}
		if (!isset($type)) {
			$type = 'text/css';
		}
		
		$this->set_attribute_str('href', $href);
		$this->set_attribute_str('media', $media);
		$this->set_attribute_str('rel', $rel);
		$this->set_attribute_str('type', $type);
	}
}
?>