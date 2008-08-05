<?php
/**
 * The main .INC for the process-product-files script.
 *
 * @copyright 2007-11-22, RFI
 */

/*
 * For the logs.
 */
#echo date('c') . "\n";

/*
 * Create the config manager objects.
 */
$cmf = HaddockProjectOrganisation_ConfigManagerFactory::get_instance();
$tsm_cm = $cmf->get_config_manager('plug-ins', 'trackit-stock-management');

/*
 * Find out if there is an instance of this file already running.
 */
#$lock_file_name = $tsm_cm->get_pptf_lock_file_name();
#
#if (!is_file($lock_file_name)) {
#	/*
#	 * Lock the process.
#	 */
#	if ($fh = fopen($lock_file_name, 'w')) {
#		fwrite($fh, date('c') . "\n");
#		fwrite($fh, getmypid() . "\n");
#	}

$process_product_text_files_lock_file
	= TrackitStockManagement_FeedFilesHelper
		::get_process_product_text_files_lock_file();

if (
	$process_product_text_files_lock_file->is_locked()
) {
	throw new Exception('The process-product-files script is locked!');
} else {
	$process_product_text_files_lock_file->lock();

	/*
	 * Create the database objects.
	 */
	$muf = Database_MySQLUserFactory::get_instance();
	$mu = $muf->get_for_this_project();
	$database = $mu->get_database();
	
	$dbh = $database->get_database_handle();

	$feed_files_table
		= $database->get_table('hpi_trackit_stock_management_feed_files');

	/*
	 * Get the list of product files to parse.
	 */
	$fs = $feed_files_table->get_product_text_files_to_parse();
	$product_files_to_parse_count = count($fs);
	
	$products_table
		= $database->get_table('hpi_trackit_stock_management_products');

	$cache_dir_name = $tsm_cm->get_cache_dir_name();
	
	/*
	 * Define how each line of the file is to be split up.
	 */
	
	$fields = array();

	$fields[] = array(
		'name' => 'site_id',
		'chars' => 3,
		'quotes' => 'n'
	);

	$fields[] = array(
		'name' => 'site_suffix',
		'chars' => 1,
		'quotes' => 'y'
	);

	$fields[] = array(
		'name' => 'style_id',
		'chars' => 10,
		'quotes' => 'n'
	);

	$fields[] = array(
		'name' => 'product_id',
		'chars' => 10,
		'quotes' => 'y'
	);

	$fields[] = array(
		'name' => 'supplier_code',
		'chars' => 16,
		'quotes' => 'y'
	);

	$fields[] = array(
		'name' => 'size',
		'chars' => 20,
		'quotes' => 'y'
	);

	$fields[] = array(
		'name' => 'colour',
		'chars' => 12,
		'quotes' => 'y'
	);

	$fields[] = array(
		'name' => 'unit_price',
		'chars' => 10,
		'quotes' => 'n'
	);

	$fields[] = array(
		'name' => 'tax_rate',
		'chars' => 5,
		'quotes' => 'n'
	);

	$fields[] = array(
		'name' => 'weight',
		'chars' => 6,
		'quotes' => 'n'
	);

	$fields[] = array(
		'name' => 'category_1',
		'chars' => 20,
		'quotes' => 'y'
	);

	$fields[] = array(
		'name' => 'category_2',
		'chars' => 20,
		'quotes' => 'y'
	);

	$fields[] = array(
		'name' => 'category_3',
		'chars' => 20,
		'quotes' => 'y'
	);

	$fields[] = array(
		'name' => 'new',
		'chars' => 1,
		'quotes' => 'y'
	);

	$fields[] = array(
		'name' => 'top',
		'chars' => 1,
		'quotes' => 'y'
	);

	$fields[] = array(
		'name' => 'special',
		'chars' => 1,
		'quotes' => 'y'
	);

	$fields[] = array(
		'name' => 'visible',
		'chars' => 1,
		'quotes' => 'y'
	);

	$fields[] = array(
		'name' => 'image_name',
		'chars' => 100,
		'quotes' => 'y'
	);

	$fields[] = array(
		'name' => 'description',
		'chars' => 50,
		'quotes' => 'y'
	);

	$fields[] = array(
		'name' => 'meta_description',
		'chars' => 400,
		'quotes' => 'y'
	);

	$fields[] = array(
		'name' => 'keywords',
		'chars' => 400,
		'quotes' => 'y'
	);

	$fields[] = array(
		'name' => 'meta_keywords',
		'chars' => 400,
		'quotes' => 'y'
	);

	$fields[] = array(
		'name' => 'full_description',
		'chars' => NULL,
		'quotes' => 'y'
	);

	/*
	 * Parse the files.
	 */
	$successfully_parsed_files = 0;
	
	foreach ($fs as $f) {
		$cache_file_name = "$cache_dir_name/" . $f->get('name');
		#echo "\$cache_file_name: $cache_file_name\n";

		if ($fh = fopen($cache_file_name, 'r')) {

			/*
			 * Parse the file.
			 */
			while (!feof($fh)) {
				$line = fgets($fh);
				#echo $line;

				$line = rtrim($line);

				$values = array();

				$offset = 0;
				foreach ($fields as $field) {
					$name = $field['name'];
					
					if (isset($field['chars'])) {
						$value = substr($line, $offset, $field['chars']);
						$offset += $field['chars'];
					} else {
						$value = substr($line, $offset);
					}
					
					$value = trim($value);
					
					if ($field['quotes'] == 'y') {
						$value = "'$value'";
					}
					
					$values[$name] = $value;
				}
				
//                                print_r($values);
//                                exit;
				
				if (isset($values['product_id'])) {
					/*
					 * Does this file already exist in the database?
					 */
					$query = 'SELECT id FROM hpi_trackit_stock_management_products WHERE ';
					
					$query .= ' product_id = ' . $values['product_id'];

					// changed product_id to already include quotes
//                                        $query .= ' product_id = \'' . $values['product_id'] . '\'';

//                                        echo $query; exit;
					
					$result = mysql_query($query, $dbh);
					
					$update = mysql_num_rows($result) > 0;
					
					#if ($update) {
					#	echo "Already a product\n";
					#} else {
					#	echo "New product\n";
					#}
					#exit;
					
					if ($update) {
						$stmt = "UPDATE ";
					} else {
						$stmt = "INSERT INTO ";
					}
					
					$stmt .= ' hpi_trackit_stock_management_products SET ';
					
					$first = TRUE;
					foreach (array_keys($values) as $key) {
						if ($first) {
							$first = FALSE;
						} else {
							$stmt .= ' , ';
						}
						
						$stmt .= $key;
						
						$stmt .= ' = ';
						
						$stmt .= $values[$key];
					}
					
					if ($update) {
						$stmt .= ', synched_with_shop = \'No\' ';
						
						$stmt .= ' WHERE ';
						
						$row = mysql_fetch_array($result);
						
						$id = $row['id'];
						
						$stmt .= " id = $id ";
					}
					
					echo "\$stmt\n$stmt\n";
//                                        exit;
					
					mysql_query($stmt, $dbh);
					#$products_table->add($values);
				}
				
				#exit;
			}
			
			#exit;
			
			/*
			 * Record that the file has been parsed.
			 */
			$feed_files_table->record_process(
				$f->get('name')
			);

			fclose($fh);
		}
		
		$successfully_parsed_files++;
	}

	/*
	 * Remove the lock.
	 */
	#unlink($lock_file_name);
	$process_product_text_files_lock_file->unlock();
	
	echo date('c') . " $product_files_to_parse_count $successfully_parsed_files\n";
}
?>
