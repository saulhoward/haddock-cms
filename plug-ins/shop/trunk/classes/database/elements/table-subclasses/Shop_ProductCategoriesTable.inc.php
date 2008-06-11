<?php
/**
 * Shop_ProductCategoriesTable
 *
 * @copyright Clear Line Web Design, 2007-04-09
 */

require_once PROJECT_ROOT
	. '/haddock/database/classes/elements/'
	. 'Database_Table.inc.php';

class
	Shop_ProductCategoriesTable
extends
	Database_Table
{
	public function
		add_product_category(
			$name,
			$description,
			$sort_order
		)
	{
		$values = array();
		
		/*
		 * Check that the sort order has been set.
		 */
		if (!isset($sort_order) || $sort_order < 1) {
			$dbh = $this->get_database_handle();
			
			$query = <<<SQL
SELECT
	MAX(sort_order)
FROM
	hpi_shop_product_categories
SQL;
			
			$result = mysql_query($query, $dbh);
			
			if ($row = mysql_fetch_array($result)) {
				$sort_order = $row[0] + 1;
			} else {
				$sort_order = 1;
			}
		}

		$values['name'] = $name;
		$values['description'] = $description;
		$values['sort_order'] = $sort_order;

		return $this->add($values);
	}

	public function
		edit_product_category(
			$edit_id,
			$name,
			$description,
			$sort_order
		)
	{
		$values = array();

		$values['name'] = $name;
		$values['description'] = $description;
		$values['sort_order'] = $sort_order;

		return $this->update_by_id($edit_id, $values);
	}

	public function
		get_active_product_categories()
	{
		/*
		 * RFI 2008-01-18
		 */
		$product_categories = $this->get_all_rows();
		
		return $product_categories;
		
		$database = $this->get_database();
		$customer_regions_table = $database->get_table('hpi_shop_customer_regions');

		#$customer_region = $customer_regions_table->get_row_by_id($_SESSION['customer_region_id']);
		$customer_region = $customer_regions_table->get_current_customer_region();
//                $products = $customer_region->get_active_products();

		$active_product_categories = array();

		foreach ($product_categories as $product_category) {
			$products = $product_category->get_displayable_products();
			
			foreach ($products as $product) {
				$customer_region_suppliers = $customer_region->get_suppliers();
				$product_supplier = $product->get_supplier();
				foreach ($customer_region_suppliers as $customer_region_supplier) {
					if ($customer_region_supplier->get_id() == $product_supplier->get_id()) {
						if (count($active_product_categories) > 0) {
							foreach ($active_product_categories as $active_product_category) 
							{
								if 
									(
										$active_product_category->get_id() 
										!= 
										$product_category->get_id()
									) {

									$active_product_categories[] =
										$product_category;
								}

							}
						} else {
							$active_product_categories[] = $product_category;
						}
					}
				}
			}
		}
//                return $this->get_all_rows();
		return $active_product_categories;
	}

	public function
		get_active_product_categories_for_tag($product_tag)
	{

		$active_product_categories = $this->get_active_product_categories();
		/*
		 * RFI 2008-01-18
		 */
		return $active_product_categories;
	
		$active_product_categories_for_tag = array();

		foreach ($active_product_categories as $active_product_category)
		{

			$products = $active_product_category->get_displayable_products();
			
			foreach ($products as $product) 
			{

				if ($product->has_tag($product_tag))
				{

					$active_product_categories_for_tag[] = $active_product_category;

				}
			}
		}
		return $active_product_categories_for_tag;
	}

}
?>
