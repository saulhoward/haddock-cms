<?php
/**
 * Strings_Splitter
 * 
 * @copyright 2007-05-07, RFI
 */

/**
 * Breaks a longer string into shorter strings
 * which are returned in arrays.
 *
 * DEPRECATED!
 *
 * Use Strings_SplittingHelper instead.
 */
class
	Strings_Splitter
{
	public static function
		line_separated($str)
	{
		#$str = Strings_Converter::line_endings_to_unix($str);
		#
		#return explode("\n", $str);
		
		return
			Strings_SplittingHelper
				::split_by_eol($str);
	}
	
	/**
	 * Takes a str that is blank line seprated and returns
	 * an array of blocks of text.
	 */
	public static function
		blank_line_separated($str)
	{
		$blocks = array();
		
		$lines = self::line_separated($str);
		
		#print_r($lines);
		#exit;
		
		$current_block = '';
		$candidate_blocks = array();
		#foreach ($lines as $line) {
		#    if (Strings_Describer::just_white_space($line)) {
		#        $candidate_blocks[] = $current_block;
		#
		#        $current_block = '';
		#    } else {
		#        $current_block .= "$line\n";
		#    }
		#}
		for ($i = 0; $i < count($lines); $i++) {
			if (Strings_Describer::just_white_space($lines[$i])) {
				if (!Strings_Describer::just_white_space($lines[$i - 1])) {
					$candidate_blocks[] = $current_block;
					
					$current_block = '';
				} else {
					#echo "Previous line was just white space!\n";
				}
			} else {
				$current_block .= $lines[$i] . "\n";
			}
		}
		
		if (strlen($current_block) > 0) {
			$candidate_blocks[] = $current_block;
		}
		
		#print_r($candidate_blocks);
		
		foreach ($candidate_blocks as $candidate_block) { 
			if (!Strings_Describer::just_white_space($candidate_block)) {
				$blocks[] = $candidate_block;
			}
		}
		
		#print_r($blocks); exit;
		
		return $blocks;
	}
}
?>