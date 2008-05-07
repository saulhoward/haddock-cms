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
		
		$in = stripcslashes($in);
		
		$in = self::replace_double_square_brackets_with_link_to_db_page($in);
		
		$ps = HTMLTags_BLSeparatedPFactory::get_ps_from_str($in);
		
		#print_r($ps); exit;
		
		$out = '';
		
		foreach ($ps as $p) {
			$out .= $p->get_as_string();
			$out .= "\n";
		}
		
		#$out = stripcslashes($out);
		
		return $out;
	}
	
	/**
	 * Makes links to other DB pages.
	 */
	public static function
		replace_double_square_brackets_with_link_to_db_page(
			$in
		)
	{
		#echo "\$in: \n\n$in\n";
		
		#$out = $in;
		
		#$out = '';
		#
		#$lines = Strings_Splitter::line_separated($in);
		#
		#foreach ($lines as $line) {
		#	if ($line)
		#	
		#	$out .= "$line\n";
		#}
		#
		#return $out;
		
		/*
		 * Split the string on all the square bracket links. 
		 */
		$parts = preg_split(
			'/(?:(?<!\\\\)|(?<=\\\\\\\\))(\[\[[-\w]+(?:\|[- \w\'".\/]+)?\]\])/',
			$in,
			-1,
			PREG_SPLIT_DELIM_CAPTURE
		);
		
		#echo "\nParts: \n\n";
		#
		#print_r($parts);
		
		/*
		 * Make the appropriate stings into links.
		 */
		
		$out = '';
		
		foreach ($parts as $part) {
			if (
				preg_match(
					'/^\[\[([-\w]+)(?:\|([- \w\'".\/]+))?\]\]$/',
					$part,
					$matches
				)
			) {
				#print_r($matches);
				
				$page_name = $matches[1];
				
				if (isset($matches[2])) {
					$title = $matches[2];
				} else {
					$title
						= Formatting_ListOfWordsHelper
							::capitalise_delimited_string(
								$page_name,
								'-'
							);
				}
				
				$page_url
					= DPPages_URLsHelper
						::get_db_page_url($page_name);
				
				#$out .= "<a href=\"/db-pages/$page_name.html\">$title</a>";
				$out .= '<a href="' . $page_url->get_as_string() . "\">$title</a>";
			} else {
				
				#echo "\$part: $part\n";
				
				/*
				 * Remove any back slashes that were used to escape any
				 * brackets.
				 */
				$part = preg_replace(
					'/(?<!\\\\)\\\\(?=\[\[)/', 
					'',
					$part
				);
				
				$out .= $part;				
			}
		}
		
		#echo "$out\n";
		
		return $out;
	}
}
?>