<?php
/**
 * Sets variables (order by, direction, offset, limit) for
 * fetching rows from the database.
 *
 * RFI & SANH 2007-01-04
 */

require_once PROJECT_ROOT . '/haddock/database/classes/Database_MySQLUserFactory.inc.php';

/**
 * Create the database objects.
 */
$mysql_user_factory = Database_MySQLUserFactory::get_instance();
$mysql_user = $mysql_user_factory->get_for_this_project();
$database = $mysql_user->get_database();

$product_categories_table = $database->get_table('hpi_shop_product_categories');


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

?>
