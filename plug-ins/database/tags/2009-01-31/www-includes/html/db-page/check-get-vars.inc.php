<?php
/**
 * Check that the required GET variables have been set.
 *
 * @copyright Clear Line Web Design, 2007-08-29
 */

/*
 * Create the singleton objects.
 */
$gvm = Caching_GlobalVarManager::get_instance();

/*
 * Make sure that the page-name has been set.
 */

if (isset($_GET['page-name'])) {
    $gvm->set('page-name', $_GET['page-name']);
} else {
    throw new Exception('\'page-name\' GET variable must be set for a db-page!');
}
?>
