<?php
/**
 * PublicHTML_PublicURLFactory
 *
 * @copyright 2007-09-23, RFI
 */

/**
 * Generates URLs.
 *
 * How can this be combined with PublicHTML_URLHelper?
 */
class
	PublicHTML_PublicURLFactory
{
	/**
	 * DEPRECATED!
	 *
	 * Use PublicHTML_URLHelper::get_pm_page_url(...) instead!
	 */
    public static function
		get_url($section, $module, $page, $type)
	{
		$url = new HTMLTags_URL();
		
		$url->set_file('/');

		$url->set_get_variable('section', $section);
        
		if (isset($module)) {
    		$url->set_get_variable('module', $module);
		}
		
        $url->set_get_variable('page', $page);
        
		$url->set_get_variable('type', $type);
        
		return $url;
	}
}
?>