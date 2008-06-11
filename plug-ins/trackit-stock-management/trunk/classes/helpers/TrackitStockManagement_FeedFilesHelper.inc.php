<?php
/**
 * TrackitStockManagement_FeedFilesHelper
 *
 * @copyright 2008-04-24, RFI
 */

class
	TrackitStockManagement_FeedFilesHelper
{
	/*
	 * ----------------------------------------
	 * Functions to do with getting data from the tables.
	 * ----------------------------------------
	 */
	
	public static function
		get_unprocessed_text_files_counts()	
	{
		$unprocessed_text_files = 
			Database_FetchingHelper
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
SQL
					)
				);
		
		#print_r($unprocessed_text_files);
		
		$counts = array();
		
		foreach ($unprocessed_text_files as $utf) {
			if (
				preg_match(
					'/^([a-z]{3})_/',
					$utf['name'],
					$matches
				)
			) {
				$stem = $matches[1];
				
				if (isset($counts[$stem])) {
					$counts[$stem]++;
				} else {
					$counts[$stem] = 1;
				}
			}
		}
		
		return $counts;
	}
	
	
	public static function
		get_unprocessed_non_text_files_counts()	
	{
		$unprocessed_non_text_files = 
			Database_FetchingHelper
				::get_rows_for_query(
					new Database_SQLSelectQuery(
<<<SQL
SELECT
	name
FROM
	hpi_trackit_stock_management_feed_files
WHERE
	file_type != 'TXT'
	AND
	processed is NULL
SQL
					)
				);
		
		$counts = array();
		
		foreach ($unprocessed_non_text_files as $untf) {
			if (
				preg_match(
					'/\.(\w+)$/',
					$untf['name'],
					$matches
				)
			) {
				$stem = $matches[1];
				
				$stem = strtoupper($stem);
				
				if (isset($counts[$stem])) {
					$counts[$stem]++;
				} else {
					$counts[$stem] = 1;
				}
			}
		}
		
		return $counts;
	}
	
	public static function
		get_unprocessed_image_text_file_names()
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
	name LIKE 'img_%'
SQL

				)
			);
		
		$cache_directory
			= TrackitStockManagement_CacheHelper
				::get_cache_directory();
		
		$unprocessed_image_text_file_names = array();
		
		foreach ($rows as $row) {
			$unprocessed_image_text_file_names[]
				= $cache_directory->get_name() . '/' . $row['name'];
		}
		
		return $unprocessed_image_text_file_names;
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with resetting the status of feed files.
	 * ----------------------------------------
	 */
	
	private static function
		reset_text_files_processed_status($stem)
	{
		$dbh = DB::m();
		
		$stmt = <<<SQL
UPDATE
	hpi_trackit_stock_management_feed_files
SET
	processed = NULL
WHERE
	name LIKE '{$stem}_%'
SQL;

		mysql_query($stmt, $dbh);
	}
	
	public static function
		reset_text_files_downloaded_status()
	{
		$dbh = DB::m();
		
		$stmt = <<<SQL
UPDATE
	hpi_trackit_stock_management_feed_files
SET
	downloaded = NULL
WHERE
	file_type = 'TXT'
SQL;

		mysql_query($stmt, $dbh);
	}
	
	public static function
		reset_non_text_files_downloaded_status()
	{
		$dbh = DB::m();
		
		$stmt = <<<SQL
UPDATE
	hpi_trackit_stock_management_feed_files
SET
	downloaded = NULL
WHERE
	file_type != 'TXT'
SQL;

		mysql_query($stmt, $dbh);
	}
	
	public static function
		reset_product_files_processed_status()
	{
		self::reset_text_files_processed_status('prd');
	}
	
	public static function
		reset_stock_files_processed_status()
	{
		self::reset_text_files_processed_status('stk');
	}
	
	public static function
		reset_deletion_files_processed_status()
	{
		self::reset_text_files_processed_status('del');
	}
	
	public static function
		reset_image_files_processed_status()
	{
		self::reset_text_files_processed_status('img');
	}
	
	public static function
		record_file_as_processed($file_name)
	{
		$dbh = DB::m();
		
		$stmt = <<<SQL
UPDATE
	hpi_trackit_stock_management_feed_files
SET
	processed = NOW()
WHERE
	name = '$file_name'
SQL;

		#echo $stmt;
		
		mysql_query($stmt, $dbh);
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with locking the script for reading feed file names from the FTP server.
	 * ----------------------------------------
	 */
	
	public static function
		get_read_feed_file_names_script_lock_file_name()
	{
		$cm
			= Configuration_ConfigManagerHelper
				::get_config_manager(
					'plug-ins',
					'trackit-stock-management'
				);
			
		return $cm->get_rffn_lock_file_name();
	}
	
	public static function
		get_read_feed_file_names_script_lock_file()
	{
		return new CLIScripts_LockFile(
			self
				::get_read_feed_file_names_script_lock_file_name()
		);
	}
	
	public static function
		get_download_non_text_files_lock_file_name()
	{
		$cm
			= Configuration_ConfigManagerHelper
				::get_config_manager(
					'plug-ins',
					'trackit-stock-management'
				);
			
		return $cm->get_dlntf_lock_file_name();
	}
	
	public static function
		get_download_non_text_files_lock_file()
	{
		return new CLIScripts_LockFile(
			self
				::get_download_non_text_files_lock_file_name()
		);
	}
	
	public static function
		get_download_text_files_lock_file_name()
	{
		$cm
			= Configuration_ConfigManagerHelper
				::get_config_manager(
					'plug-ins',
					'trackit-stock-management'
				);
			
		return $cm->get_dltf_lock_file_name();
	}
	
	public static function
		get_download_text_files_lock_file()
	{
		return new CLIScripts_LockFile(
			self
				::get_download_text_files_lock_file_name()
		);
	}
	
	public static function
		get_process_product_text_files_lock_file_name()
	{
		$cm
			= Configuration_ConfigManagerHelper
				::get_config_manager(
					'plug-ins',
					'trackit-stock-management'
				);
			
		return $cm->get_pptf_lock_file_name();
	}
	
	public static function
		get_process_product_text_files_lock_file()
	{
		return new CLIScripts_LockFile(
			self
				::get_process_product_text_files_lock_file_name()
		);
	}
	
	public static function
		get_process_stock_text_files_lock_file_name()
	{
		$cm
			= Configuration_ConfigManagerHelper
				::get_config_manager(
					'plug-ins',
					'trackit-stock-management'
				);
			
		return $cm->get_pptf_lock_file_name();
	}
	
	public static function
		get_process_stock_text_files_lock_file()
	{
		return new CLIScripts_LockFile(
			self
				::get_process_stock_text_files_lock_file_name()
		);
	}
	
	public static function
		get_process_image_text_files_lock_file_name()
	{
		$cm
			= Configuration_ConfigManagerHelper
				::get_config_manager(
					'plug-ins',
					'trackit-stock-management'
				);
			
		return $cm->get_pitf_lock_file_name();
	}
	
	public static function
		get_process_image_text_files_lock_file()
	{
		return new CLIScripts_LockFile(
			self
				::get_process_image_text_files_lock_file_name()
		);
	}
}
?>