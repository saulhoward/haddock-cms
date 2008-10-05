<?php
/**
 * PhotoGallery_ConfigManager
 *
 * @copyright 2008-02-09, RFI
 */

class
	PhotoGallery_ConfigManager
extends
	HaddockProjectOrganisation_ConfigManager
{
	protected function
		get_module_prefix_string()
	{
		return '/plug-ins/photo-gallery/';
	}
	
	public function
		get_html_page_class_name()
	{
		return $this->get_config_value('page-classes/html-page');
	}
}
?>
