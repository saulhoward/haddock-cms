<?php
/**
 * Shop_CustomerRegionRow
 *
 * @copyright Clear Line Web Design, 2007-03-05
 */

require_once PROJECT_ROOT
. '/haddock/database/classes/elements/'
. 'Database_Row.inc.php';

class
	Shop_CustomerRegionRow
	extends
	Database_Row
{
	public function 
		get_name()
	{
		return $this->get('name');
	}

	public function 
		get_name_with_the()
	{
		$name = $this->get('name');
		
		if ($name == 'USA' || $name == 'United Kingdom')
		{

			$name = 'the ' . $name;

		}
		if ($name == 'Other')
		{
			$name = 'all other countries';
		}
		return $name;
	}    

	public function 
		get_description()
	{
		return $this->get('description');
	}

	public function 
		get_currency_id()
	{
		return $this->get('currency_id');
	}

	public function 
		get_language_id()
	{
		return $this->get('language_id');
	}

	public function 
		get_sort_order()
	{
		return $this->get('sort_order');
	}

	public function 
		get_currency()
	{
		$database = $this->get_database();
		$currencies_table = $database->get_table('hpi_shop_currencies');
		$currency_id = $this->get_currency_id();

		return $currencies_table->get_row_by_id($currency_id);
	}

	public function 
		get_language()
	{
		$database = $this->get_database();
		$languages_table = $database->get_table('hpi_shop_languages');
		$language_id = $this->get_language_id();

		return $languages_table->get_row_by_id($language_id);
	}

	public function
		get_suppliers()
	{
		$database = $this->get_database();
        
		$customer_region_supplier_links_table
            = $database->get_table('hpi_shop_customer_region_supplier_links');

		$suppliers = array();

		$conditions = array();
		$conditions['customer_region_id'] = $this->get_id();

		$customer_region_supplier_links
            = $customer_region_supplier_links_table
                ->get_rows_where($conditions);
        
		foreach ($customer_region_supplier_links as $customer_region_supplier_link) {
			$suppliers[] = $customer_region_supplier_link->get_supplier();
		}		

		return $suppliers;
	}

	public function
		get_products()
	{
		$products = array();
		$suppliers = $this->get_suppliers();
        
		foreach ($suppliers as $supplier) {
			$products[] = $supplier->get_products();
		}		

		return $products;
	}

	public function
		get_active_products()
	{
//                $products = array();
//                $suppliers = $this->get_suppliers();
//                foreach ($suppliers as $supplier)
//                {
//                        $this_suppliers_products = $supplier->get_active_products();
//                        foreach ($this_suppliers_products as $this_suppliers_product)
//                        {
//                                $products[] = $this_suppliers_product; 
//                        }
//                        #print_r($products);
//                }		
		$database = $this->get_database();
		$products_table = $database->get_table('hpi_shop_products');

		$customer_region_id = $this->get_id();
		$query = <<<SQL
SELECT
    hpi_shop_products.*
FROM
    hpi_shop_customer_region_supplier_links,
    hpi_shop_products
WHERE
    hpi_shop_customer_region_supplier_links.customer_region_id = $customer_region_id
    AND
    hpi_shop_customer_region_supplier_links.supplier_id = hpi_shop_products.supplier_id
    AND
    hpi_shop_products.status = 'display'
ORDER BY
    hpi_shop_products.sort_order ASC
SQL;

		return $products_table->get_rows_for_select($query);  
	}

	public function
		get_active_products_for_product_category($product_category_id)
	{
//                $products = array();
//                $suppliers = $this->get_suppliers();
//                foreach ($suppliers as $supplier)
//                {
//                        $this_suppliers_products = 
//                                $supplier->get_active_products_for_product_category($product_category_id);
//                        foreach ($this_suppliers_products as $this_suppliers_product)
//                        {
//                                $products[] = $this_suppliers_product; 
//                        }
//                        #print_r($products);
//                }		

//                return $products;

		$database = $this->get_database();
		$products_table = $database->get_table('hpi_shop_products');

		$customer_region_id = $this->get_id();
		$query = <<<SQL
SELECT 
	*
FROM 
	hpi_shop_products
WHERE 
	supplier_id
IN (
	SELECT DISTINCT (
		supplier_id
	)
	FROM
	`hpi_shop_customer_region_supplier_links`
	WHERE
	customer_region_id = $customer_region_id
	AND
	hpi_shop_products.product_category_id = $product_category_id
	AND
	hpi_shop_products.status = 'display'
)
ORDER BY
	hpi_shop_products.sort_order ASC
SQL;

		return $products_table->get_rows_for_select($query);  
	}


	public function
		get_active_products_for_product_category_and_tag($product_category_id, $tag)
	{
		$database = $this->get_database();
		$products_table = $database->get_table('hpi_shop_products');

		$customer_region_id = $this->get_id();

		//id 	added 	name 	description 	product_category_id 	supplier_id 	
		//product_brand_id 	stock_level 	use_stock_level 	stock_buffer_level 	
		//status 	sort_order
		$query = <<<SQL
SELECT 
	hpi_shop_products.id AS id,
	hpi_shop_products.added AS added,
	hpi_shop_products.name AS name,
	hpi_shop_products.description AS description,
	hpi_shop_products.product_category_id AS product_category_id,
	hpi_shop_products.supplier_id AS supplier_id,
	hpi_shop_products.product_brand_id AS product_brand_id,
	hpi_shop_products.stock_level AS stock_level,
	hpi_shop_products.use_stock_level AS use_stock_level,
	hpi_shop_products.stock_buffer_level AS stock_buffer_level,
	hpi_shop_products.status AS status,
	hpi_shop_products.sort_order AS sort_order
FROM
	hpi_shop_products
INNER JOIN
	hpi_shop_customer_region_supplier_links
	ON
	hpi_shop_products.supplier_id = hpi_shop_customer_region_supplier_links.supplier_id
INNER JOIN
	hpi_shop_product_tag_links
	ON
	hpi_shop_products.id = hpi_shop_product_tag_links.product_id
INNER JOIN
	hpi_shop_product_tags 
	ON 
	hpi_shop_product_tag_links.product_tag_id = hpi_shop_product_tags.id
WHERE
	customer_region_id = $customer_region_id
	AND
	hpi_shop_product_tags.tag = '$tag'
	AND 
	hpi_shop_products.status = 'display'
	AND
	hpi_shop_products.product_category_id = $product_category_id
ORDER BY
	hpi_shop_products.sort_order ASC
SQL;

		return $products_table->get_rows_for_select($query);  
	}
}
?>
