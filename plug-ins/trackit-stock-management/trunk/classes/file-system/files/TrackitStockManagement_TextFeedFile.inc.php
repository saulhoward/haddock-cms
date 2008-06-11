<?php
/**
 * TrackitStockManagement_TextFeedFile
 *
 * @copyright 2008-04-25, RFI
 */

abstract class
	TrackitStockManagement_TextFeedFile
extends
	FileSystem_TextFile
{
	abstract public function
		process();
	
	public function
		recorded_process()
	{
		$this->process();
		
		$this->record_as_processed();
	}
	
	public function
		record_as_processed()
	{
		TrackitStockManagement_FeedFilesHelper
			::record_file_as_processed(
				$this->basename()
			);
	}
}
?>