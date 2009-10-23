<?php
/**
 * VideoLibrary_PageBuildingHelper
 *
 * @copyright 2009-01-10, SANH
 */

class
VideoLibrary_PageBuildingHelper
{
	public static function
		get_page_builder()
	{
		$cmf = HaddockProjectOrganisation_ConfigManagerFactory::get_instance();
		$config_manager = 
			$cmf->get_config_manager('plug-ins', 'video-library');
		$page_builder_class_name= $config_manager->get_page_builder_class_name();

		/* Can't believe this works...
		 */
		$page_builder_class_name = trim($page_builder_class_name);
		$instance = new $page_builder_class_name();
		return $instance;
	}
}
?>
