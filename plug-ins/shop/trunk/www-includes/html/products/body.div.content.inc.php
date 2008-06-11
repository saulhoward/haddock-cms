<?php
/**
 * The page that lists all the products in the shop plug-in.
 * 
 * @copyright Clear Line Web Design, 2007-07-26
 */

#echo "On the products page.\n";

$page_manager = PublicHTML_PageManager::get_instance();

$mysql_user_factory = Database_MySQLUserFactory::get_instance();
$mysql_user = $mysql_user_factory->get_for_this_project();
$database = $mysql_user->get_database();

$products_table = $database->get_table('hpi_shop_products');
$products_table_renderer = $products_table->get_renderer();

$shopping_baskets_table = $database->get_table('hpi_shop_shopping_baskets');

$comments_table = $database->get_table('hpi_shop_comments');

// CONTENT DIV
$content_div = new HTMLTags_Div();
$content_div->set_attribute_str('id', 'content');

// MAIN PAGE HEADER
$content_div->append_str_to_content(
    $page_manager->get_inc_file_as_string('body.div.content-header')
);

// CUSTOMER REGION NOTIFICATION
$content_div->append_str_to_content(
    $page_manager->get_inc_file_as_string('body.div.customer-region-notification')
);

// SHOP WELCOME BLURB
$content_div->append_str_to_content(
    $page_manager->get_inc_file_as_string('body.div.welcome-blurb')
);

// ALL PRODUCTS DIV
$all_products_ul = $products_table_renderer->get_all_products_ul_in_public();

$content_div->append_tag_to_content($all_products_ul);

echo $content_div->get_as_string();
?>
