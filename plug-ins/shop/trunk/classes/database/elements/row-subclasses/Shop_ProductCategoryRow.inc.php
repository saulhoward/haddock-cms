<?php
/**
 * Shop_ProductCategoryRow
 *
 * @copyright Clear Line Web Design, 2007-03-03
 */

require_once PROJECT_ROOT
. '/haddock/database/classes/elements/'
. 'Database_Row.inc.php';

class
	Shop_ProductCategoryRow
	extends
	Database_Row
{
	public function
		get_name()
	{
		return $this->get('name');
	}

	public function
		get_description()
	{
		return $this->get('description');
	}

	public function
		get_sort_order()
	{
		return $this->get('sort_order');
	}

	public function
		get_products()
	{
		$database = $this->get_database();
		$products_table = $database->get_table('hpi_shop_products');

		$conditions = array();
		$conditions['product_category_id'] = $this->get_id();
		$products = $products_table->get_rows_where($conditions);

		return $products;
	}

	public function
		get_displayable_products()
	{
		$database = $this->get_database();
		$products_table = $database->get_table('hpi_shop_products');

		$conditions = array();
		$conditions['product_category_id'] = $this->get_id();
		$conditions['status'] = 'display';
		$products = $products_table->get_rows_where($conditions);

		return $products;
	}

	public function
		is_active()
	{
		$database = $this->get_database();
		$customer_regions_table = $database->get_table('hpi_shop_customer_regions');
		$customer_region_row = $customer_regions_table->get_row_by_id($_SESSION['customer_region_id']);
		$products = $customer_region_row->get_active_products();

		$result = FALSE;
		foreach ($products as $product)
		{
			if ($product->get_product_category_id() == $this->get_id())
			{
				$result = TRUE;
			}
		}
		return $result;
	}

	public function
		count_products()
	{

		$database = $this->get_database();
		$products_table = $database->get_table('hpi_shop_products');

		$conditions = array();
		$conditions['product_category_id'] = $this->get_id();

		return $products_table->count_rows_where($conditions);
	}
}
?>
