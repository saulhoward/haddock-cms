<?php
/**
 * HTMLTags_ScriptRenderer
 *
 * @copyright, 2008-03-05, RFI
 */

class
	HTMLTags_ScriptRenderer
{
	public static function
		render_external_js_script(
			$url
		)
	{
		echo "<script type=\"text/javascript\" src=\"$url\"></script>\n";
	}
}
?>