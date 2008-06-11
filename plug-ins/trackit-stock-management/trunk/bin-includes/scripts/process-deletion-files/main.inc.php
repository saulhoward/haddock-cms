<?php
/**
 * The main .INC for the process-deletion-files script.
 *
 * @copyright 2008-04-25, Robert Impey
 */

$process_deletion_files_script_lock_file
	= TrackitStockManagement_DeletionFilesHelper
		::get_process_deletion_files_script_lock_file();

if (
	$process_deletion_files_script_lock_file->is_locked()
) {
	throw new Exception('The process-deletion-files script is locked!');
} else {
	$process_deletion_files_script_lock_file->lock();
	
	TrackitStockManagement_DeletionFilesHelper
		::process_deletion_files();
	
	$process_deletion_files_script_lock_file->unlock();
}
?>