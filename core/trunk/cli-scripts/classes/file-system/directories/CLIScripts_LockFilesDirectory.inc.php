<?php
/**
 * CLIScripts_LockFilesDirectory
 *
 * @copyright 2008-05-08, RFI
 */

class
	CLIScripts_LockFilesDirectory
extends
	FileSystem_Directory
{
	public function
		get_lock_files()
	{
		$lock_files = array();
		
		$files = $this->get_files();
		
		#echo 'print_r($files): ' . "\n";
		#print_r($files);
		
		foreach ($files as $file) {
			if (
				CLIScripts_LockFilesHelper::is_lock_file($file)
			) {
				$lock_files[]
					= new CLIScripts_LockFile(
						$file->get_name()
					);
			}
		}
		
		#echo 'print_r($lock_files): ' . "\n";
		#print_r($lock_files);
		
		return $lock_files;
	}
	
	public function
		get_dead_lock_files()
	{
		return array_filter(
			$this->get_lock_files(),
			array(
				'CLIScripts_LockFilesHelper',
				'is_lock_file_dead'
			)
		);
	}
}
?>