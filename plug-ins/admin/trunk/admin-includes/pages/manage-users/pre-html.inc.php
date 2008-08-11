<?php
/**
 * Pre-display code for the manage-users admin page.
 *
 * @copyright Clear Line Web Design, 2007-09-21
 */

/*
 * Create the singleton objects.
 */
$gvm = Caching_GlobalVarManager::get_instance();

/*
 * Set the selection variables.
 */
if (isset($_GET['order_by'])) {
    #define('ORDER_BY', $_GET['order_by']);
    $gvm->set('order_by', $_GET['order_by']);
} else {
    #define('ORDER_BY', 'id');
    $gvm->set('order_by', 'name');
}

if (isset($_GET['direction'])) {
    #define('DIRECTION', $_GET['direction']);
    $gvm->set('direction', $_GET['direction']);
} else {
    #define('DIRECTION', 'ASC');
    $gvm->set('direction', 'ASC');
}

if (isset($_GET['limit'])) {
    #define('LIMIT', $_GET['limit']);
    $gvm->set('limit', $_GET['limit']);
} else {
    #define('LIMIT', 10);
    $gvm->set('limit', 10);
}

if (isset($_GET['offset'])) {
    # Make sure that the offset is a multiple of the limit.
    if ($_GET['offset'] % $gvm->get('limit') == 0) {
        #define('OFFSET', $_GET['offset']);
        $gvm->set('offset', $_GET['offset']);
    } else {
        #define('OFFSET', (floor($_GET['offset'] / LIMIT) * LIMIT));
        #echo OFFSET;
        $gvm->set('offset', (floor($_GET['offset'] / $gvm->get('limit')) * $gvm->get('limit')));
    }
} else {
    #define('OFFSET', 0);
    $gvm->set('offset', 0);
}
?>