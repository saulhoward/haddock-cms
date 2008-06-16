<?php
/**
 * HaddockProjectOrganisation_ModuleDirectory
 *
 * @copyright 2006-11-13, RFI
 */

#/*
# * Define the necessary classes.
# */
#require_once PROJECT_ROOT
#	. '/haddock/admin/classes/'
#	. 'Admin_IncludesDirectory.inc.php';
#
#require_once PROJECT_ROOT
#	. '/haddock/cli-scripts/classes/'
#	. 'CLIScripts_BinIncludesDirectory.inc.php';
#
#require_once PROJECT_ROOT
#	. '/haddock/database/classes/table-structure-synchronisation/'
#	. 'Database_TableSpecificationDirectory.inc.php';
#
#require_once PROJECT_ROOT
#	. '/haddock/file-system/classes/'
#	. 'FileSystem_Directory.inc.php';
#
#require_once PROJECT_ROOT
#	. '/haddock/file-system/classes/'
#	. 'FileSystem_SVNWorkingDirectory.inc.php';
#
#require_once PROJECT_ROOT
#	. '/haddock/file-system/classes/'
#	. 'FileSystem_PHPClassFile.inc.php';
#
#require_once PROJECT_ROOT
#	. '/haddock/formatting/classes/'
#	. 'Formatting_ListOfWords.inc.php';
#
##require_once PROJECT_ROOT
##    . '/haddock/haddock-project-organisation/classes/'
##    . 'HaddockProjectOrganisation_ModuleConfigFile.inc.php';
#
#require_once PROJECT_ROOT
#	. '/haddock/haddock-project-organisation/classes/'
#	. 'HaddockProjectOrganisation_ClassesDirectory.inc.php';
#
#//require_once PROJECT_ROOT
#//    . '/haddock/haddock-project-organisation/classes/'
#//    . 'HaddockProjectOrganisation_PublicPageDirectory.inc.php';
#
#require_once PROJECT_ROOT
#	. '/haddock/haddock-project-organisation/classes/'
#	. 'HaddockProjectOrganisation_CLIScriptDirectory.inc.php';
#
#require_once PROJECT_ROOT
#	. '/haddock/haddock-project-organisation/classes/'
#	. 'HaddockProjectOrganisation_IncludesDirectory.inc.php';
#
##require_once PROJECT_ROOT
##    . '/haddock/haddock-project-organisation/classes/'
##    . 'HaddockProjectOrganisation_ModuleConfigXMLFile.inc.php';
#
#require_once PROJECT_ROOT
#	. '/haddock/haddock-project-organisation/classes/exceptions/'
#	. 'HaddockProjectOrganisation_ModuleConfigException.inc.php';

/**
 * Represents a module directory under SVN control
 * that is part of a haddock project.
 *
 * i.e.
 *  - the project specific directory
 *  - one of the haddock core module directories
 *  - a haddock plug-in module
 */
abstract class
	HaddockProjectOrganisation_ModuleDirectory
extends
	FileSystem_SVNWorkingDirectory
{
	/*
	 * -------------------------------------------------------------------------
	 * Instance Variables.
	 * -------------------------------------------------------------------------
	 */

	/**
	 * @var
	 *  HaddockProjectOrganisation_ProjectDirectory
	 *  The project using this module.
	 */
	private $project_directory;

	/*
	 * -------------------------------------------------------------------------
	 */

	public function
		__construct(
			$name,
			HaddockProjectOrganisation_ProjectDirectory $project_directory
		)
	{
		parent::__construct($name);
		$this->project_directory = $project_directory;
	}

	/*
	 * -------------------------------------------------------------------------
	 */

	public function
		get_project_directory()
	{
		return $this->project_directory;
	}

	/*
	 * -------------------------------------------------------------------------
	 * The Module Configuration File.
	 * -------------------------------------------------------------------------
	 */

	private function
		get_module_config_filename()
	{
		return $this->get_name() . '/module-config.txt';
	}

	public function
		has_module_config_file()
	{
		return file_exists($this->get_module_config_filename());
	}

	public function
		get_module_config_file()
	{
		if ($this->has_module_config_file()) {
			return
				new HaddockProjectOrganisation_ModuleConfigFile(
					$this->get_module_config_filename(),
					$this
				);
		} else {
			$msg = 'Module configuration file requested for '
				. $this->get_module_name()
				. ' but no such file exists!';

			throw new Exception($msg);
		}
	}

	/*
	 * -------------------------------------------------------------------------
	 * The Admin Includes Directory.
	 * -------------------------------------------------------------------------
	 */

	private function
		get_admin_includes_directory_name()
	{
		return $this->get_name() . '/admin-includes';
	}

	public function
		has_admin_includes_directory()
	{
		$directory_name = $this->get_admin_includes_directory_name();

		#echo "\$directory_name: $directory_name\n";

		return is_dir($directory_name);
	}

	public function
		get_admin_includes_directory()
	{
		if ($this->has_admin_includes_directory()) {
			return
				new Admin_IncludesDirectory(
					$this->get_admin_includes_directory_name(),
					$this
				);
		} else {
			$msg = 'Admin includes directory requested for '
				. $this->get_module_name()
				. ' but no such directory exists!';

			throw new Exception($msg);
		}
	}

	/*
	 * -------------------------------------------------------------------------
	 * The Classes Directory.
	 * -------------------------------------------------------------------------
	 */

	private function
		get_classes_directory_name()
	{
		return $this->get_name() . DIRECTORY_SEPARATOR . 'classes';
	}

	public function
		has_classes_directory()
	{
		$directory_name = $this->get_classes_directory_name();

		return is_dir($directory_name);
	}

	public function
		get_classes_directory()
	{
		if ($this->has_classes_directory()) {
			return
				new HaddockProjectOrganisation_ClassesDirectory(
					$this->get_classes_directory_name(),
					$this
				);
		} else {
			$msg = 'Classes directory requested for '
				. $this->get_module_name()
				. ' but no such directory exists!';

			throw new Exception($msg);
		}
	}
	
	public function
		make_sure_classes_directory_exists()
	{
		if (!$this->has_classes_directory()) {
			FileSystem_DirectoryHelper
				::mkdir_parents($this->get_classes_directory_name());
		}
	}
	
	public function
		get_php_class_files()
	{
		$php_class_files = array();

		if ($this->has_classes_directory()) {
			$classes_directory = $this->get_classes_directory();

			$php_class_files = $classes_directory->get_php_class_files();
		}

		#print_r($php_class_files);

		return $php_class_files;
	}

	/*
	 * -------------------------------------------------------------------------
	 * Methods to do with names.
	 * -------------------------------------------------------------------------
	 */

	/**
	 * Returns the name of this module in camel-case.
	 *
	 * Abstract because the way that this is extracted
	 * from the directory name is different for the subclasses
	 * of this class:
	 *
	 *  - HaddockProjectOrganisation_ProjectSpecificDirectory
	 *  - HaddockProjectOrganisation_CoreModuleDirectory
	 *  - HaddockProjectOrganisation_PlugInDirectory
	 */
	public abstract function
		get_module_name();

	public abstract function
		get_module_name_as_l_o_w();

	/**
	 * The main name that we would use to identify this module.
	 *
	 * All lc, no spaces, hyphen separated.
	 */
	public function
		get_identifying_name()
	{
		$module_name_l_o_ws = $this->get_module_name_as_l_o_w();
		return $module_name_l_o_ws->get_words_as_delimited_lc_string('-');
	}

	public function
		get_admin_section_directory_name()
	{
		$module_name_l_o_ws = $this->get_module_name_as_l_o_w();
		return $module_name_l_o_ws->get_words_as_delimited_lc_string('-');
	}

	/**
	 * The camel case root for this module.
	 *
	 * This might be used to create classes for this module.
	 */
	public function
		get_camel_case_root()
	{
		if ($this->has_module_config_file()) {
			$module_config_file = $this->get_module_config_file();
			
			if ($module_config_file->has_camel_case_root()) {
				return $module_config_file->get_camel_case_root();
			}
		}
		
		$name_as_l_o_w = $this->get_module_name_as_l_o_w();
		
		return $name_as_l_o_w->get_words_as_camel_case_string();
	}

	/**
	 * A module is said to have an admin section if
	 * it has an admin includes directory and there is
	 * an configuration file that defines an admin section
	 * title.
	 */
	public function
		has_admin_section()
	{
		if ($this->has_admin_includes_directory()) {
			if ($this->has_module_config_file()) {
				$module_config_file = $this->get_module_config_file();

				#print_r($module_config_file);

				return $module_config_file->has_admin_section_title();
			}
		}

		return FALSE;
	}

	public function
		get_admin_section_title()
	{
		$admin_section_title = '';

		if ($this->has_module_config_file()) {
			$module_config_file = $this->get_module_config_file();

			if ($module_config_file->has_admin_section_title()) {
				$admin_section_title .= $module_config_file->get_admin_section_title();
				#$admin_section_title .= ' ';
			}
		}

		#$admin_section_title .= 'Admin';

		return $admin_section_title;
	}

	public function
		get_title()
	{
		return $this->get_module_name();
	}

	/*
	 * -------------------------------------------------------------------------
	 */

	private function
		get_table_specification_directory_name()
	{
		return $this->get_name() . '/table-specification';
	}

	public function
		has_table_specification_directory()
	{
		return is_dir($this->get_table_specification_directory_name());
	}

	public function
		create_table_specification_directory()
	{
		if ($this->has_table_specification_directory()) {
			throw new Exception(
				$this->get_table_specification_directory_name()
				. ' already exists!'
			);
		} else {
			mkdir($this->get_table_specification_directory_name());
		}
	}

	public function
		get_table_specification_directory()
	{
		if ($this->has_table_specification_directory()) {
			return new Database_TableSpecificationDirectory(
				$this->get_table_specification_directory_name()
			);
		} else {
			throw new Exception(
				$this->get_table_specification_directory_name()
				. ' does not exist!'
			);
		}
	}

	public function
		get_cli_script_directories()
	{
		$cli_script_directories = array();

		$bin_includes_directory_name = $this->get_name() . '/bin-includes/scripts';

		#echo "\$bin_includes_directory_name: $bin_includes_directory_name\n";

		if (is_dir($bin_includes_directory_name)) {
			$bin_includes_directory = new FileSystem_Directory($bin_includes_directory_name);

			$directories = $bin_includes_directory->get_subdirectories();

			foreach ($directories as $dir) {
				$cli_script_directories[] = new HaddockProjectOrganisation_CLIScriptDirectory($dir->get_name());
			}
		}

		return $cli_script_directories;
	}

	///*
	// * To do with public-include page directories.
	// */
	//public function
	//    get_public_page_directories()
	//{
	//    $public_page_directories = array();
	//
	//    $public_includes_pages_directory_name = $this->get_name() . '/public-includes/pages';
	//
	//    if (is_dir($public_includes_pages_directory_name)) {
	//        $public_includes_pages_directory = new FileSystem_Directory($public_includes_pages_directory_name);
	//
	//        foreach ($public_includes_pages_directory->get_subdirectories() as $sd) {
	//            $public_page_directories[] = new HaddockProjectOrganisation_PublicPageDirectory($sd->get_name());
	//        }
	//    }
	//
	//    return $public_page_directories;
	//}
	//
	//public function
	//    get_public_page_directory($page_name)
	//{
	//    $public_page_directories = $this->get_public_page_directories();
	//
	//    foreach ($public_page_directories as $ppd) {
	//        if ($ppd->get_page_name() == $page_name) {
	//            return $ppd;
	//        }
	//    }
	//
	//    throw new Exception("No page called $page_name in ". $this->get_name() . '!');
	//}
	//
	///*
	// * Methods to do with the public-includes directory.
	// */
	//private function
	//    get_public_includes_directory_name()
	//{
	//    return $this->get_name() . '/public-includes';
	//}
	//
	//public function
	//    has_public_includes_directory()
	//{
	//    return is_dir($this->get_public_includes_directory_name());
	//}
	//
	//public function
	//    get_public_includes_directory()
	//{
	//    if ($this->has_public_includes_directory()) {
	//        return new PublicHTML_IncludesDirectory(
	//            $this->get_public_includes_directory_name(),
	//            $this
	//        );
	//    } else {
	//        throw new Exception('No public-includes directory!');
	//    }
	//}

	/*
	 * Methods to do with the bin-includes directory.
	 */
	private function
		get_bin_includes_directory_name()
	{
		return $this->get_name() . '/bin-includes';
	}

	public function
		has_bin_includes_directory()
	{
		return is_dir($this->get_bin_includes_directory_name());
	}

	public function
		get_bin_includes_directory()
	{
		if ($this->has_bin_includes_directory()) {
			return new CLIScripts_BinIncludesDirectory($this->get_bin_includes_directory_name(), $this);
		} else {
			throw
				new Exception(
					$this->get_bin_includes_directory_name()
					. ' does not exist!'
				);
		}
	}

	/*
	 * Script directories.
	 */
	public function
		get_script_directories()
	{
		$script_directories = array();

		if ($this->has_bin_includes_directory()) {
			$bin_includes_directory = $this->get_bin_includes_directory();
			$script_directories
				= $bin_includes_directory->get_script_directories();
		}

		return $script_directories;
	}

	public function
		get_script_directory($script_name)
	{
		$bin_includes_directory = $this->get_bin_includes_directory();

		$scripts_directory = $bin_includes_directory->get_scripts_directory();

		$script_directory =
			$scripts_directory->get_script_directory($script_name);

		return $script_directory;
	}

	public abstract function
		get_admin_section_home_page_href();

	public abstract function
		get_section_short_form();

	public abstract function
		get_section_name();

	/*
	 * -------------------------------------------------------------------------
	 * The WWW Includes Directory.
	 * -------------------------------------------------------------------------
	 */

	private function
		get_www_includes_directory_name()
	{
		return $this->get_name() . '/www-includes';
	}

	public function
		has_www_includes_directory()
	{
		$www_includes_directory_name
			= $this->get_www_includes_directory_name();

		#echo "\$www_includes_directory_name: $www_includes_directory_name\n";

		return is_dir($www_includes_directory_name);
	}

	public function
		create_www_includes_directory()
	{
		if (!$this->has_www_includes_directory()) {
			$widn = $this->get_www_includes_directory_name();

			mkdir($widn);
		}
	}

	public function
		get_www_includes_directory()
	{
		if ($this->has_www_includes_directory()) {
			return
				new HaddockProjectOrganisation_WWWIncludesDirectory(
					$this->get_www_includes_directory_name(),
					$this
				);
		} else {
			$msg = 'Admin includes directory requested for '
				. $this->get_module_name()
				. ' but no such directory exists!';

			throw new Exception($msg);
		}
	}

	/*
	 * ----------------------------------------
	 * Methods to do with the required modules file.
	 * ----------------------------------------
	 */

	private function
		get_required_modules_filename()
	{
		return $this->get_name() . '/haddock-project-organisation/required-modules.xml';
	}

	public function
		has_required_modules_file()
	{
		return file_exists($this->get_required_modules_filename());
	}

	public function
		get_required_modules_file()
	{
		if ($this->has_required_modules_file()) {
			return new HaddockProjectOrganisation_RequiredModulesFile(
				$this->get_required_modules_filename()
			);
		} else {
			throw new Exception('No required modules file!');
		}
	}

	public function
		create_required_modules_file()
	{
		//echo "In: HaddockProjectOrganisation_ModuleDirectory::create_required_modules_file()\n";

		if ($this->has_required_modules_file()) {
			throw new Exception(
				'Cannot create new required modules file when one already exists!'
			);
		} else {
			$hpo_dir_name = $this->get_name() . '/haddock-project-organisation';

			if (!is_dir($hpo_dir_name)) {

				echo "Creating: $hpo_dir_name\n";

				mkdir($hpo_dir_name);
			}

			$required_modules_file
				= new HaddockProjectOrganisation_RequiredModulesFile(
					$this->get_required_modules_filename()
				);

			$required_modules_file->initialise();
		}
	}

	/*
	 * ----------------------------------------
	 * Methods to do with module config files.
	 * ----------------------------------------
	 */

	protected function
		get_config_file_reflection_class_file_name()
	{
		return 'HaddockProjectOrganisation_ConfigFile';
	}

	private function
		get_config_file_reflection_class()
	{
		$class_name = $this->get_config_file_reflection_class_file_name();

		return new ReflectionClass($class_name);
	}

	private function
		get_config_filename()
	{
		return $this->get_name() . '/config/config.xml';
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
			//return new HaddockProjectOrganisation_ModuleConfigXMLFile(
			//    $this->get_config_filename()
			//);

			$config_file_reflection_class
				= $this->get_config_file_reflection_class();

			return $config_file_reflection_class->newInstance(
				$this->get_config_filename()
			);
		} else {
			throw
				new HaddockProjectOrganisation_ModuleConfigException(
					'No config file in \'%s\'!',
					array($this->get_name())
				);
		}
	}

	/*
	 * ----------------------------------------
	 * Methods to do with project-specific module config files.
	 * ----------------------------------------
	 */

	private function
		get_project_specific_config_file_name()
	{
		$pd = $this->get_project_directory();
		$psd = $pd->get_project_specific_directory();

		return
			$psd->get_name() . '/config/'
			. $this->get_section_name() . '/'
			. $this->get_identifying_name() . '/config.xml';
	}

	public function
		has_project_specific_config_file()
	{
		return is_file($this->get_project_specific_config_file_name());
	}

	public function
		get_project_specific_config_file()
	{
		if ($this->has_project_specific_config_file()) {
			//$project_specific_config_file_reflection_class
			//    = $this->get_project_specific_config_file_reflection_class();
			//
			//return $project_specific_config_file_reflection_class->newInstance(
			//    $this->get_project_specific_config_file_name()
			//);

			$config_file_reflection_class
				= $this->get_config_file_reflection_class();

			return $config_file_reflection_class->newInstance(
				$this->get_project_specific_config_file_name()
			);
		} else {
			throw new ErrorHandling_SprintfException(
				'No project-specific config file for the \'%s\' module in the \'%s\' section! File called \'%s\' expected!',
				array(
					$this->get_identifying_name(),
					$this->get_section_name(),
					$this->get_project_specific_config_file_name()
				)
			);
		}
	}

	//private function
	//    get_project_specific_config_file_reflection_class()
	//{
	//    $class_name = 'HaddockProjectOrganisation_PSModuleConfigFile';
	//
	//    if ($this->has_config_file()) {
	//        $config_file
	//            = new HaddockProjectOrganisation_ModuleConfigXMLFile(
	//                $this->get_config_filename()
	//            );
	//
	//        if ($config_file->has_project_specific_config_file_class_name()) {
	//            $class_name  = $config_file->get_project_specific_config_file_class_name();
	//        }
	//    }
	//
	//    return new ReflectionClass($class_name);
	//}

	/*
	 * ----------------------------------------
	 * Methods to do with the instance specific config files.
	 * ----------------------------------------
	 */

	private function
		get_instance_specific_config_file_name()
	{
		$pd = $this->get_project_directory();

		return
			$pd->get_name() . '/config/'
			. $this->get_section_name() . '/'
			. $this->get_identifying_name() . '/config.xml';
	}

	public function
		has_instance_specific_config_file()
	{
		return is_file($this->get_instance_specific_config_file_name());
	}

	public function
		get_instance_specific_config_file()
	{
		if ($this->has_instance_specific_config_file()) {
			//$instance_specific_config_file_reflection_class
			//    = $this->get_project_specific_config_file_reflection_class();
			//
			//return $instance_specific_config_file_reflection_class->newInstance(
			//    $this->get_instance_specific_config_file_name()
			//);

			$config_file_reflection_class
				= $this->get_config_file_reflection_class();

			return $config_file_reflection_class->newInstance(
				$this->get_instance_specific_config_file_name()
			);
		} else {
			throw new HaddockProjectOrganisation_ModuleConfigException(
				'No instance specific config file for the \'%s\' module in the \'%s\' section! File called \'%s\' expected!',
				array(
					$this->get_identifying_name(),
					$this->get_section_name(),
					$this->get_instance_specific_config_file_name()
				)
			);
		}
	}

	/*
	 * Methods to do with the admin-db-pages
	 */
	private function
		get_db_admin_xml_file_name($stem)
	{
		return $this->get_name() . '/admin-db-pages/' . $stem . '.xml';
	}

	public function
		has_db_admin_xml_file($stem)
	{
		return is_file($this->get_db_admin_xml_file_name($stem));
	}

	public function
		get_db_admin_xml_file($stem)
	{
		if ($this->has_db_admin_xml_file($stem)) {
			return new FileSystem_XMLFile($this->get_db_admin_xml_file_name($stem));
		} else {
			throw new Exception('No db_admin_xml file called ' . $this->get_db_admin_xml_file_name($stem));
		}
	}
	
	/*
	 * ----------------------------------------
	 * Methods to do with config variables.
	 * ----------------------------------------
	 */
	
	public function
		get_config_variable($key)
	{
		if (DEBUG) {
			echo DEBUG_DELIM_OPEN;
			
			echo 'Line: ' . __LINE__ . "\n";
			echo 'File: ' . __FILE__ . "\n";
			echo 'Class: ' . __CLASS__ . "\n";
			echo 'Method: ' . __METHOD__ . "\n";
			echo 'get_class($this): ' . get_class($this) . "\n";
			echo '$this->basename(): ' . $this->basename() . "\n";
			
			echo "\$key: $key\n";
			
			echo DEBUG_DELIM_CLOSE;
		}

		/*
		 * Is this variable set in the instance specific file?
		 */
		if ($this->has_instance_specific_config_file()) {
			$instance_specific_config_file
				= $this->get_instance_specific_config_file();
			
			if ($instance_specific_config_file->has_value($key)) {
				$value = $instance_specific_config_file->get_value($key);
				
				if (DEBUG) {
					echo DEBUG_DELIM_OPEN;
					
					echo 'Line: ' . __LINE__ . "\n";
					echo 'File: ' . __FILE__ . "\n";
					echo 'Class: ' . __CLASS__ . "\n";
					echo 'Method: ' . __METHOD__ . "\n";
					echo 'get_class($this): ' . get_class($this) . "\n";
					
					echo "\$key: $key\n";
					echo "Instance specific config value found\n";
					echo "$value\n";
					   
					echo DEBUG_DELIM_CLOSE;
				}
				
				return $value;
			}
		}
		
		/*
		 * Is this variable set in the project specific file?
		 */
		if ($this->has_project_specific_config_file()) {
			$project_specific_config_file
				= $this->get_project_specific_config_file();
			
			if ($project_specific_config_file->has_value($key)) {
				$value = $project_specific_config_file->get_value($key);

				if (DEBUG) {
					echo DEBUG_DELIM_OPEN;
					
					echo 'Line: ' . __LINE__ . "\n";
					echo 'File: ' . __FILE__ . "\n";
					echo 'Class: ' . __CLASS__ . "\n";
					echo 'Method: ' . __METHOD__ . "\n";
					echo 'get_class($this): ' . get_class($this) . "\n";
					
					echo "\$key: $key\n";
					echo "Project specific config value found\n";
					echo "$value\n";
					   
					echo DEBUG_DELIM_CLOSE;
				}
				
				return $value;
			}
		}
		
		/*
		 * Is this variable set in the module config file?
		 */
		if ($this->has_config_file()) {
			$config_file
				= $this->get_config_file();
			
			if (DEBUG) {
				echo DEBUG_DELIM_OPEN;
				
				echo 'Line: ' . __LINE__ . "\n";
				echo 'File: ' . __FILE__ . "\n";
				echo 'Class: ' . __CLASS__ . "\n";
				echo 'Method: ' . __METHOD__ . "\n";
				echo 'get_class($this): ' . get_class($this) . "\n";
				
				echo 'print_r($config_file):' . "\n";
				print_r($config_file);
				
				echo DEBUG_DELIM_CLOSE;
			}
			
			if ($config_file->has_value($key)) {
				$value = $config_file->get_value($key);
				
				if (DEBUG) {
					echo DEBUG_DELIM_OPEN;
					
					echo 'Line: ' . __LINE__ . "\n";
					echo 'File: ' . __FILE__ . "\n";
					echo 'Class: ' . __CLASS__ . "\n";
					echo 'Method: ' . __METHOD__ . "\n";
					echo 'get_class($this): ' . get_class($this) . "\n";
					
					echo "\$key: $key\n";
					echo "Module config value found\n";
					echo "$value\n";
					   
					echo DEBUG_DELIM_CLOSE;
				}
				
				return $value;
			}
		}
		
		/*
		 * If we've got this far, the variable is not set.
		 */
		if (DEBUG) {
			echo DEBUG_DELIM_OPEN;
			
			echo 'Line: ' . __LINE__ . "\n";
			echo 'File: ' . __FILE__ . "\n";
			echo 'Class: ' . __CLASS__ . "\n";
			echo 'Method: ' . __METHOD__ . "\n";
			echo 'get_class($this): ' . get_class($this) . "\n";
			
			echo "\$key: $key\n";
			echo "Nothing found for $key\n";
			
			echo DEBUG_DELIM_CLOSE;
		}
		
		throw new HaddockProjectOrganisation_ModuleConfigException(
			'No config variable called \'%s\' set in the \'%s\' module in the \'%s\' section!',
			array(
				$key,
				$this->get_identifying_name(),
				$this->get_section_name()
			)
		);
	}
	
	/**
	 * Says whether or not the given variable has been set or not.
	 *
	 * It finds this out in a sub-optimal way.
	 *
	 * It tries to find the value and, if an exception is
	 * thrown, returns false.
	 *
	 * It does this because the way that config variables are set
	 * is quite complicated.
	 */
	public function
		has_config_variable($key)
	{
		if (DEBUG) {
			echo DEBUG_DELIM_OPEN;
			
			echo 'Line: ' . __LINE__ . "\n";
			echo 'File: ' . __FILE__ . "\n";
			echo 'Class: ' . __CLASS__ . "\n";
			echo 'Method: ' . __METHOD__ . "\n";
			echo 'get_class($this): ' . get_class($this) . "\n";
			echo '$this->basename(): ' . $this->basename() . "\n";
			
			echo "\$key: $key\n";
			
			echo DEBUG_DELIM_CLOSE;
		}
		
		try {
			$value = $this->get_config_variable($key);
			
			if (isset($value)) {
				if (strlen($value) > 0) {
					return TRUE;
				}
			}
		} catch (HaddockProjectOrganisation_ModuleConfigException $e) {
			
		}
		
		if (DEBUG) {
			echo DEBUG_DELIM_OPEN;
			
			echo 'Line: ' . __LINE__ . "\n";
			echo 'File: ' . __FILE__ . "\n";
			echo 'Class: ' . __CLASS__ . "\n";
			echo 'Method: ' . __METHOD__ . "\n";
			echo 'get_class($this): ' . get_class($this) . "\n";
			
			echo "\n";
			
			echo "\$key: $key\n";
			echo "Nothing found.\n";
			
			echo DEBUG_DELIM_CLOSE;
		}
		
		return FALSE;
	}
	
	/*
	 * ----------------------------------------
	 * Methods to do with nested config variables.
	 * ----------------------------------------
	 */
	
	public function
		get_nested_config_variable(
			array $element_names,
			$required = TRUE
		)
	{
		if (count($element_names) < 1) {
			throw new Exception('Zero length array given to find a nested config variable!');
		}
		
		/*
		 * Is this variable set in the instance specific file?
		 */
		if ($this->has_instance_specific_config_file()) {
			$instance_specific_config_file
				= $this->get_instance_specific_config_file();
			
			if ($instance_specific_config_file->has_nested_value($element_names)) {
				$value = $instance_specific_config_file->get_nested_value($element_names);
				#echo "\$value: $value\n";
				return $value;
			}
		}
		
		/*
		 * Is this variable set in the project specific file?
		 */
		if ($this->has_project_specific_config_file()) {
			$project_specific_config_file
				= $this->get_project_specific_config_file();
			
			if ($project_specific_config_file->has_nested_value($element_names)) {
				return $project_specific_config_file->get_nested_value($element_names);
			}
		}
		
		/*
		 * Is this variable set in the module config file?
		 */
		if ($this->has_config_file()) {
			$config_file
				= $this->get_config_file();
			
			if ($config_file->has_nested_value($element_names)) {
				return $config_file->get_nested_value($element_names);
			}
		}
		
		if ($required) {
			$key = '';
			
			$first = TRUE;
			foreach ($element_names as $e_n) {
				if ($first) {
					$first = FALSE;
				} else {
					$key .= ' -> ';
				}
				
				$key .= $e_n;
			}
			
			throw new HaddockProjectOrganisation_ModuleConfigException(
				'No config variable called \'%s\' set in the \'%s\' module in the \'%s\' section!',
				array(
					$key,
					$this->get_identifying_name(),
					$this->get_section_name()
				)
			);
		} else {
			return NULL;
		}
	}
	
	public function
		has_nested_config_variable(
			array $element_names
		)
	{
		$var = NULL;
		
		$var = $this->get_nested_config_variable(
			$element_names,
			$required = FALSE
		);
		
		return isset($var);
	}
	
	/*
	 * ----------------------------------------
	 * Methods to do with the config directory.
	 * ----------------------------------------
	 */
	
	private function
		get_config_directory_name()
	{
		return $this->get_name() . '/config';
	}
	
	public function
		has_config_directory()
	{
		return is_dir($this->get_config_directory_name());
	}
	
	public function
		get_config_directory()
	{
		if ($this->has_config_directory()) {
			return
				new Configuration_ConfigDirectory(
					$this->get_config_directory_name()
					#,
					#$this
				);
		} else {
			throw
				new HaddockProjectOrganisation_StandardModuleSubDirectoryNotFoundException(
					'config',
					$this->get_config_directory_name()
				);
		}
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with the database table name root.
	 * ----------------------------------------
	 */
	
	abstract public function
		get_database_table_name_root();
	
	/**
	 * Should this value be set for each module?
	 */
	public function
		get_copyright_holder()
	{
		return HaddockProjectOrganisation_ProjectInformationHelper::get_copyright_holder();
	}
}
?>