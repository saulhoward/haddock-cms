<?php
/**
 * TrackitStockManagement_PhotographsHelper
 *
 * @copyright 2008-05-08, RFI
 */

class
	TrackitStockManagement_PhotographsHelper
{
	/*
	 * ----------------------------------------
	 * Functions to do with lock files.
	 * ----------------------------------------
	 */
	
	public static function
		get_add_photographs_from_cache_lock_file_name()
	{
		$cm
			= Configuration_ConfigManagerHelper
				::get_config_manager(
					'plug-ins',
					'trackit-stock-management'
				);
			
		return $cm->get_apfc_lock_file_name();
	}
	
	public static function
		get_add_photographs_from_cache_lock_file()
	{
		return new CLIScripts_LockFile(
			self
				::get_add_photographs_from_cache_lock_file_name()
		);
	}
	
	public static function
		get_process_photographs_lock_file_name()
	{
		$cm
			= Configuration_ConfigManagerHelper
				::get_config_manager(
					'plug-ins',
					'trackit-stock-management'
				);
			
		return $cm->get_process_photographs_lock_file_name();
	}
	
	public static function
		get_process_photographs_lock_file()
	{
		return new CLIScripts_LockFile(
			self
				::get_process_photographs_lock_file_name()
		);
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with processing phototgraphs.
	 * ----------------------------------------
	 */
	
	public static function
		process_photographs()
	{
		#echo __METHOD__ . "\n";
		
		$tsm_cm = Configuration_ConfigManagerHelper::get_config_manager('plug-ins', 'trackit-stock-management');
		
		/*
		 * Create the database objects.
		 */
		$muf = Database_MySQLUserFactory::get_instance();
		$mu = $muf->get_for_this_project();
		$database = $mu->get_database();
	
		$feed_files_table
			= $database->get_table('hpi_trackit_stock_management_feed_files');
			
		/*
		 * Get the list of photographs to process.
		 */
		$ps = $feed_files_table->get_photographs_to_process();
		
		$cache_dir_name = $tsm_cm->get_cache_dir_name();
		
		$resized_photos_temporary_dir_name
			= $tsm_cm->get_resized_photos_temporary_dir_name();
			
		if (!is_dir($resized_photos_temporary_dir_name)) {
			system("mkdir -p $resized_photos_temporary_dir_name");
		}
		
		/*
		 * Resize them.
		 */
		foreach ($ps as $p) {
			$cache_file_name = "$cache_dir_name/" . $p->get('name');
			#echo "\$cache_file_name: $cache_file_name\n";
			
			$sizes = $tsm_cm->get_photograph_sizes();
			
			for ($i = 0; $i < count($sizes); $i++) {
				/*
				 * Resize the image in the temporary dir.
				 */
				$sizes[$i]['tmp_file_name']
					= "$resized_photos_temporary_dir_name/"
						. $sizes[$i]['name']
						. '_'
						. $p->get('name');
	
				$cmd = 'cp "' . $cache_file_name .'" "' . $sizes[$i]['tmp_file_name'] . '"';
	
				#echo "\$cmd: $cmd\n";
				system($cmd);
	
				$cmd = 'mogrify '
					. ' -resize ' . $sizes[$i]['x'] . 'x' . $sizes[$i]['y'] . ' '
					. '"' . $sizes[$i]['tmp_file_name'] . '"';
					
				#echo "\$cmd: $cmd\n";
				system($cmd);
			}
			
			$feed_files_table->record_process(
				$p->get('name')
			);
		}
	}
	
	public static function
		reset_photograph_processing()
	{
		Database_ModifyingStatementHelper
			::apply_statement(
				new Database_SQLUpdateStatement(
<<<SQL
UPDATE
	hpi_trackit_stock_management_feed_files
SET
	processed = NULL
WHERE
	file_type != 'TXT'
	AND
	UPPER(name) REGEXP '\.(JPG|PNG|GIF)$'
SQL

			)
		);
	}
}
?>