<?php
/**
 * Shop_SupplierShippingPricesTable
 *
 * @copyright Clear Line Web Design, 2007-03-06
 */

class
	Shop_SupplierShippingPricesTable
	extends
	Database_Table
{
	public function
		add_supplier_shipping_price (
			$supplier_id,
			$customer_region_id,
			$product_category_id,
			$first_price,
			$additional_price

		)
	{
		$values = array();
		$values['supplier_id'] = $supplier_id;
		$values['customer_region_id'] = $customer_region_id;
		$values['product_category_id'] = $product_category_id;
		$values['first_price'] = $first_price;
		$values['additional_price'] = $additional_price;

		$id = $this->add($values);
		return $id;
	}

	public function
		edit_supplier_shipping_price (
			$edit_id,
			$supplier_id,
			$customer_region_id,
			$product_category_id,
			$first_price,
			$additional_price
		)
	{
		$values = array();
		$values['supplier_id'] = $supplier_id;
		$values['customer_region_id'] = $customer_region_id;
		$values['product_category_id'] = $product_category_id;
		$values['first_price'] = $first_price;
		$values['additional_price'] = $additional_price;

		return $this->update_by_id($edit_id, $values);
	}
}
?>
