<?php
/**
 * Database_DatabaseClassFinder
 *
 * @copyright Clear Line Web Design, 2006-11-17
 */

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
	
	public function
		get_database_class_files()
	{
		$database_class_files = array();
		
		/*
		 * The default database class file.
		 */
		$database_class_files[] = new FileSystem_PHPClassFile(
			PROJECT_ROOT
				. '/plug-ins/database/classes/elements/'
				. 'Database_Database.inc.php'
		);
		
		$project_directory = $this->get_project_directory();
		
		$php_class_files = $project_directory->get_php_class_files();

		$database_reflection_class = new ReflectionClass('Database_Database');
		
		foreach ($php_class_files as $php_class_file) {

			$php_class_file->declare_class();
			
			$php_class_file_reflection_class
				= $php_class_file->get_reflection_class();
			
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
				. '/plug-ins/database/classes/renderers/'
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
	
	public function
		get_table_class_files()
	{
		$table_class_files = array();
		
		/*
		 * The default table class file.
		 */
		$default_table_class_file = new FileSystem_PHPClassFile(
			PROJECT_ROOT
				. '/plug-ins/database/classes/elements/'
				. 'Database_Table.inc.php'
		);
		
		$mysql_user_factory = Database_MySQLUserFactory::get_instance();
		$mysql_user = $mysql_user_factory->get_for_this_project();
		$database = $mysql_user->get_database();
		$table_names = $database->get_table_names();
		
		$project_directory = $this->get_project_directory();
		
		$php_class_files = $project_directory->get_php_class_files();

		$table_reflection_class
			= $default_table_class_file->get_reflection_class();
		
		foreach ($table_names as $table_name) {
			$table_class_files[$table_name][] = $default_table_class_file;
			
			foreach ($php_class_files as $php_class_file) {
				$php_class_file->declare_class();
				
				$php_class_file_reflection_class
					= $php_class_file->get_reflection_class();
								
				if (
					!$php_class_file_reflection_class->isAbstract()
					&&
					$php_class_file_reflection_class
					->isSubclassOf($table_reflection_class)
				) {
					$table_class_files[$table_name][] = $php_class_file;
				}
			}
		}
                
		return $table_class_files;
	}
	
	public function get_table_renderer_files()
	{
		$table_renderer_files = array();
		
		/*
		 * The default table renderer file.
		 */
		$default_table_renderer_class_file = new FileSystem_PHPClassFile(
			PROJECT_ROOT
				. '/plug-ins/database/classes/renderers/'
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
	
	public function get_row_class_files()
	{
		$row_class_files = array();
		
		/*
		 * The default row class file.
		 */
		$default_row_class_file = new FileSystem_PHPClassFile(
			PROJECT_ROOT
				. '/plug-ins/database/classes/elements/'
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
	
	public function get_field_class_files()
	{
		$field_class_files = array();
		
		/*
		 * The default field class file.
		 */
		$default_field_class_file = new FileSystem_PHPClassFile(
			PROJECT_ROOT
				. '/plug-ins/database/classes/elements/'
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