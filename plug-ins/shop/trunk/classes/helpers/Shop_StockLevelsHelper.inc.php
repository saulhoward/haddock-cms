<?php
/**
 * Shop_StockLevelsHelper
 *
 * @copyright 2008-02-25, RFI
 */

class
	Shop_StockLevelsHelper
{
	/**
	 * Decouple this from the mash shop project!
	 */
	public static function
		get_available_stock_level(
			$product_id,
			$variation = NULL
		)
	{
		$available_stock_level = 0;
		
		if (
			isset($variation)
			&&
			isset($variation['size'])
			&&
			isset($variation['colour'])
		) {
			$dbh = DB::m();
			
			$product_id = mysql_real_escape_string($product_id, $dbh);
			
			$size = $variation['size'];
			$size = mysql_real_escape_string($size, $dbh);
			
			$colour = $variation['colour'];
			$colour = mysql_real_escape_string($colour, $dbh);
			
			$query = <<<SQL
SELECT
	hpi_trackit_stock_management_stock_levels.quantity
FROM
	hpi_trackit_stock_management_products
		INNER JOIN hpi_trackit_stock_management_stock_levels
			ON
				hpi_trackit_stock_management_products.product_id
				=
				hpi_trackit_stock_management_stock_levels.product_id
WHERE
	hpi_trackit_stock_management_products.shop_product_id = $product_id
	AND
	hpi_trackit_stock_management_stock_levels.size = '$size'
	AND
	hpi_trackit_stock_management_stock_levels.colour = '$colour'
SQL;

			#echo $query; exit;
			
			$result = mysql_query($query, $dbh);
			
			if ($row = mysql_fetch_array($result)) {
				$available_stock_level = floor($row[0]);
			}
			
			#print_r($stock_level_data); exit;
		}
		
		#echo $available_stock_level; exit;
		
		return $available_stock_level;
	}
}
?>