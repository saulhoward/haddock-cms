<?php
/**
 * Create objects that are used throughout the shop site.
 *
 * @copyright Clear Line Web Design, 2007-08-23
 */

/*
 * Define these values so that they cannot be modified.
 */

//if (isset($_GET['order_by'])) {
//    define('ORDER_BY', $_GET['order_by']);
//} else {
//    define('ORDER_BY', 'added');
//}

//if (isset($_GET['direction'])) {
//    define('DIRECTION', $_GET['direction']);
//} else {
//    define('DIRECTION', 'DESC');
//}

//if (isset($_GET['limit'])) {
//    define('LIMIT', $_GET['limit']);
//} else {
//    define('LIMIT', 10);
//}

//if (isset($_GET['offset'])) {
//    # Make sure that the offset is a multiple of the limit.
//    if ($_GET['offset'] % LIMIT == 0) {
//        define('OFFSET', $_GET['offset']);
//    } else {
//        define('OFFSET', (floor($_GET['offset'] / LIMIT) * LIMIT));
//        #echo OFFSET;
//    }
//} else {
//    define('OFFSET', 0);
//}

$mysql_user_factory = Database_MySQLUserFactory::get_instance();
$mysql_user = $mysql_user_factory->get_for_this_project();
$database = $mysql_user->get_database();
$customer_regions_table = $database->get_table('hpi_shop_customer_regions');
$shopping_baskets_table = $database->get_table('hpi_shop_shopping_baskets');
/*
 * set SESSION 'customer_region_id' 
 */
if ($customer_regions_table->count_all_rows() > 0) {
	if (isset($_GET['customer_region_session'])) {
		$_SESSION['customer_region_id'] = $_GET['customer_region_session'];
	
		$current_session_has_shopping_basket = 
			$shopping_baskets_table->check_for_current_session_in_shopping_baskets();
		if ($current_session_has_shopping_basket) {
			$shopping_baskets_table->delete_illegal_shopping_baskets_for_current_customer_region();	
		}
	} elseif (!isset($_SESSION['customer_region_id'])) {
		$default_customer_region = $customer_regions_table->get_default_customer_region(); 
		$_SESSION['customer_region_id'] = $default_customer_region->get_id();
	}
}
?>
