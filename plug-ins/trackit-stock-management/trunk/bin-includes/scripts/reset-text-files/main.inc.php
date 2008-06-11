<?php
/**
 * The main .INC for the reset-text-files script.
 *
 * @copyright Clear Line Web Design, 2007-12-05
 */

/*
 * Create the database objects.
 */
$muf = Database_MySQLUserFactory::get_instance();
$mu = $muf->get_for_this_project();
$database = $mu->get_database();
$dbh = $database->get_database_handle();

mysql_query('TRUNCATE TABLE hpi_shop_products', $dbh);
mysql_query('TRUNCATE TABLE hpi_shop_product_photograph_links', $dbh);
mysql_query('TRUNCATE TABLE hpi_shop_product_currency_prices', $dbh);

mysql_query('TRUNCATE TABLE hpi_trackit_stock_management_products', $dbh);
mysql_query('TRUNCATE TABLE hpi_trackit_stock_management_stock_levels', $dbh);

mysql_query('UPDATE hpi_trackit_stock_management_feed_files SET processed = NULL WHERE file_type = \'TXT\'', $dbh);

?>