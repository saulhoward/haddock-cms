<?php
/**
 * Database_DeltaFile
 *
 * @copyright 2008-06-13, Robert Impey
 */

class
	Database_DeltaFile
extends
	Database_SQLFile
{
	public function
		apply()
	{
		Database_DeltaFilesHelper::apply_delta_file($this);
	}
	
	public function
		record_application()
	{
		Database_DeltaFilesHelper
			::record_delta_file_application($this);
	}
	
	public function
		has_been_applied()
	{
		return Database_DeltaFilesHelper
			::has_delta_file_been_applied($this);
	}
	
	public function
		get_creation_time()
	{
		return Database_DeltaFilesHelper
			::get_delta_file_creation_time($this);
	}
}
?>