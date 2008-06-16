<?php
/**
 * Database_DatabaseClassFactory
 *
 * @copyright 2006-09-18, RFI
 */

#/**
# * Define the necessary classes.
# */
#require_once PROJECT_ROOT
#    . '/haddock/file-system/classes/'
#    . 'FileSystem_PHPClassFile.inc.php';
#
#require_once PROJECT_ROOT
#    . '/haddock/haddock-project-organisation/classes/'
#    . 'HaddockProjectOrganisation_ProjectDirectoryFinder.inc.php';

/**
 * An instance of this class chooses the correct subclass of Element to
 * instantiate.
 * 
 * We might extend the Database, Table, Row or Field
 * classes in project specific code or in the haddock
 * core modules.
 *
 * The classes returned are ReflectionClass objects.
 *
 * This class uses the singleton pattern so that we can cache
 * ReflectionClass objects for speed.
 *
 * This class looks at the database class name file that
 * is set in the project-specific directory as a look up
 * table.
 *
 * This file is saved in
 *
 * PROJECT_ROOT . '/project-specific/sql/database-class-names.inc.php
 *
 * which is read by Database_DatabaseClassNameFile.
 *
 * If a class is requested that has not been set in this
 * file or the project doesn't have a database class name
 * file, then the default Database, Table, Row or Field
 * class is returned.
 *
 * It should be clear that instances of this class in
 * different projects will return different ReflectionClass
 * objects.
 *
 * The filenames should be relative to PROJECT_ROOT,
 * that way, we could use the same file on all our servers.
 */
class
	Database_DatabaseClassFactory
{
	static private $instance = NULL;
	
	/**
	 * Cached copies of the classes.
	 */
	private $database_class;
	private $database_renderer_class;
	
	private $table_classes;
	private $table_renderer_classes;
	
	private $row_classes;
	private $row_renderer_classes;
	
	private $field_classes;
	private $field_renderer_classes;
	
	##################################################################
	
	private function
		__construct()
	{
		require_once PROJECT_ROOT . '/project-specific/sql/database-class-names.inc.php';
	}
	
	/**
	 * This class uses the singleton pattern.
	 */
	public static function
		get_instance()
	{
		if (self::$instance == NULL) {
			self::$instance = new Database_DatabaseClassFactory();
		}

		return self::$instance;
		#if (!isset($_SESSION['database-class-factory'])) {
		#    $_SESSION['database-class-factory']
		#        = new Database_DatabaseClassFactory();
		#}
		#
		#return $_SESSION['database-class-factory'];
	}
	
	##################################################################
	# These methods return classes to do with databases.
	
	public function
		get_database_class()
	{
		if (!isset($this->database_class)) {
			$this->database_class = null;
			
			$project_directory_finder
				= HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();
			
			$project_directory 
				= $project_directory_finder->get_project_directory_for_this_project();
			
			$project_specific_directory
				= $project_directory->get_project_specific_directory();
			
			$database_class_file = null;
			
			if ($project_specific_directory->has_database_class_name_file()) {
				$database_class_name_file
					= $project_specific_directory->get_database_class_name_file();
				
				if ($database_class_name_file->has_database_class_file()) {
					$database_class_file
						= $database_class_name_file->get_database_class_file();
				}
			}
			
			# Fallback.
			if (!isset($database_class_file)) {
				$database_class_file
					= new FileSystem_PHPClassFile(
						PROJECT_ROOT
						. '/haddock/database/classes/elements/'
						. 'Database_Database.inc.php');
			}
			
			$database_class_file->declare_class();
			
			$this->database_class
				= new ReflectionClass($database_class_file->get_php_class_name());
		}
		
		return $this->database_class;
	}
	
	public function get_database_renderer_class()
	{
		if (!isset($this->database_renderer_class)) {
			$this->database_renderer_class = null;
			
			$project_directory_finder
				= HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();
			
			$project_directory
				= $project_directory_finder->get_project_directory_for_this_project();
			
			$project_specific_directory = $project_directory->get_project_specific_directory();
			
			$database_renderer_class_file = null;
			
			if ($project_specific_directory->has_database_class_name_file()) {
				$database_class_name_file = $project_specific_directory->get_database_class_name_file();
				
				if ($database_class_name_file->has_database_renderer_class_file()) {
					$database_renderer_class_file
						= $database_class_name_file
							->get_database_renderer_class_file();
				}
			}
			
			# Fallback.
			if (!isset($database_renderer_class_file)) {
				$database_renderer_class_file
					= new FileSystem_PHPClassFile(
						PROJECT_ROOT
							. '/haddock/database/classes/renderers/'
							. 'Database_DatabaseRenderer.inc.php'
					);
			}
			
			$database_renderer_class_file->declare_class();
			
			$this->database_renderer_class
				= new ReflectionClass(
					$database_renderer_class_file->get_php_class_name()
				);
		}
				
		return $this->database_renderer_class;
	}
	
	##################################################################
	# These methods return classes to do with tables.
	
	public function
		get_table_class($table_name)
	{
		#echo "Getting the class for $table_name\n";
		
		if (isset($_SESSION['database-class-names'][$table_name]['table_class']['class_file'])) {
			require_once PROJECT_ROOT . $_SESSION['database-class-names'][$table_name]['table_class']['class_file'];
			return new ReflectionClass($_SESSION['database-class-names'][$table_name]['table_class']['class_name']);
		}
		
		if (!isset($this->table_classes[$table_name])) {
			$this->table_classes[$table_name] = null;
			
			$project_directory_finder
				= HaddockProjectOrganisation_ProjectDirectoryFinder
					::get_instance();
			
			$project_directory
				= $project_directory_finder
					->get_project_directory_for_this_project();
			
			$project_specific_directory
				= $project_directory
					->get_project_specific_directory();
			
			$table_class_file = null;
			
			if ($project_specific_directory->has_database_class_name_file()) {
				$database_class_name_file
					= $project_specific_directory
						->get_database_class_name_file();
				
				if (
					$database_class_name_file
					->has_table_class_file($table_name)
				) {
					$table_class_file
						= $database_class_name_file
							->get_table_class_file($table_name);
				}
			}
			
			# Fallback.
			if (!isset($table_class_file)) {
				$table_class_file
					= new FileSystem_PHPClassFile(
						PROJECT_ROOT
							. '/haddock/database/classes/elements/'
							. 'Database_Table.inc.php');
			}
			
			$table_class_file->declare_class();
			
			$this->table_classes[$table_name]
				= new ReflectionClass($table_class_file->get_php_class_name());
		}
		
		return $this->table_classes[$table_name];
	}
	
	public function get_table_renderer_class($table_name)
	{
		if (isset($_SESSION['database-class-names'][$table_name]['table_renderer']['class_file'])) {
			require_once PROJECT_ROOT . $_SESSION['database-class-names'][$table_name]['table_renderer']['class_file'];
			return new ReflectionClass($_SESSION['database-class-names'][$table_name]['table_renderer']['class_name']);
		}
		
		if (!isset($this->table_renderer_classes[$table_name])) {
			$this->table_renderer_classes[$table_name] = null;
			
			$project_directory_finder = HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();
			
			$project_directory = $project_directory_finder->get_project_directory_for_this_project();
			
			$project_specific_directory = $project_directory->get_project_specific_directory();
			
			$table_renderer_class_file = null;
			
			if ($project_specific_directory->has_database_class_name_file()) {
				$database_class_name_file = $project_specific_directory->get_database_class_name_file();
				
				if ($database_class_name_file->has_table_renderer_class_file($table_name)) {
					$table_renderer_class_file = $database_class_name_file->get_table_renderer_class_file($table_name);
				}
			}
			
			# Fallback.
			if (!isset($table_renderer_class_file)) {
				$table_renderer_class_file = new FileSystem_PHPClassFile(PROJECT_ROOT . '/haddock/database/classes/renderers/Database_TableRenderer.inc.php');
			}
			
			$table_renderer_class_file->declare_class();
			
			$this->table_renderer_classes[$table_name] = new ReflectionClass($table_renderer_class_file->get_php_class_name());
		}
		
		return $this->table_renderer_classes[$table_name];
	}
	
	##################################################################
	# These methods return classes to do with rows.
	
	public function get_row_class($table_name)
	{
		if (isset($_SESSION['database-class-names'][$table_name]['row_class']['class_file'])) {
			require_once PROJECT_ROOT . $_SESSION['database-class-names'][$table_name]['row_class']['class_file'];
			return new ReflectionClass($_SESSION['database-class-names'][$table_name]['row_class']['class_name']);
		}
		
		if (!isset($this->row_classes[$table_name])) {
			$this->row_classes[$table_name] = null;
			
			$project_directory_finder
				= HaddockProjectOrganisation_ProjectDirectoryFinder
					::get_instance();
			
			$project_directory = $project_directory_finder->get_project_directory_for_this_project();
			
			$project_specific_directory = $project_directory->get_project_specific_directory();
			
			$row_class_file = null;
			
			if ($project_specific_directory->has_database_class_name_file()) {
				$database_class_name_file = $project_specific_directory->get_database_class_name_file();
				
				if ($database_class_name_file->has_row_class_file($table_name)) {
					$row_class_file = $database_class_name_file->get_row_class_file($table_name);
				}
			}
			
			# Fallback.
			if (!isset($row_class_file)) {
				$row_class_file = new FileSystem_PHPClassFile(PROJECT_ROOT . '/haddock/database/classes/elements/Database_Row.inc.php');
			}
			
			$row_class_file->declare_class();
			
			$this->row_classes[$table_name] = new ReflectionClass($row_class_file->get_php_class_name());
		}
		
		return $this->row_classes[$table_name];
	}
	
	public function get_row_renderer_class($table_name)
	{
		if (isset($_SESSION['database-class-names'][$table_name]['row_renderer']['class_file'])) {
			require_once PROJECT_ROOT . $_SESSION['database-class-names'][$table_name]['row_renderer']['class_file'];
			return new ReflectionClass($_SESSION['database-class-names'][$table_name]['row_renderer']['class_name']);
		}
		
		if (!isset($this->row_renderer_classes[$table_name])) {
			$this->row_renderer_classes[$table_name] = null;
			
			$project_directory_finder = HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();
			
			$project_directory = $project_directory_finder->get_project_directory_for_this_project();
			
			$project_specific_directory = $project_directory->get_project_specific_directory();
			
			$row_renderer_class_file = null;
			
			if ($project_specific_directory->has_database_class_name_file()) {
				$database_class_name_file = $project_specific_directory->get_database_class_name_file();
				
				if ($database_class_name_file->has_row_renderer_class_file($table_name)) {
					$row_renderer_class_file = $database_class_name_file->get_row_renderer_class_file($table_name);
				}
			}
			
			# Fallback.
			if (!isset($row_renderer_class_file)) {
				$row_renderer_class_file = new FileSystem_PHPClassFile(PROJECT_ROOT . '/haddock/database/classes/renderers/Database_RowRenderer.inc.php');
			}
			
			$row_renderer_class_file->declare_class();
			
			$this->row_renderer_classes[$table_name] = new ReflectionClass($row_renderer_class_file->get_php_class_name());
		}
		
		return $this->row_renderer_classes[$table_name];
	}
	
	##################################################################
	# These methods return classes to do with fields.
	
	public function
		get_field_class(
			$table_name,
			$field_name
		)
	{
		if (isset($_SESSION['database-class-names'][$table_name]['fields'][$field_name]['class']['class_file'])) {
			require_once PROJECT_ROOT . $_SESSION['database-class-names'][$table_name]['fields'][$field_name]['class']['class_file'];
			return new ReflectionClass($_SESSION['database-class-names'][$table_name]['fields'][$field_name]['class']['class_name']);
		}
		
		if (!isset($this->field_classes[$table_name][$field_name])) {
			$this->field_classes[$table_name][$field_name] = null;
			
			$project_directory_finder = HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();
			
			$project_directory = $project_directory_finder->get_project_directory_for_this_project();
			
			$project_specific_directory = $project_directory->get_project_specific_directory();
			
			$field_class_file = null;
			
			if ($project_specific_directory->has_database_class_name_file()) {
				$database_class_name_file = $project_specific_directory->get_database_class_name_file();
				
				if ($database_class_name_file->has_field_class_file($table_name, $field_name)) {
					$field_class_file = $database_class_name_file->get_field_class_file($table_name, $field_name);
				}
			}
			
			# Fallback.
			if (!isset($field_class_file)) {
				$field_class_file = new FileSystem_PHPClassFile(PROJECT_ROOT . '/haddock/database/classes/elements/Database_Field.inc.php');
			}
			
			$field_class_file->declare_class();
			
			$this->field_classes[$table_name][$field_name] = new ReflectionClass($field_class_file->get_php_class_name());
		}
		
		return $this->field_classes[$table_name][$field_name];
	}
	
	public function get_field_renderer_class($table_name, $field_name)
	{
		if (isset($_SESSION['database-class-names'][$table_name]['fields'][$field_name]['renderer']['class_file'])) {
			require_once PROJECT_ROOT . $_SESSION['database-class-names'][$table_name]['fields'][$field_name]['renderer']['class_file'];
			return new ReflectionClass($_SESSION['database-class-names'][$table_name]['fields'][$field_name]['renderer']['class_name']);
		}
		
		if (DEBUG) {
			echo DEBUG_DELIM_OPEN;
			
			echo "Just entered: Database_DatabaseClassFactory::get_field_renderer_class(...)\n";
			echo "\$table_name: $table_name\n";
			echo "\$field_name: $field_name\n";
			
			$execution_timer = CLWDProjects_ExecutionTimer::get_instance();
			$execution_timer->mark();
			
			echo DEBUG_DELIM_CLOSE;
		}
		
		if (isset($this->field_renderer_classes[$table_name][$field_name])) {
			if (DEBUG) {
				echo DEBUG_DELIM_OPEN;
				
				echo "\$this->field_renderer_classes[$table_name][$field_name] is already set.\n";
				
				$execution_timer->mark();
				
				echo DEBUG_DELIM_CLOSE;
			}
		} else {
			$this->field_renderer_classes[$table_name][$field_name] = null;
			
			$project_directory_finder = HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();
			
			$project_directory = $project_directory_finder->get_project_directory_for_this_project();
			
			$project_specific_directory = $project_directory->get_project_specific_directory();
			
			$field_renderer_class_file = null;
			
			if ($project_specific_directory->has_database_class_name_file()) {
				$database_class_name_file = $project_specific_directory->get_database_class_name_file();
				
				if ($database_class_name_file->has_field_renderer_class_file($table_name, $field_name)) {
					$field_renderer_class_file = $database_class_name_file->get_field_renderer_class_file($table_name, $field_name);
				}
			}
			
			# Fallback.
			if (!isset($field_renderer_class_file)) {
				$field_renderer_class_file = new FileSystem_PHPClassFile(PROJECT_ROOT . '/haddock/database/classes/renderers/Database_FieldRenderer.inc.php');
			}
			
			$field_renderer_class_file->declare_class();
			
			$this->field_renderer_classes[$table_name][$field_name] = new ReflectionClass($field_renderer_class_file->get_php_class_name());
		}
		
		if (DEBUG) {
			echo DEBUG_DELIM_OPEN;
			
			echo "About to return from: Database_DatabaseClassFactory::get_field_renderer_class(...)\n";
			
			$execution_timer->mark();
			
			echo "\$this->field_renderer_classes[$table_name][$field_name]:\n";
			print_r($this->field_renderer_classes[$table_name][$field_name]);
			
			echo DEBUG_DELIM_CLOSE;
		}
		
		return $this->field_renderer_classes[$table_name][$field_name];
	}
}
?>