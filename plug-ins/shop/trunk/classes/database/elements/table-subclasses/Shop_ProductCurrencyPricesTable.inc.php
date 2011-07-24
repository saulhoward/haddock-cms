<?php
/**
 * Shop_ProductCurrencyPricesTable
 *
 * @copyright Clear Line Web Design, 2007-03-06
 */

class
	Shop_ProductCurrencyPricesTable
	extends
	Database_Table
{
	public function
		add_product_currency_price (
			$product_id,
			$currency_id,
			$price
		)
	{
		$values = array();
		$values['product_id'] = $product_id;
		$values['currency_id'] = $currency_id;
		$values['price'] = $price;

		$id = $this->add($values);
		return $id;
	}

	public function
		edit_product_currency_price (
			$edit_id,
			$product_id,
			$currency_id,
			$price
		)
	{
		$values = array();
		$values['product_id'] = $product_id;
		$values['currency_id'] = $currency_id;
		$values['price'] = $price;

		return $this->update_by_id($edit_id, $values);
	}
}
?>
