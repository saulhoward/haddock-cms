<?php
/**
 * Database_TableSpecificationHelper
 *
 * @copyright 2008-06-12, RFI
 */

class
	Database_TableSpecificationHelper
{
	#private static function
	#	get_table_specification_files()
	#{
	#	$table_specification_files = array();
	#	
	#	$module_directories
	#		= HaddockProjectOrganisation_ModuleDirectoriesHelper
	#			::get_all_module_directories();
	#	
	#	foreach ($module_directories as $module_directory) {
	#		
	#	}
	#	
	#	return $table_specification_files;
	#}
	
	public static function
		get_tables()
	{
		$tables = array();
		
		#$table_specification_files = self::get_table_specification_files();
		#
		#foreach ($table_specification_files as $table_specification_file) {
		#	$tables[]
		#		= self
		#			::get_specified_table_from_table_specification_file(
		#				$table_specification_file
		#			);
		#}
		
		foreach (
			HaddockProjectOrganisation_ModuleDirectoriesHelper::get_all_module_directories()
			as
			$module_directory
		) {
			foreach (
				glob(
					$module_directory->get_name()
					. DIRECTORY_SEPARATOR . 'database'
					. DIRECTORY_SEPARATOR . 'table-specification'
					. DIRECTORY_SEPARATOR . '*'
				)
				as
				$table_specification_directory_name
			) {
				#echo '$table_specification_directory_name: ' . $table_specification_directory_name . PHP_EOL;
				
				/*
				 * What's the table's name?
				 */
				$table_name
					= $module_directory->get_database_table_name_root()
						. basename($table_specification_directory_name);
					
				#echo '$table_name: ' . $table_name . PHP_EOL;
				
				$specified_table = new Database_SpecifiedTable($table_name);
				
				/*
				 * Find the fields.
				 */
				foreach (
					glob(
						$table_specification_directory_name . DIRECTORY_SEPARATOR . '*.type'
					)
					as
					$type_file
				) {
					#echo '$type_file: ' . $type_file . PHP_EOL;
					
					$field_name = basename($type_file);
				
					$field_name = preg_replace('/\.type$/', '', $field_name);
					
					$specified_table->add_field_type(
						$field_name,
						trim(
							file_get_contents(
								$type_file
							)
						)
					);
				}
				
				/*
				 * Find the keys.
				 */
				foreach (
					glob(
						$table_specification_directory_name . DIRECTORY_SEPARATOR . '*.index'
					)
					as
					$index_file
				) {
					#echo '$index_file: ' . $index_file . PHP_EOL;
					
					$index_name = preg_replace('/\.index$/', '', basename($index_file));
					
					#echo '$index_name: ' . $index_name . PHP_EOL;
					
					#echo 'file_get_contents($index_file): ' . file_get_contents($index_file) . PHP_EOL;
					
					$lines = array();
					if ($fh = fopen($index_file, 'r')) {
						while (!feof($fh)) {
							$lines[] = fgets($fh, 4096);
						}
						
						fclose($fh);
					}
					
					$index_file_vars = array();
					foreach (
						$lines
						as
						$line
					) {
						if (
							preg_match('/(\w+): (\w+)/', $line, $matches)
						) {
							$index_file_vars[$matches[1]] = $matches[2];
						}
					}
					
					if (
						isset($index_file_vars['Non_unique'])
						&&
						isset($index_file_vars['Column_name'])
					) {
						$specified_table->add_index(
							$index_name,
							$index_file_vars['Column_name'],
							$index_file_vars['Non_unique']
						);
					}
					
					#$specified_table->add_field_type(
					#	$field_name,
					#	trim(
					#		file_get_contents(
					#			$type_file
					#		)
					#	)
					#);
				}
				
				$tables[] = $specified_table;
			}
		}
		
		return $tables;
	}
	
	#public static function
	#	get_specified_table_from_table_specification_file(
	#		Database_TableSpecificationFile $table_specification_file
	#	)
	#{
	#	$specified_table = new Database_SpecifiedTable();
	#	
	#	$specified_table
	#		->set_name($table_specification_file->get_table_name());
	#	
	#	#foreach ($table_specification_file->get_fields)
	#	
	#	return $specified_table;
	#}
	
	public static function
		table_exists($table_name)
	{
		return
			is_dir(
				self
					::get_table_specification_directory_name($table_name)
			);
	}
	
	private static function
		get_table_specification_directory_name($table_name)
	{
		foreach (
			HaddockProjectOrganisation_ModuleDirectoriesHelper
				::get_all_module_directories()
			as
			$module_directory
		) {
			if (
				preg_match(
					'/' . $module_directory->get_database_table_name_root() . '(\w+)/',
					$table_name,
					$matches
				)
			) {
				return
					$module_directory->get_name()
					. DIRECTORY_SEPARATOR . 'database'
					. DIRECTORY_SEPARATOR . 'table-specification'
					#. DIRECTORY_SEPARATOR . str_replace('_', '-', $matches[1]);
					. DIRECTORY_SEPARATOR . $matches[1];
			}
		}
		
		throw new ErrorHandling_SprintfException(
			'Unable to parse \'%s\'!',
			array(
				$table_name
			)
		);
	}
	
	public static function
		get_table($table_name)
	{
		if (
			self::table_exists($table_name)
		) {
			$table_specification_directory_name
				= self
					::get_table_specification_directory_name($table_name);
			
			$table = new Database_SpecifiedTable($table_name);
			
			foreach (
				glob($table_specification_directory_name . DIRECTORY_SEPARATOR . '*.type')
				as
				$field_file_name
			) {
				$field_name = basename($field_file_name);
				
				$field_name = preg_replace('/\.type$/', '', $field_name);
				
				$table->add_field_type(
					$field_name,
					trim(
						file_get_contents(
							$field_file_name
						)
					)
				);
			}
			
			return $table;
		} else {
			throw new ErrorHandling_SprintfException(
				'No table specification for \'%s\'!',
				array(
					$table_name
				)
			);
		}
	}
	
	/**
	 * This function makes the table specification
	 * like the database.
	 */
	public static function
		sync_database_with_table_specification()
	{
		$debug = FALSE;
		#$debug = TRUE;
		
		foreach (
			Database_DatabaseHelper
				::get_tables()
			as
			$db_table
		) {
			$table_specification_directory_name
				= self
					::get_table_specification_directory_name($db_table->get_name());
			if ($debug) {
				echo '$table_specification_directory_name: ' . $table_specification_directory_name . PHP_EOL;
			}
			
			self
				::save_table_structure_in_directory(
					$table_name,
					$table_specification_directory_name
				);
		}
	}
	
	public static function
		save_table_structure_in_directory(
			Database_Table $table,
			$table_specification_directory_name
		)
	{
		$debug = FALSE;
		#$debug = TRUE;
		
		$table_name = $table->get_name();
		if ($debug) {
			echo '$table_name: ' . $table_name . PHP_EOL;
		}
		
		/*
		 * Make sure that the dir exists.
		 */
		if (!is_dir($table_specification_directory_name)) {
			FileSystem_DirectoryHelper
				::mkdir_parents(
					$table_specification_directory_name
				);
		}
		
		foreach (
			$db_table->get_fields()
			as
			$db_field
		) {
			$db_field_name = $db_field->get_name();
			if ($debug) {
				echo '$db_field_name: ' . $db_field_name . PHP_EOL;
			}
			
			/*
			 * Save the type.
			 */
			$db_field_type = $db_field->get_type();
			if ($debug) {
				echo '$db_field_type: ' . $db_field_type . PHP_EOL;
			}
			
			$db_field_type_file_name
				= $table_specification_directory_name
					. DIRECTORY_SEPARATOR . $db_field_name . '.type';
			if ($debug) {
				echo '$db_field_type_file_name: ' . $db_field_type_file_name . PHP_EOL;
			}
			
			if (!$debug) {
				if ($fh = fopen($db_field_type_file_name, 'w')) {
					fwrite($fh, $db_field_type . PHP_EOL);
					
					fclose($fh);
				}
			}
			
			/*
			 * Save whether this field can be null or not
			 */
			$db_field_can_be_null = $db_field->can_be_null();
			if ($debug) {
				echo '$db_field_can_be_null: ' . ($db_field_can_be_null ? 'YES' : 'NO') . PHP_EOL;
			}
			
			$db_field_can_be_null_file_name
				= $table_specification_directory_name
					. DIRECTORY_SEPARATOR . $db_field_name . '.can-be-null';
			if ($debug) {
				echo '$db_field_can_be_null_file_name: ' . $db_field_can_be_null_file_name . PHP_EOL;
			}
			
			if (!$debug) {
				if ($fh = fopen($db_field_can_be_null_file_name, 'w')) {
					fwrite(
						$fh,
						($db_field_can_be_null ? 'YES' : 'NO') . PHP_EOL
					);
					
					fclose($fh);
				}
			}
			
			/*
			 * Save the key
			 */
			$db_field_key = $db_field->get_key();
			
			if (strlen($db_field_key) > 0) {
				if ($debug) {
					echo '$db_field_key: ' . $db_field_key . PHP_EOL;
				}
				
				$db_field_key_file_name
					= $table_specification_directory_name
						. DIRECTORY_SEPARATOR . $db_field_name . '.key';
				if ($debug) {
					echo '$db_field_key_file_name: ' . $db_field_key_file_name . PHP_EOL;
				}
				
				if (!$debug) {
					if ($fh = fopen($db_field_key_file_name, 'w')) {
						fwrite(
							$fh,
							$db_field_key . PHP_EOL
						);
						
						fclose($fh);
					}
				}
			}
			
			/*
			 * Save the default
			 */
			$db_field_default = $db_field->get_default();
			
			if (strlen($db_field_default) > 0) {
				if ($debug) {
					echo '$db_field_default: ' . $db_field_default . PHP_EOL;
				}
				
				$db_field_default_file_name
					= $table_specification_directory_name
						. DIRECTORY_SEPARATOR . $db_field_name . '.default';
				if ($debug) {
					echo '$db_field_default_file_name: ' . $db_field_default_file_name . PHP_EOL;
				}
				
				if (!$debug) {
					if ($fh = fopen($db_field_default_file_name, 'w')) {
						fwrite(
							$fh,
							$db_field_default . PHP_EOL
						);
						
						fclose($fh);
					}
				}
			}
			
			/*
			 * Save any extra info.
			 */
			$db_field_extra = $db_field->get_extra();
			
			if (strlen($db_field_extra) > 0) {
				if ($debug) {
					echo '$db_field_extra: ' . $db_field_extra . PHP_EOL;
				}
				
				$db_field_extra_file_name
					= $table_specification_directory_name
						. DIRECTORY_SEPARATOR . $db_field_name . '.extra';
				if ($debug) {
					echo '$db_field_extra_file_name: ' . $db_field_extra_file_name . PHP_EOL;
				}
				
				if (!$debug) {
					if ($fh = fopen($db_field_extra_file_name, 'w')) {
						fwrite(
							$fh,
							$db_field_extra . PHP_EOL
						);
						
						fclose($fh);
					}
				}
			}
		}
		
		#/*
		# * Save the indexes.
		# */
		#
		#$dbh = DB::m();
		#
		#$query = "SHOW INDEX FROM $table_name";
		#
		#$result = mysql_query($query, $dbh);
		#
		#while ($row = mysql_fetch_assoc($result)) {
		#	print_r($row);
		#	
		#	$index_file_name
		#		= $table_specification_directory_name
		#			. DIRECTORY_SEPARATOR . $row['Key_name'] . '.index';
		#	echo '$index_file_name: ' . $index_file_name . PHP_EOL;
		#	
		#	if ($fh = fopen($index_file_name, 'w')) {
		#		foreach (
		#			explode(' ', 'Non_unique Column_name')
		#			as
		#			$key
		#		) {
		#			fwrite(
		#				$fh,
		#				$key . ': ' . $row[$key] . PHP_EOL
		#			);
		#		}
		#		
		#		fclose($fh);
		#	}
		#}
	}
	
	/**
	 * This function makes the database
	 * like the table specification.
	 */
	public static function
		sync_table_specification_with_database(
			$root_password
		)
	{
		$specified_tables = self::get_tables();
		
		#print_r($specified_tables);
		
		foreach (
			$specified_tables
			as
			$specified_table
		) {
			#$table_name = $specified_table->get_name();
			
			#echo '$table_name: ' . $table_name . PHP_EOL;
			
			/*
			 * Does the table exist?
			 *
			 * If not, create it.
			 */
			$dbh
				= Database_ConnectionsHelper
					::get_root_connection($root_password);

			#$query = "SHOW TABLES LIKE $table_name";
			#
			#$result = mysql_query($query, $dbh);
			#
			#if (mysql_num_rows($result) == 0) {
			#	$stmt = 
			#}
			
			#$stmt = "CREATE TABLE IF NOT EXISTS $table_name";
			$create_statement = $specified_table->get_create_statement();
			
			echo '$create_statement: ' . $create_statement . PHP_EOL;

			#mysql_query($stmt, $dbh);
		}
	}
}
?>