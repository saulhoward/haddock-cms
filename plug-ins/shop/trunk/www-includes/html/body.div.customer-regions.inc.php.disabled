<?php
/**
 * The customer regions div.
 *
 * @copyright Clear Line Web Design, 2007-07-26
 */

$page_manager = PublicHTML_PageManager::get_instance();

$mysql_user_factory = Database_MySQLUserFactory::get_instance();
$mysql_user = $mysql_user_factory->get_for_this_project();
$database = $mysql_user->get_database();

$customer_regions_table = $database->get_table('hpi_shop_customer_regions');

$customer_regions = $customer_regions_table->get_all_rows('sort_order', 'ASC');

$customer_regions_div = new HTMLTags_Div();
$customer_regions_div->set_attribute_str('id', 'tabs');
$customer_regions_ul = new HTMLTags_UL();

foreach ($customer_regions as $customer_region) {
    $customer_region_li = new HTMLTags_LI();

    $customer_region_link_span = new HTMLTags_Span($customer_region->get_name());

    if ($customer_region->get_id() == $_SESSION['customer_region_id']) {
        $double_span = new HTMLTags_Span();
        $double_span->set_attribute_str('class', 'current');
        $double_span->append_tag_to_content($customer_region_link_span);

        $customer_region_li->append_tag_to_content($double_span);              
    } else {
        //$customer_region_link_file = '/';
        //$customer_region_link_location = new HTMLTags_URL();
        //$customer_region_link_location->set_file($customer_region_link_file);
        //$customer_region_link_location->set_get_variable('page', $page_manager->get_page());
        $customer_region_link_location = $page_manager->get_script_uri();
        $customer_region_link_location->set_get_variable('customer_region_session', $customer_region->get_id());

        $customer_region_link_anchor = new HTMLTags_A();
        $customer_region_link_anchor->set_href($customer_region_link_location);
        $customer_region_link_anchor
            ->set_attribute_str(
                'title',
                'Change your location to&nbsp;' . $customer_region->get_name()
            );
            
        $customer_region_link_anchor->append_tag_to_content($customer_region_link_span);
        
        $customer_region_li->append_tag_to_content($customer_region_link_anchor);
    }

    $customer_regions_ul->append_tag_to_content($customer_region_li);
}

$customer_regions_div->append_tag_to_content($customer_regions_ul);

echo $customer_regions_div->get_as_string();
?>
