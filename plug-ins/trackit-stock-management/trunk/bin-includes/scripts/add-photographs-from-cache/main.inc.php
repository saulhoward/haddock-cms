<?php
/**
 * The main .INC for the add-photographs-from-cache script.
 *
 * @copyright Clear Line Web Design, 2007-11-24
 */

/*
 * For the logs.
 */
echo date('c') . "\n";

/*
 * Create the config manager objects.
 */
$cmf = HaddockProjectOrganisation_ConfigManagerFactory::get_instance();
$tsm_cm = $cmf->get_config_manager('plug-ins', 'trackit-stock-management');

/*
 * Find out if there is an instance of this file already running.
 */
#$lock_file_name = $tsm_cm->get_apfc_lock_file_name();
#
#if (!is_file($lock_file_name)) {
#	/*
#	 * Lock the process.
#	 */
#	if ($fh = fopen($lock_file_name, 'w')) {
#		fwrite($fh, date('c') . "\n");
#		fwrite($fh, getmypid() . "\n");
#	}

$add_photographs_from_cache_lock_file
	= TrackitStockManagement_PhotographsHelper
		::get_add_photographs_from_cache_lock_file();

if (
	!$add_photographs_from_cache_lock_file->is_locked()
) {
	$add_photographs_from_cache_lock_file->lock();

	/*
	 * Create the database objects.
	 */
	$muf = Database_MySQLUserFactory::get_instance();
	$mu = $muf->get_for_this_project();
	$database = $mu->get_database();

	$feed_files_table
		= $database->get_table('hpi_trackit_stock_management_feed_files');
	$images_table
		= $database->get_table('hc_database_images');
	$shop_photographs_table
		= $database->get_table('hpi_shop_photographs');
	$trackit_photographs_table
		= $database->get_table('hpi_trackit_stock_management_photographs');

	/*
	 * Get the list of photographs to process.
	 */
	$ps = $feed_files_table->get_photographs_to_process();

	$cache_dir_name = $tsm_cm->get_cache_dir_name();

	$resized_photos_temporary_dir_name
		= $tsm_cm->get_resized_photos_temporary_dir_name();
	if (!is_dir($resized_photos_temporary_dir_name)) {
		system("mkdir -p $resized_photos_temporary_dir_name");
	}

	/*
	 * Resize them and add them to the database.
	 */
	foreach ($ps as $p) {
		/*
		 * Record that the photo has been processed.
		 */
		$cache_file_name = "$cache_dir_name/" . $p->get('name');
		echo "\$cache_file_name: $cache_file_name\n";

		$sizes = $tsm_cm->get_photograph_sizes();

		$photograph_values = array();

		for ($i = 0; $i < count($sizes); $i++) {
			/*
			 * Resize the image in the temporary dir.
			 */
			$sizes[$i]['tmp_file_name']
				= "$resized_photos_temporary_dir_name/"
					. $sizes[$i]['name']
					. '_'
					. $p->get('name');

			$cmd = 'cp "' . $cache_file_name .'" "' . $sizes[$i]['tmp_file_name'] . '"';

			echo "\$cmd: $cmd\n";
			system($cmd);

			$cmd = 'mogrify '
				. ' -resize ' . $sizes[$i]['x'] . 'x' . $sizes[$i]['y'] . ' '
				. '"' . $sizes[$i]['tmp_file_name'] . '"';

			echo "\$cmd: $cmd\n";
			system($cmd);

			$photograph_values[$sizes[$i]['name'] . '_image_id']
				= $images_table->add_local_image_file($sizes[$i]['tmp_file_name']);

			$photograph_values['name'] = $p->get('name');
		}

        $photograph_values['added'] = 'NOW()';

		$shop_photograph_id = $shop_photographs_table->add($photograph_values);

		$values = array();

		$values['trackit_feed_file_id'] = $p->get_id();
		$values['shop_photograph_id'] = $shop_photograph_id;

		$trackit_photographs_table->add($values);

		$feed_files_table->record_process(
			$p->get('name')
		);
	}

	/*
	 * Remove the lock.
	 */
	#unlink($lock_file_name);
	$add_photographs_from_cache_lock_file->unlock();
} else {
	#echo "Script already running!\n";
	
	fprintf(
		STDERR, 
		"The process-stock-files script is locked!\n"
	);
}
?>