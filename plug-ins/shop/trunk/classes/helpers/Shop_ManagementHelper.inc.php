<?php
/**
 * Shop_ManagementHelper
 *
 * @copyright 2008-04-23, RFI
 */

class
	Shop_ManagementHelper
{
	public static function
		reset_tables()
	{
		#echo __METHOD__ . "\n";
		
		Database_TableHelper::empty_table('hpi_shop_products');
		
		Database_TableHelper::empty_table('hpi_shop_photographs');
		Database_TableHelper::empty_table('hpi_shop_product_photograph_links');
		
		Database_TableHelper::empty_table('hpi_shop_product_currency_prices');
		
		Database_TableHelper::empty_table('hpi_shop_product_tag_links');
		
		Database_TableHelper::empty_table('hpi_shop_product_text_links');
		Database_TableHelper::empty_table('hpi_shop_texts');
		
		Database_TableHelper::empty_table('hpi_shop_customers');
		
		Database_TableHelper::empty_table('hpi_shop_shopping_baskets');
		Database_TableHelper::empty_table('hpi_shop_orders');
		Database_TableHelper::empty_table('hpi_protx_payments_transactions');
		
		Database_TableHelper::empty_table('hpi_shop_comments');
		Database_TableHelper::empty_table('hpi_shop_commenters');
	}
}
?>