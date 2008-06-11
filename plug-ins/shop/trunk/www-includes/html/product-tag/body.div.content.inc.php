<?php
/**
 * The content of a page that shows a product tag.
 *
 * @copyright Clear Line Web Design, 2007-07-26
 */

/*
 * Get instances of the singleton objects.
 */
$mysql_user_factory = Database_MySQLUserFactory::get_instance();

$page_manager = PublicHTML_PageManager::get_instance();
$current_page_url = $page_manager->get_script_uri();
//$redirect_script_url = clone $current_page_url;
//$redirect_script_url->set_get_variable('type', 'redirect-script');
//$cancel_href = $current_page_url;

/*
 * Create other objects.
 */
$mysql_user = $mysql_user_factory->get_for_this_project();
$database = $mysql_user->get_database();

$products_table = $database->get_table('hpi_shop_products');
$products_table_renderer = $products_table->get_renderer();

$product_categories_table = $database->get_table('hpi_shop_product_categories');
$product_categories_table_renderer = $product_categories_table->get_renderer();

$content_div = new HTMLTags_Div();
$content_div->set_attribute_str('id', 'content');

if (isset($_GET['product_tag_id']))
{
	$product_tag_id = $_GET['product_tag_id'];
	$product_tag = $product_categories_table->get_row_by_id($product_tag_id);

	if ($product_tag->is_active())
	{
		// PRODUCT CATEGORY HEADER
		// 
		$product_tag_header_id = 'product-tag';
		$product_tag_header_class = 'product-tag';

		if (isset($_GET['tag']))
		{
			$product_tag_header_title = $_GET['tag'] . '&nbsp;' . $product_tag->get_name();
		}
		else
		{
			$product_tag_header_title = $product_tag->get_name();
		}

		$product_tag_header_h = new HTMLTags_Heading(2);
		$product_tag_header_h->set_attribute_str('class', $product_tag_header_class);
		$product_tag_header_h->set_attribute_str('id', $product_tag_header_id);

		$product_tag_header_h->append_str_to_content($product_tag_header_title);

		$content_div->append_tag_to_content($product_tag_header_h);

		// PRODUCTS FOR PRODUCT CATEGORY DIV
		//
		if (isset($_GET['tag']))
		{
			$products_for_product_tag_ul = 
				$products_table_renderer->get_products_for_product_tag_and_tag_ul_in_public(
					$product_tag_id, $_GET['tag']
				);
		}
		else
		{
			$products_for_product_tag_ul = 
				$products_table_renderer
				->get_products_for_product_tag_ul_in_public($product_tag_id);
		}

		$content_div->append_tag_to_content($products_for_product_tag_ul);
	} else {
		$customer_regions_table = $database->get_table('hpi_shop_customer_regions');
		$customer_region = $customer_regions_table->get_row_by_id($_SESSION['customer_region_id']);

		$this_product_tag_inactive_text = 'There are no&nbsp;';
		$this_product_tag_inactive_text .= $product_tag->get_name();
		$this_product_tag_inactive_text .= '&nbsp;available in&nbsp;';
		$this_product_tag_inactive_text .= $customer_region->get_name_with_the();
		$this_product_tag_inactive_text .= '.';

		$this_product_tag_inactive_p = new HTMLTags_P($this_product_tag_inactive_text);
		$content_div->append_tag_to_content($this_product_tag_inactive_p);

		$all_products_available_text = 'See all products available in&nbsp;';
		$all_products_available_text .= $customer_region->get_name_with_the();

		$all_products_link = new HTMLTags_A($all_products_available_text);
		$all_products_location = clone $current_page_url;
		$all_products_location->set_get_variable('page', 'products');
		$all_products_location->set_get_variable('customer_region_session', $customer_region->get_id());
		$all_products_link->set_href($all_products_location);

		$all_products_available_p = new HTMLTags_P();
		$all_products_available_p->append_tag_to_content($all_products_link);

		$content_div->append_tag_to_content($all_products_available_p);
	}
}
elseif (!isset($_GET['product_tag_id']))
{
	$content_div->append_str_to_content(
		$page_manager->get_inc_file_as_string('body.div.product_tag_id-missing')
	);
}
echo $content_div->get_as_string();
?>
