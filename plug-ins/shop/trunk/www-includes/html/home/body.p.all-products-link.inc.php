<?php
/**
 * The p the link to the page for all the products.
 * 
 * @copyright Clear Line Web Design, 2007-07-26
 */

$all_products_link = new HTMLTags_A('View our products');

$all_products_location = new HTMLTags_URL();

$all_products_location->set_file('/');

$all_products_location->set_get_variable('section', 'plug-ins');
$all_products_location->set_get_variable('module', 'shop');
$all_products_location->set_get_variable('page', 'products');
$all_products_location->set_get_variable('type', 'html');

$all_products_link->set_href($all_products_location);

$all_products_link_p = new HTMLTags_P();
$all_products_link_p->append_tag_to_content($all_products_link);

echo $all_products_link_p->get_as_string();
?>
