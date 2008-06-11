<?php
/**
 * The Shopping Basket page of the shop hpi.
 * 
 * @copyright Clear Line Web Design, 2007-08-02
 */

$mysql_user_factory = Database_MySQLUserFactory::get_instance();
$mysql_user = $mysql_user_factory->get_for_this_project();
$database = $mysql_user->get_database();

$products_table = $database->get_table('hpi_shop_products');
$products_table_renderer = $products_table->get_renderer();

$shopping_baskets_table = $database->get_table('hpi_shop_shopping_baskets');
$shopping_baskets_table_renderer = $shopping_baskets_table->get_renderer();

// CONTENT DIV
$content_div = new HTMLTags_Div();
$content_div->set_attribute_str('id', 'content');

/*
 * LAST ACTION BOX DIV
 *
 */
if (
	isset($_GET['last_deleted_product_id']) 
	||
	isset($_GET['last_edited_shopping_basket_id']) 
	||
	isset($_GET['last_added_shopping_basket_id'])
	||
	isset($_GET['customer_region_session'])
) {		
    if (
        isset($_GET['last_deleted_product_id']) 
        &&
        isset($_GET['last_deleted_quantity'])
    ){
        $last_deleted_product_row = 
            $products_table->get_row_by_id($_GET['last_deleted_product_id']);
        $last_deleted_product_row_renderer =
            $last_deleted_product_row->get_renderer();

        $message_div = 
            $last_deleted_product_row_renderer
            ->get_deleted_shopping_basket_confirmation_div(
                $_GET['last_deleted_quantity']);
    } elseif (isset($_GET['last_edited_shopping_basket_id'])) {
        $last_edited_shopping_basket_row = 
            $shopping_baskets_table
            ->get_row_by_id($_GET['last_edited_shopping_basket_id']);
        $last_edited_shopping_basket_row_renderer = 
            $last_edited_shopping_basket_row->get_renderer();

        $message_div = 
            $last_edited_shopping_basket_row_renderer
            ->get_edited_confirmation_div();	   
    } elseif (isset($_GET['last_added_shopping_basket_id'])) {
        $last_added_shopping_basket_row = 
            $shopping_baskets_table
            ->get_row_by_id($_GET['last_added_shopping_basket_id']);
        $last_added_shopping_basket_row_renderer = 
            $last_added_shopping_basket_row->get_renderer();

        $message_div = 
            $last_added_shopping_basket_row_renderer->get_added_confirmation_div();
    } elseif (isset($_GET['customer_region_session'])) {
        $customer_regions_table = $database->get_table('hpi_shop_customer_regions');

        $last_changed_customer_region_row = 
            $customer_regions_table
            ->get_row_by_id($_GET['customer_region_session']);
        $last_changed_customer_region_row_renderer = 
            $last_changed_customer_region_row->get_renderer();

        $message_div = 
            $last_changed_customer_region_row_renderer->get_changed_confirmation_div();
    }
    $message_div->set_attribute_str('class', 'last-action-div');
    $content_div->append_tag_to_content($message_div);
}

// Show The Shopping Basket Div
//
$main_page_header_id = 'shopping-basket';
$main_page_header_title = 'Your Shopping Basket';
$main_page_header_class = 'shopping-basket';

$main_page_header_h = new HTMLTags_Heading(2);
$main_page_header_h->set_attribute_str('class', $main_page_header_class);
$main_page_header_h->set_attribute_str('id', $main_page_header_id);

$main_page_header_h->append_tag_to_content(new HTMLTags_Span($main_page_header_title));

$content_div->append_tag_to_content($main_page_header_h);
$all_shopping_baskets_div =
	$shopping_baskets_table_renderer->
		get_full_shopping_baskets_for_current_session_div();

$content_div->append_tag_to_content($all_shopping_baskets_div);

$p_text = <<<TXT
Your Shopping Basket, brought to you by...
TXT;
$content_div->append_tag_to_content(new HTMLTags_P($p_text));

// Links to all products and checkout
$shopping_basket_checkout_links_ul =
	$shopping_baskets_table_renderer->
		get_shopping_basket_checkout_links_ul($logged_in);

$content_div->append_tag_to_content($shopping_basket_checkout_links_ul);

echo $content_div->get_as_string();
?>
