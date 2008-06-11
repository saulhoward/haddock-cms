<?php
/**
 * The div to tell the customer about which products are available in
 * the selected region in the shop plug-in.
 * 
 * @copyright Clear Line Web Design, 2007-07-26
 */

if (isset($_GET['customer_region_session'])) {
    $div_customer_region_notification = new HTMLTags_Div();
    
    $mysql_user_factory = Database_MySQLUserFactory::get_instance();
    $mysql_user = $mysql_user_factory->get_for_this_project();
    $database = $mysql_user->get_database();
    
    $customer_regions_table = $database->get_table('hpi_shop_customer_regions');
    $customer_region = $customer_regions_table->get_row_by_id($_SESSION['customer_region_id']);

    $customer_region_blurb_p = new HTMLTags_P();

    $customer_region_blurb_p->append_str_to_content('These are the products available in&nbsp;');

    $customer_region_blurb_p->append_str_to_content($customer_region->get_name_with_the());
    $customer_region_blurb_p->append_str_to_content('.');
    
    $div_customer_region_notification->append_tag_to_content($customer_region_blurb_p);
    
    echo $div_customer_region_notification->get_as_string();
}
?>
