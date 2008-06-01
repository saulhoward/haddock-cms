<?php
/**
 * HaddockProjectOrganisation_CoreModuleDirectory
 *
 * @copyright 2006-11-13, RFI
 */

/*
 * Define the necessary classes.
 */
#require_once PROJECT_ROOT
#	. '/haddock/haddock-project-organisation/classes/'
#	. 'HaddockProjectOrganisation_ModuleDirectory.inc.php';
#
#require_once PROJECT_ROOT
#	. '/haddock/formatting/classes/helpers/'
#	. 'Formatting_ListOfWordsHelper.inc.php';

/**
 * Represents a directory under SVN control
 * that is part of a haddock project and is a
 * core module.
 */
class
	HaddockProjectOrganisation_CoreModuleDirectory
extends
	HaddockProjectOrganisation_ModuleDirectory
{
	private $core_modules_directory;
	
	private $module_name;
	
	public function
		__construct(
			$name,
			HaddockProjectOrganisation_CoreModulesDirectory $core_modules_directory
		)
	{
		parent::__construct($name, $core_modules_directory->get_project_directory());
		
		$this->core_modules_directory = $core_modules_directory;
	}
	
	public function
		get_module_name()
	{
		if (!isset($this->module_name)) {            
			#/*
			# * Does this module have a module name override file?
			# */
			#if ($this->has_module_name_override_file()) {
			#    
			#    $module_name_override_file = $this->get_module_name_override_file();
			#    
			#    $this->module_name = $module_name_override_file->get_module_name();
			#} else {
			/*
			 * Does this module have a module config file?
			 */
			if ($this->has_module_config_file()) {
			    
			    $module_config_file = $this->get_module_config_file();
			    
				if ($module_config_file->has_module_name()) {
					$this->module_name = $module_config_file->get_module_name();
				}
			}
			
			if (!isset($this->module_name)) {
				/*
				 * There isn't a module name set in the file,
				 * so we should work out the name algorithmically.
				 */
				if (preg_match('{([^\\\\/]+)$}', $this->get_name(), $matches)) {
					$c_c_m_n_l_o_ws
						= Formatting_ListOfWordsHelper
							::get_list_of_words_for_string($matches[1], '-');
				
					$this->module_name
						= $c_c_m_n_l_o_ws
							#->get_words_as_camel_case_string();
							->get_words_as_capitalised_string();
				} else {
					$this->module_name = '';
				}
			}
		}
		
		return $this->module_name;
	}
	
	public function
		get_module_name_as_l_o_w()
	{
		$module_name_as_l_o_w = null;
		
		if (
			preg_match(
				'{([^\\\\/]+)$}',
				$this->get_name(),
				$matches
			)
		) {
			$module_name_as_l_o_w
				= Formatting_ListOfWordsHelper
					::get_list_of_words_for_string($matches[1], '-');
		}
		
		return $module_name_as_l_o_w;
	}
	
	public function
		get_admin_section_home_page_href()
	{
		$admin_section_home_page_href = new HTMLTags_URL();
		
		$admin_section_home_page_href_str = '/admin/hc/';

		$admin_section_home_page_href_str .= $this->get_identifying_name();
		
		$admin_section_home_page_href_str .= '/home.html';
		
		$admin_section_home_page_href->set_file($admin_section_home_page_href_str);
		
		return $admin_section_home_page_href;
	}
	
	public function
		get_section_name()
	{
		return 'haddock';
	}
	
	public function
		get_section_short_form()
	{
		return 'hc';
	}
}
?>