<?php
/**
 * Shop_ProductCurrencyPriceRow
 *
 * @copyright Clear Line Web Design, 2007-03-05
 */

class
	Shop_ProductCurrencyPriceRow
extends
    Database_Row
{
	public function 
		get_product_id()
	{
		return $this->get('product_id');
	}

	public function 
		get_currency_id()
	{
		return $this->get('currency_id');
	}

	public function 
		get_price()
	{
		return $this->get('price');
	}
			
	public function 
		get_product()
	{
		$database = $this->get_database();
		$products_table = $database->get_table('hpi_shop_products');
		$product_id = $this->get_product_id();
		
		return $products_table->get_row_by_id($product_id);
	}
			
	public function 
		get_currency()
	{
		$database = $this->get_database();
		$currencies_table = $database->get_table('hpi_shop_currencies');
		$currency_id = $this->get_currency_id();
		
		return $currencies_table->get_row_by_id($currency_id);
	}
}
?>
