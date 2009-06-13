<?php
/**
 * DBPages_SPoE
 *
 * @copyright 2007-12-15, RFI
 */

/**
 * Rather old fashioned.
 * Should be renamed 'helper'.
 *
 * If you find that you need to use objects and functions from this module
 * in code in other modules, perhaps more functionality needs to be
 * added to this class or the module.
 *
 * All the functions in this class should take as arguments and return
 * primitive types or void.
 *
 * This approach is not necessarily good design in general but for something
 * as simple as the DB pages plug-in, it keeps the interface clean.
 *
 * Ad-hoc code is all well and good, that's the beauty of PHP.
 * And ad-hoc classes are not inherently bad.
 * But if you don't have strong typing, returning ad-hoc classes can be
 * a maintenance nightmare.
 * Hence, this straight jacket.
 */
class
	DBPages_SPoE
{
	/**
	 * Returns the section of the page.
	 *
	 * Before the text of the section is returned,
	 * it is passed through a processing function
	 * that can be set for each text saved in this
	 * module.
	 *
	 * For example, the processing function might
	 * make HTML entities render nicely in browsers.
	 */
	public static function
		get_filtered_page_section($page_name, $section_name)
	{
		if (DEBUG) {
			echo DEBUG_DELIM_OPEN;
			
			echo __FILE__ . PHP_EOL;
			echo 'Line: ' . __LINE__ . PHP_EOL;
			echo 'Method: ' . __METHOD__ . PHP_EOL;
			
			echo DEBUG_DELIM_CLOSE;
		}
		
		$cm = DBPages_ContentManager::get_instance();
		#echo "\$cm:\n"; print_r($cm); exit;
		
		$page = $cm->get_page($page_name);
		#print_r($page);exit;
		
		$section = $page->get_section($section_name);
		#print_r($section);
		#exit;
		
		$ft = $section->get_filtered_text();
		
		#echo "\$ft: $ft\n";
		#exit;
		
		return $ft;
	}
	
	/**
	 * Gets the section for the current page as set by the get variables.
	 *
	 * Assumes that a get variable called 'page-name' has been set.
	 *
	 * If not, an exception is thrown.
	 */
	public static function
		get_filtered_page_section_from_get($section_name)
	{
		if (isset($_GET['page-name'])) {
			return self::get_filtered_page_section($_GET['page-name'], $section_name);
		} else {
			throw new Exception('The page-name GET variable must be set!');
		}
	}
}
?>