<?php
/**
 * TrackitStockManagement_LockFilesHelper
 *
 * @copyright 2008-04-23, RFI
 */

class
	TrackitStockManagement_LockFilesHelper
{
	public static function
		check_for_dead_lock_files()
	{
		$lock_files_directory
			= self::get_lock_files_directory();
			
		$dead_lock_files = $lock_files_directory->get_dead_lock_files();
		
		#echo 'print_r($dead_lock_files):' . "\n";
		#print_r($dead_lock_files);
		
		foreach ($dead_lock_files as $dead_lock_file) {
			self::email_admin_about_dead_lock_file($dead_lock_file);
			
			$dead_lock_file->unlock();
		}
	}
	
	public static function
		get_lock_files_directory()
	{
		$tism_cm = Configuration_ConfigManagerHelper
			::get_config_manager(
				'plug-ins',
				'trackit-stock-management'
			);
		
		$lock_files_dir_name = $tism_cm->get_lock_files_dir_name();
		
		return
			new CLIScripts_LockFilesDirectory($lock_files_dir_name);
	}
	
	#public static function
	#	delete_all_lock_files()
	#{
	#	
	#}
	
	public static function
		email_admin_about_dead_lock_file(
			CLIScripts_LockFile $dead_lock_file
		)
	{
		$dead_lock_file_removal_email
			= new TrackitStockManagement_DeadLockFileRemovalEmail(
				$dead_lock_file
			);
		
		$dead_lock_file_removal_email->send();
	}
	
	public static function
		unlock_all_lock_files()
	{
		$tsm_cm = Configuration_ConfigManagerHelper
			::get_config_manager(
				'plug-ins',
				'trackit-stock-management'
			);
		
		$lock_files_directory = $tsm_cm->get_lock_files_directory();
		
		$lock_files_directory->unlock_all_lock_files();
	}
}
?>