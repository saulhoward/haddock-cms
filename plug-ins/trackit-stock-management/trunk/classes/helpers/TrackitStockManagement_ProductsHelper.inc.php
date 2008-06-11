<?php
/**
 * TrackitStockManagement_ProductsHelper
 *
 * @copyright 2008-04-24, RFI
 */

class
	TrackitStockManagement_ProductsHelper
{
	public static function
		reset_products()
	{
		Database_TableHelper
			::empty_table('hpi_trackit_stock_management_products');
			
		Shop_ProductsHelper::delete_all_products();
		
		TrackitStockManagement_FeedFilesHelper
			::reset_product_files_processed_status();
	}
	
	public static function
		restore_all_products()
	{
		$dbh = DB::m();
		
		$stmt = <<<SQL
UPDATE
	hpi_trackit_stock_management_products
SET
	deleted = 'No'
SQL;

		#echo $stmt;
		
		mysql_query($stmt, $dbh);
	}
	
	public static function
		get_id_for_product_id(
			$product_id
		)
	{
		$rows
			= Database_FetchingHelper
				::get_rows_for_query(
					new Database_SQLSelectQuery(
<<<SQL
SELECT
	id
FROM
	hpi_trackit_stock_management_products
WHERE
	product_id = '$product_id'
SQL

					)
				);
		
		if (count($rows) == 0) {
			throw new Exception("No product with product ID '$product_id'!'");
		} else {
			$row = $rows[0];
			
			return $row['id'];
		}
	}
}
?>