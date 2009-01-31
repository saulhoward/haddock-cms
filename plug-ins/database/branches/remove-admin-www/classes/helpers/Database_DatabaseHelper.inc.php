<?php
/**
 * Database_DatabaseHelper
 *
 * @copyright 2008-06-12, RFI
 */

class
	Database_DatabaseHelper
{
	public static function
		get_database()
	{
		$mysql_user_factory = Database_MySQLUserFactory::get_instance();
		$mysql_user = $mysql_user_factory->get_for_this_project();
		
		return $mysql_user->get_database();
	}
	
	public static function
		get_tables()
	{
		$database = self::get_database();
		
		$tables = $database->get_tables();
		
		#print_r($tables);
		
		return $tables;
	}
	
	public static function
		table_exists($table_name)
	{
		$database = self::get_database();
		
		return $database->has_table($table_name);
	}
	
	public static function
		get_table($table_name)
	{
		$database = self::get_database();
		
		return $database->get_table($table_name);
	}
	
	public static function
		reset_database($root_dbh)
	{
		self::drop_all_tables($root_dbh);
		Database_DeltaFilesHelper::reset_delta_file_applications();
	}
	
	public static function
		drop_all_tables(
			$root_dbh
		)
	{
		foreach (
			self::get_tables()
			as
			$table
		) {
			$table_name = $table->get_name();
			
			$stmt = "DROP TABLE $table_name";
			
			mysql_query($stmt, $root_dbh);
		}
	}
}
?>