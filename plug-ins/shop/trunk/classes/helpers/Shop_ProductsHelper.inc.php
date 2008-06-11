<?php
/**
 * Shop_ProductsHelper
 *
 * @copyright 2008-02-25, RFI
 */

class
	Shop_ProductsHelper
{
	/*
	 * ----------------------------------------
	 * Functions to do deleting things.
	 * ----------------------------------------
	 */
	
	public static function
		disassociate_product_photo(
			$product_id,
			$photograph_id
		)
	{
		$dbh = DB::m();
		
		$product_id = mysql_real_escape_string($product_id, $dbh);
		$photograph_id = mysql_real_escape_string($photograph_id, $dbh);
		
		$stmt = <<<SQL
DELETE FROM
	hpi_shop_product_photograph_links
WHERE
	product_id = $product_id
	AND
	photograph_id = $photograph_id
SQL;

		mysql_query($stmt, $dbh);
	}
	
	public static function
		delete_all_products()
	{
		Database_TableHelper
			::empty_tables(
				'hpi_shop_products hpi_shop_product_currency_prices hpi_shop_product_photograph_links hpi_shop_product_tag_links hpi_shop_product_text_links hpi_shop_shopping_baskets'
			);
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with URLs
	 * ----------------------------------------
	 */
	
	public static function
		get_admin_products_page_url()
	{
		return PublicHTML_URLHelper
			::get_oo_page_url(
				'Shop_AdminProductsPage'
			);
	}
	
	public static function
		get_admin_edit_product_page_url(
			$product_id
		)
	{
		$url = self::get_admin_products_page_url();
		
		$url->set_get_variable('edit_id', $product_id);
		
		return $url;
	}
	
	public static function
		get_admin_disassociate_product_photo_redirect_script_url(
			$product_id,
			$photograph_id
		)
	{
		return PublicHTML_URLHelper
			::get_oo_page_url(
				'Shop_AdminDisassociateProductPhotoRedirectScript',
				array(
					'product_id' => $product_id,
					'photograph_id' => $photograph_id
				)
			);
	}
}
?>