<?php
/**
 * HaddockProjectOrganisation_ProjectSpecificDirectory
 *
 * @copyright 2006-11-13, RFI
 */

/**
 * Represents a directory under SVN control
 * that is part of a CLWD project and contains
 * the project specific files.
 */
class
	HaddockProjectOrganisation_ProjectSpecificDirectory
extends
	HaddockProjectOrganisation_ModuleDirectory
{
	private $module_name;
	
	private $database_class_name_file;
	
#    private function
#        get_passwords_filename()
#    {
#        $project_directory = $this->get_project_directory();
#        
#        $passwords_file_name =
#            $this->get_name()
#            . '/passwords/'
#            . $project_directory->get_current_purpose_name() . '.'
#            . $project_directory->get_current_project_name() . '.'
#            . $project_directory->get_current_host_name() #. '.'
#            #. 'clearlinewebdesign.com'
#            #. '.txt';
#            . '.inc.php';
#        
#        #echo "\$passwords_file_name: $passwords_file_name\n";
#        
#        return $passwords_file_name;
#    }
#    
#    public function
#        has_passwords_file()
#    {
#        $passwords_filename = $this->get_passwords_filename();
#        
#        return file_exists($passwords_filename);
#    }
#    
#    public function
#        get_passwords_file()
#    {
#        /*
#         * Does the passwords directory exist?
#         */
#        $passwords_directory_name = $this->get_name() . '/passwords';
#        if (!is_dir($passwords_directory_name)) {
#            mkdir($passwords_directory_name);
#        }
#        
#        $passwords_file
#            = new Database_PasswordFile($this->get_passwords_filename());
#        
#        return $passwords_file;
#    }
	
	public function
		get_module_name()
	{
		if (!isset($this->module_name)) {
			# TO DO: Do this with the module config file.
			# Does this module have a module name override file?
			#if ($this->has_module_name_override_file()) {
			#    $module_name_override_file
			#        = $this->get_module_name_override_file();
			#    
			#    $this->module_name
			#        = $module_name_override_file->get_module_name();
			#} else {
				# There isn't a module name override file,
				# so we should work out the name algorithmically.
				
				$project_directory
					= $this->get_project_directory();
			
				#$project_name
				#	= $project_directory->get_current_project_name();
				
				#$hpo_cm
				#	= Configuration_ConfigManagerHelper
				#		::get_config_manager(
				#			'haddock',
				#			'haddock-project-organisation'
				#		);
				#		
				#$project_name = $hpo_cm->get_project_name();
				
				$p_n_l_o_ws
					= Formatting_ListOfWordsHelper
						::get_list_of_words_for_string($project_name, '-');
				
				$this->module_name
					= $p_n_l_o_ws->get_words_as_camel_case_string();
			#}
		}
				
		return $this->module_name;
	}
	
	public function
		get_module_name_as_l_o_w()
	{
		#$project_directory = $this->get_project_directory();
		#$project_name = $project_directory->get_current_project_name();
		#$p_n_l_o_ws = Formatting_ListOfWords::get_list_of_words_for_string($project_name, '-');
		#
		#return $p_n_l_o_ws;
		
		#$hpo_cm
		#	= Configuration_ConfigManagerHelper
		#		::get_config_manager(
		#			'haddock',
		#			'haddock-project-organisation'
		#		);
		#		
		#$project_name = $hpo_cm->get_project_name();
		
		$project_name
			= HaddockProjectOrganisation_ProjectInformationHelper
				::get_name();
		
		return
			Formatting_ListOfWordsHelper
				::get_list_of_words_for_string(
					$project_name,
					'-'
				);
	}
	
	private function
		get_database_class_name_filename()
	{
		$database_class_name_filename = '';
		
		$database_class_name_filename .= $this->get_name();
		
		$database_class_name_filename .= '/sql/database-class-names.';
		
		#$database_class_name_filename .= 'txt';
		#$database_class_name_filename .= 'xml';
		$database_class_name_filename .= '.inc.php';
		
		return $database_class_name_filename;
	}
	
	public function
		has_database_class_name_file()
	{
		$database_class_name_filename
			= $this->get_database_class_name_filename();
		
		return file_exists($database_class_name_filename);
	}
	
	/**
	 * Even if there isn't a file there yet, return one.
	 */
	public function
		get_database_class_name_file()
	{
		/*
		 * Does the sql directory exist?
		 */
		$sql_directory_name = $this->get_name() . '/sql';
		if (!is_dir($sql_directory_name)) {
			mkdir($sql_directory_name);
		}
		
		if (!isset($this->database_class_name_file)) {
			$database_class_name_filename
				= $this->get_database_class_name_filename();
			
			$this->database_class_name_file
				= new Database_DatabaseClassNameFile(
					$database_class_name_filename
				);
		}
		
		return $this->database_class_name_file;
	}
	
	public function
		get_section_name()
	{
		return 'project-specific';
	}
	
	public function
		get_admin_section_directory_name()
	{
		return $this->get_section_name();
	}
	
	private function
		get_config_filename()
	{
		$project_directory = $this->get_project_directory();
		
		return $this->get_name()
			. '/config/'
			//. $project_directory->get_current_purpose_name()
			//. '.'
			//. $project_directory->get_current_project_name()
			//. '.'
			//. $project_directory->get_current_host_name()
			//. '.txt';
			. 'config.xml';
	}
	
	public function
		has_config_file()
	{
		return file_exists($this->get_config_filename());
	}
	
	public function
		get_config_file()
	{
		if ($this->has_config_file()) {
			#$config_file_class = $this->get_config_file_class();
			#
			#return $config_file_class->newInstance(
			#	$this->get_config_filename()
			#);
			
			return
				new HaddockProjectOrganisation_ProjectSpecificConfigFile(
					$this->get_config_filename()
				);
		} else {
			throw new Exception('No config file for this project!');
		}
	}
	
	public function
		get_config_file_class()
	{
		$config_file_class
			= new ReflectionClass('HaddockProjectOrganisation_ConfigFile');
			
		/*
		 * Does this project define its own class for config
		 * files?
		 */
		$php_class_files = $this->get_php_class_files();
		
		foreach ($php_class_files as $p_c_f) {
			$ref_class = $p_c_f->get_reflection_class();
			
			if ($ref_class->isSubclassOf($config_file_class)) {
				return $ref_class;
			}
		}
		
		return $config_file_class;
	}
	
	/*
	 * ----------------------------------------
	 * Methods to do with a module's configuration file.
	 * ----------------------------------------
	 */
	
	public function
		get_module_config_file($section, $module)
	{
		$project_directory = $this->get_project_directory();
		
		if ($section == 'haddock') {
			$module_directory = $project_directory->get_core_module_directory($module);
		} elseif ($section == 'plug-ins') {
			$module_directory = $project_directory->get_plug_in_module_directory($module);
		} else {
			throw
				new ErrorHandling_SprintfException(
					'The section for a module config file must be \'haddock\' or \'plug-ins\', \'%s\' given!',
					array($section)
				);
		}
		
		return $module_directory->get_project_specific_config_file();
	}
	
	/*
	 * ----------------------------------------
	 * Methods to do with the autoload .INC file.
	 * ----------------------------------------
	 */

	private function
		get_autoload_inc_filename()
	{
		return $this->get_name() . '/haddock-project-organisation/autoload.inc.php';
	}
	
	public function
		has_autoload_inc_file()
	{
		return file_exists($this->get_autoload_inc_filename());
	}
	
	public function
		get_autoload_inc_file()
	{
		if (!$this->has_autoload_inc_file()) {
			if (!is_dir($this->get_name() . '/haddock-project-organisation')) {
				mkdir($this->get_name() . '/haddock-project-organisation');
			}
			
			touch($this->get_autoload_inc_filename());
		}
		
		return new HaddockProjectOrganisation_AutoloadIncFile(
			$this->get_autoload_inc_filename()
		);
	}
	
	/*
	 * ----------------------------------------
	 * Methods to do with admin section HREFs.
	 * ----------------------------------------
	 */
	
	public function
		has_required_plug_ins_file()
	{
		return file_exists($this->get_required_plug_ins_filename());
	}
	
	public function
		get_required_plug_ins_file()
	{
		if ($this->has_required_plug_ins_file()) {
			return new HaddockProjectOrganisation_RequiredPlugInsFile(
				$this->get_required_plug_ins_filename()
			);
		} else {
			throw new Exception('No plug-ins file!');
		}
	}
	
	public function
		get_admin_section_home_page_href()
	{
		$admin_section_home_page_href = new HTMLTags_URL();
		
		$admin_section_home_page_href_str = '/admin/ps/home.html';
		
		$admin_section_home_page_href->set_file(
			$admin_section_home_page_href_str
		);
		
		return $admin_section_home_page_href;
	}
	
	public function
		get_section_short_form()
	{
		return 'ps';
	}
	
	/*
	 * Functions to do with the admin navigation XML file.
	 */
	
	private function
		get_admin_navigation_xml_filename()
	{
		return $this->get_name() . '/config/plug-ins/admin/navigation.xml';
	}
	
	public function
		has_admin_navigation_xml_file()
	{
		return is_file($this->get_admin_navigation_xml_filename());
	}
	
	public function
		get_admin_navigation_xml_file()
	{
		if ($this->has_admin_navigation_xml_file()) {
			return new Admin_NavigationXMLFile($this->get_admin_navigation_xml_filename());
		} else {
			throw new Exception($this->get_admin_navigation_xml_filename() . ' does not exist!');
		}
	}
	
	public function
		get_title()
	{
		return HaddockProjectOrganisation_ProjectInformationHelper
			::get_title();
	}
	
	public function
		get_database_table_name_root()
	{
		return 'ps_';
	}
}
?>