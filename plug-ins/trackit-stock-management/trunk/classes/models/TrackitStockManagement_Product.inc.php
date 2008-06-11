<?php
/**
 * TrackitStockManagement_Product
 *
 * @copyright 2008-05-01, RFI
 */

class
	TrackitStockManagement_Product
extends
	TrackitStockManagement_Model
{
	private $product_id;

	public function 
		__construct(
			$product_id
		)
	{
		$this->product_id = $product_id;
	}

	public function 
		get_product_id()
	{
		return $this->product_id;
	}

	public function 
		set_product_id($product_id)
	{
		$this->product_id = $product_id;
	}
	
	public function
		delete()
	{
		#echo __METHOD__ . "\n";
		
		$product_id = $this->get_product_id();
		
		#echo "\$product_id: $product_id\n";
		
		$affected_rows = Database_ModifyingStatementHelper
			::apply_statement(
				new Database_SQLUpdateStatement(
<<<SQL
UPDATE
	hpi_trackit_stock_management_products
SET
	deleted = 'Yes'
WHERE
	product_id = '$product_id'
SQL

				)
			);
			
		#echo "\$affected_rows: $affected_rows\n";
	}
}
?>