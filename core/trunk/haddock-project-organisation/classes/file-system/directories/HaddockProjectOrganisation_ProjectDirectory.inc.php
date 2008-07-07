<?php
/**
 * HaddockProjectOrganisation_ProjectDirectory
 *
 * @copyright 2006-11-13, RFI
 */

/*
 * Define the necessary classes.
 */
#require_once PROJECT_ROOT
#    . '/haddock/file-system/classes/'
#    . 'FileSystem_Directory.inc.php';
#
#require_once PROJECT_ROOT
#    . '/haddock/haddock-project-organisation/classes/'
#    . 'HaddockProjectOrganisation_ProjectSpecificDirectory.inc.php';
#
#require_once PROJECT_ROOT
#    . '/haddock/haddock-project-organisation/classes/'
#    . 'HaddockProjectOrganisation_CoreModulesDirectory.inc.php';
#
#require_once PROJECT_ROOT
#    . '/haddock/haddock-project-organisation/classes/'
#    . 'HaddockProjectOrganisation_CoreModuleDirectory.inc.php';
#
#require_once PROJECT_ROOT
#    . '/haddock/haddock-project-organisation/classes/'
#    . 'HaddockProjectOrganisation_PlugInModuleDirectory.inc.php';
#
#require_once PROJECT_ROOT
#    . '/haddock/haddock-project-organisation/classes/'
#    . 'HaddockProjectOrganisation_PlugInModulesDirectory.inc.php';
#
#require_once PROJECT_ROOT
#    . '/haddock/haddock-project-organisation/classes/'
#    . 'HaddockProjectOrganisation_RequiredModulesFile.inc.php';
#
#require_once PROJECT_ROOT
#    . '/haddock/formatting/classes/'
#    . 'Formatting_FileName.inc.php';
#
#require_once PROJECT_ROOT
#    . '/haddock/database/classes/'
#    . 'Database_TableNameTranslatorFactory.inc.php';
#
#require_once PROJECT_ROOT
#    . '/haddock/database/classes/'
#    . 'Database_DatabaseClassFinder.inc.php';
#
#require_once PROJECT_ROOT
#    . '/haddock/database/classes/table-structure-synchronisation/'
#    . 'Database_TableStructureManager.inc.php';
#
#require_once PROJECT_ROOT
#    . '/haddock/unit-tests/classes/'
#    . 'UnitTests_UnitTestsPHPClassFile.inc.php';

/**
 * Represents a directory that contains a haddock project.
 *
 * This directory will contain a directory called
 * "project-specific" that contains the PHP files and
 * so on for the project.
 *
 * There is also be a directory called "haddock"
 * that contains directories with files for modules
 * that can be reused in any of our projects.
 *
 * There may be a directory called "plug-ins" that
 * contains one or more haddock plug-ins.
 */
class
	HaddockProjectOrganisation_ProjectDirectory
extends
	FileSystem_Directory
{
	##################################################################
	# The private members of this class.
   
	/**
	 * A HaddockProjectOrganisation_ProjectSpecificDirectory object
	 * for the directory containing the files that
	 * are specific to this project.
	 */
	private $project_specific_directory;
 
	/**
	 * The FileSystem_Directory for "haddock".
	 */
	private $core_modules_directory;
	
	/**
	 * An array of HaddockProjectOrganisation_CoreModuleDirectory
	 * objects.
	 * One for each of the core modules used by this project.
	 */
	#private $core_module_directories;
	
	/**
	 * The FileSystem_Directory for the plug-ins.
	 */
	private $plug_in_modules_directory;
	
	/**
	 * An array of HaddockProjectOrganisation_PlugInModuleDirectory
	 * objects.
	 * One for each of the plug-in modules used by this project.
	 */
	#private $plug_in_module_directories;
	
	/**
	 * Data extracted from the directory name in
	 * an array.
	 * 
	 * e.g.
	 *  - purpose
	 *  - project
	 *  - host
	 */
#    private $directory_name_data;
	
	/**
	 * The Database_TableNameTranslatorFactory object
	 * associated with this project.
	 */
#    private $table_name_translator_factory;
	
#    private $database_username_suggestion;
	
	private $database_class_finder;
	
	private $php_class_files;
	
	##################################################################
	# For returning the special directories in this project.
	
	/*
	 * ----------------------------------------
	 * Methods to do with the project-specific directory.
	 * ----------------------------------------
	 */
	
	private function
		get_project_specific_directory_name()
	{
		return $this->get_name() . '/project-specific';
	}
	
	/**
	 * @return HaddockProjectOrganisation_ProjectSpecificDirectory
	 *  An object representing the PSD.
	 *  This may be a sub-class for the above class.
	 */
	public function
		get_project_specific_directory()
	{
		if (!isset($this->project_specific_directory)) {
			$this->project_specific_directory
				= new HaddockProjectOrganisation_ProjectSpecificDirectory(
					$this->get_project_specific_directory_name(),
					$this
				);
		}
		
		return $this->project_specific_directory;
	}
	
	/*
	 * ----------------------------------------
	 * Methods to do with the core modules directory.
	 * ----------------------------------------
	 */
	
	private function
		get_core_modules_directory_name()
	{
		return $this->get_name() . '/haddock';
	}
	
	public function
		get_core_modules_directory()
	{
		if (!isset($this->core_modules_directory)) {
			$this->core_modules_directory
				= new HaddockProjectOrganisation_CoreModulesDirectory(
					$this->get_core_modules_directory_name(),
					$this
				);
		}
		
		return $this->core_modules_directory;
	}
	
	public function
		get_core_module_directories()
	{
		//if (!isset($this->core_module_directories)) {
		//    $core_modules_directory = $this->get_core_modules_directory();
		//    
		//    $dirs = $core_modules_directory->get_subdirectories();
		//    $this->core_module_directories = array();
		//    
		//    foreach ($dirs as $dir) {
		//        $this->core_module_directories[]
		//            = new HaddockProjectOrganisation_CoreModuleDirectory(
		//                $dir->get_name(), $this
		//            );
		//    }
		//}
		//
		//return $this->core_module_directories;
		
		$core_modules_directory = $this->get_core_modules_directory();
		
		return $core_modules_directory->get_module_directories();
	}
	
	public function
		get_core_module_directory($module)
	{
		//$core_module_directories = $this->get_core_module_directories();
		//
		//foreach ($core_module_directories as $cmd) {
		//    if ($cmd->get_identifying_name() == $module) {
		//        return $cmd;
		//    }
		//}
		//
		//throw new Exception("No core module called $module!");
		
		$core_modules_directory = $this->get_core_modules_directory();
		
		return $core_modules_directory->get_module_directory($module);
	}
	
	/*
	 * ----------------------------------------
	 * Methods to do with the plug-ins modules.
	 * ----------------------------------------
	 */
	
	private function
		get_plug_in_modules_directory_name()
	{
		return $this->get_name() . '/plug-ins';
	}
	
	public function
		get_plug_in_modules_directory()
	{
		#return new FileSystem_Directory($this->get_name() . '/plug-ins');
		if (!isset($this->plug_in_modules_directory)) {
			$this->plug_in_modules_directory
				= new HaddockProjectOrganisation_PlugInModulesDirectory(
					$this->get_plug_in_modules_directory_name(),
					$this
				);
		}
		
		return $this->plug_in_modules_directory;
	}
	
	public function
		get_plug_in_module_directories()
	{
		//if (!isset($this->plug_in_module_directories)) {
		//    $plug_in_modules_directory = $this->get_plug_in_modules_directory();
		//    
		//    $this->plug_in_module_directories = array();
		//    
		//    foreach ($plug_in_modules_directory->get_subdirectories() as $p_i_m_d) {
		//        $this->plug_in_module_directories[]
		//            = new HaddockProjectOrganisation_PlugInModuleDirectory(
		//                $p_i_m_d->get_name(),
		//                $this
		//            );
		//    }
		//}
		//
		//return $this->plug_in_module_directories;
		
		$plug_in_modules_directory = $this->get_plug_in_modules_directory();
		
		return $plug_in_modules_directory->get_module_directories();
	}
	
	public function
		get_plug_in_module_directory($module)
	{
		//$plug_in_module_directories = $this->get_plug_in_module_directories();
		//
		//foreach ($plug_in_module_directories as $pimd) {
		//    if ($pimd->get_identifying_name() == $module) {
		//        return $pimd;
		//    }
		//}
		//
		//throw new Exception("No plug-in module called $module!");
		
		$plug_in_modules_directory = $this->get_plug_in_modules_directory();
		
		return $plug_in_modules_directory->get_module_directory($module);
	}
	
	/**
	 * @return array
	 *  All the module directories in the project.
	 */
	public function
		get_module_directories()
	{
		$module_directories = array();
		
		$module_directories[] = $this->get_project_specific_directory();
		
		foreach ($this->get_core_module_directories() as $c_m_d) {
			$module_directories[] = $c_m_d;
		}
		
		foreach ($this->get_plug_in_module_directories() as $p_i_m_d) {
			$module_directories[] = $p_i_m_d;
		}
		
		return $module_directories;
	}
	
	///**
	// * The module might be
	// *  the project specific modules
	// *  one of the core haddock modules
	// *  one of the plug-in modules.
	// */
	//public function
	//    get_module_directory($module_name)
	//{
	//    #$module_directory = null;
	//    
	//    $project_specific_directory = $this->get_project_specific_directory();
	//    
	//    if ($module_name == 'project-specific') {
	//        return $project_specific_directory;
	//        #return $this->get_project_specific_directory();
	//    }
	//    
	//    $module_name_as_l_o_w
	//        = $project_specific_directory->get_module_name_as_l_o_w();
	//    if (
	//        $module_name_as_l_o_w
	//        ->get_words_as_delimited_lc_string('-') == $module_name
	//    ) {
	//        #$module_directory = $project_specific_directory;
	//        return $project_specific_directory;
	//        #return $this->get_project_specific_directory();
	//    } else {
	//        $core_module_directories = $this->get_core_module_directories();
	//        
	//        foreach ($core_module_directories as $c_m_d) {
	//            $module_name_as_l_o_w = $c_m_d->get_module_name_as_l_o_w();
	//            if (
	//                $module_name_as_l_o_w->get_words_as_delimited_lc_string('-')
	//                == $module_name
	//            ) {
	//                #$module_directory = $c_m_d;
	//                #break;
	//                return $c_m_d;
	//            }
	//        }
	//        
	//        $plug_in_module_directories = $this->get_plug_in_module_directories();
	//        
	//        foreach ($plug_in_module_directories as $p_i_m_d) {
	//            $module_name_as_l_o_w = $p_i_m_d->get_module_name_as_l_o_w();
	//            if (
	//                $module_name_as_l_o_w->get_words_as_delimited_lc_string('-')
	//                == $module_name
	//            ) {
	//                #$module_directory = $c_m_d;
	//                #break;
	//                return $p_i_m_d;
	//            }
	//        }
	//    }
	//    
	//    #return $module_directory;
	//    throw new Exception("No module called $module_name!");
	//}
	
	/**
	 * Finds a module and returns the appropriate subclass of HaddockProjectOrganisation_ModuleDirectory.
	 *
	 * 3 exceptions and 2 return statements, does that mean that I'll go to hell?
	 */
	public function
		get_module_directory(
			$section,
			$module = NULL
		)
	{
		if (isset($module)) {
			if ($section == 'project-specific') {
				throw new ErrorHandling_SprintfException(
					'Project specific directory requested but \'%s\' given as module name!',
					array($module)
				);
			} else {
				if ($section == 'haddock') {
					$modules_directory = $this->get_core_modules_directory();
				} elseif ($section == 'plug-ins') {
					$modules_directory = $this->get_plug_in_modules_directory();
				} else {
					throw new ErrorHandling_SprintfException(
						'No section called \'%s\'!',
						array($section)
					);
				}

				return $modules_directory->get_module_directory($module);
			}
		} else {	
			if ($section == 'project-specific') {
				return $this->get_project_specific_directory();
			}
		}

		throw new ErrorHandling_SprintfException(
			'No \'%s\' module found in the \'%s\' section!',
			array($module, $section)
		);
	}

	##################################################################
	# Our projects have to be saved in directories that have names
	# from which we can extract data.
	
	//private function
	//    get_directory_name_data()
	//{
	//    if (!isset($this->directory_name_data)) {
	//        #$regex = '/([\w-]+)\.([\w-]+)\.([\w-]+)\.clearlinewebdesign.com/';
	//        $regex = '{haddock-projects(?:\\\\|/)([\w-]+)(?:\\\\|/)([\w-]+)(?:\\\\|/)([\w-]+)}';
	//        
	//        if (preg_match($regex, PROJECT_ROOT, $matches)) {
	//            #$this->directory_name_data['purpose'] = $matches[1];
	//            #$this->directory_name_data['project'] = $matches[2];
	//            #$this->directory_name_data['host'] = $matches[3];
	//            
	//            $this->directory_name_data['host'] = $matches[1];
	//            $this->directory_name_data['project'] = $matches[2];
	//            $this->directory_name_data['purpose'] = $matches[3];
	//        } else {
	//            throw new Exception('Unable to extract directory name data from "' . PROJECT_ROOT . "\"!\n");
	//        }
	//    }
	//    
	//    return $this->directory_name_data;
	//}
	//
	//public function
	//    get_current_purpose_name()
	//{
	//    $directory_name_data = $this->get_directory_name_data();
	//    return $directory_name_data['purpose'];
	//}
	//
	//public function
	//    get_current_project_name()
	//{
	//    //$directory_name_data = $this->get_directory_name_data();
	//    //return $directory_name_data['project'];
	//    
	//    $project_specific_directory = $this->get_project_specific_directory();
	//    
	//    $config_file =  $project_specific_directory->get_config_file();
	//    
	//    return $config_file->get_project_name();
	//}
	//
	//public function
	//    get_current_host_name()
	//{
	//    $directory_name_data = $this->get_directory_name_data();
	//    return $directory_name_data['host'];
	//}
	
	public function
		get_mysql_user()
	{
		$mysql_user_factory = Database_MySQLUserFactory::get_instance();
		
		return $mysql_user_factory->get_for_this_project();
	}
	
	//public function
	//    get_table_specification_files()
	//{
	//    $table_specification_files = array();
	//    
	//    return $table_specification_files;
	//}
	//
	//public function
	//    get_names_of_tables_in_files()
	//{
	//    $names_of_tables_in_files = array();
	//    
	//    return $names_of_tables_in_files;
	//}
	
	##################################################################
	# Helps us turn table names into class names.
	
	//public function
	//    get_table_name_translator_factory()
	//{
	//    if (!isset($this->table_name_translator_factory)) {
	//        $this->table_name_translator_factory
	//            = new Database_TableNameTranslatorFactory($this);
	//    }
	//    
	//    return $this->table_name_translator_factory;
	//}
	//
	//public function
	//    get_database_username_suggestion()
	//{
	//    if (!isset($this->database_username_suggestion)) {
	//        $this->database_username_suggestion = '';
	//        
	//        $purpose = $this->get_current_purpose_name();
	//        
	//        $this->database_username_suggestion .= strtolower($purpose[0]);
	//        
	//        $this->database_username_suggestion .= '_';
	//        
	//        $project = $this->get_current_project_name();
	//        
	//        foreach (explode('-', $project) as $p_w) {
	//            $this->database_username_suggestion .= strtolower($p_w[0]);
	//        }
	//        
	//        $this->database_username_suggestion .= '_';
	//        
	//        $host = $this->get_current_host_name();
	//        
	//        $this->database_username_suggestion .= strtolower($host[0]);
	//    }
	//    
	//    return $this->database_username_suggestion;
	//}
	//
	//public function get_database_name_suggestion()
	//{
	//    return $this->get_database_username_suggestion();
	//}
	
	public function get_database_class_finder()
	{
		if (!isset($this->database_class_finder)) {
			$this->database_class_finder = new Database_DatabaseClassFinder($this);
		}
		
		return $this->database_class_finder;
	}
	
	/**
	 * This method searches for PHP class files in the following places:
	 *  - The project specific directory.
	 *  - The core module directories.
	 *  - The plug-in module directories.
	 * 
	 * @return
	 *  FileSystem_PHPClassFile[]
	 *  All the PHP classes defined in the project.
	 */
	public function
		get_php_class_files()
	{
		if (!isset($this->php_class_files)) {
			/*
			 * What classes are defined in the project-specific
			 * directory?
			 */
			$project_specific_directory
				= $this->get_project_specific_directory();
			
			$this->php_class_files
			#$php_class_files
				= $project_specific_directory->get_php_class_files();
			
			/*
			 * What classes are defined in the core
			 * module directories?
			 */
			$core_module_directories = $this->get_core_module_directories();
			foreach ($core_module_directories as $core_module_directory) {
				$c_m_php_class_files
					= $core_module_directory->get_php_class_files();
				
				foreach ($c_m_php_class_files as $c_m_php_class_file) {
					$this->php_class_files[]
					#$php_class_files[]
						= $c_m_php_class_file;
				}
			}
			
			/*
			 * Are any classes defined in any of the plug-in modules?
			 */
			$plug_in_module_directories
				= $this->get_plug_in_module_directories();
			foreach ($plug_in_module_directories as $plug_in_module_directory) {
				$p_i_m_php_class_files
					= $plug_in_module_directory->get_php_class_files();
				
				foreach ($p_i_m_php_class_files as $p_i_m_php_class_file) {
					$this->php_class_files[]
					#$php_class_files[]
						= $p_i_m_php_class_file;
					#echo $p_i_m_php_class_file->get_php_class_name();
				}
			}
		}
		
		#print_r($php_class_files);
		
		usort(
			$this->php_class_files,
			array(
				'FileSystem_PHPClassFile',
				'cmp_php_class_names'
			)
		);
		
		return $this->php_class_files;
		#return $php_class_files;
	}
	
	/**
	 * Returns an array of <code>FileSystem_PHPClassFile</code> objects that extend
	 * <code>$parent_class_name</code>.
	 *
	 * @param string $parent_class_name The name of the class that all the returned PHP classes files should extend.
	 * @param boolean $include_parent_class Whether the parent class should go into the returned list or not.
	 * @param boolean $include_abstract_classes Whether to include abstract classes in the list or not.
	 * @return array The <code>FileSystem_PHPClassFile</code> objects.
	 */
	public function
		get_php_subclass_files(
			$parent_class_name,
			$include_parent_class = TRUE,
			$include_abstract_classes = TRUE
		)
	{
		$php_subclass_files = array();
		
		$php_class_files = $this->get_php_class_files();
		
		/*
		 * Loop through the classes to check that there is a class called
		 * <code>$parent_class_name</code>.
		 */
		foreach (
			$php_class_files
			as
			$p_c_f
		) {
			if ($p_c_f->get_php_class_name() == $parent_class_name) {
				$parent_reflection_class = $p_c_f->get_reflection_class();
				break;
			}
		}
		#print_r($parent_reflection_class);
		
		/*
		 * Filter out the classes that are not subclasses of <code>$parent_class_name</code>.
		 */
		if (isset($parent_reflection_class)) {
			foreach (
				$php_class_files
				as
				$p_c_f
			) {
				$current_reflection_class = $p_c_f->get_reflection_class();
				
				if (
					$current_reflection_class
						->isSubclassOf($parent_reflection_class)
					||
					(
						$include_parent_class
						&&
						(
							$current_reflection_class->getName()
							==
							$parent_reflection_class->getName()
						)
					)
				) {
					$php_subclass_files[] = $p_c_f;
				}
			}
		}
		
		/*
		 * Filter out the abstract classes, if not requested.
		 */
		if (!$include_abstract_classes) {
			$php_subclass_files
				= array_filter(
					$php_subclass_files,
					create_function(
						'$php_subclass_file',
						'$reflection_class = $php_subclass_file->get_reflection_class(); return !$reflection_class->isAbstract();'
					)
				);
		}
		
		usort(
			$php_subclass_files,
			array(
				'FileSystem_PHPClassFile',
				'cmp_php_class_names'
			)
		);
		
		return $php_subclass_files;
	}
	
	public function
		get_modules_with_admin_sections()
	{
		$modules_with_admin_sections = array();
		
		/**
		 * Does the project have it's own admin section?
		 */
		$project_specific_directory = $this->get_project_specific_directory();
		
		if ($project_specific_directory->has_admin_section()) {
			$modules_with_admin_sections[] = $project_specific_directory;
		}
		
		/**
		 * Which of the haddock core modules have admin sections?
		 */
		foreach ($this->get_core_module_directories() as $c_m_d) {
			if ($c_m_d->has_admin_section()) {
				$modules_with_admin_sections[] = $c_m_d;
			}
		}
		
		/**
		 * Do any of the plug-in modules have admin sections?
		 */
		
		foreach ($this->get_plug_in_module_directories() as $p_i_m_d) {
			if ($p_i_m_d->has_admin_section()) {
				$modules_with_admin_sections[] = $p_i_m_d;
			}
		}
		
		return $modules_with_admin_sections;
	}
	
	public function
		get_table_structure_manager()
	{
		return new Database_TableStructureManager($this);
	}
	
	/*
	 * ----------------------------------------
	 * Methods to do with unit tests
	 * ----------------------------------------
	 */
	
	public function
		get_all_unit_tests_php_class_files()
	{
		$unit_tests_php_class_files = array();
		
		$module_directories = $this->get_module_directories();
		
		foreach ($module_directories as $m_d) {
			if ($m_d->has_classes_directory()) {
				$classes_directory = $m_d->get_classes_directory();
				
				if ($classes_directory->has_subdirectory('unit-tests')) {
					$unit_tests_directory = $classes_directory->get_subdirectory('unit-tests');
					
					$files = $unit_tests_directory->get_files_by_extension_recursively('inc.php');
					
					foreach ($files as $file) {
						$unit_tests_php_class_files[]
							= new UnitTests_UnitTestsPHPClassFile(
								$file->get_name()
							);
					}
				}
			}
		}
		
		return $unit_tests_php_class_files;
	}
   
	/*
	 * ----------------------------------------
	 * Methods to do with the config file for the project.
	 * ----------------------------------------
	 */

	public function
		has_config_file()
	{
		$project_specific_directory = $this->get_project_specific_directory();
		
		return $project_specific_directory->has_config_file();
	}
	
	public function
		get_config_file()
	{
		$project_specific_directory = $this->get_project_specific_directory();
		
		return $project_specific_directory->get_config_file();
	}
	
	/*
	 * ----------------------------------------
	 * Methods to do with the autoload file.
	 * ----------------------------------------
	 */
	
	public function
		define_autoload_inc_file()
	{
		$project_specific_directory = $this->get_project_specific_directory();
		
		$autoload_inc_file
			= $project_specific_directory->get_autoload_inc_file();
		
		require_once $autoload_inc_file->get_name();
	}
	
	public function
		refresh_autoload_file()
	{
		$project_specific_directory = $this->get_project_specific_directory();

		$autoload_inc_file
			= $project_specific_directory->get_autoload_inc_file();
		
		$autoload_inc_file->refresh();
		
		return TRUE;
	}
	
	/*
	 * ----------------------------------------
	 * Methods to do with the database passwords file.
	 * ----------------------------------------
	 */
	
	private function
		get_passwords_filename()
	{
		$passwords_file_name =
			$this->get_name()
			. '/passwords/passwords.inc.php';
		
		#echo "\$passwords_file_name: $passwords_file_name\n";
		
		return $passwords_file_name;
	}
	
	public function
		has_passwords_file()
	{
		$passwords_filename = $this->get_passwords_filename();
		
		return file_exists($passwords_filename);
	}
	
	public function
		get_passwords_file()
	{
		/*
		 * Does the passwords directory exist?
		 */
		if ($this->has_passwords_file()) {
			#$passwords_directory_name = $this->get_name() . '/passwords';
			#if (!is_dir($passwords_directory_name)) {
			#	mkdir($passwords_directory_name);
			#}
			
			$passwords_file
				= new Database_PasswordFile($this->get_passwords_filename());
			
			return $passwords_file;
		} else {
			$error_message = 'No passwords file!';
			
			/*
			 * TO DO:
			 * Try to find a way to throw this exception
			 * and not have the exceptions page redirect
			 * infinitely.
			 */
			
			throw new Exception($error_message);
			#echo "$error_message\n"; exit;
		}
	}
	
	///*
	// * Methods to do with the instance specific config file.
	// *
	// * This is a file that is not under SVN control and is
	// * specific to a single instance of this project.
	// *
	// * e.g. the config for a site on a dev machine might be
	// * different from that on a production machine.
	// */
	//private function
	//    get_instance_specific_config_filename()
	//{
	//    $instance_specific_config_filename = $this->get_name();
	//    
	//    $instance_specific_config_filename .= '/config/config.xml';
	//    
	//    return $instance_specific_config_filename;
	//}
	//
	//public function
	//    has_instance_specific_config_file()
	//{
	//    return file_exists($this->get_instance_specific_config_filename());
	//}
	//
	//public function
	//    get_instance_specific_config_file()
	//{
	//    if ($this->has_instance_specific_config_file()) {
	//        $iscfm = HPO_ISCFileManager::get_instance();
	//        
	//        return $iscfm->get_isc_file();
	//    } else {
	//        throw new HPO_NoISCFileException();
	//    }
	//}
	
	public function
		get_script_directories()
	{
		$script_directories = array();
		
		foreach ($this->get_module_directories() as $md) {
			foreach ($md->get_script_directories() as $mdsd) {
				$script_directories[] = $mdsd;
			}
		}
		
		return $script_directories;
	}
	
#    public function
#        get_admin_navigation_xml_file()
#    {
#        $psd = $this->get_project_specific_directory();
#
#        if ($psd->has_admin_navigation_xml_file()) {
#            $anxf = $psd->get_admin_navigation_xml_file();
#        } else {
#            $anxf = $this->generate_admin_navigation_xml_file();
#        }
#        
#        return $anxf;
#    }
}
?>