<?php
/**
 * CLIScripts_LockFilesHelper
 *
 * @copyright 2008-05-08, RFI
 */

class
	CLIScripts_LockFilesHelper
{
	public static function
		is_lock_file_dead(
			CLIScripts_LockFile $lock_file
		)
	{
		return !$lock_file->is_alive();
	}
	
	public static function
		is_lock_file(FileSystem_File $file)
	{
		$file_name = $file->get_name();
		
		#echo "\$file_name: '$file_name'\n";
		
		return preg_match(
			'/\.txt$/',
			$file_name
		);
	}
}
?>