<?php
/**
 * TrackitStockManagement_StockLevelsHelper
 *
 * @copyright 2008-04-25, RFI
 */

class
	TrackitStockManagement_StockLevelsHelper
{
	public static function
		reset_stock_levels()
	{
		Database_TableHelper
			::empty_table(
				'hpi_trackit_stock_management_stock_levels'
			);
		
		TrackitStockManagement_FeedFilesHelper
			::reset_stock_files_processed_status();
	}
}
?>