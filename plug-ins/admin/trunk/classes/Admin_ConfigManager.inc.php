<?php
/**
 * Admin_ConfigManager
 * 
 * @copyright Clear Line Web Design, 2007-10-16
 */

class
	Admin_ConfigManager
extends
	HaddockProjectOrganisation_ConfigManager
{
	protected function
		get_module_prefix_string()
	{
		return '/plug-ins/admin/';
	}

	public function
		get_navigation_file_not_found_msg()
	{
		return $this->get_config_value('navigation/file-not-found-msg');
	}

	public function
		get_logo_image_filename()
	{
		return $this->get_config_value('admin-style/logo-image-filename');
	}

	public function
		get_start_page_widget_classes()
	{
		$widget_classes_str = $this->get_config_value('start-page/widget-classes');
		return explode(',', $widget_classes_str);
	}
}
?>
