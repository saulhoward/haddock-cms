<?php
/**
 * TrackitStockManagement_ProductDeletionUpdateStatement
 *
 * @copyright 2008-05-14, RFI
 */

class
	TrackitStockManagement_ProductDeletionUpdateStatement
extends
	Database_SQLUpdateStatement
{
	private $products;
	
	public function
		__construct()
	{
		parent::__construct();
		
		$this->products = array();
	}
	
	public function
		add_product(
			TrackitStockManagement_Product $product
		)
		
	{
		$this->products[] = $product;
	}
	
	public function
        get_set_clause()
    {
		$set_clause = new Database_SQLSetClause();
		
		$set_clause->add_field(
			new Database_SQLUpdateClauseQuotedValueFieldSubClause(
				'deleted',
				'Yes'
			)
		);
		
		return $set_clause;
    }
	
	protected function
		get_table_name()
	{
		return 'hpi_trackit_stock_management_products';
	}
	
	public function
        get_where_clause()
    {
        $where_clause = new Database_SQLWhereClause();
		
		$in_condition
			= new Database_SQLWhereClauseFieldInListConditionSubClause('product_id');
		
		#$in_condition->set_field_name('product_id');
		
		foreach ($this->products as $product) {
			$in_condition->add_value(
				$product->get_product_id()
			);
		}
		
		$where_clause->add_condition($in_condition);
		
		return $where_clause;
    }
}
?>