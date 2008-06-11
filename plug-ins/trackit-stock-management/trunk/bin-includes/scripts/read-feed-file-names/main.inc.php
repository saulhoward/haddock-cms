<?php
/**
 * The main .INC for the read-feed-files script.
 *
 * @copyright 2007-11-21, RFI
 */

/*
 * For the logs.
 */
#echo date('c');
#echo "\n";

#exit;

/*
 * Create the singleton variables.
 */
$cmf = HaddockProjectOrganisation_ConfigManagerFactory::get_instance();
#exit;
$muf = Database_MySQLUserFactory::get_instance();

#exit;

/*
 * Create the config managers.
 */
$tsm_cm = $cmf->get_config_manager('plug-ins', 'trackit-stock-management');

#/*
# * Create a lock file to prevent any more copies of this script running.
# */
#$lock_file_name = $tsm_cm->get_rffn_lock_file_name();
#
#if (!is_file($lock_file_name)) {
#	if ($fh = fopen($lock_file_name, 'w')) {
#		fwrite($fh, date('c') . "\n");
#	} else {
#		throw new Exception("Unable to open the lock file: $lock_file_name!");
#	}

$read_feed_file_names_script_lock_file
	= TrackitStockManagement_FeedFilesHelper
		::get_read_feed_file_names_script_lock_file();

if (
	$read_feed_file_names_script_lock_file->is_locked()
) {
	throw new Exception('The read-feed-file-names script is locked!');
} else {
	$read_feed_file_names_script_lock_file->lock();
	
	/*
	 * Create the database objects.
	 */
	$mu = $muf->get_for_this_project();
	$database = $mu->get_database();

	$feed_files_table
		= $database->get_table('hpi_trackit_stock_management_feed_files');

	/*
	 * Connect to the remote host and get a list of the files.
	 */

	$ftp_server_address = $tsm_cm->get_ftp_server_address();

	#echo "\$ftp_server_address: $ftp_server_address\n";

	$ftph = ftp_connect($ftp_server_address);

	if (!$ftph) {
		throw new Exception('Couldn\'t open the FTP handle!');
	}

	$login_result = ftp_login(
		$ftph,
		$tsm_cm->get_ftp_server_user(),
		$tsm_cm->get_ftp_server_password()
	);
	
	if ($login_result) {
		#echo " logged_in";
		#echo "\n";
		

		#$lsa = ftp_rawlist($ftph, '/webin/');
		#$ftp_file_names = ftp_nlist($ftph, '/webin/');
		$ftp_file_names = ftp_nlist($ftph, $tsm_cm->get_ftp_server_webin());
		
		#echo ' ' . count($ftp_file_names);
		#echo " files found on the remote host.\n";
		$remote_files_count = count($ftp_file_names);
		
		#echo "\$ftp_file_names:\n";
		#print_r($ftp_file_names);
		
		/*
		 * Close the remote host handle.
		 */
		ftp_close($ftph);
	
		/*
		 * Get a list of the files in the DB
		 */
		$db_file_names = $feed_files_table->get_file_names();
	
		#echo ' ' . count($db_file_names);
		#echo " files listed locally.\n";
		
		$db_files_count = count($db_file_names);
		
		#echo "\$db_file_names:\n";
		#print_r($db_file_names);
		
		/*
		 * Get the complement of $db_file_names in $ftp_file_names.
		 */
		$db_comp = array();
	
		foreach ($ftp_file_names as $ffn) {
			if (!in_array($ffn, $db_file_names)) {
				$db_comp[] = $ffn;
			}
		}
		
		#echo "The complement of the remote file list in the the DB file list:\n";
		#echo ' ' . count($db_comp);
		$complement_count = count($db_comp);
		
		#echo " elements.\n";
		#print_r($db_comp);
	
		/*
		 * Add the names of the new files to the database.
		 */	
		foreach ($db_comp as $new_file_name) {
			#echo "Adding $new_file_name\n";
			
			$feed_files_table->add_new_feed_file(
				$new_file_name
			);
		}
	} else {
		#echo "Unable to log in!\n";
		#echo " log_in_failure";
		#echo "\n";
		
		throw Exception('Unable to log in!');
	}

	/*
	 * Unlock the script.
	 */
	#unlink($lock_file_name);
	$read_feed_file_names_script_lock_file->unlock();
	
	echo date('c') . " $remote_files_count $db_files_count $complement_count\n";
}

?>