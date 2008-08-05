<?php
/**
 * Shop_ProductsHelper
 *
 * @copyright 2008-02-25, RFI
 */

class
	Shop_ProductsHelper
{
	/*
	 * ----------------------------------------
	 * Functions to do deleting things.
	 * ----------------------------------------
	 */
	
	public static function
		disassociate_product_photo(
			$product_id,
			$photograph_id
		)
	{
		$dbh = DB::m();
		
		$product_id = mysql_real_escape_string($product_id, $dbh);
		$photograph_id = mysql_real_escape_string($photograph_id, $dbh);
		
		$stmt = <<<SQL
DELETE FROM
	hpi_shop_product_photograph_links
WHERE
	product_id = $product_id
	AND
	photograph_id = $photograph_id
SQL;

		mysql_query($stmt, $dbh);
	}
	
	public static function
		delete_all_products()
	{
		Database_TableHelper
			::empty_tables(
				'hpi_shop_products hpi_shop_product_currency_prices hpi_shop_product_photograph_links hpi_shop_product_tag_links hpi_shop_product_text_links hpi_shop_shopping_baskets'
			);
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with URLs
	 * ----------------------------------------
	 */
	
	public static function
		get_admin_products_page_url()
	{
		return PublicHTML_URLHelper
			::get_oo_page_url(
				'Shop_AdminProductsPage'
			);
	}
	
	public static function
		get_admin_edit_product_page_url(
			$product_id
		)
	{
		$url = self::get_admin_products_page_url();
		
		$url->set_get_variable('edit_id', $product_id);
		
		return $url;
	}
	
	public static function
		get_admin_disassociate_product_photo_redirect_script_url(
			$product_id,
			$photograph_id
		)
	{
		return PublicHTML_URLHelper
			::get_oo_page_url(
				'Shop_AdminDisassociateProductPhotoRedirectScript',
				array(
					'product_id' => $product_id,
					'photograph_id' => $photograph_id
				)
			);
	}

	public static function
		toggle_status_for_all_products_with_this_products_style_id($product)
	{
		if ($product->get_status() == 'hide')
		{
			self::set_status_for_all_products_with_this_style_id('display', $product->get_style_id());
		}
		else
		{
			self::set_status_for_all_products_with_this_style_id('hide', $product->get_style_id());
		}
	}

	public static function
		set_status_for_all_products_with_this_style_id($status, $style_id)
	{
		$query = <<<SQL
UPDATE
	hpi_shop_products
SET
	status = '$status'
	WHERE
	style_id = $style_id

SQL;

		/*
		 * Create the database objects.
		 */
		$muf = Database_MySQLUserFactory::get_instance();
		$mu = $muf->get_for_this_project();
		$database = $mu->get_database();
		$dbh = $database->get_database_handle();

//                print_r($query);exit;
		mysql_query($query, $dbh);
	}

	public static function
		get_all_products_for_style_id($style_id)
	{

		$mysql_user_factory = Database_MySQLUserFactory::get_instance();
		$mysql_user = $mysql_user_factory->get_for_this_project();
		$database = $mysql_user->get_database();

		$products_table = $database->get_table('hpi_shop_products');


		$query = <<<SQL
SELECT
	hpi_shop_products.*
FROM
	hpi_shop_products
	WHERE
	style_id = $style_id

SQL;

//                print_r($query);exit;
//                print_r($products_table->get_rows_for_select($query));exit;
		return $products_table->get_rows_for_select($query);
	}

	public static function
		edit_all_products_with_this_products_style_id($product_id, $values)
	{

		$mysql_user_factory = Database_MySQLUserFactory::get_instance();
		$mysql_user = $mysql_user_factory->get_for_this_project();
		$database = $mysql_user->get_database();

		$products_table = $database->get_table('hpi_shop_products');


		$query = <<<SQL
SELECT
	hpi_shop_products.style_id
FROM
	hpi_shop_products
	WHERE
	id = $product_id

SQL;

		/*
		 * Create the database objects.
		 */
		$muf = Database_MySQLUserFactory::get_instance();
		$mu = $muf->get_for_this_project();
		$database = $mu->get_database();
		$dbh = $database->get_database_handle();

		//                                print_r($query);exit;
		$result = mysql_query($query, $dbh);

		//                print_r($result);exit;

		while ($row = mysql_fetch_array($result)) {
			$style_id = $row['style_id'];

			//                print_r($row);exit;
		}

		$products = self::get_all_products_for_style_id($style_id);
//                print_r($products);exit;

		foreach ($products as $product)
		{

			$products_table->edit_product(
				$product->get_id(),
				$_POST['name'],
				$_POST['description'],
				$_POST['product_category_id'],
				$_POST['product_brand_id'],
				$_POST['supplier_id'],
				//                $_POST['use_stock_level'],
				$_POST['sort_order']
			);

			/*	 
			 *	 PRICES
			 */
			//        $product_currency_prices_table = $database->get_table('hpi_shop_product_currency_prices');
			//        $currencies_table = $database->get_table('hpi_shop_currencies');
			//        $currencies = $currencies_table->get_all_rows();
			//        foreach ($currencies as $currency)
			//        {
			//                $conditions = array();
			//                $conditions['product_id'] = $_GET['edit_id'];
			//                $conditions['currency_id'] = $currency->get_id();
			//                $product_currency_prices_table->delete_where($conditions);

			//                $product_currency_prices_table->add_product_currency_price(
			//                        $_GET['edit_id'],
			//                        $currency->get_id(),
			//                        $_POST['price_' . $currency->get_id()]		
			//                );
			//        }

			/*
			 * TAGS
			 */
			$product_tags_table = $database->get_table('hpi_shop_product_tags');
//                        $product = $products_table->get_row_by_id($_GET['edit_id']);

			/*
			 * REMOVE ALL PRINCIPAL TAGS FROM PRODUCT
			 */
			$products_table->remove_all_principal_tags($product->get_id());

			$principal_tags = $product_tags_table->get_principal_tags();

			#print_r($principal_tags);exit;
			foreach ($principal_tags as $principal_tag) {
				if (isset($_POST['tag_' . $principal_tag->get_id()])) {
					$product->add_tag($principal_tag);
				}
			}

			/*
			 * PHOTOGRAPHS
			 */
			# MAIN PHOTOGRAPH
			if (isset($_POST['main_photograph_id'])) {
				$product->add_photograph_by_id($_POST['main_photograph_id'], 'main');
			}

			# DESIGN PHOTOGRAPH
			if (isset($_POST['design_photograph_id'])) {
				$product->add_photograph_by_id($_POST['design_photograph_id'], 'design');
			}

			# EXTRAS PHOTOGRAPH
			//        $product->delete_photograph_product_link_of_type('extra');
			//        $photographs_table = $database->get_table('hpi_shop_photographs');
			//        $photographs = $photographs_table->get_all_rows();
			//        foreach ($photographs as $photograph)
			//        {
			//                if (isset($_POST['extra_photograph_id_' . $photograph->get_id()]))
			//                {
			//                        $product->add_photograph_by_id($photograph->get_id(), 'extra');
			//                }
			//        }
			//
		}





	}
}
?>
