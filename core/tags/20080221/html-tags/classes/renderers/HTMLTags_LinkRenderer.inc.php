<?php
/**
 * HTMLTags_LinkRenderer
 *
 * RFI & SANH 2006-11-27
 */

class
	HTMLTags_LinkRenderer
{
	public static function
		render_style_sheet_link(
			$href,
			$media = NULL,
			$rel = NULL,
			$type = NULL
		)
	{
		$ssl = HTMLTags_LinkFactory::get_style_sheet_link(
			$href,
			$media,
			$rel,
			$type
		);
		
		echo $ssl->get_as_string();
	}
}
?>