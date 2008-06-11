<?php
/**
 * Check that the product_tag's id has been set.
 *
 * @copyright Clear Line Web Design, 2007-07-27
 */

/*
 * Define these values so that they cannot be modified.
 */
if (isset($_GET['order_by'])) {
    define('ORDER_BY', $_GET['order_by']);
} else {
    define('ORDER_BY', 'added');
}

if (isset($_GET['direction'])) {
    define('DIRECTION', $_GET['direction']);
} else {
    define('DIRECTION', 'DESC');
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

/*
 * The product_tag ID.
 */

if (isset($_GET['product_tag_id'])) {
    $mysql_user_factory = Database_MySQLUserFactory::get_instance();
    $mysql_user = $mysql_user_factory->get_for_this_project();
    $database = $mysql_user->get_database();
    
    $product_categories_table = $database->get_table('hpi_shop_product_categories');
    
    $product_tag = $product_categories_table->get_row_by_id($_GET['product_tag_id']);
    
    $gvm = Caching_GlobalVarManager::get_instance();
    
    $gvm->set('product_tag', $product_tag);
} else {
    throw new Exception('No product tag ID set on product tag page!');
}
?>
