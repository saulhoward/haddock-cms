<?php
/**
 * Configuration_ConfigManagerHelper
 *
 * @copyright 2008-03-23, RFI
 */

class
	Configuration_ConfigManagerHelper
{
	public static function
		get_config_manager(
			$section,
			$module
		)
	{
		$config_manager_factory
			= HaddockProjectOrganisation_ConfigManagerFactory
				::get_instance();
		
		$config_manager
			= $config_manager_factory
				->get_config_manager(
					$section,
					$module
				);
		
		return $config_manager;
	}
}
?>