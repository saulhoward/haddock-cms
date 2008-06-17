<?php
/**
 * HaddockProjectOrganisation_PlugInModuleDirectory
 *
 * @copyright Clear Line Web Design, 2007-02-16
 */

/**
 * Define the necessary classes.
 */
#require_once PROJECT_ROOT
#	. '/haddock/haddock-project-organisation/classes/'
#	. 'HaddockProjectOrganisation_ModuleDirectory.inc.php';

class
	HaddockProjectOrganisation_PlugInModuleDirectory
extends
	HaddockProjectOrganisation_ModuleDirectory
{
	private $plug_in_modules_directory;
	
	private $module_name;
	
	public function
		__construct(
			$name,
			HaddockProjectOrganisation_PlugInModulesDirectory
				$plug_in_modules_directory
		)
	{
		parent::__construct(
			$name,
			$plug_in_modules_directory->get_project_directory()
		);
		
		$this->plug_in_modules_directory = $plug_in_modules_directory;
	}
	
	public function
		get_plug_in_modules_directory()
	{
		return $this->plug_in_modules_directory;
	}
	
	public function
		get_module_name()
	{
		if (!isset($this->module_name)) {            
			## Does this module have a module name override file?
			##if ($this->has_module_name_override_file()) {
			##    
			##    $module_name_override_file = $this->get_module_name_override_file();
			##    
			##    $this->module_name = $module_name_override_file->get_module_name();
			##} else {
			#	# There isn't a module name override file,
			#	# so we should work out the name algorithmically.
			#
			#	if (
			#		preg_match(
			#			'{([^\\\\/]+)$}', $this->get_name(), $matches
			#		)
			#	) {
			#		$c_c_m_n_l_o_ws = Formatting_ListOfWordsHelper
			#			::get_list_of_words_for_string($matches[1], '-');
			#			
			#		$this->module_name
			#			= $c_c_m_n_l_o_ws
			#				#->get_words_as_camel_case_string();
			#				->get_words_as_capitalised_string();
			#	} else {
			#		$this->module_name = '';
			#	}
			##}
			$this->module_name
				= HaddockProjectOrganisation_ModuleDirectoryNamesHelper
					::get_module_name($this);
		}
		
		return $this->module_name;
	}
	
	public function
		get_module_name_as_l_o_w()
	{
		$module_name_as_l_o_w = null;
		
		if (preg_match('{([^\\\\/]+)$}', $this->get_name(), $matches)) {
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
		
		$admin_section_home_page_href_str = '/admin/hpi/';

		$admin_section_home_page_href_str .= $this->get_identifying_name();
		
		$admin_section_home_page_href_str .= '/home.html';
		
		$admin_section_home_page_href->set_file($admin_section_home_page_href_str);
		
		return $admin_section_home_page_href;
	}
	
	
	public function
		get_section_name()
	{
		return 'plug-ins';
	}
	
	public function
		get_section_short_form()
	{
		return 'hpi';
	}
	
	/*
	 * ----------------------------------------
	 * Methods to do with abstract plug-ins
	 * ----------------------------------------
	 */
	
	public function
		is_abstract_plug_in()
	{
		return FALSE;
	}
	
	public function
		make_abstract()
	{
		if (!$this->has_module_config_file()) {
			$this->create_module_config_file();
		}
		
		$module_config_file = $this->get_module_config_file();
		
		$module_config_file->set_abstract(TRUE);
	}
	
	/*
	 * ----------------------------------------
	 * Methods to do with required plug-ins
	 * ----------------------------------------
	 */
	
	public function
		get_required_plug_in_module_names()
	{
		if ($this->has_required_modules_file()) {
			#$conf_file = $this->get_module_config_file();
			
			$required_modules_file = $this->get_required_modules_file();
			
			return $required_modules_file->get_required_plug_in_module_names();
		} else {
			return array();
		}
	}
	
	public function
		check_plug_in_module_dependencies()
	{
		$this->plug_in_modules_directory = $this->get_plug_in_modules_directory();
		
		foreach ($this->get_required_plug_in_module_names() as $r_p_i_m_n) {
			if (!$this->plug_in_modules_directory->has_module_directory($r_p_i_m_n)) {
				return FALSE;
			}
		}
		
		return TRUE;
	}
	
	public function
		get_missing_plug_in_module_names()
	{
		$missing_plug_in_module_names = array();
		
		$plug_in_modules_directory = $this->get_plug_in_modules_directory();
		
		foreach ($this->get_required_plug_in_module_names() as $r_p_i_m_n) {
			if (!$plug_in_modules_directory->has_module_directory($r_p_i_m_n)) {
				$missing_plug_in_module_names[] = $r_p_i_m_n;
			}
		}
		
		return $missing_plug_in_module_names;
	}
	
	public function
		get_database_table_name_root()
	{
		$database_table_name_root = 'hpi_';
		
		$database_table_name_root .= str_replace(
			'-',
			'_',
			$this->get_identifying_name()
		);
		
		$database_table_name_root .= '_';
		
		return $database_table_name_root;
	}
}
?>