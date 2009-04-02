<?php
/**
 * A script to add, update and delete
 * rows in the products table in the shop plug-in.
 *
 * @copyright Clear Line Web Design, 2007-03-02
 */

//echo "Made it to the redirect script.\n";
//exit;

/*
 * Create the singleton objects.
 */
$mysql_user_factory = Database_MySQLUserFactory::get_instance();
$gvm = Caching_GlobalVarManager::get_instance();
$page_manager = PublicHTML_PageManager::get_instance();

/*
 * Create the database objects.
 */
$mysql_user = $mysql_user_factory->get_for_this_project();
$database = $mysql_user->get_database();

$products_table = $database->get_table('hpi_shop_products');

/*
 * Set the default return to page.
 */
$return_to_url = $gvm->get('current_page_admin_url');

//echo '$return_to_url->get_as_string(): ' . "\n";
//echo $return_to_url->get_as_string() . "\n";
//exit;

//$return_to = '/admin/?module=shop&page=products';

# Delete the project from the database.

if (isset($_GET['delete_id'])) {
	$products_table->delete_by_id($_GET['delete_id']);

	$product_tags_table = $database->get_table('hpi_shop_product_tags');
	$product_tags_table->delete_orphaned_tags_excluding_principal_tags();

	$product_photograph_links_table = $database->get_table('hpi_shop_product_photograph_links');
	$product_photograph_links_table->delete_orphaned_product_photograph_links();

	$return_to_url->set_get_variable('last_deleted_id', $_GET['delete_id']);
}
# Delete the project from the database.

if (isset($_GET['delete_all'])) {

	//    $return_to .= '&deleted_all=successful';

	$return_to_url->set_get_variable('deleted_all', 'successful');
}

# Add a new row to the table.
if (
	isset($_GET['add_row'])
	&&
	isset($_POST['main_photograph_id'])
	&&
	isset($_POST['design_photograph_id'])
) {
//        echo "Adding a product.\n";
	//exit;
	
//        echo 'print_r($_POST): '. "\n";
//        print_r($_POST);
//        exit;

	$last_added_id = $products_table->add_product(
		$_POST['name'],
		$_POST['description'],
		$_POST['product_category_id'],
		$_POST['product_brand_id'],
		$_POST['supplier_id'],
		$_POST['use_stock_level'],
		$_POST['sort_order']
	);

	/*	 
	 *	 PRICES
	 */
	$product_currency_prices_table = $database->get_table('hpi_shop_product_currency_prices');
	$currencies_table = $database->get_table('hpi_shop_currencies');
	$currencies = $currencies_table->get_all_rows();
	foreach ($currencies as $currency)
	{
		$product_currency_prices_table->add_product_currency_price(
			$last_added_id,
			$currency->get_id(),
			$_POST['price_' . $currency->get_id()]		
		);
	}

	/*
	 * TAGS
	 */
	$product_tags_table = $database->get_table('hpi_shop_product_tags');
	$product = $products_table->get_row_by_id($last_added_id);

	$principal_tags = $product_tags_table->get_principal_tags();

	/*
	 * REMOVE ALL PRINCIPAL TAGS FROM PRODUCT
	 */
	$products_table->remove_all_principal_tags($last_added_id);


	#print_r($principal_tags);exit;
	foreach ($principal_tags as $principal_tag)
	{
		if (isset($_POST['tag_' . $principal_tag->get_id()]))
		{
			$product->add_tag($principal_tag);
		}
	}

	/*
	 * PHOTOGRAPHS
	 */
	# MAIN PHOTOGRAPH
	$product->add_photograph_by_id($_POST['main_photograph_id'], 'main');

	# DESIGN PHOTOGRAPH
	$product->add_photograph_by_id($_POST['design_photograph_id'], 'design');

	# EXTRAS PHOTOGRAPH
	$photographs_table = $database->get_table('hpi_shop_photographs');
	$photographs = $photographs_table->get_all_rows();
	foreach ($photographs as $photograph)
	{
		if (isset($_POST['extra_photograph_id_' . $photograph->get_id()]))
		{
			$product->add_photograph_by_id($photograph->get_id(), 'extra');
		}
	}

	$return_to_url->set_get_variable('last_added_id', $last_added_id);
}


# Update a project in the database.
if (isset($_GET['edit_id'])) {
	#print_r($_POST);exit;
	//        print_r($_GET);exit;

	Shop_ProductsHelper::edit_all_products_with_this_products_style_id(
		$_GET['edit_id'],
		$_POST
	);
	$return_to_url->set_get_variable('last_edited_id', $_GET['edit_id']);

	if (isset($_GET['plu_code'])) {
		$return_to_url->set_get_variable('plu_code', $_GET['plu_code']);
	}
}


if (isset($_GET['set_price'])
	&&
		isset($_GET['product_id'])
	) {
		#print_r($_POST);
		$product_currency_prices_table = $database->get_table('hpi_shop_product_currency_prices');
		$currencies_table = $database->get_table('hpi_shop_currencies');
		$currencies = $currencies_table->get_all_rows();
		foreach ($currencies as $currency)
		{
			$conditions = array();
			$conditions['product_id'] = $_GET['product_id'];
			$conditions['currency_id'] = $currency->get_id();
			$product_currency_prices_table->delete_where($conditions);

			$product_currency_prices_table->add_product_currency_price(
				$_GET['product_id'],
				$currency->get_id(),
				$_POST[$currency->get_id()]		
			);
		}

		//                $return_to .= '&last_set_priceed_id=' . $_GET['set_price'];

		$return_to_url->set_get_variable('last_set_priced_id', $_GET['set_price']);
	}

if (isset($_GET['edit_tags'])
	&&
		isset($_GET['product_id'])
	) {
		$products_table->edit_product_tags(
			$_GET['product_id'],
			$_POST['tags']
		);
		//    $return_to .= '&last_edited_id=' . $_GET['edit_id'];

		$return_to_url->set_get_variable('last_edited_id', $_GET['edit_id']);
	}

if (isset($_GET['set_principal_tags'])
	&&
		isset($_GET['product_id'])
	) {
		#print_r($_POST);exit;
		$product_tags_table = $database->get_table('hpi_shop_product_tags');
		$product = $products_table->get_row_by_id($_GET['product_id']);

		// REMOVE ALL PRINCIPAL TAGS FROM PRODUCT
		$products_table->remove_all_principal_tags($_GET['product_id']);

		$principal_tags = $product_tags_table->get_principal_tags();

		#print_r($principal_tags);exit;
		foreach ($principal_tags as $principal_tag)
		{
			if (isset($_POST[$principal_tag->get_id()]))
			{
				$product->add_tag($principal_tag);
			}
		}

		$return_to_url->set_get_variable(
			'last_edited_id',
			$_GET['product_id']
		);
	}
if (isset($_GET['set_stock_level'])
	&&
		isset($_GET['product_id'])
	) {
		$product = $products_table->get_row_by_id($_GET['product_id']);
		$product->set_stock_level_and_stock_buffer_level(
			$_POST['stock_level'],
			$_POST['stock_buffer_level']
		);
		//    $return_to .= '&last_edited_id=' . $_GET['edit_id'];

		$return_to_url->set_get_variable('last_edited_id', $_GET['product_id']);
	}
if (isset($_GET['toggle_status'])
	&&
		isset($_GET['product_id'])
	) {
		$product = $products_table->get_row_by_id($_GET['product_id']);
//                $product->toggle_status();
		
		Shop_ProductsHelper::toggle_status_for_all_products_with_this_products_style_id($product);

		//    $return_to .= '&last_edited_id=' . $_GET['edit_id'];

		$return_to_url->set_get_variable('last_edited_id', $_GET['product_id']);
	}

if (isset($_GET['product_category_id'])) 
{
	$return_to_url->set_get_variable('product_category_id', $_GET['product_category_id']);
}

if (
	isset($_GET['set_main_photograph'])
	&&
	isset($_GET['product_id'])
	&&
	isset($_GET['photograph_id'])
) {
	$dbh = $database->get_database_handle();
	
	$product_id = $_GET['product_id'];
	$photograph_id = $_GET['photograph_id'];
	
	$query = <<<SQL
SELECT
	id
FROM
	hpi_shop_product_photograph_links
WHERE
	product_id = $product_id
	AND
	type = 'main'
SQL;
	
	$result = mysql_query($query, $dbh);
	
	if ($row = mysql_fetch_array($result)) {
		$sppl_id = $row['id'];
		
		$stmt = <<<SQL
UPDATE
	hpi_shop_product_photograph_links
SET
	product_id = $product_id,
	photograph_id = $photograph_id
WHERE
	id = $sppl_id
SQL;
		
	} else {
		$stmt = <<<SQL
INSERT INTO
	hpi_shop_product_photograph_links
SET
	product_id = $product_id,
	photograph_id = $photograph_id,
	type = 'main'
SQL;
		
	}
	
	mysql_query($stmt, $dbh);
	
	$return_to_url = Admin_AdminIncluderURLFactory::get_url(
		'plug-ins',
		'shop',
		'products',
		'html'
	);
	
	$return_to_url->set_get_variable('edit_id', $product_id);
}

if (
	isset($_GET['set_design_photograph'])
	&&
	isset($_GET['product_id'])
	&&
	isset($_GET['photograph_id'])
) {
	$dbh = $database->get_database_handle();
	
	$product_id = $_GET['product_id'];
	$photograph_id = $_GET['photograph_id'];
	
	$query = <<<SQL
SELECT
	id
FROM
	hpi_shop_product_photograph_links
WHERE
	product_id = $product_id
	AND
	type = 'design'
SQL;
	
	$result = mysql_query($query, $dbh);
	
	if ($row = mysql_fetch_array($result)) {
		$sppl_id = $row['id'];
		
		$stmt = <<<SQL
UPDATE
	hpi_shop_product_photograph_links
SET
	product_id = $product_id,
	photograph_id = $photograph_id
WHERE
	id = $sppl_id
SQL;
		
	} else {
		$stmt = <<<SQL
INSERT INTO
	hpi_shop_product_photograph_links
SET
	product_id = $product_id,
	photograph_id = $photograph_id,
	type = 'design'
SQL;
		
	}
	
	mysql_query($stmt, $dbh);
	
	$return_to_url = Admin_AdminIncluderURLFactory::get_url(
		'plug-ins',
		'shop',
		'products',
		'html'
	);
	
	$return_to_url->set_get_variable('edit_id', $product_id);
}

if (
	isset($_GET['add_extra_photograph'])
	&&
	isset($_GET['product_id'])
	&&
	isset($_GET['photograph_id'])
) {
	#echo "Adding extra photo";
	#exit;
	
	$dbh = $database->get_database_handle();
	
	$product_id = $_GET['product_id'];
	$photograph_id = $_GET['photograph_id'];
	
	$stmt = <<<SQL
INSERT INTO
	hpi_shop_product_photograph_links
SET
	product_id = $product_id,
	photograph_id = $photograph_id,
	type = 'extra'
SQL;
	
	#echo $stmt;
	
	mysql_query($stmt, $dbh);
	
	$return_to_url = Admin_AdminIncluderURLFactory::get_url(
		'plug-ins',
		'shop',
		'products',
		'html'
	);
	
	$return_to_url->set_get_variable('edit_id', $product_id);
	
	#exit;
}

$page_manager->set_return_to_url($return_to_url);
?>
