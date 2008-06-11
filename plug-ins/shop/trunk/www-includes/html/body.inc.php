<?php
/**
 * The HTML body of a page in the shop.
 *
 * @copyright Clear Line Web Design, 2007-11-01
 */

$page_manager = PublicHTML_PageManager::get_instance();

echo "<body>\n";

$page_manager->render_inc_file('body.div.header');

$page_manager->render_inc_file('body.div.customer-regions-header');

$page_manager->render_inc_file('body.div.content');

$page_manager->render_inc_file('body.div.shop-navigation');

$page_manager->render_inc_file('body.div.mini-shop-accounts');

$page_manager->render_inc_file('body.div.mini-payments-info');

$page_manager->render_inc_file('body.div.mini-shopping-basket');

$page_manager->render_inc_file('body.div.footer');

echo "</body>\n";
  
?>
