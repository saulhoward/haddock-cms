<?php
/**
 * Shop_SupplierShippingPriceRow
 *
 * @copyright Clear Line Web Design, 2007-03-05
 */

class
	Shop_SupplierShippingPriceRow
extends
    Database_Row
{
	public function 
		get_supplier_id()
	{
		return $this->get('supplier_id');
	}

	public function 
		get_customer_region_id()
	{
		return $this->get('customer_region_id');
	}

	public function 
		get_product_category_id()
	{
		return $this->get('product_category_id');
	}

	public function 
		get_additional_price()
	{
		return $this->get('additional_price');
	}

	public function 
		get_first_price()
	{
		return $this->get('first_price');
	}
			
	public function 
		get_supplier()
	{
		$database = $this->get_database();
		$suppliers_table = $database->get_table('hpi_shop_suppliers');
		$supplier_id = $this->get_supplier_id();
		
		return $suppliers_table->get_row_by_id($supplier_id);
	}
			
	public function 
		get_customer_region()
	{
		$database = $this->get_database();
		$customer_regions_table = $database->get_table('hpi_shop_customer_regions');
		$customer_region_id = $this->get_customer_region_id();
		
		return $customer_regions_table->get_row_by_id($customer_region_id);
	}

	public function 
		get_product_category()
	{
		$database = $this->get_database();
		$product_categories_table = $database->get_table('hpi_shop_product_categories');
		$product_category_id = $this->get_product_category_id();
		
		return $product_categories_table->get_row_by_id($product_category_id);
	}
}
?>
