<?php
/**
 * HaddockProjectOrganisation_ProjectDirectory
 *
 * @copyright 2006-11-13, RFI
 */

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
	 * The FileSystem_Directory for the plug-ins.
	 */
	private $plug_in_modules_directory;
	
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
		$core_modules_directory = $this->get_core_modules_directory();
		
		return $core_modules_directory->get_module_directories();
	}
	
	public function
		get_core_module_directory($module)
	{	
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
		$plug_in_modules_directory = $this->get_plug_in_modules_directory();
		
		return $plug_in_modules_directory->get_module_directories();
	}
	
	public function
		get_plug_in_module_directory($module)
	{	
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

	public function
		get_mysql_user()
	{
		$mysql_user_factory = Database_MySQLUserFactory::get_instance();
		
		return $mysql_user_factory->get_for_this_project();
	}
	
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
		
		usort(
			$this->php_class_files,
			array(
				'FileSystem_PHPClassFile',
				'cmp_php_class_names'
			)
		);
		
		return $this->php_class_files;
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
		#echo "\$passwords_file_name: $passwords_file_name\n"; exit;
		
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
		if (DEBUG) {
			echo DEBUG_DELIM_OPEN;
			
			echo 'File: ' . __FILE__ . PHP_EOL;
			echo 'Line: ' . __LINE__ . PHP_EOL;
			echo 'Method: ' . __METHOD__ . PHP_EOL;
			
			echo DEBUG_DELIM_CLOSE;
		}
		
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
			#print_r($passwords_file); exit;
			
			return $passwords_file;
		} else {
			$error_message = 'No passwords file!';
			
			/*
			 * TO DO:
			 * Try to find a way to throw this exception
			 * and not have the exceptions page redirect
			 * infinitely.
			 */
			
			#echo "$error_message\n"; exit;
			throw new Exception($error_message);
		}
	}
	
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
}
?>