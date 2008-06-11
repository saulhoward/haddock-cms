<?php
/**
 * The main .INC for the process-photographs script.
 *
 * @copyright 2008-05-15, Robert Impey
 */

$process_photographs_lock_file
	= TrackitStockManagement_PhotographsHelper
		::get_process_photographs_lock_file();

if (
	$process_photographs_lock_file->is_locked()
) {
	throw new CLIScripts_ScriptLockedException('process-photographs');
} else {
	$process_photographs_lock_file->lock();
	#exit;
	TrackitStockManagement_PhotographsHelper
		::process_photographs();
	
	$process_photographs_lock_file->unlock();
}
?>