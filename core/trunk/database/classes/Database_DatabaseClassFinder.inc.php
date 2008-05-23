<?php
/**
 * Database_DatabaseClassFinder
 *
 * @copyright Clear Line Web Design, 2006-11-17
 */

#/*
# * Define the necessary classes.
# */
#require_once PROJECT_ROOT
#	. '/haddock/haddock-project-organisation/classes/'
#	. 'HaddockProjectOrganisation_ProjectDirectory.inc.php';
#
#require_once PROJECT_ROOT
#	. '/haddock/database/classes/'
#	. 'Database_MySQLUserFactory.inc.php';
#
#require_once PROJECT_ROOT
#	. '/haddock/database/classes/elements/'
#	. 'Database_Database.inc.php';
#
#require_once PROJECT_ROOT
#	. '/haddock/database/classes/renderers/'
#	. 'Database_DatabaseRenderer.inc.php';
#
#require_once PROJECT_ROOT
#	. '/haddock/database/classes/elements/'
#	. 'Database_Table.inc.php';
#
#require_once PROJECT_ROOT
#	. '/haddock/database/classes/renderers/'
#	. 'Database_TableRenderer.inc.php';
#
#require_once PROJECT_ROOT
#	. '/haddock/database/classes/elements/'
#	. 'Database_Row.inc.php';
#
#require_once PROJECT_ROOT
#	. '/haddock/database/classes/renderers/'
#	. 'Database_RowRenderer.inc.php';
#
#require_once PROJECT_ROOT
#	. '/haddock/database/classes/elements/'
#	. 'Database_Field.inc.php';
#
#require_once PROJECT_ROOT
#	. '/haddock/database/classes/renderers/'
#	. 'Database_FieldRenderer.inc.php';

/**
 * Searches a project directory in
 *
 * the project specific directory
 * the haddock core modules directories
 * the plug-in modules directories
 *
 * for classes that might be subclasses of
 * Database_Element.
 *
 * The suggestions are presented to the user for
 * selection on
 *
 * /admin/database/database-class-finding.html
 */
class
	Database_DatabaseClassFinder
{
	private $project_directory;
	
	public function
		__construct(
			HaddockProjectOrganisation_ProjectDirectory $project_directory
		)
	{
		$this->project_directory = $project_directory;
	}
	
	public function
		get_project_directory()
	{
		return $this->project_directory;
	}
	
	/**
	 * Lists the other core packages that are being
	 * used in this project.
	 */
	#public function list_other_core_packages()
	#{
	#    $other_core_packages = array();
	#    
	#    $files_in_clwd_core = glob(CLWD_CORE_ROOT . '/*');
	#    
	#    foreach ($files_in_clwd_core as $file_in_clwd_core) {
	#        if (is_dir($file_in_clwd_core)) {
	#            $file_in_clwd_core = basename($file_in_clwd_core);
	#            if ($file_in_clwd_core != 'database') {
	#                $other_core_packages[] = $file_in_clwd_core;
	#            }
	#        }
	#    }
	#    
	#    return $other_core_packages;
	#}
	
	/**
	 * Lists the directories where there might be
	 * subclasses of the element classes.
	 */
	#public function list_possible_subclass_directories()
	#{
	#    $directories = array();
	#    
	#    # The project specific database subclasses directory.
	#    $directories[] = PROJECT_ROOT . '/classes/database/';
	#    
	#    # Other CLWD core packages' database subclasses directories.
	#    
	#    # The database package's subclass directory.
	#    
	#    return $directories;
	#}
	
	#public function get_element_subclass_overrides()
	#{
	#    if (!isset($this->element_subclass_overrides)) {
	#        $this->element_subclass_overrides = array();
	#    
	#        $clwd_project_directory = $this->get_clwd_project_directory();
	#        
	#        # Is there a subclass name override file
	#        # in the project specific directory?
	#        $p_s_d = $clwd_project_directory->get_project_specific_directory();
	#        
	#        if ($p_s_d->has_database_class_name_override_file()) {
	#            $d_e_s_o_f = $p_s_d->get_database_class_name_override_file();
	#            $t_n_ts = $d_e_s_o_f->get_table_name_translators();
	#            
	#            foreach ($t_n_ts as $t_n_t) {
	#                $this->element_subclass_overrides[$t_n_t->get_table_name()] = $t_n_t;
	#            }
	#        }
	#        
	#        # Do any of the CLWD core modules have override
	#        # files?
	#        $c_c_m_ds = $clwd_project_directory->get_clwd_core_module_directories();
	#        
	#        foreach ($c_c_m_ds as $c_c_m_d) {
	#            if ($c_c_m_d->has_database_class_name_override_file()) {
	#                $d_e_s_o_f = $c_c_m_d->get_database_class_name_override_file();
	#                $t_n_ts = $d_e_s_o_f->get_table_name_translators();
	#                
	#                foreach ($t_n_ts as $t_n_t) {
	#                    $this->element_subclass_overrides[$t_n_t->get_table_name()] = $t_n_t;
	#                }
	#            }
	#        }
	#    }
	#    
	#    return $this->element_subclass_overrides;
	#}
	
	#public function get_table_name_translator($table_name)
	#{
	#    $element_subclass_overrides = $this->get_element_subclass_overrides();
	#    
	#    if (isset($element_subclass_overrides[$table_name])) {
	#        return $element_subclass_overrides[$table_name];
	#    } 
	#    
	#    return new Database_TableNameTranslator($table_name);
	#}
	
	#public function get_row_subclass_name($table_name)
	#{
	#    if (array_key_exists($table_name, $this->row_subclass_names)) {
	#        return $this->row_subclass_names[$table_name];
	#    } else {
	#        return self::algorithmically_translate_table_name_to_row_subclass_name($table_name);
	#    }
	#}
	
	#public function get_subclass_name_root_for_table($table_name)
	#{
	#    if (array_key_exists($table_name, $this->table_subclass_names)) {
	#        #echo "Table subclass name from array\n";
	#        return $this->table_subclass_names[$table_name];
	#    } else {
	#        #echo "Table subclass name from algorithm\n";
	#        return self::algorithmically_translate_table_name_to_table_subclass_name($table_name);
	#    }
	#}
	
	# Rename to find_*file, etc.
	
	##################################################################
	# These methods return classes to do with databases.
	
	#private function get_database_class_php_class_file()
	#{
	#    if (DEBUG) {
	#        echo DEBUG_DELIM_OPEN;
	#        
	#        echo "Just entered: Database_DatabaseClassFinder::get_database_class_php_class_file()\n";
	#        
	#        $execution_timer = CLWDProjects_ExecutionTimer::get_instance();
	#        $execution_timer->mark();
	#        
	#        echo DEBUG_DELIM_CLOSE;
	#    }
	#    
	#    $database_class_php_class_file = null;
	#    
	#    $clwd_project_directory = $this->get_clwd_project_directory();
	#    
	#    # Has the database class been extended in the
	#    # the project specific directory?
	#    $p_s_d = $clwd_project_directory->get_project_specific_directory();
	#    if ($p_s_d->has_database_subclass_php_class_file()) {
	#        $database_class_php_class_file = $p_s_d->get_database_subclass_php_class_file();
	#    }
	#    
	#    # Has the database class been extended in the
	#    # one of the CLWD core modules?
	#    if (!isset($database_class_php_class_file)) {
	#        $c_c_m_ds = $clwd_project_directory->get_clwd_core_module_directories();
	#        foreach ($c_c_m_ds as $c_c_m_d) {
	#            if ($c_c_m_d->has_database_subclass_php_class_file()) {
	#                $database_class_php_class_file = $c_c_m_d->get_database_subclass_php_class_file();
	#                break;
	#            }
	#        }
	#    }
	#    
	#    # The default database file:
	#    if (!isset($database_class_php_class_file)) {
	#        $database_class_php_class_file = new FileSystem_PHPClassFile(CLWD_CORE_ROOT . '/database/classes/elements/Database_Database.inc.php');
	#    }
	#    
	#    if (DEBUG) {
	#        echo DEBUG_DELIM_OPEN;
	#        
	#        echo "About to return from: Database_DatabaseClassFinder::get_database_class_php_class_file()\n";
	#        
	#        $execution_timer->mark();
	#        
	#        echo "\$database_class_php_class_file:\n";
	#        print_r($database_class_php_class_file);
	#        
	#        echo DEBUG_DELIM_CLOSE;
	#    }
	#    
	#    return $database_class_php_class_file;
	#}
	#
	#public function get_database_class()
	#{
	#    if (DEBUG) {
	#        echo DEBUG_DELIM_OPEN;
	#        
	#        echo "Just entered: Database_ElementSubclassFactory::get_database_class()\n";
	#        
	#        $exection_timer = CLWDProjects_ExecutionTimer::get_instance();
	#        $exection_timer->mark();
	#        
	#        echo DEBUG_DELIM_CLOSE;
	#    }
	#    
	#    $database_class_php_class_file = $this->get_database_class_php_class_file();
	#    $database_class_php_class_file->declare_class();
	#    
	#    $database_reflection_class = new ReflectionClass($database_class_php_class_file->get_php_class_name());
	#    
	#    if (DEBUG) {
	#        echo DEBUG_DELIM_OPEN;
	#        
	#        echo "About to return from: Database_ElementSubclassFactory::get_database_class()\n";
	#        
	#        $exection_timer->mark();
	#        
	#        echo "\$database_reflection_class:\n";
	#        print_r($database_reflection_class);
	#        
	#        echo DEBUG_DELIM_CLOSE;
	#    }
	#    
	#    return $database_reflection_class;
	#}
	
	public function
		get_database_class_files()
	{
		$database_class_files = array();
		
		/*
		 * The default database class file.
		 */
		$database_class_files[] = new FileSystem_PHPClassFile(
			PROJECT_ROOT
				. '/haddock/database/classes/elements/'
				. 'Database_Database.inc.php'
		);
		
		$project_directory = $this->get_project_directory();
		
		$php_class_files = $project_directory->get_php_class_files();
		
		#print_r($php_class_files);
		
		$database_reflection_class = new ReflectionClass('Database_Database');
		#print_r($database_reflection_class);
		
		#echo '$database_reflection_class->getName(): ' . "\n";
		#echo $database_reflection_class->getName() . "\n";
		#
		#echo '$database_reflection_class->isAbstract(): ' . "\n";
		#echo $database_reflection_class->isAbstract() . "\n";
		
		foreach ($php_class_files as $php_class_file) {
			#print_r($php_class_file);
			
			$php_class_file->declare_class();
			
			$php_class_file_reflection_class
				= $php_class_file->get_reflection_class();
			
			#print_r($php_class_file_reflection_class);
			
			if (
				!$php_class_file_reflection_class->isAbstract()
				&&
				$php_class_file_reflection_class
				->isSubclassOf(
					$database_reflection_class
				)
			) {
				$database_class_files[] = $php_class_file;
			}
		}
		
		#print_r($database_class_files);
		
		return $database_class_files;
	}
	
	public function
		get_database_renderer_files()
	{
		$database_renderer_class_files = array();
		
		/*
		 * The default database renderer file.
		 */
		$database_renderer_class_files[] = new FileSystem_PHPClassFile(
			PROJECT_ROOT
				. '/haddock/database/classes/renderers/'
				. 'Database_DatabaseRenderer.inc.php'
		);
		
		$project_directory = $this->get_project_directory();
		
		$php_class_files = $project_directory->get_php_class_files();
		
		$database_renderer_reflection_class
			= new ReflectionClass('Database_DatabaseRenderer');
		
		foreach ($php_class_files as $php_class_file) {
			$php_class_file->declare_class();
			
			$php_class_file_reflection_class
				= $php_class_file->get_reflection_class();
			
			if (
				!$php_class_file_reflection_class->isAbstract()
				&&
				$php_class_file_reflection_class
				->
				isSubclassOf($database_renderer_reflection_class
				)
			) {
				$database_renderer_class_files[] = $php_class_file;
			}
		}
		
		return $database_renderer_class_files;
	}
	
	##################################################################
	# These methods return classes to do with tables.
	
	#private function get_table_class_php_class_file($table_name)
	#{
	#    if (DEBUG) {
	#        echo DEBUG_DELIM_OPEN;
	#        
	#        echo "Just entered: Database_ElementSubclassFactory::get_table_class_php_class_file(...)\n";
	#        echo "\$table_name: $table_name\n";
	#        
	#        $execution_timer = CLWDProjects_ExecutionTimer::get_instance();
	#        $execution_timer->mark();
	#        
	#        echo DEBUG_DELIM_CLOSE;
	#    }
	#    
	#    $table_class_php_class_file = null;
	#    
	#    $clwd_project_directory = $this->get_clwd_project_directory();
	#    
	#    # Has the table class been extended in the
	#    # the project specific directory for this table?
	#    
	#    if (DEBUG) {
	#        echo DEBUG_DELIM_OPEN;
	#        
	#        echo "In: Database_ElementSubclassFactory::get_table_class_php_class_file(...)\n";
	#        echo "About to look for a table subclass, defined in the project specific directory.\n";
	#        $execution_timer = CLWDProjects_ExecutionTimer::get_instance();
	#        $execution_timer->mark();
	#        
	#        echo DEBUG_DELIM_CLOSE;
	#    }
	#    
	#    $p_s_d = $clwd_project_directory->get_project_specific_directory();
	#    
	#    if ($p_s_d->has_table_subclass_php_class_file($table_name)) {
	#        $table_class_php_class_file = $p_s_d->get_table_subclass_php_class_file($table_name);
	#    }
	#    
	#    # Has the table class been extended in the
	#    # one of the CLWD core modules for this table?
	#    if (!isset($table_class_php_class_file)) {
	#    $c_c_m_ds = $clwd_project_directory->get_clwd_core_module_directories();
	#        foreach ($c_c_m_ds as $c_c_m_d) {
	#            if ($c_c_m_d->has_table_subclass_php_class_file($table_name)) {
	#                $table_class_php_class_file = $c_c_m_d->get_table_subclass_php_class_file($table_name);
	#                break;
	#            }
	#        }
	#    }
	#    # The default table file:
	#    if (!isset($table_class_php_class_file)) {
	#       $table_class_php_class_file = new FileSystem_PHPClassFile(CLWD_CORE_ROOT . '/database/classes/elements/Database_Table.inc.php');
	#    }
	#    
	#    if (DEBUG) {
	#        echo DEBUG_DELIM_OPEN;
	#        
	#        echo "About to return from: Database_ElementSubclassFactory::get_table_class_php_class_file(...)\n";
	#        $execution_timer->mark();
	#        
	#        echo "\$table_class_php_class_file:\n";
	#        echo $table_class_php_class_file;
	#        echo "\n";
	#        #print_r($table_class_php_class_file);
	#        
	#        echo DEBUG_DELIM_CLOSE;
	#    }
	#    
	#    return $table_class_php_class_file;
	#}
	#
	#public function get_table_class($table_name)
	#{
	#    if (DEBUG) {
	#        echo DEBUG_DELIM_OPEN;
	#        
	#        echo "Just entered: Database_ElementSubclassFactory::get_table_class(...)\n";
	#        echo "\$table_name: $table_name\n";
	#        
	#        $exection_timer = CLWDProjects_ExecutionTimer::get_instance();
	#        $exection_timer->mark();
	#        
	#        echo DEBUG_DELIM_CLOSE;
	#    }
	#    
	#    $table_class_php_class_file = $this->get_table_class_php_class_file($table_name);
	#    $table_class_php_class_file->declare_class();
	#    
	#    $table_reflection_class = new ReflectionClass($table_class_php_class_file->get_php_class_name());
	#    
	#    if (DEBUG) {
	#        echo DEBUG_DELIM_OPEN;
	#        
	#        echo "About to return from: Database_ElementSubclassFactory::get_table_class(...)\n";
	#        $exection_timer->mark();
	#        
	#        echo "\$table_reflection_class:\n";
	#        print_r($table_reflection_class);
	#        
	#        echo DEBUG_DELIM_CLOSE;
	#    }
	#    
	#    return $table_reflection_class;
	#}
	
	public function
		get_table_class_files()
	{
		$table_class_files = array();
		
		/*
		 * The default table class file.
		 */
		$default_table_class_file = new FileSystem_PHPClassFile(
			PROJECT_ROOT
				. '/haddock/database/classes/elements/'
				. 'Database_Table.inc.php'
		);
		
		$mysql_user_factory = Database_MySQLUserFactory::get_instance();
		$mysql_user = $mysql_user_factory->get_for_this_project();
		$database = $mysql_user->get_database();
		$table_names = $database->get_table_names();
		
		$project_directory = $this->get_project_directory();
		
		$php_class_files = $project_directory->get_php_class_files();
		
		#print_r($php_class_files);
		
		#$table_reflection_class = new ReflectionClass('Database_Table');
		$table_reflection_class
			= $default_table_class_file->get_reflection_class();
		
		#print_r($table_reflection_class);
		
		foreach ($table_names as $table_name) {
			$table_class_files[$table_name][] = $default_table_class_file;
			
			foreach ($php_class_files as $php_class_file) {
				$php_class_file->declare_class();
				
				$php_class_file_reflection_class
					= $php_class_file->get_reflection_class();
								
				#echo $php_class_file_reflection_class->getName() . "<br />\n";
				#print_r($php_class_file_reflection_class);
				#
				#echo '$php_class_file_reflection_class->isAbstract(): ' . "\n";
				#echo $php_class_file_reflection_class->isAbstract() . "\n";
				#
				#echo '$php_class_file_reflection_class->isSubclassOf($table_reflection_class): ' . "\n";
				#echo $php_class_file_reflection_class->isSubclassOf($table_reflection_class) . "\n";
				
				if (
					!$php_class_file_reflection_class->isAbstract()
					&&
					$php_class_file_reflection_class
					->isSubclassOf($table_reflection_class)
				) {
					#echo 'Appending '
					#    . $php_class_file->get_php_class_name()
					#    . " to the array.\n";
					
					$table_class_files[$table_name][] = $php_class_file;
				}
			}
		}
		
		#print_r($table_class_files);
		
		return $table_class_files;
	}
	
	#private function get_table_renderer_class_php_class_file($table_name)
	#{
	#}
	#
	#public function get_table_renderer_class($table_name)
	#{
	#}
	
	public function get_table_renderer_files()
	{
		$table_renderer_files = array();
		
		/*
		 * The default table renderer file.
		 */
		$default_table_renderer_class_file = new FileSystem_PHPClassFile(
			PROJECT_ROOT
				. '/haddock/database/classes/renderers/'
				. 'Database_TableRenderer.inc.php'
		);
		
		$mysql_user_factory = Database_MySQLUserFactory::get_instance();
		$mysql_user = $mysql_user_factory->get_for_this_project();
		$database = $mysql_user->get_database();
		$table_names = $database->get_table_names();
		
		$project_directory = $this->get_project_directory();
		
		$php_class_files = $project_directory->get_php_class_files();
		
		$table_renderer_reflection_class = new ReflectionClass('Database_TableRenderer');
		
		foreach ($table_names as $table_name) {
			$table_renderer_files[$table_name][]
				= $default_table_renderer_class_file;
			
			foreach ($php_class_files as $php_class_file) {
				$php_class_file->declare_class();
				
				$php_class_file_reflection_class = $php_class_file->get_reflection_class();
				
				if (
					!$php_class_file_reflection_class->isAbstract()
					&&
					$php_class_file_reflection_class
					->isSubclassOf($table_renderer_reflection_class)
				) {
					$table_renderer_files[$table_name][] = $php_class_file;
				}
			}
		}
		
		return $table_renderer_files;
	}
	
	##################################################################
	# These methods return classes to do with rows.
	
	#private function get_row_class_php_class_file($table_name)
	#{
	#    
	#}
	#
	#public function get_row_class($table_name)
	#{
	#    
	#}
	
	public function get_row_class_files()
	{
		$row_class_files = array();
		
		/*
		 * The default row class file.
		 */
		$default_row_class_file = new FileSystem_PHPClassFile(
			PROJECT_ROOT
				. '/haddock/database/classes/elements/'
				. 'Database_Row.inc.php'
		);
		
		$mysql_user_factory = Database_MySQLUserFactory::get_instance();
		$mysql_user = $mysql_user_factory->get_for_this_project();
		$database = $mysql_user->get_database();
		$table_names = $database->get_table_names();
		
		$project_directory = $this->get_project_directory();
		
		$php_class_files = $project_directory->get_php_class_files();
		
		$row_reflection_class = new ReflectionClass('Database_Row');
		
		foreach ($table_names as $table_name) {
			$row_class_files[$table_name][] = $default_row_class_file;
			
			foreach ($php_class_files as $php_class_file) {
				$php_class_file->declare_class();
				
				$php_class_file_reflection_class
					= $php_class_file->get_reflection_class();
				
				if (
					!$php_class_file_reflection_class->isAbstract()
					&&
					$php_class_file_reflection_class
					->isSubclassOf($row_reflection_class)
				) {
					$row_class_files[$table_name][] = $php_class_file;
				}
			}
		}
		
		return $row_class_files;
	}
	
	#private function get_row_renderer_class_php_class_file($table_name)
	#{
	#    
	#}
	#
	#public function get_row_renderer_class($table_name)
	#{
	#    
	#}
	
	public function get_row_renderer_files()
	{
		$row_renderer_files = array();
		
		/*
		 * The default row renderer file.
		 */
		$default_row_renderer_class_file = new FileSystem_PHPClassFile(
			PROJECT_ROOT
				. '/haddock/database/classes/renderers/'
				. 'Database_RowRenderer.inc.php'
		);
		
		$mysql_user_factory = Database_MySQLUserFactory::get_instance();
		$mysql_user = $mysql_user_factory->get_for_this_project();
		$database = $mysql_user->get_database();
		$table_names = $database->get_table_names();
		
		$project_directory = $this->get_project_directory();
		
		$php_class_files = $project_directory->get_php_class_files();
		
		$row_renderer_reflection_class = new ReflectionClass('Database_RowRenderer');
		
		foreach ($table_names as $table_name) {
			$row_renderer_files[$table_name][]
				= $default_row_renderer_class_file;
				
			foreach ($php_class_files as $php_class_file) {
				$php_class_file->declare_class();
				
				$php_class_file_reflection_class = $php_class_file->get_reflection_class();
				
				if (
					!$php_class_file_reflection_class->isAbstract()
					&&
					$php_class_file_reflection_class
					->isSubclassOf($row_renderer_reflection_class)
				) {
					$row_renderer_files[$table_name][] = $php_class_file;
				}
			}
		}
		
		return $row_renderer_files;
	}
	
	##################################################################
	# These methods return classes to do with fields.
	
	#private function get_field_class_php_class_file($table_name, $field_name)
	#{
	#}
	#
	#public function get_field_class($table_name, $field_name)
	#{
	#}
	
	public function get_field_class_files()
	{
		$field_class_files = array();
		
		/*
		 * The default field class file.
		 */
		$default_field_class_file = new FileSystem_PHPClassFile(
			PROJECT_ROOT
				. '/haddock/database/classes/elements/'
				. 'Database_Field.inc.php'
		);
		
		$mysql_user_factory = Database_MySQLUserFactory::get_instance();
		$mysql_user = $mysql_user_factory->get_for_this_project();
		$database = $mysql_user->get_database();
		$table_names = $database->get_table_names();
		
		$project_directory = $this->get_project_directory();
		
		$php_class_files = $project_directory->get_php_class_files();
		
		$field_reflection_class = new ReflectionClass('Database_Field');
		
		foreach ($table_names as $table_name) {
			$table = $database->get_table($table_name);
			
			$fields = $table->get_fields();
			
			foreach ($fields as $field) {
				$field_class_files[$table_name][$field->get_name()][]
					= $default_field_class_file;
				
				foreach ($php_class_files as $php_class_file) {
					$php_class_file->declare_class();
					
					$php_class_file_reflection_class
						= $php_class_file->get_reflection_class();
					
					if (
						!$php_class_file_reflection_class->isAbstract()
						&&
						$php_class_file_reflection_class
						->isSubclassOf($field_reflection_class)
					) {
						$field_class_files[$table_name][$field->get_name()][] = $php_class_file;
					}
				}
			}
		}
		
		return $field_class_files;
	}
	
	#private function get_field_renderer_class_php_class_file($table_name, $field_name)
	#{
	#}
	#
	#public function get_field_renderer_class($table_name, $field_name)
	#{
	#}
	
	public function get_field_renderer_files()
	{
		$field_renderer_files = array();
		
		/*
		 * The default field renderer file.
		 */
		$default_field_renderer_class_file = new FileSystem_PHPClassFile(
			PROJECT_ROOT
				. '/haddock/database/classes/renderers/'
				. 'Database_FieldRenderer.inc.php'
		);
		
		$mysql_user_factory = Database_MySQLUserFactory::get_instance();
		$mysql_user = $mysql_user_factory->get_for_this_project();
		$database = $mysql_user->get_database();
		$table_names = $database->get_table_names();
		
		$project_directory = $this->get_project_directory();
		
		$php_class_files = $project_directory->get_php_class_files();
		
		$field_renderer_reflection_class = new ReflectionClass('Database_FieldRenderer');
		
		foreach ($table_names as $table_name) {
			$table = $database->get_table($table_name);
			
			$fields = $table->get_fields();
			
			foreach ($fields as $field) {
				$field_renderer_files[$table_name][$field->get_name()][]
					= $default_field_renderer_class_file;
					
				foreach ($php_class_files as $php_class_file) {
					$php_class_file->declare_class();
					
					$php_class_file_reflection_class
						= $php_class_file->get_reflection_class();
					
					if (
						!$php_class_file_reflection_class->isAbstract()
						&&
						$php_class_file_reflection_class
						->isSubclassOf($field_renderer_reflection_class)
					) {
						$field_renderer_files[$table_name][$field->get_name()][] = $php_class_file;
					}
				}
			}
		}
		
		return $field_renderer_files;
	}
}
?>