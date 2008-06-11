<?php
/**
 * DEPRECATED!
 *
 * Sets variables (order by, direction, offset, limit) for
 * fetching rows from the database.
 *
 * RFI & SANH 2007-01-04
 */

/*
 * Redirect everyone who tries to access this page to the
 * OO page version.
 */

$location = '/haddock/public-html/public-html/index.php?oo-page=1&page-class=Shop_AdminProductsPage';

foreach (array_keys($_GET) as $key) {
    $location .= "&$key=" . $_GET[$key];
}

#echo $location;
header("Location: $location");
exit;

/*
 * Create the database objects.
 */
$mysql_user_factory = Database_MySQLUserFactory::get_instance();
$mysql_user = $mysql_user_factory->get_for_this_project();
$database = $mysql_user->get_database();

$products_table = $database->get_table('hpi_shop_products');


/**
 * Define these values so that they cannot be modified.
 */

if (isset($_GET['order_by'])) {
    define('ORDER_BY', $_GET['order_by']);
} else {
    define('ORDER_BY', 'sort_order');
}

if (isset($_GET['direction'])) {
    define('DIRECTION', $_GET['direction']);
} else {
    define('DIRECTION', 'ASC');
}

if (isset($_GET['limit'])) {
    define('LIMIT', $_GET['limit']);
} else {
    define('LIMIT', 10);
}

if (isset($_GET['offset'])) {
    # Make sure that the offset is a multiple of the limit.
    if ($_GET['offset'] % LIMIT == 0) {
        define('OFFSET', $_GET['offset']);
    } else {
        define('OFFSET', (floor($_GET['offset'] / LIMIT) * LIMIT));
        #echo OFFSET;
    }
} else {
    define('OFFSET', 0);
}

#echo 'LIMIT: ' . LIMIT . "\n";
#exit;

?>
