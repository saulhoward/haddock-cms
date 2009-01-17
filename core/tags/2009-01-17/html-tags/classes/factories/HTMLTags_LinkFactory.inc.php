<?php
/**
 * HTMLTags_LinkFactory
 *
 * RFI & SANH 2006-11-27
 */

class
	HTMLTags_LinkFactory
{
	public static function
		get_style_sheet_link(
			$href,
			$media = NULL,
			$rel = NULL,
			$type = NULL
		)
	{
		return new HTMLTags_StyleSheetLink(
			$href,
			$media,
			$rel,
			$type
		);
	}
}
?>