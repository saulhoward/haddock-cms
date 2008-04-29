<?php
/**
 * Strings_FilteringHelper
 *
 * @copyright 2008-04-29, RFI
 */

class
	Strings_FilteringHelper
{
	public static function
		truncate_with_ellipsis(
			$str,
			$length = 50,
			$ellipsis = '&#0133'
		)
	{
		$str = stripcslashes($str);
		
		if (strlen($str) > $length) {
			$str = substr($str, 0, $length);
			$str .= $ellipsis;
		}
		
		return $str;
	}
}
?>