<?php
/**
 * DBPages_PCROFactory
 *
 * @copyright 2008-02-09, RFI
 */

/**
 * The Database Pages Page Class Reflection Object Factory.
 *
 * This class creates page class objects for rendering DB pages.
 *
 * The name of the class that is created is set in the config
 * files for this plug-in.
 */
class
	DBPages_PCROFactory
extends
	PublicHTML_PCROFactory
{
	public function
		get_page_class_reflection_object_name()
	{
		$cmf = HaddockProjectOrganisation_ConfigManagerFactory::get_instance();
		
		$config_manager = $cmf->get_config_manager('plug-ins', 'db-pages');
		
		return $config_manager->get_html_page_class_name();
	}
}

?>