<?php
/**
 * HTMLTags_BLSeparatedPFactory
 *
 * @copyright 2007-05-07, RFI
 */

class
	HTMLTags_BLSeparatedPFactory
{
	public function
		__construct()
	{
	}
	
	public static function
		get_ps_from_str($str)
	{
		$ps = array();
		
		$strs = Strings_Splitter::blank_line_separated($str);
		
		#print_r($strs); exit;
		
		foreach ($strs as $p_str) {
			$ps[] = new HTMLTags_P($p_str);
		}
		
		return $ps;
	}
}
?>