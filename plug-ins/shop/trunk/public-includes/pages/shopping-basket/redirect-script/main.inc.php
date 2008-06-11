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

/*
 * Set the default return to page.
 */
// ADD PRODUCT
if (isset($_GET['add_product_id']) && isset($_GET['add_product_quantity'])) {
	//try {
		$product_id = $_GET['add_product_id'];
		$quantity = $_GET['add_product_quantity'];
		$session_id = session_id();

		$last_added_id = 
			$shopping_baskets_table
                ->add_shopping_basket($product_id, $session_id, $quantity);
        
        #$return_to .= '&last_added_shopping_basket_id=' . $last_added_id;
	//} catch (Exception $e) {
	//	print_r(session_id());
	//	print('Failed to add Product to your Shopping Basket!');
	//}
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
    $shopping_baskets_table->edit_shopping_basket(
	$_GET['edit_shopping_basket_id'],
	$_POST['quantity']
    );
    $return_to .= '&last_edited_shopping_basket_id=' . $_GET['edit_shopping_basket_id'];
}

// DELETE SHOPPING BASKET
//
elseif (isset($_GET['delete_shopping_basket_id'])) {

	$row_to_be_deleted = 
		$shopping_baskets_table->get_row_by_id($_GET['delete_shopping_basket_id']);
	$quantity = $row_to_be_deleted->get_quantity();
	$product = $row_to_be_deleted->get_product();
	$product_id = $product->get_id();

        $shopping_baskets_table->delete_shopping_basket($_GET['delete_shopping_basket_id']);
        
	$return_to .= '&last_deleted_product_id=' . $product_id;
        $return_to .= '&last_deleted_quantity=' . $quantity;
    }
?>
