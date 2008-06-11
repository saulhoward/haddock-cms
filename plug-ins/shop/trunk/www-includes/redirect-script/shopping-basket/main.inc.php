<?php
/**
 * The redirect script for the shopping basket page.
 *
 * @copyright Clear Line Web Design, 2007-08-02
 */

$mysql_user_factory = Database_MySQLUserFactory::get_instance();

$mysql_user = $mysql_user_factory->get_for_this_project();

$database = $mysql_user->get_database();

$shopping_baskets_table = $database->get_table('hpi_shop_shopping_baskets');

$page_manager = PublicHTML_PageManager::get_instance();
$return_to_url = $page_manager->get_return_to_url();

// ADD PRODUCT
if (
	isset($_GET['add_product_id'])
	&&
	isset($_GET['add_product_quantity'])
) {
	$product_id = $_GET['add_product_id'];
	$quantity = $_GET['add_product_quantity'];
	$session_id = session_id();

	#header('Content-type: text/plain');
	#print_r($_POST);
	#foreach (array_keys($_POST) as $key) {
	#	echo "$key\n";
	#	echo urldecode($key) . "\n";
	#	echo $_POST[$key] . "\n";
	#}
	#exit;
	
	/*
	 * Parse the size/colour string.
	 */
	$scs = $_POST['size-colour'];
	$scs = urldecode($scs);
	
	if (preg_match('/(.+)SEPARATOR(.+)/', $scs, $matches)) {
		#print_r($matches);
		$size = trim($matches[1]);
		$colour = trim($matches[2]);
		#exit;
		
		$last_added_id = 
			$shopping_baskets_table
				->add_shopping_basket(
					$product_id,
					$session_id,
					$quantity,
					$size,
					$colour
				);
			
		$return_to_url->set_get_variable('last_added_shopping_basket_id', $last_added_id);
	#} else {
	#	echo "No match\n";
	}
}            

// EDIT SHOPPIN BASKET ID
//
//        edit_shopping_basket(
//            $edit_id,
//                $quantity

elseif (
	isset($_GET['edit_shopping_basket_id']) 
)
{
	try {
		$shopping_baskets_table->edit_shopping_basket(
			$_GET['edit_shopping_basket_id'],
			$_POST['quantity']
		);
		
		$return_to_url
			->set_get_variable(
				'last_edited_shopping_basket_id',
				$_GET['edit_shopping_basket_id']
			);
	} catch (Shop_StockNotAvailableException $e) {
		$_SESSION['stock-not-available-exception'] = $e;
		
		$return_to_url->set_get_variable('stock_not_available_exception');
	}
}

/*
 * Delete the shopping basket.
 *
 * This now returns the id of the deleted shopping basket as well
 * so that the shopping basket row can be restored.
 */
elseif (isset($_GET['delete_shopping_basket_id'])) {
	/*
	 * This is a rather inefficient way of doing this.
	 *
	 * The product and the quantity aren't really needed anymore
	 * but leave it in for now and remove it later.
	 */
	#$row_to_be_deleted = 
	#	$shopping_baskets_table->get_row_by_id($_GET['delete_shopping_basket_id']);
	#
	#$quantity = $row_to_be_deleted->get_quantity();
	#$product = $row_to_be_deleted->get_product();
	#$product_id = $product->get_id();
	
	$shopping_baskets_table->delete_shopping_basket($_GET['delete_shopping_basket_id']);
	
//        $return_to .= '&last_deleted_product_id=' . $product_id;
//        $return_to .= '&last_deleted_quantity=' . $quantity;
	#$return_to_url->set_get_variable('last_deleted_product_id', $product_id);
	
	/*
	 * The quantity is not used on the shopping basket page anymore.
	 *
	 * Should this be removed (with some of the lines above)?
	 */
	#$return_to_url->set_get_variable('last_deleted_quantity', $quantity);
	
	/*
	 * The deleted shopping basket id
	 */
	$return_to_url->set_get_variable(
		'last_deleted_shopping_basket_id',
		$_GET['delete_shopping_basket_id']
	);
} elseif (isset($_GET['restore_shopping_basket_id'])) {
	Shop_ShoppingBasketsTable
		::restore_shopping_basket(
			$_GET['restore_shopping_basket_id']
		);
}

$page_manager->set_return_to_url($return_to_url);
?>