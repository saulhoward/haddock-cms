<?php
/**
 * Strings_FilteringHelper
 *
 * @copyright 2008-04-29, RFI
 */

class
	Strings_FilteringHelper
{
	/**
	 * Truncates a string to a set length, converts any relevant
	 * characters to HTML entities and, if necessary, adds ellipsis points.
	 *
	 * Useful for displaying the first part of a string in a table,
	 * e.g. on an admin page.
	 */
	public static function
		truncate_with_ellipsis_and_convert_html_entities(
			$str,
			$length = 50,
			$ellipsis = '&#0133'
		)
	{
		$str = stripcslashes($str);
		
		$truncated = FALSE;
		if (strlen($str) > $length) {
			$str = substr($str, 0, $length);
			
			$truncated = TRUE;
		}
		
		$str = htmlentities($str);
		
		if ($truncated) {
			$str .= $ellipsis;
		}
		
		return $str;
	}
}
?>