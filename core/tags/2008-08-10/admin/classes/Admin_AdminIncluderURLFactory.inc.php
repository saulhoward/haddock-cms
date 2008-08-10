<?php
/**
 * Admin_AdminIncluderURLFactory
 *
 * @copyright Clear Line Web Design, 2007-08-30
 */

class
	Admin_AdminIncluderURLFactory
{
	/**
	 * Just because I was getting bored of typing out this minchia all the time...
	 * 
	 * No error checking at this point, is it necessary or desirable?
	 *
	 * If the section is 'project-specific', the module should be set to NULL.
	 */
	public static function
		get_url($section, $module, $page, $type)
	{
		$url = new HTMLTags_URL();
		
		$url->set_file('/');

		$url->set_get_variable('section', 'haddock');
		$url->set_get_variable('module', 'admin');
		$url->set_get_variable('page', 'admin-includer');

		$url->set_get_variable('type', $type);

		$url->set_get_variable('admin-section', $section);

		if (isset($module)) {
			$url->set_get_variable('admin-module', $module);
		}
		
		$url->set_get_variable('admin-page', $page);
		
		return $url;
	}
}
?>
