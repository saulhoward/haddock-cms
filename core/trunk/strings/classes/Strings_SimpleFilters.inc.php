<?php
/**
 * Strings_SimpleFilters
 *
 * @copyright RFI, 2008-01-09
 */

class
	Strings_SimpleFilters
{
	public static function
		truncate_with_ellipsis(
			$str,
			$length = 50,
			$ellipsis = '&#0133'
		)
	{	
		return Strings_FilteringHelper
			::truncate_with_ellipsis_and_convert_html_entities(
				$str,
				$length = 50,
				$ellipsis = '&#0133'
			);
	}
}
?>