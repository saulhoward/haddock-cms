<?php
/**
 * HaddockProjectOrganisation_HPOConfigManager
 * 
 * @copyright Clear Line Web Web Design, 2007-10-21
 */

/**
 * Config manager for the HPO module. 
 * 
 * Not to be confused with 
 * 
 * HaddockProjectOrganisation_ConfigManager
 * 
 * which is this class's parent.
 * 
 * This is used to access config data to do with the
 * haddock project in this vhost.
 */
class
	HaddockProjectOrganisation_HPOConfigManager
extends
	HaddockProjectOrganisation_ConfigManager
{
	protected function
		get_module_prefix_string()
	{
		return '/haddock/haddock-project-organisation/';
	}

	public function
		get_major_release_version()
	{
		return $this->get_config_value('release/version/major');
	}
	
	public function
		get_project_name()
	{
		return $this->get_config_value('project/name');
	}
	
	public function
		get_copyright_holder()
	{
		return $this->get_config_value('project/copyright-holder');
	}
}
?>
