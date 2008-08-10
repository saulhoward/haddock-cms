<?php
/**
 * Create the objects for the DB page.
 *
 * @copyright Clear Line Web Design, 2007-08-29
 */

/*
 * Create the singleton objects.
 */
$gvm = Caching_GlobalVarManager::get_instance();

//echo 'print_r($gvm): ' . "\n";
//print_r($gvm);
//exit;

$mysql_user_factory = Database_MySQLUserFactory::get_instance();

/*
 * Create the database objects.
 */
$mysql_user = $mysql_user_factory->get_for_this_project();
$database = $mysql_user->get_database();

$pages_table = $database->get_table('hc_database_pages');

$page_row = $pages_table->get_page_by_name($gvm->get('page-name'));
$gvm->set('page-row', $page_row);

$page_row_renderer = $page_row->get_renderer();
$gvm->set('page-row-renderer', $page_row_renderer);
?>
