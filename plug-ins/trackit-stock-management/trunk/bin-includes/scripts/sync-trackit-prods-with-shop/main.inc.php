<?php
/**
 * The main .INC for the sync-trackit-prods-with-shop script.
 *
 * @copyright Clear Line Web Design, 2007-11-26
 */

/*
 * For the logs.
 */
echo date('c') . "\n";

$debug = TRUE;
$debug = FALSE;

/*
 * Create the config manager objects.
 */
$cmf = HaddockProjectOrganisation_ConfigManagerFactory::get_instance();
$tsm_cm = $cmf->get_config_manager('plug-ins', 'trackit-stock-management');

/*
 * Create the database objects.
 */
$muf = Database_MySQLUserFactory::get_instance();
$mu = $muf->get_for_this_project();
$database = $mu->get_database();
$dbh = $database->get_database_handle();

/*
 * Get the list of product files to copy.
 */
$query = <<<SQL
SELECT
	*
FROM
	hpi_trackit_stock_management_products
WHERE
	synched_with_shop = 'No'
SQL;

$result = mysql_query($query, $dbh);

$trackit_products = array();
while ($row = mysql_fetch_array($result)) {
	#print_r($row);
	
	$p = array();
	
	foreach (array_keys($row) as $key) {
		$p[$key] = $row[$key];
	}
	
	$trackit_products[] = $p;
}

#print_r($trackit_products);
#echo "\n";
#echo count($trackit_products) . " products to synch.\n";
#exit;

foreach ($trackit_products as $trackit_product) {
	$trackit_product_id = $trackit_product['id'];
	
	/*
	 * Is there already a row in the products table in the shop
	 * module that corresponds to this row in the trackit module?
	 */
	$shop_product_id = $trackit_product['shop_product_id'];
	
	if (strlen($shop_product_id)) {
		#echo "Updating product $shop_product_id.\n";
		
		$stmt = 'UPDATE ';
	} else {
		#echo "Adding a new product\n";
		
		$stmt = 'INSERT INTO ';		
	}
	
	$stmt .= ' hpi_shop_products SET ';
	
	if (strlen($shop_product_id) == 0) {
		$stmt .= ' added = NOW(), ';
	}
	
	$stmt .= ' name = \'' . $trackit_product['description'] . '\'';
	$stmt .= ' , plu_code = \'' . $trackit_product['product_id'] . '\'';
	$stmt .= ' , style_id = \'' . $trackit_product['style_id'] . '\'';
	
	if (strlen($trackit_product['meta_description'])) {
		$stmt .= ' , description = \'' . $trackit_product['full_description'] . '\'';
	}
	
	$stmt .= ' , supplier_id = 1 ';
	
	if (strlen($shop_product_id)) {
		$stmt .= " WHERE id = $shop_product_id ";
	}
	
	if ($debug) {
		echo "$stmt\n";
	} else {
		mysql_query($stmt, $dbh);
	}
	#exit;
	
	/*
	 * Are we going to have to set the shop product ID in the
	 * trackit products table?
	 *
	 * If this is the first time that the product has been synched
	 * with the shop, the shop product ID will be the ID of the
	 * last inserted row.
	 *
	 * That will be saved in the trackit system to store a link.
	 */
	$need_to_set_shop_product_id = FALSE;
	if (strlen($shop_product_id) == 0) {
		$shop_product_id = mysql_insert_id($dbh);
		$need_to_set_shop_product_id = TRUE;
	}
	
	/*
	 * Set the shop product id of the trackit product.
	 */
	
	if ($need_to_set_shop_product_id) {
		$stmt = <<<SQL
UPDATE
	hpi_trackit_stock_management_products
SET
	shop_product_id = $shop_product_id
WHERE
	id = $trackit_product_id
SQL;

		if ($debug) {
			echo "$stmt\n";
		} else {
			mysql_query($stmt, $dbh);
		}
	}

#	exit;
	
	/*
	 * Is there an image?
	 */
	if (strlen($trackit_product['image_name']) > 0) {
		#echo "Image found.\n";
		#exit;
		
		$image_name = $trackit_product['image_name'];
		
		/*
		 * Can we find that image in the photographs table?
		 */
		$query = <<<SQL
SELECT
	hpi_trackit_stock_management_photographs.shop_photograph_id
FROM
	hpi_trackit_stock_management_feed_files
		INNER JOIN
			hpi_trackit_stock_management_photographs
		ON
			hpi_trackit_stock_management_feed_files.id
			= hpi_trackit_stock_management_photographs.trackit_feed_file_id
WHERE
	hpi_trackit_stock_management_feed_files.name = '$image_name'
SQL;
		
		#echo "$query\n";
		
		$result = mysql_query($query, $dbh);
		
		if ($row = mysql_fetch_array($result)) {
			$shop_photograph_id = $row[0];
			
			#echo "Photograph with ID $shop_photograph_id found.\n";
			#exit;

			/*
			 * Is there already a row in the photograph links table?
			 */
			$query = <<<SQL
SELECT
	id
FROM
	hpi_shop_product_photograph_links
WHERE
	product_id = $shop_product_id
	AND
	type = 'main'
SQL;
			
			#echo "$query\n";
			
			$result = mysql_query($query, $dbh);
			
			$sppl_id = NULL;
			if ($row = mysql_fetch_array($result)) {
				$sppl_id = $row[0];
				
				#echo "Shop product photograph link found with ID $sppl_id\n";
			} else {
				#echo "Creating new product photograph link\n";
			}
			
			if (isset($sppl_id)) {
				$stmt = 'UPDATE ';
			} else {
				$stmt = 'INSERT INTO ';
			}
			
			$stmt .= ' hpi_shop_product_photograph_links SET ';
			
			$stmt .= " product_id = $shop_product_id , ";
			$stmt .= " photograph_id = $shop_photograph_id , ";
			$stmt .= " type = 'main' ";
			
			if (isset($sppl_id)) {
				$stmt .= " WHERE id = $sppl_id ";
			}
			
			if ($debug) {
				echo "$stmt\n";
			} else {
				mysql_query($stmt, $dbh);
			}
		}
	}
	
	/*
	 * Do we need to set the price?
	 */
	if (strlen($trackit_product['unit_price'])) {
		/*
		 * Does the product already have a price?
		 */
		$query = <<<SQL
SELECT
	id
FROM
	hpi_shop_product_currency_prices
WHERE
	product_id = $shop_product_id
SQL;

		$result = mysql_query($query, $dbh);
		
		$current_price_id = NULL;
		if ($row = mysql_fetch_assoc($result)) {
			$current_price_id = $row['id'];
		}
		
		if (isset($current_price_id)) {
			$stmt = 'UPDATE ';
		} else {
			$stmt = 'INSERT INTO ';
		}
		
		$stmt .= ' hpi_shop_product_currency_prices SET ';
		
		$stmt .= ' currency_id = 1, ';
		
//                $stmt .= ' product_id = ' . $trackit_product['id'] . ' , ';
		$stmt .= ' product_id = ' . $shop_product_id . ' , ';
		
		$stmt .= ' price = ' . ($trackit_product['unit_price'] * 100);
		
		if (isset($current_price_id)) {
			$stmt .= " WHERE id = $current_price_id ";
		}
		
		if ($debug) {
			echo "$stmt\n";
		} else {
			mysql_query($stmt, $dbh);
		}
		#exit;
	}
	
	/*
	 * The rows are now synched.
	 */
	$stmt = <<<SQL
UPDATE
	hpi_trackit_stock_management_products
SET
	synched_with_shop = 'Yes'
WHERE
	id = $trackit_product_id
SQL;

	if ($debug) {
		echo "$stmt\n";
	} else {
		mysql_query($stmt, $dbh);
	}
	
	#exit;
}

?>
