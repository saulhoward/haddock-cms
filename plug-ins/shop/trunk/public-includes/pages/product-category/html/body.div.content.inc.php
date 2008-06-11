<?php
/**
 * The content of a page that shows a product category.
 *
 * @copyright Clear Line Web Design, 2007-07-26
 */

/*
 * Get instances of the singleton objects.
 */
$mysql_user_factory = Database_MySQLUserFactory::get_instance();

/*
 * Create other objects.
 */
$mysql_user = $mysql_user_factory->get_for_this_project();
$database = $mysql_user->get_database();

$products_table = $database->get_table('hpi_shop_products');
$products_table_renderer = $products_table->get_renderer();

$product_categories_table = $database->get_table('hpi_shop_product_categories');
$product_categories_table_renderer = $product_categories_table->get_renderer();

$product_category = $product_categories_table->get_row_by_id($_GET['product_category_id']);

$content_div = new HTMLTags_Div();
$content_div->set_attribute_str('id', 'content');

if ($product_category->is_active()) {
	// PRODUCT CATEGORY HEADER
	// 
	$product_category_header_id = 'product-category';
	$product_category_header_title = $product_category->get_name();
	$product_category_header_class = 'product-category';

	$product_category_header_h = new HTMLTags_Heading(2);
	$product_category_header_h->set_attribute_str('class', $product_category_header_class);
	$product_category_header_h->set_attribute_str('id', $product_category_header_id);

	$product_category_header_h->append_str_to_content($product_category_header_title);

	$content_div->append_tag_to_content($product_category_header_h);

	// PRODUCTS FOR PRODUCT CATEGORY DIV
	//
	$products_for_product_category_ul = 
		$products_table_renderer
			->get_products_for_product_category_ul_in_public($_GET['product_category_id']);

	$content_div->append_tag_to_content($products_for_product_category_ul);
} else {
	$customer_regions_table = $database->get_table('hpi_shop_customer_regions');
	$customer_region = $customer_regions_table->get_row_by_id($_SESSION['customer_region_id']);

	$this_product_category_inactive_text = 'There are no&nbsp;';
	$this_product_category_inactive_text .= $product_category->get_name();
	$this_product_category_inactive_text .= '&nbsp;available in&nbsp;';
	$this_product_category_inactive_text .= $customer_region->get_name_with_the();
	$this_product_category_inactive_text .= '.';

	$this_product_category_inactive_p = new HTMLTags_P($this_product_category_inactive_text);
	$content_div->append_tag_to_content($this_product_category_inactive_p);

	$all_products_available_text = 'See all products available in&nbsp;';
	$all_products_available_text .= $customer_region->get_name_with_the();

	$all_products_link = new HTMLTags_A($all_products_available_text);
	$all_products_location = new HTMLTags_URL();
	$all_products_location->set_file('/');
	$all_products_location->set_get_variable('page', 'products');
	$all_products_location->set_get_variable('customer_region_session', $customer_region->get_id());
	$all_products_link->set_href($all_products_location);

	$all_products_available_p = new HTMLTags_P();
	$all_products_available_p->append_tag_to_content($all_products_link);

	$content_div->append_tag_to_content($all_products_available_p);
}

echo $content_div->get_as_string();
?>
