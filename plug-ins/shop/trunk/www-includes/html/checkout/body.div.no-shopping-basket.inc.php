<?php
/**
 * A div that is displayed if the customer is trying to go to the checkout with no shopping basket.
 *
 * @copyright Clear Line Web Design, 2007-08-21
 */

$no_shopping_basket_div = new HTMLTags_Div();

$p_text = <<<TXT
I'm sorry, you have no shopping basket yet. Why are you trying to Checkout?
TXT;

$product_links_ul = new HTMLTags_UL();
$product_links_ul->set_attribute_str('id', 'shopping-basket-ul');

$all_products_link = new HTMLTags_A('See All Products');
$all_products_location = new HTMLTags_URL();
$all_products_location->set_file('/hpi/shop/products.html');
$all_products_link->set_href($all_products_location);
$all_products_li = new HTMLTags_LI();
$all_products_li->set_attribute_str('class', 'all-products');
$all_products_li->append_tag_to_content($all_products_link);

$product_links_ul->append_tag_to_content($all_products_li);

$no_shopping_basket_div->append_tag_to_content(new HTMLTags_P($p_text));
$no_shopping_basket_div->append_tag_to_content($product_links_ul);
echo $no_shopping_basket_div->get_as_string();
?>
