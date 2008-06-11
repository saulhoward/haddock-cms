<?php
/**
 * TrackitStockManagement_DeletionFilesHelper
 *
 * @copyright 2008-04-25, RFI
 */

class
	TrackitStockManagement_DeletionFilesHelper
{
	/*
	 * ----------------------------------------
	 * Functions to do with processing deletion files.
	 * ----------------------------------------
	 */
	
	#public static function
	#	process_deletion_file(
	#		TrackitStockManagement_DeletionFile $df
	#	)
	#{
	#	$products = $df->get_products();
	#	
	#	foreach ($products = $product) {
	#		$product->delete();
	#	}
	#}
	
	public static function
		process_deletion_files()
	{
		$unprocessed_deletion_files
			= self
				::get_unprocessed_deletion_files();
			
		foreach ($unprocessed_deletion_files as $udf) {
			$udf->recorded_process();
		}
	}
	
	public static function
		get_unprocessed_deletion_file_names()
	{
		$rows
			= Database_FetchingHelper
				::get_rows_for_query(
					new Database_SQLSelectQuery(
<<<SQL
SELECT
	name
FROM
	hpi_trackit_stock_management_feed_files
WHERE
	file_type = 'TXT'
	AND
	processed is NULL
	AND
	name LIKE 'del_%'
SQL

				)
			);
		
		$cache_directory
			= TrackitStockManagement_CacheHelper
				::get_cache_directory();
		
		$unprocessed_deletion_file_names = array();
		
		foreach ($rows as $row) {
			$unprocessed_deletion_file_names[]
				= $cache_directory->get_name() . '/' . $row['name'];
		}
		
		return $unprocessed_deletion_file_names;
	}
	
	public static function
		get_unprocessed_deletion_files()
	{
		$unprocessed_deletion_file_names
			= self
				::get_unprocessed_deletion_file_names();
		
		$unprocessed_deletion_files = array();
		
		foreach ($unprocessed_deletion_file_names as $udfn) {
			$unprocessed_deletion_files[]
				= new TrackitStockManagement_DeletionFile(
					$udfn
				);
		}
		
		return $unprocessed_deletion_files;
	}
	
	public static function
		reset_deletion_files()
	{
		TrackitStockManagement_FeedFilesHelper
			::reset_deletion_files_processed_status();
		
		TrackitStockManagement_ProductsHelper
			::restore_all_products();
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with locking the script for processing the deletion files.
	 * ----------------------------------------
	 */
	
	public static function
		get_process_deletion_files_script_lock_file_name()
	{
		$cm
			= Configuration_ConfigManagerHelper
				::get_config_manager(
					'plug-ins',
					'trackit-stock-management'
				);
			
		return $cm->get_pdf_lock_file_name();
	}
	
	public static function
		get_process_deletion_files_script_lock_file()
	{
		return new CLIScripts_LockFile(
			self
				::get_process_deletion_files_script_lock_file_name()
		);
	}
}
?>