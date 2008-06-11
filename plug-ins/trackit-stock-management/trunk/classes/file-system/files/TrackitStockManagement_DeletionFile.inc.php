<?php
/**
 * TrackitStockManagement_DeletionFile
 *
 * @copyright 2008-04-25, RFI
 */

class
	TrackitStockManagement_DeletionFile
extends
	TrackitStockManagement_TextFeedFile
{
	public function
		process()
	{
		echo __METHOD__ . "\n";
		echo $this->get_name() . "\n";
		
		#$products = $this->get_products();
		
		#print_r($products);
		
		#foreach ($products as $product) {
		#	$product->delete();
		#}
		
		$update_statement
			= $this->get_product_deletion_update_statement();
		
		$affected_rows = Database_ModifyingStatementHelper
			::apply_statement(
				$update_statement
			);
		
		echo "\$affected_rows: $affected_rows\n";
	}
	
	public function
		get_products()
	{
		$products = array();
		
		$lines = $this->get_lines();
		
		foreach ($lines as $line) {
			if (
				preg_match(
					'/^(\d{3})P(.*)$/',
					$line,
					$matches
				)
			){
				$site_id = $matches[1];
				$product_id = $matches[2];
				
				$products[]
					= new TrackitStockManagement_Product($product_id);
			}
		}
		
		#echo count($products) . "\n";
		#exit;
		
		return $products;
	}
	
	public function
		get_product_deletion_update_statement()
	{
		$products = $this->get_products();
		
		
		$product_deletion_update_statement
			= new TrackitStockManagement_ProductDeletionUpdateStatement();
		
		foreach ($products as $product) {
			$product_deletion_update_statement
				->add_product(
					$product
				);
		}
		
		return $product_deletion_update_statement;
	}
}
?>