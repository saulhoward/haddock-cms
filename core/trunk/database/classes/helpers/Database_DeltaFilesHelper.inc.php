<?php
/**
 * Database_DeltaFilesHelper
 *
 * @copyright 2008-06-13, RFI
 */

class
	Database_DeltaFilesHelper
{
	public static function
		create_delta_file(
			HaddockProjectOrganisation_ModuleDirectory $module_directory
		)
	{
		$delta_files_directory_name
			= self::get_delta_files_directory_name($module_directory);
		
		FileSystem_DirectoryHelper::mkdir_parents($delta_files_directory_name);
		
		$delta_file_name = $delta_files_directory_name . DIRECTORY_SEPARATOR . date('U') . '.sql';
		
		#echo '$delta_file_name: ' . $delta_file_name . PHP_EOL;
		
		if ($fh = fopen($delta_file_name, 'w')) {
			fwrite(
				$fh,
				'-- Delta file for the ' . $module_directory->get_title() . ' module' . PHP_EOL
			);
			fwrite(
				$fh,
				'-- (c) ' . date('Y-m-d') . ', ' . $module_directory->get_copyright_holder() . PHP_EOL
			);
			fwrite(
				$fh,
				PHP_EOL
			);
			
			fclose($fh);
		}
	}
	
	public static function
		get_delta_files()
	{
		$delta_files = array();
		
		foreach (
			HaddockProjectOrganisation_ModuleDirectoriesHelper
				::get_all_module_directories()
			as
			$module_directory
		) {
			foreach (
				self::get_delta_files_from_module_directory($module_directory)
				as
				$delta_file
			) {
				$delta_files[] = $delta_file;
			}
		}
		
		return $delta_files;
	}
	
	public static function
		list_delta_files()
	{
		foreach (
			self::get_delta_files()
			as
			$delta_file
		) {
			echo $delta_file->get_name() . PHP_EOL;
		}
	}
	
	public static function
		get_delta_files_from_module_directory(
			HaddockProjectOrganisation_ModuleDirectory $module_directory
		)
	{
		$delta_files = array();
		
		$delta_files_directory_name
			= self::get_delta_files_directory_name($module_directory);
		
		foreach (
			glob("$delta_files_directory_name/*.sql")
			as
			$delta_file_name
		) {
			$delta_files[] = new Database_DeltaFile($delta_file_name);
		}
		
		return $delta_files;
	}
	
	public static function
		get_delta_files_directory_name(
			HaddockProjectOrganisation_ModuleDirectory $module_directory
		)
	{
		$delta_files_directory_name
			= $module_directory->get_name()
				. DIRECTORY_SEPARATOR . 'database'
				. DIRECTORY_SEPARATOR . 'deltas';
		
		#echo '$delta_files_directory_name: ' . $delta_files_directory_name . PHP_EOL;
		
		return $delta_files_directory_name;
	}
	
	public static function
		apply_unapplied_delta_files()
	{
		foreach (
			self::get_unapplied_delta_files()
			as
			$unapplied_delta_file
		) {
			$unapplied_delta_file->apply();
		}
	}
	
	public static function
		apply_delta_file(
			Database_DeltaFile $delta_file
		)
	{
		$root_dbh
			= Database_ConnectionsHelper
				::get_root_connection_using_cli();

		mysql_query(
			$delta_file->get_contents(),
			$root_dbh
		);

		#self::record_delta_file_application($delta_file);
		$delta_file->record_application();
	}
	
	public static function
		record_delta_file_application(
			Database_DeltaFile $delta_file
		)
	{
		self
			::record_delta_file_application_with_data(
				$delta_file->get_name(),
				$delta_file->md5(),
				date('U')
			);
	}
	
	public static function
		record_delta_file_application_with_data(
			$delta_file_name,
			$delta_file_md5,
			$time_stamp
		)
	{
		$stmt = <<<SQL
INSERT
	INTO delta_file_applications
		(
			name,
			md5,
			applied
		)
	VALUES
		(
			'$delta_file_name',
			'$delta_file_md5',
			$time_stamp
		)
SQL;
		
		$delta_files_database = self::get_delta_files_database();
		
		$delta_files_database->query($stmt);
	}
	
	public static function
		get_delta_files_database()
	{
		$delta_files_database_file_name = self::get_delta_files_database_file_name();
		
		if (!is_file($delta_files_database_file_name)) {
			self::initialise_delta_files_database();
		}
		
		return new SQLiteDatabase(
			$delta_files_database_file_name
		);
	}
	
	public static function
		get_delta_files_database_file_name()
	{
		return
			self::get_delta_files_database_file_directory_name()
			. DIRECTORY_SEPARATOR . 'delta-files.db';
	}
	
	public static function
		get_delta_files_database_file_directory_name()
	{
		$instance_specific_config_directory
			= Configuration_ConfigDirectoriesHelper
				::get_instance_specific_config_directory();
				
		return
			$instance_specific_config_directory->get_name()
			. DIRECTORY_SEPARATOR . 'database';
	}
	
	public static function
		initialise_delta_files_database()
	{
		Configuration_ConfigDirectoriesHelper
			::make_sure_instance_specific_config_directory_exists();
		
		FileSystem_DirectoryHelper
			::mkdir_parents(
				self
					::get_delta_files_database_file_directory_name()
			);
		
		$delta_files_database = new SQLiteDatabase(
			self::get_delta_files_database_file_name()
		);
		
		$stmt = <<<SQL
CREATE TABLE
	delta_file_applications (
		name TEXT NOT NULL UNIQUE,
		md5 TEXT,
		applied INTEGER
	)
SQL;
		
		$delta_files_database->query($stmt);
	}
	
	public static function
		get_delta_file_applications()
	{
		$delta_files_database = self::get_delta_files_database();
		
		$query = <<<SQL
SELECT
	name,
	md5,
	applied
FROM
	delta_file_applications
SQL;

		$result = $delta_files_database->query($query);
		
		$delta_file_applications = array();
		while ($row = $result->fetch()) {
			$delta_file_application = array();
			
			foreach (
				explode(' ', 'name md5 applied')
				as
				$key
			) {
				$delta_file_application[$key] = $row[$key];
			}
			
			$delta_file_applications[] = $delta_file_application;
		}
		
		return $delta_file_applications;
	}
	
	public static function
		list_delta_file_applications()
	{
		$formatted_data = array();
		foreach (
			self::get_delta_file_applications()
			as
			$delta_file_application
		) {
			$formatted_data[]
				= array(
					'name' => $delta_file_application['name'],
					'md5' => $delta_file_application['md5'],
					'applied' => date('c', $delta_file_application['applied'])
				);
		}
		
		CLIScripts_DataRenderingHelper
			::render_array_of_assocs_in_table(
				$formatted_data,
				array(
					'md5' => 'MD5'
				)
			);
	}
	
	public static function
		list_unapplied_delta_files()
	{
		foreach (
			self::get_unapplied_delta_files()
			as
			$unapplied_delta_file
		) {
			echo $unapplied_delta_file->get_name() . PHP_EOL;
		}
	}
	
	public static function
		get_unapplied_delta_files()
	{
		$unapplied_delta_files = array();
		
		foreach (
			self::get_delta_files()
			as
			$delta_file
		) {
			if (!self::has_delta_file_been_applied($delta_file)) {
				$unapplied_delta_files[] = $delta_file;
			}
		}
		
		/*
		 * Sort the files by creation time.
		 */
		usort(
			$unapplied_delta_files,
			create_function(
				'$a, $b',
				'return $a->get_creation_time() - $b->get_creation_time();'
			)
		);
		
		return $unapplied_delta_files;
	}
	
	public static function
		has_delta_file_been_applied(
			Database_DeltaFile $delta_file
		)
	{
		$delta_files_database = self::get_delta_files_database();
		
		$delta_file_name = $delta_file->get_name();
		
		$query = <<<SQL
SELECT
	COUNT(*)
FROM
	delta_file_applications
WHERE
	name = '$delta_file_name'
SQL;

		$result = $delta_files_database->query($query);
		
		if ($row = $result->fetch()) {
			#print_r($row);
			
			return $row['COUNT(*)'] > 0;
		}
		
		return FALSE;
	}
	
	public static function
		reset_delta_file_applications()
	{
		$delta_files_database = self::get_delta_files_database();
		
		$stmt = "DELETE FROM delta_file_applications";
		
		$delta_files_database->query($stmt);
	}
	
	public static function
		get_delta_file_creation_time(
			Database_DeltaFile $delta_file
		)
	{
		return trim($delta_file->basename(), '.sql');
	}
	
	/**
	 * Is there a more efficient way of doing this?
	 *
	 * It's not pretty to generate the array and then
	 * count the elements.
	 */
	public static function
		count_unapplied_delta_files()
	{
		return count(
			self::get_unapplied_delta_files()
		);
	}
}
?>