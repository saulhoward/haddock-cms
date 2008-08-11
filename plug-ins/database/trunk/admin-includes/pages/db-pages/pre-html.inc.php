<?php
/**
 * Pre-html code for the "db-pages" admin page.
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
$gvm->set('pages-table', $pages_table);

$pages_table_renderer = $pages_table->get_renderer();
$gvm->set('pages-table-renderer', $pages_table_renderer);

//echo 'print_r($gvm): ' . "\n";
//print_r($gvm);
//exit;
?>

