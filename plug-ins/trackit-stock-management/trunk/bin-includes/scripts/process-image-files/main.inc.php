<?php
/**
 * The main .INC for the process-image-files script.
 *
 * @copyright 2008-05-14, Robert Impey
 */


$debug = FALSE;
#$debug = TRUE;

if ($debug) {
	CodeAnalysis_MemoryHelper
		::cli_print_memory_usage('Start');
	
	$start_time = microtime(TRUE);
}

#/*
# * Create the config manager objects.
# */
#$tsm_cm
#	= Configuration_ConfigManagerHelper
#		::get_config_manager(
#			'plug-ins',
#			'trackit-stock-management'
#		);

#if ($debug) {
#	CodeAnalysis_MemoryHelper
#		::cli_print_memory_usage('Created config manager');
#}

/*
 * Find out if there is an instance of this script already running.
 */
$process_image_text_files_lock_file
	= TrackitStockManagement_FeedFilesHelper
		::get_process_image_text_files_lock_file();

if (
	$process_image_text_files_lock_file->is_locked()
) {
	throw new Exception('The process-image-files script is locked!');
} else {
	$process_image_text_files_lock_file->lock();
	
	/*
	 * Get the list of image files to process.
	 */
	$unprocessed_image_text_files = TrackitStockManagement_ImageFilesHelper
		::get_unprocessed_image_text_files();
	
	if ($debug) {
		CodeAnalysis_MemoryHelper
			::cli_print_memory_usage('Created unprocessed image files array');
	}
	
	$files_to_process_count = count($unprocessed_image_text_files);

	#$cache_dir_name = $tsm_cm->get_cache_dir_name();
	#
	#$fields = array();
	#
	#$fields[] = array(
	#	'name' => 'site_id',
	#	'chars' => 3,
	#	'quotes' => 'n'
	#);
	#
	#$fields[] = array(
	#	'name' => 'product_id',
	#	'chars' => 15,
	#	'quotes' => 'y'
	#);
	#
	#$fields[] = array(
	#	'name' => 'image_order',
	#	'chars' => 2,
	#	'quotes' => 'n'
	#);
	#
	#$fields[] = array(
	#	'name' => 'image_name',
	#	'chars' => 100,
	#	'quotes' => 'y'
	#);
	
	$processed_files_count = 0;
	
	/*
	 * Parse them.
	 */
	foreach (
		$unprocessed_image_text_files
		as
		$unprocessed_image_text_file
	) {
		#$cache_file_name = "$cache_dir_name/" . $f['name'];
		#echo "\$cache_file_name: $cache_file_name\n";
		
		#$values = array();
		#
		#if ($fh = fopen($cache_file_name, 'r')) {
		#	/*
		#	 * Parse the file.
		#	 */
		#	while (!feof($fh)) {
		#		$line = fgets($fh);
		#		#echo $line;
		#		
		#		$line = rtrim($line);
		#
		#		$values = array();
		#
		#		$offset = 0;
		#		foreach ($fields as $field) {
		#			if ($offset > 0) {
		#				$stmt .= ' , ';
		#			}
		#
		#			$k = $field['name'];
		#			
		#			if (isset($field['chars'])) {
		#				$v = substr($line, $offset, $field['chars']);
		#
		#				$offset += $field['chars'];
		#			} else {
		#				$v = substr($line, $offset);
		#			}
		#
		#			$v = trim($v);
		#
		#			if ($field['quotes'] == 'y') {
		#				$v = "'$v'";
		#			}
		#
		#			$values[$k] = $v;
		#		}
		#		
		#	}
			
			#/*
			# * Record that the file has been processed.
			# */
			#TrackitStockManagement_FeedFilesHelper
			#	::record_file_as_processed($f['name']);
			
			#fclose($fh);
		#} else {
		#	throw new Exception("Unable to open $cache_file_name!");
		#}
		
		$unprocessed_image_text_file->recorded_process();
		
		$processed_files_count++;
	}
	
	/*
	 * Remove the lock.
	 */
	$process_image_text_files_lock_file->unlock();
	
	echo date('c') . " $files_to_process_count $processed_files_count\n";
}

if ($debug) {
	$end_time = microtime(TRUE);
	
	$total_time = $end_time - $start_time;
	
	fprintf(
		STDERR,
		"Total time: %.3f sec\n",
		$total_time
	);
	
	CodeAnalysis_MemoryHelper
		::cli_print_memory_usage('Finish');
}
?>