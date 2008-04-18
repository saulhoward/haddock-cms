<?php
/**
 * HTMLTags_BLSeparatedPsRenderer
 *
 * @copyright 2008-04-18, RFI
 */

class
	HTMLTags_BLSeparatedPsRenderer
{
	public static function
		render_bl_separated_text_as_ps($str)
	{
		$ps = HTMLTags_BLSeparatedPFactory::get_ps_from_str($str);
		
		foreach ($ps as $p) {
			echo $p->get_as_string();
		}
	}
}
?>