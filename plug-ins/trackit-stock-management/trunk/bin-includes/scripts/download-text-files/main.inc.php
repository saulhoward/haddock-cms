<?php
/**
 * The main .INC for the download-text-files script.
 *
 * @copyright Clear Line Web Design, 2007-11-22
 */

/*
 * For the logs.
 */
#echo date('c');
#echo "\n";

/*
 * Create the config manager objects.
 */
$cmf = HaddockProjectOrganisation_ConfigManagerFactory::get_instance();
$tsm_cm = $cmf->get_config_manager('plug-ins', 'trackit-stock-management');

/*
 * Find out if there is an instance of this file already running.
 */
#$lock_file_name = $tsm_cm->get_dltf_lock_file_name();
#
#if (!is_file($lock_file_name)) {
#	/*
#	 * Lock the process.
#	 */
#	if ($fh = fopen($lock_file_name, 'w')) {
#		fwrite($fh, date('c') . "\n");
#		fwrite($fh, getmypid() . "\n");
#	}

$download_text_files_lock_file
	= TrackitStockManagement_FeedFilesHelper
		::get_download_text_files_lock_file();

if (
	$download_text_files_lock_file->is_locked()
) {
	throw new Exception('The download-text-files script is locked!');
} else {
	$download_text_files_lock_file->lock();
	
	#echo date('c');
	
	/*
	 * Create the database objects.
	 */
	$muf = Database_MySQLUserFactory::get_instance();
	$mu = $muf->get_for_this_project();
	$database = $mu->get_database();

	$feed_files_table
		= $database->get_table('hpi_trackit_stock_management_feed_files');

	/*
	 * Get the list of text files to download.
	 */
	$fs = $feed_files_table->get_text_files_to_download();
	
	#echo ' ' . count($fs);
	$feed_files_to_download_count = count($fs);
	
	/*
	 * Connect to the remote host
	 */

	$ftp_server_address = $tsm_cm->get_ftp_server_address();

	$ftph = ftp_connect($ftp_server_address);

	if (!$ftph) {
		throw new Exception('Couldn\'t open the FTP handle!');
	}

	$login_result = ftp_login(
		$ftph,
		$tsm_cm->get_ftp_server_user(),
		$tsm_cm->get_ftp_server_password()
	);

	$cache_dir_name = $tsm_cm->get_cache_dir_name();
	if (!is_dir($cache_dir_name)) {
		mkdir($cache_dir_name);
	}

	/*
	 * Download and save them.
	 */
	$successful_downloads_count = 0;
	foreach ($fs as $f) {
		/*
		 * Record that the file has been downloaded and its md5.
		 */
		$cache_file_name = "$cache_dir_name/" . $f->get('name');
		#echo "\$cache_file_name: $cache_file_name\n";

		if (
			ftp_get(
				$ftph,
				$cache_file_name,
				$tsm_cm->get_ftp_server_webin() . '/' . $f->get('name'),
				$is_txt ? FTP_ASCII  : FTP_BINARY
			)
		) {
			$feed_files_table->record_download(
				$f->get('name'),
				md5_file($cache_file_name)
			);
			
			$successful_downloads_count++;
		}
	}
	
	#echo ' ' . $successful_downloads_count;
	
	/*
	 * Remove the lock.
	 */
	#unlink($lock_file_name);
	$download_text_files_lock_file->unlock();
	
	echo date('c') . " $feed_files_to_download_count $successful_downloads_count\n";
}
?>