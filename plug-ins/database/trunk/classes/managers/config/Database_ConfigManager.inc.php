<?php
/**
 * Database_ConfigManager
 *
 * @copyright 2008-05-02, RFI
 */

class
	Database_ConfigManager
extends
	HaddockProjectOrganisation_ConfigManager
{
	protected function
		get_module_prefix_string()
	{
		return '/haddock/database/';
	}
	
	public function
		get_crud_admin_page_limits_string()
	{
		return $this->get_config_value('pages/admin/crud/limits_string');
	}
}
?>