<?php
/**
 * DBPages_FilterHelper
 *
 * @copyright RFI 2007-12-15
 */

/**
 * Provides filtering functions for processing
 * the text from sections of the pages before they
 * are rendered in the browser.
 *
 * It would probably be a mistake to do too much processing in this
 * class.
 * This is really just a convenience for providing a functional
 * interface to other other code (which might be object oriented
 * or return HTMLTags objects or use some other technique that makes
 * the code unsuitable for being a filter).
 */
class
	DBPages_FilterHelper
{
	/**
	 * Converts text that is blank line separated
	 * to HTML <p> separated text.
	 */
	public static function
		blank_line_delimited_paragraphs($in)
	{
		#echo $in; exit;
		
		$out = '';
		
		$ps = HTMLTags_BLSeparatedPFactory::get_ps_from_str($in);
		
		#print_r($ps); exit;
		
		foreach ($ps as $p) {
			$out .= $p->get_as_string();
			$out .= "\n";
		}
		
		$out = stripcslashes($out);
		
		return $out;
	}
}
?>