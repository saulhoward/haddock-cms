<?php
/**
 * Takes the user to a page where they can request for their password to be
 * reset and a new password be sent to their email address.
 *
 * @copyright Clear Line Web Design, 2007-08-21
 */

$gvm = Caching_GlobalVarManager::get_instance();

$page_manager = PublicHTML_PageManager::get_instance();
$current_page_url = $page_manager->get_script_uri();
$customer_region_url = clone $current_page_url;
$customer_region_url->set_get_variable('page', 'customer-details');

$customer_region_a = new HTMLTags_A('Change your address');
$customer_region_a->set_href($customer_region_url);

echo $customer_region_a->get_as_string();
?>
