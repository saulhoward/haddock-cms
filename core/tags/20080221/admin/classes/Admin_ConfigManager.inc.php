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
		return '/haddock/admin/';
	}

	public function
		get_navigation_file_not_found_msg()
	{
		return $this->get_config_value('navigation/file-not-found-msg');
	}
}
?>
