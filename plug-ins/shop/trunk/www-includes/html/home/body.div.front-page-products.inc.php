<?php
/**
 * The div for the front page products for the shop plug-in.
 * 
 * @copyright Clear Line Web Design, 2007-07-26
 */

$div_front_page_products = new HTMLTags_Div();
$div_front_page_products->set_attribute_str('id', 'front_page_products');

$mysql_user_factory = Database_MySQLUserFactory::get_instance();
$mysql_user = $mysql_user_factory->get_for_this_project();
$database = $mysql_user->get_database();

$products_table = $database->get_table('hpi_shop_products');
$products_table_renderer = $products_table->get_renderer();
$products_ul = $products_table_renderer->get_products_for_product_tags_ul_in_public('front_page');
$products_ul->set_attribute_str('id', 'products');

$div_front_page_products->append_tag_to_content($products_ul);

echo $div_front_page_products->get_as_string();
?>
