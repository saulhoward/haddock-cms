<?php
/**
 * Sets variables (order by, direction, offset, limit) for
 * fetching rows from the database.
 *
 * @copyright Clear Line Web Design, 2007-01-04
 */

/*
 * Create the singleton objects.
 */
$mysql_user_factory = Database_MySQLUserFactory::get_instance();
$gvm = Caching_GlobalVarManager::get_instance();

/*
 * Create the database objects.
 */
$mysql_user = $mysql_user_factory->get_for_this_project();
$database = $mysql_user->get_database();

if (isset($_GET['table'])) {
    $table = $database->get_table($_GET['table']);
    $gvm->set('table', $table);
} else {
    throw new Exception('The table must be set!');
}

/*
 * Define these values so that they cannot be modified.
 */

if (isset($_GET['order_by'])) {
    define('ORDER_BY', $_GET['order_by']);
} else {
    define('ORDER_BY', 'id');
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
