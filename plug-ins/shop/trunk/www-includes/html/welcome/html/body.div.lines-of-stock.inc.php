<?php
/**
 * The div for the lines of stock for the shop plug-in.
 * 
 * @copyright Clear Line Web Design, 2007-07-26
 */

$div_lines_of_stock = new HTMLTags_Div();
$div_lines_of_stock->set_attribute_str('id', 'lines_of_stock');

$product_categories_blurb_p = new HTMLTags_P('We have the following lines in stock:');
$div_lines_of_stock->append_tag_to_content($product_categories_blurb_p);

$mysql_user_factory = Database_MySQLUserFactory::get_instance();
$mysql_user = $mysql_user_factory->get_for_this_project();
$database = $mysql_user->get_database();

$product_categories_table = $database->get_table('hpi_shop_product_categories');
$product_categories_table_renderer = $product_categories_table->get_renderer();
$product_categories_ul = $product_categories_table_renderer->get_active_product_categories_ul_in_public();

$div_lines_of_stock->append_tag_to_content($product_categories_ul);

echo $div_lines_of_stock->get_as_string();
?>
