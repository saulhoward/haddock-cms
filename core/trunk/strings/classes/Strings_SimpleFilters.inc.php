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
		$str = stripcslashes($str);
		
		if (strlen($str) > $length) {
			$str = substr($str, 0, $length);
			$str .= $ellipsis;
		}
		
		return $str;
	}
}
?>