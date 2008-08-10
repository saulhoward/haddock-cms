<?php
/**
 * Strings_SplittingHelper
 *
 * @copyright 2008-05-28, RFI
 */

class
	Strings_SplittingHelper
{
	public static function
		split_by_eol($str)
	{
		$str = Strings_Converter::line_endings_to_unix($str);
		
		return explode("\n", $str);
	}
}
?>