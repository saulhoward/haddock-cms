<?php
/**
 * Shop_ProductRow
 *
 * @copyright Clear Line Web Design, 2007-03-03
 */

require_once PROJECT_ROOT
. '/haddock/database/classes/elements/'
. 'Database_Row.inc.php';

class
	Shop_ProductRow
extends
	Database_Row
{
	private $product_currency_prices;

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

	private function
		get_product_currency_prices()
	{
		if (!isset($this->product_currency_prices)) {
			$database = $this->get_database();

			$product_currency_prices_table
				= $database->get_table('hpi_shop_product_currency_prices');

			$conditions = array();
			$product_id = $this->get_id();
			$conditions['product_id'] = $product_id;

			$product_currency_price_rows
				= $product_currency_prices_table->get_rows_where($conditions);

			foreach ($product_currency_price_rows as $pcpr) {
				$this->product_currency_prices[$pcpr->get_currency_id()] = $pcpr;
			}
		}

		return $this->product_currency_prices;
	}

	public function
		has_product_currency_price($currency_id)
	{
		$product_currency_price_rows = $this->get_product_currency_prices();

		return isset($product_currency_price_rows[$currency_id]);
	}

	public function
		get_product_currency_price($currency_id)
	{
		if ($this->has_product_currency_price($currency_id)) {
			$product_currency_price_rows = $this->get_product_currency_prices();

			return $product_currency_price_rows[$currency_id];
		} else {
			throw new ErrorHandling_SprintfException(
				'No price in currency %d for product %d!',
				array($currency_id, $product_id)
			);
		}
	}

	public function
		get_status()
	{
		return $this->get('status');
	}

	public function
		get_added()
	{
		return $this->get('added');
	}

	public function
		has_supplier()
	{
		$supplier_id = $this->get_supplier_id();
		
		return $supplier_id > 0;
	}

	public function
		get_supplier_id()
	{
		return $this->get('supplier_id');
	}

	public function
		get_supplier()
	{
		$database = $this->get_database();

		$suppliers_table = $database->get_table('hpi_shop_suppliers');

		return $suppliers_table->get_row_by_id($this->get_supplier_id());
	}
	
	public function
		has_main_photograph()
	{
		$main_photographs =  $this->get_photographs_of_type('main');

		return count($main_photographs) > 0;
	}
	
	public function
		get_main_photograph()
	{
		$main_photographs =  $this->get_photographs_of_type('main');

		#print_r($main_photographs);exit;
		return $main_photographs[0];
	}

	public function
		has_design_photograph()
	{
		$design_photographs =  $this->get_photographs_of_type('design');

		return count($design_photographs) > 0;
	}
	
	public function
		get_design_photograph()
	{
		$design_photographs = $this->get_photographs_of_type('design');
		return $design_photographs[0];
	}

	public function
		get_photographs_of_type($type)
	{
		$database = $this->get_database();

		$photographs_table = $database->get_table('hpi_shop_photographs');
		$product_photograph_links_table = $database->get_table('hpi_shop_product_photograph_links');

		$conditions = array();
		$conditions['product_id'] = $this->get_id();
		$conditions['type'] = $type;
		$product_photograph_links = $product_photograph_links_table->get_rows_where($conditions);

		#print_r($product_photograph_links);exit;

		$photographs = array();
		foreach ($product_photograph_links as $product_photograph_link)
		{
			$photographs[] =
				$photographs_table->get_row_by_id($product_photograph_link->get_photograph_id());
		}
		return $photographs;
	}

	public function
		get_extra_photographs()
	{
		return $this->get_photographs_of_type('extra');
	}

	public function
		get_all_photographs()
	{
		$database = $this->get_database();

		$photographs_table = $database->get_table('hpi_shop_photographs');
		$product_photograph_links_table = $database->get_table('hpi_shop_product_photograph_links');

		$conditions = array();
		$conditions['product_id'] = $this->get_id();
		$product_photograph_links = $product_photograph_links_table->get_rows_where($conditions);

		#print_r($product_photograph_links);exit;

		$photographs = array();
		foreach ($product_photograph_links as $product_photograph_link)
		{
			$photographs[] =
				$photographs_table->get_row_by_id($product_photograph_link->get_photograph_id());
		}
		return $photographs;
	}

	public function
		get_all_photograph_thumbnail_urls()
	{
		$thumbnail_image_urls = array();

		$photographs = $this->get_all_photographs();
		foreach ($photographs as $photograph)
		{
			$thumbnail_image = $photograph->get_thumbnail_image();
			$thumbnail_image_renderer = $thumbnail_image->get_renderer();
			$thumbnail_image_urls[] = $thumbnail_image_renderer->get_html_url_in_public_images();
		}
		return $thumbnail_image_urls;
	}

	public function
		get_design_photograph_thumbnail_url()
	{
		if ($this->has_design_photograph()) {
			$photograph = $this->get_design_photograph();
			$thumbnail_image = $photograph->get_thumbnail_image();
			$thumbnail_image_renderer = $thumbnail_image->get_renderer();
			return $thumbnail_image_renderer->get_html_url_in_public_images();
		} else {
			return '<img src="/plug-ins/shop/public-html/images/no-image-available-thumbnail.png" />';
		}
	}

	public function
		get_product_category_id()
	{
		return $this->get('product_category_id');
	}

	public function
		get_product_category()
	{
		$pci = $this->get_product_category_id();

		if ($pci > 0) {
			$database = $this->get_database();

			$product_categories_table = $database->get_table('hpi_shop_product_categories');

			return $product_categories_table->get_row_by_id($pci);
		} else {
			return NULL;
		}
	}

	//    public function
	//            get_shipping_price($shipping_location)
	//    {
	//            $shipping_category = $this->get_shipping_category();
	//            $shipping_price = $shipping_category->get_price_for_location($shipping_location);

	//            return $shipping_price;
	//    }
	
	/*
	 * ----------------------------------------
	 * Functions to do with the stock levels of the product.
	 * ----------------------------------------
	 */
	
	private function
		get_stock_level_query()
	{
		$id = $this->get_id();
		
		$query = <<<SQL
SELECT
	SUM(hpi_trackit_stock_management_stock_levels.quantity)
FROM
	hpi_trackit_stock_management_products
		INNER JOIN hpi_trackit_stock_management_stock_levels
			ON
				hpi_trackit_stock_management_products.product_id
				=
				hpi_trackit_stock_management_stock_levels.product_id
WHERE
	hpi_trackit_stock_management_products.shop_product_id = $id
SQL;
		
		return $query;
	}
	
	/**
	 * This looks at the trackit stock management table of stock levels
	 * rather than the field stock level in the products table.
	 *
	 * This should be changed to use a similar stock levels table in the
	 * shop plug-in so that this plug-in doesn't rely on the trackit
	 * plug-in.
	 */
	public function
		get_stock_level()
	{
		#return $this->get('stock_level');
		
		$dbh = DB::m();
		
		$query = $this->get_stock_level_query();
		
		$result = mysql_query($query, $dbh);
		
		if (
			$result
			&&
			$row = mysql_fetch_array($result)
		) {
			$stock_level = $row[0];
			
			$stock_level = (int)$stock_level;
			
			return $stock_level;
		} else {
			throw new Exception("Unable to find the stock level for product $id!");
		}
	}

	public function
		get_stock_buffer_level()
	{
		return $this->get('stock_buffer_level');
	}

	public function
		remove_quantity_from_stock($quantity)
	{
		if ($this->uses_stock_level())
		{
			$stock_level = $this->get_stock_level();
			$this->set_stock_level($stock_level - $quantity);
		}
	}
	
	/**
	 * Deprecated temporarily.
	 *
	 * The way that stock levels work need to be overhauled somewhat.
	 */
	public function
		set_stock_level($stock_level)
	{
		throw new Exception('Attempt to set the stock level!');
	
		$this->set('stock_level', $stock_level);
		$this->commit();
	}

	public function
		get_use_stock_level()
	{
		return $this->get('use_stock_level');
	}

	public function
		uses_stock_level()
	{
		if ($this->get('use_stock_level') == 'yes')
		{
			return TRUE;
		}
		
		return FALSE;
	}
	
	/*
	 * Looks at the stock levels in the trackit stock levels
	 * table and subtracts the stock buffer level from each
	 */
	public function
		get_available_stock_level()
	{
		#return $this->get_stock_level() - $this->get_stock_buffer_level();
		
		$dbh = DB::m();
		
		$id = $this->get_id();
		
		$slb = $this->get_stock_buffer_level();
		
		$slb = $slb < 0 ? 0 : $slb;
		
		$query = <<<SQL
SELECT
	SUM(available_stock)
FROM
	(
	SELECT
		IF (
			(hpi_trackit_stock_management_stock_levels.quantity - $slb) > 0,
			(hpi_trackit_stock_management_stock_levels.quantity - $slb),
			0
		)
		AS available_stock
	FROM
		hpi_trackit_stock_management_products
			INNER JOIN hpi_trackit_stock_management_stock_levels
				ON
					hpi_trackit_stock_management_products.product_id
					=
					hpi_trackit_stock_management_stock_levels.product_id
	WHERE
		hpi_trackit_stock_management_products.shop_product_id = $id
	) AS t1
SQL;

		#echo $query; exit;
		
		$result = mysql_query($query, $dbh);
		
		if (
			$result
			&&
			($row = mysql_fetch_array($result))
		) {
			$asl = $row[0];
			$asl = (int)$asl;
			return $asl;
		} else {
			throw new Exception("Unable to calculate the available stock level of product $id!");
		}
	}

	public function
		is_out_of_stock()
	{
		if (!$this->uses_stock_level()) {
			return FALSE;
		}
		
		if ($this->get_available_stock_level() < 1) {
			return TRUE;
		}
		
		return FALSE;
	}
	
	/**
	 * Should this method be merged with get_stock_level() above?
	 */
	public function
		get_trackit_stock_quanities_sum()
	{
		$id = $this->get_id();
		
		$query = <<<SQL
SELECT
	SUM(hpi_trackit_stock_management_stock_levels.quantity)
FROM
	hpi_shop_products
		INNER JOIN hpi_trackit_stock_management_products
			ON hpi_shop_products.id = hpi_trackit_stock_management_products.shop_product_id
		INNER JOIN hpi_trackit_stock_management_stock_levels
			ON hpi_trackit_stock_management_products.product_id
			=
			hpi_trackit_stock_management_stock_levels.product_id
WHERE
	hpi_shop_products.id = $id
SQL;

		$dbh = $this->get_database_handle();
		
		$result = mysql_query($query, $dbh);
		
		if ($row = mysql_fetch_array($result)) {
			$quantity = $row[0];
			
			$quantity = (int)$quantity;
			
			return $quantity;
		}
		
		return 0;
	}

	public function
		get_sort_order()
	{
		return $this->get('sort_order');
	}
	
	public function
		get_product_brand_id()
	{
		return $this->get('product_brand_id');
	}

	public function
		get_product_brand()
	{
		$pdi = $this->get_product_brand_id();

		if ($pdi > 0) {
			$database = $this->get_database();

			$product_brands_table = $database->get_table('hpi_shop_product_brands');

			return $product_brands_table->get_row_by_id($pdi);
		} else {
			return NULL;
		}
	}

	public function
		is_active()
	{
		if ($this->get_status() == 'hide')
		{
			return FALSE;
		}
		
		return !$this->is_out_of_stock();
		
		$database = $this->get_database();
		$customer_regions_table = $database->get_table('hpi_shop_customer_regions');

		$supplier = $this->get_supplier();

		$customer_region = $customer_regions_table->get_row_by_id($_SESSION['customer_region_id']);

		$customer_region_suppliers = $customer_region->get_suppliers();

		foreach ($customer_region_suppliers as $customer_region_supplier)
		{
			if ($supplier->get_id() == $customer_region_supplier->get_id())
			{
				//                                print_r("true");
				$result = TRUE;
			}
			//                        else
			//                        {
			//                                                                print_r("false");
			//                        }
		}

		return $result;
	}

	public function
		get_comments()
	{
		$database = $this->get_database();
		$comments_table = $database->get_table('hpi_shop_comments');

		$conditions = array();
		$conditions['status'] = 'accepted';
		$conditions['product_id'] = $this->get_id();

		return $comments_table->get_rows_where($conditions, 'added', 'DESC');
	}

	public function
		count_comments()
	{
		$database = $this->get_database();
		$comments_table = $database->get_table('hpi_shop_comments');

		$conditions = array();
		$conditions['status'] = 'accepted';
		$conditions['product_id'] = $this->get_id();

		return $comments_table->count_rows_where($conditions);
	}

	public function
		has_comments()
	{
		if ($this->count_comments() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	public function
		get_shipping_price_for_customer_region($quantity, $customer_region_id)
	{
		$database = $this->get_database();
		$supplier_shipping_prices_table = $database->get_table('hpi_shop_supplier_shipping_prices');

		$conditions = array();
		$conditions['supplier_id'] = $this->get_supplier_id();
		$conditions['customer_region_id'] = $customer_region_id;
		$conditions['product_category_id'] = $this->get_product_category_id();

		$supplier_shipping_price =
			$supplier_shipping_prices_table->get_rows_where($conditions);

		$first_price = $supplier_shipping_price[0]->get_first_price();
		$quantity = $quantity - 1;
		$additional_price = $supplier_shipping_price[0]->get_additional_price() * $quantity;

		return $first_price + $additional_price;
	}

	public function
		get_shipping_price_for_current_session($quantity)
	{
		$database = $this->get_database();
		$supplier_shipping_prices_table = $database->get_table('hpi_shop_supplier_shipping_prices');

		$conditions = array();
		$conditions['supplier_id'] = $this->get_supplier_id();
		$conditions['customer_region_id'] = $_SESSION['customer_region_id'];
		$conditions['product_category_id'] = $this->get_product_category_id();

		$supplier_shipping_price =
			$supplier_shipping_prices_table->get_rows_where($conditions);

		$first_price = $supplier_shipping_price[0]->get_first_price();
		$quantity = $quantity - 1;
		$additional_price = $supplier_shipping_price[0]->get_additional_price() * $quantity;

		return $first_price + $additional_price;
	}

	public function
		get_first_shipping_price_for_current_session()
	{
		$database = $this->get_database();
		$supplier_shipping_prices_table = $database->get_table('hpi_shop_supplier_shipping_prices');

		$conditions = array();
		$conditions['supplier_id'] = $this->get_supplier_id();
		$conditions['customer_region_id'] = $_SESSION['customer_region_id'];
		$conditions['product_category_id'] = $this->get_product_category_id();

		$supplier_shipping_price =
			$supplier_shipping_prices_table->get_rows_where($conditions);

		return $supplier_shipping_price[0]->get_first_price();
	}

	public function
		get_additional_shipping_price_for_current_session()
	{
		$database = $this->get_database();
		$supplier_shipping_prices_table = $database->get_table('hpi_shop_supplier_shipping_prices');

		$conditions = array();
		$conditions['supplier_id'] = $this->get_supplier_id();
		$conditions['customer_region_id'] = $_SESSION['customer_region_id'];
		$conditions['product_category_id'] = $this->get_product_category_id();

		$supplier_shipping_price =
			$supplier_shipping_prices_table->get_rows_where($conditions);

		return $supplier_shipping_price[0]->get_additional_price();
	}
	public function
		get_tags_strs()
	{
		$dbh = $this->get_database_handle();

		$product_id = $this->get_id();

		$query = <<<SQL
SELECT
    hpi_shop_product_tags.tag
FROM
	hpi_shop_products,
	hpi_shop_product_tags,
	hpi_shop_product_tag_links
WHERE
	hpi_shop_products.id = hpi_shop_product_tag_links.product_id
	AND
	hpi_shop_product_tags.id = hpi_shop_product_tag_links.product_tag_id
	AND
	hpi_shop_products.id = $product_id
ORDER BY
    hpi_shop_product_tags.tag ASC
SQL;

		$result = mysql_query($query, $dbh);

		$tags = array();

		while ($row = mysql_fetch_array($result)) {
			$tags[] = $row[0];
		}

		return $tags;
	}

	public function
		get_tags_ids()
	{
		$dbh = $this->get_database_handle();

		$product_id = $this->get_id();

		$query = <<<SQL
SELECT
    hpi_shop_product_tags.id
FROM
	hpi_shop_products,
	hpi_shop_product_tags,
	hpi_shop_product_tag_links
WHERE
	hpi_shop_products.id = hpi_shop_product_tag_links.product_id
	AND
	hpi_shop_product_tags.id = hpi_shop_product_tag_links.product_tag_id
	AND
	hpi_shop_products.id = $product_id
ORDER BY
	hpi_shop_product_tags.tag ASC
SQL;

		$result = mysql_query($query, $dbh);

		$tags = array();

		while ($row = mysql_fetch_array($result)) {
			$tags[] = $row[0];
		}

		return $tags;
	}

	public function
		get_tags()
	{
		if (!isset($this->tags)) {
			$product_id = $this->get_id();

			$query = <<<SQL
SELECT
    hpi_shop_product_tags.*
FROM
	hpi_shop_product_tag_links,
	hpi_shop_product_tags
WHERE
	hpi_shop_product_tag_links.product_id = $product_id
	AND
	hpi_shop_product_tag_links.product_tag_id = hpi_shop_product_tags.id
SQL;

			$database = $this->get_database();
			$tags_table = $database->get_table('hpi_shop_product_tags');

			$this->tags = $tags_table->get_rows_for_select($query);
		}

		return $this->tags;
	}

	public function
		get_tags_with_counts(
			$order_by = 'product_count',
			$direction = 'DESC'
		)
	{
		$product_id = $this->get_id();

		$query = <<<SQL
SELECT
    count(distinct(hpi_shop_products.id)) AS 'product_count',
    hpi_shop_product_tags.*
FROM
    hpi_shop_products,
    hpi_shop_product_tags,
    hpi_shop_product_tag_links
WHERE
    hpi_shop_product_tag_links.product_id = $product_id
    AND
    hpi_shop_product_tag_links.product_tag_id = hpi_shop_product_tags.id
GROUP BY
    hpi_shop_product_tags.id
ORDER BY
    $order_by $direction
SQL;

		#echo $query;
		$database = $this->get_database();
		$tags_table = $database->get_table('hpi_shop_product_tags');

		return $tags_table->get_rows_for_select($query);
	}

	//        public function
	//                get_products_grouped_by_tag_intersections()
	//        {
	//                $current_product_id = $this->get_id();

	//                $dbh = $this->get_database_handle();

	//                $query = <<<SQL
//SELECT
//    hpi_shop_product_tags.id AS tag__id,
//    hpi_shop_product_tags.tag AS tag__tag,
//        hpi_shop_products.id AS product__id,
//        hpi_shop_products.name AS product__name,
//        hpi_shop_products.description AS product__description,
//        hpi_shop_products.full_size_image_id AS product__full_size_image_id,
//        hpi_shop_products.thumbnail_image_id AS product__thumbnail_image_id,
//        hpi_shop_products.added AS product__added
//FROM
//    hpi_shop_product_tag_links,
//    hpi_shop_product_tags,
//    hpi_shop_products
//WHERE
//    hpi_shop_product_tag_links.product_tag_id
//    IN
//    (
//        SELECT
//            hpi_shop_product_tag_links.product_tag_id
//        FROM
//            hpi_shop_product_tag_links
//        WHERE
//            hpi_shop_product_tag_links.product_id = $current_product_id
//    )
//    AND
//    hpi_shop_product_tag_links.product_id <> $current_product_id
//    AND
//    hpi_shop_product_tag_links.product_tag_id = hpi_shop_product_tags.id
//    AND hpi_shop_product_tag_links.product_id = hpi_shop_products.id
//SQL;

//                $result = mysql_query($query, $dbh);

//                #$tags_and_products = array();
//                $products =  array();
//                $products_table = $this->get_table();
//                $product_reflection_class = $products_table->get_row_class();

//                $database = $this->get_database();
//                $tags_table = $database->get_table('hpi_shop_product_tags');
//                $tag_reflection_class = $tags_table->get_row_class();

//                while ($row = mysql_fetch_assoc($result)) {
//                        #$tags_and_products[] = $row;

//                        if (!isset($products[$row['product__id']])) {
//                                $product_data = array();

//                                $product_data['id'] = $row['product__id'];
//                                $product_data['name'] = $row['product__name'];
//                                $product_data['description'] = $row['product__description'];
//                                $product_data['full_size_image_id'] = $row['product__full_size_image_id'];
//                                $product_data['thumbnail_image_id'] = $row['product__thumbnail_image_id'];
//                                $product_data['added'] = $row['product__added'];


//                                $products[$row['product__id']]
//                                        = $product_reflection_class->newInstance(
//                                                $products_table,
//                                                $product_data
//                                        );
//                        }

//                        $tag_data = array();

//                        $tag_data['id'] = $row['tag__id'];
//                        $tag_data['tag'] = $row['tag__tag'];

//                        $tag = $tag_reflection_class->newInstance($tags_table, $tag_data);

//                        $products[$row['product__id']]->add_tag($tag);
//                }

//                $tag_intersections = array();

//                foreach ($products as $other_product) {
//                        $tag_intersections[$this->get_tag_intersection_str($other_product)][] = $other_product;
//                }

//                $tag_intersection_counts = array();

//                foreach (array_keys($tag_intersections) as $t_i) {
//                        $tag_intersection_counts[$t_i]
//                                = count(
//                                        explode(' ', $t_i)
//                                );
//                }

//                #echo '$tag_intersection_counts: ' . "\n";
//                #print_r($tag_intersection_counts);

//                arsort ($tag_intersection_counts);

//                #echo '$tag_intersection_counts: ' . "\n";
//                #print_r($tag_intersection_counts);

//                $products_grouped_by_tag_intersections = array();

//                foreach (array_keys($tag_intersection_counts) as $t_i) {
//                        $products_grouped_by_tag_intersections[$t_i] = $tag_intersections[$t_i];
//                }

//                return $products_grouped_by_tag_intersections;
//        }

	public function
		add_tag(Shop_ProductTagRow $tag)
	{
		//                if (!is_array($this->tags)) {
		//                        $this->tags = array();
		//                }

		//                $this->tags[] = $tag;
		$database = $this->get_database();
		$tag_links_table = $database->get_table('hpi_shop_product_tag_links');

		$tag_links_values = array();
		$tag_links_values['product_tag_id'] = $tag->get_id();
		$tag_links_values['product_id'] = $this->get_id();

		try
		{
			$tag_links_table->add($tag_links_values);
		}
		catch (Database_MySQLException $e)
		{
			if ($e->get_error_number() == 1062) #duplicate sql entry
			{
				#if tag link already exists, do nothing

			} else {
				throw $e;
			}
		}
	}

	public function
		get_tag_intersection_str(Shop_ProductRow $other_product)
	{
		$these_tags = array();

		foreach ($this->get_tags() as $tag) {
			$these_tags[$tag->get_id()] = $tag;
		}

		$these_tags_ids = array_keys($these_tags);

		#echo 'print_r($these_tags_ids): ' . "\n";
		#print_r($these_tags_ids);

		$other_tags = array();

		foreach ($other_product->get_tags() as $tag) {
			$other_tags[$tag->get_id()] = $tag;
		}

		$other_tags_ids = array_keys($other_tags);

		#echo 'print_r($other_tags_ids): ' . "\n";
		#print_r($other_tags_ids);

		$intersection_product_tag_ids = array_intersect($these_tags_ids, $other_tags_ids);

		#echo 'print_r($intersection_product_tag_ids): ' . "\n";
		#print_r($intersection_product_tag_ids);

		$intersection_tag_strs = array();

		foreach ($intersection_product_tag_ids as $product_tag_id) {
			$intersection_tag_strs[] = $these_tags[$product_tag_id]->get_tag();
		}

		sort($intersection_tag_strs);

		$tag_intersection_str = '';

		$first = TRUE;
		foreach ($intersection_tag_strs as $tag) {
			if ($first) {
				$first = FALSE;
			} else {
				$tag_intersection_str .= ' ';
			}

			$tag_intersection_str .= $tag;
		}

		#echo "\$tag_intersection_str: $tag_intersection_str\n";


		return $tag_intersection_str;
	}


	public function
		has_tag($tag_to_be_checked)
	{
		$tags = $this->get_tags();

		foreach ($tags as $tag)
		{
			if ($tag->get_id() == $tag_to_be_checked->get_id())
			{
				return TRUE;
			}
		}
		return FALSE;
	}

	public function
		remove_all_principal_tags()
	{
		$tags = $this->get_tags();

		foreach ($tags as $tag)
		{
			if ($tag->is_principal())
			{

				#print_r($tags);exit;
				$this->remove_tag($tag);
			}
		}
	}

	public function
		remove_tag(Shop_ProductTagRow $tag)
	{
		$database = $this->get_database();
		$tags_table = $database->get_table('hpi_shop_product_tags');
		$tag_links_table = $database->get_table('hpi_shop_product_tag_links');

		$conditions = array();
		$conditions['product_tag_id'] = $tag->get_id();
		$conditions['product_id'] = $this->get_id();

		$tag_links_table->delete_where($conditions);

		$tags_table->delete_orphaned_tags_excluding_principal_tags();


		//                if (!is_array($this->tags)) {
		//                        $this->tags = array();
		//                }
		//                $this->tags[] = $tag;

	}
	public function
		set_stock_level_and_stock_buffer_level(
			$stock_level,
			$stock_buffer_level
		)
	{
		$this->set('stock_level', $stock_level);
		$this->set('stock_buffer_level', $stock_buffer_level);

		$this->commit();
	}
	public function
		toggle_status()
	{
		if ($this->get_status() == 'hide')
		{
			$this->set('status', 'display');
		}
		else
		{
			$this->set('status', 'hide');
		}

		$this->commit();
	}

    /**
     * A product is NOT displayable if:
     *  - No prices in any currency have been set.
     */
	public function
		is_displayable()
	{
//                if ($this->get_status() == 'hide')
//                {
//                        return FALSE;
//                }

		$database = $this->get_database();

		$product_currency_prices = $this->get_product_currency_prices();
		if (count($product_currency_prices) == 0) {
			return FALSE;
		}

		return TRUE;
	}

	public function
		add_photograph_by_id($photograph_id, $type)
	{
		$database = $this->get_database();
		
		$dbh = $database->get_database_handle();
		
		$product_photograph_links_table = $database->get_table('hpi_shop_product_photograph_links');

		if ($type == 'main' || $type == 'design')
		{
			$this->delete_photograph_product_link_of_type($type);
		}

		#$values = array();
		#$values['product_id'] = $this->get_id();
		#$values['photograph_id'] = $photograph_id;
		#$values['type'] = $type;
		
		#$new_photo_id = $product_photograph_links_table->add($values);
		
		$product_id = $this->get_id();
		
		$stmt = <<<SQL
INSERT INTO
	hpi_shop_product_photograph_links
SET
	product_id = $product_id,
	photograph_id = $photograph_id,
	type = '$type'
SQL;
		
		#echo $stmt;
		#exit;
		
		mysql_query($stmt, $dbh);
		
		#exit;
		
		return $new_photo_id;
	}

	public function
		delete_photograph_product_link_of_type($type)
	{
		$database = $this->get_database();
		$product_photograph_links_table = $database->get_table('hpi_shop_product_photograph_links');

		$conditions = array();
		$conditions['product_id'] = $this->get_id();
		$conditions['type'] = $type;

		$product_photograph_links_table->delete_where($conditions);
	}
}
?>
