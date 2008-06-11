<?php
/**
 * The customer-region redirect script for the shop.
 *
 * @copyright Clear Line Web Design, 2007-07-06
 */

//echo "Foo!\n";
//exit;
$mysql_user_factory = Database_MySQLUserFactory::get_instance();
$mysql_user = $mysql_user_factory->get_for_this_project();
$database = $mysql_user->get_database();
$shopping_baskets_table = $database->get_table('hpi_shop_shopping_baskets');


/*
 * Create the singleton variables.
 */
$svm = Caching_SessionVarManager::get_instance();
$page_manager = PublicHTML_PageManager::get_instance();
$log_in_manager = Shop_LogInManager::get_instance();


if (isset($_GET['customer_region_session'])) {
	//    echo "customer_region_session set by GET.\n";

	//    echo '$_GET[\'customer_region_session\']: ' . "\n";
	//    echo $_GET['customer_region_session'] . "\n";

	$_SESSION['customer_region_id'] = $_GET['customer_region_session'];

	$current_session_has_shopping_basket = 
		$shopping_baskets_table->check_for_current_session_in_shopping_baskets();
	if ($current_session_has_shopping_basket) {
		$shopping_baskets_table->delete_illegal_shopping_baskets_for_current_customer_region();	
		$shopping_baskets_table->convert_shopping_baskets_for_current_session_to_new_customer_region();
	}

	if ($log_in_manager->is_logged_in())
	{
		$user = $log_in_manager->get_user();
		if ($user->get_customer_region_id() != 0)
		{
			$user->set_customer_region_id($_SESSION['customer_region_id']); 
		}

		$svm = Caching_SessionVarManager::get_instance();
		$svm->set('customer_shipping_details_confirmed', FALSE);
	}
} elseif (isset($_SESSION['customer_region_id'])) {
	//    echo "customer_region_id set in the session variable.\n";
} else {
	//    echo "customer_region_id has not been set by GET or in the session, getting the default from the DB.\n";

	$default_customer_region = $customer_regions_table->get_default_customer_region();

	//    echo '$default_customer_region->get_id()' . ": \n";
	//    echo $default_customer_region->get_id() . "\n";

	$_SESSION['customer_region_id'] = $default_customer_region->get_id();
}

/*
 * Set the return location after successfully adding to the database.
 */
$return_to_url = new HTMLTags_URL();

if (isset($_GET['desired_location'])) {
	$return_to_url->parse_url(
		urldecode($_GET['desired_location'])
	);
	$return_to_url->set_get_variable('customer_region_session', $_SESSION['customer_region_id']);
} else {
	$return_to_url->set_file('/');
}



$page_manager->set_return_to_url($return_to_url);
?>
