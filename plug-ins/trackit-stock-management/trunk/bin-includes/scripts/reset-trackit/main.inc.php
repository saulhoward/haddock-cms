<?php
/**
 * The main .INC for the reset-trackit script.
 *
 * @copyright Robert Impey, 2008-04-23
 */

TrackitStockManagement_LockFilesHelper
	::unlock_all_lock_files();

TrackitStockManagement_CacheHelper
	::delete_all_cache_files();

/*
 * Empty the tables in the database.
 */

#Database_TableHelper::empty_table('hpi_trackit_stock_management_feed_files');
#Database_TableHelper::empty_table('hpi_trackit_stock_management_photographs');
#Database_TableHelper::empty_table('hpi_trackit_stock_management_products');
#Database_TableHelper::empty_table('hpi_trackit_stock_management_stock_levels');

TrackitStockManagement_ManagementHelper::reset_tables();

#Database_TableHelper::empty_table('hpi_shop_products');
#Database_TableHelper::empty_table('hpi_shop_product_photograph_links');
#Database_TableHelper::empty_table('hpi_shop_product_currency_prices');

Shop_ManagementHelper::reset_tables();

?>