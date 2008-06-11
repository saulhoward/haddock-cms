<?php
/**
 * TrackitStockManagement_ManagementHelper
 *
 * @copyright 2008-04-23, RFI
 */

class
	TrackitStockManagement_ManagementHelper
{
	public static function
		reset_tables()
	{
		Database_TableHelper::empty_table('hpi_trackit_stock_management_feed_files');
		Database_TableHelper::empty_table('hpi_trackit_stock_management_photographs');
		Database_TableHelper::empty_table('hpi_trackit_stock_management_products');
		Database_TableHelper::empty_table('hpi_trackit_stock_management_stock_levels');
	}
}
?>