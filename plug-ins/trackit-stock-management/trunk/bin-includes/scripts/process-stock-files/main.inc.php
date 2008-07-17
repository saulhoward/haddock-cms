<?php
/**
 * The main .INC for the process-stock-files script.
 *
 * @copyright 2007-11-26, RFI
 */

$debug = FALSE;
#$debug = TRUE;

if ($debug) {
	CodeAnalysis_MemoryHelper
		::cli_print_memory_usage('Start');
	
	$start_time = microtime(TRUE);
}

/*
 * Create the config manager objects.
 */
$tsm_cm
	= Configuration_ConfigManagerHelper
		::get_config_manager(
			'plug-ins',
			'trackit-stock-management'
		);

if ($debug) {
	CodeAnalysis_MemoryHelper
		::cli_print_memory_usage('Created config manager');
}

/*
 * Find out if there is an instance of this file already running.
 */
$process_stock_text_files_lock_file
	= TrackitStockManagement_FeedFilesHelper
		::get_process_stock_text_files_lock_file();

if (
	$process_stock_text_files_lock_file->is_locked()
) {
	throw new Exception('The process-stock-files script is locked!');
} else {
	$process_stock_text_files_lock_file->lock();
	
	/*
	 * Create the database objects.
	 */
	$muf = Database_MySQLUserFactory::get_instance();
	$mu = $muf->get_for_this_project();
	$database = $mu->get_database();
	
	if ($debug) {
		CodeAnalysis_MemoryHelper
			::cli_print_memory_usage('Created database objects');
	}
	
	$dbh = $database->get_database_handle();
	
	$feed_files_table
		= $database->get_table('hpi_trackit_stock_management_feed_files');
		
	if ($debug) {
		CodeAnalysis_MemoryHelper
			::cli_print_memory_usage('Created db table objects');
	}
	
	/*
	 * Get the list of stock files to process.
	 */
	$fs = $feed_files_table->get_stock_text_files_to_process();
	
	if ($debug) {
		CodeAnalysis_MemoryHelper
			::cli_print_memory_usage('Created db row objects');
	}
	
	$files_to_process_count = count($fs);
	
	$products_table
		= $database->get_table('hpi_trackit_stock_management_products');

	$cache_dir_name = $tsm_cm->get_cache_dir_name();

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
		'chars' => 15,
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
		'name' => 'quantity',
		'chars' => 8,
		'quotes' => 'n'
	);
	
	#$update_count = 0;
	$processed_files_count = 0;
	
	/*
	 * Parse them.
	 */
	foreach ($fs as $f) {
		$cache_file_name = "$cache_dir_name/" . $f->get('name');
		#echo "\$cache_file_name: $cache_file_name\n";
		
		$values = array();
		
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
					if ($offset > 0) {
						$stmt .= ' , ';
					}

					$k = $field['name'];
					
					if (isset($field['chars'])) {
						$v = substr($line, $offset, $field['chars']);

						$offset += $field['chars'];
					} else {
						$v = substr($line, $offset);
					}

					$v = trim($v);

					if ($field['quotes'] == 'y') {
						$v = "'$v'";
					}

					$values[$k] = $v;
				}
				
				/*
				 * Check if there is already a row in the table that
				 * matches this line.
				 */
				$where_clause = ' WHERE ';
				$where_clause .= ' product_id = ' . $values['product_id'] . ' AND ';
				$where_clause .= ' size = ' . $values['size'] . ' AND ';
				$where_clause .= ' colour = ' . $values['colour'] . ' ';
				
				$query = "SELECT id, quantity FROM hpi_trackit_stock_management_stock_levels $where_clause";
				
				#echo "\$query: $query\n";exit;
				
				$result = mysql_query($query, $dbh);
				
				if (mysql_numrows($result) > 0) {
					$row = mysql_fetch_array($result);
					$id = $row['id'];
					$quantity = $row['quantity'];
					
					if ($quantity != $values['quantity']) {
						$stmt = 'UPDATE hpi_trackit_stock_management_stock_levels ';
						
						$stmt .= ' SET quantity = ' . $values['quantity'];
						
						$stmt .= " WHERE id = $id";
						
						$update_count++;
						
						#echo "\$stmt\n$stmt\n";
					}
				} else {
					#print_r($values); exit;
					
					$stmt = 'INSERT INTO hpi_trackit_stock_management_stock_levels SET ';
					
					$first = TRUE;
					foreach (array_keys($values) as $key) {
						if ($first) {
							$first = FALSE;
						} else {
							$stmt .= ' , ';
						}
						
						$stmt .= " $key = ";
						
						$stmt .= ' ' . $values[$key] . ' ';
					}
				}
				
//                                echo "\$stmt\n$stmt\n";
//                                exit;
				mysql_query($stmt, $dbh);
			}

			/*
			 * Record that the file has been parsed.
			 */
			$feed_files_table->record_process(
				$f->get('name')
			);

			fclose($fh);
		} else {
			throw new Exception("Unable to open $cache_file_name!");
		}
		
		$processed_files_count++;
	}
	
	#echo "Update count: $update_count\n";
	
	/*
	 * Remove the lock.
	 */
	#unlink($lock_file_name);
	$process_stock_text_files_lock_file->unlock();
	
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
