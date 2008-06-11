<?php
/**
 * The div to tell the customer which region they are currently set to.
 *
 * @copyright Clear Line Web Design, 2007-08-23
 */

$mysql_user_factory = Database_MySQLUserFactory::get_instance();
$mysql_user = $mysql_user_factory->get_for_this_project();
$database = $mysql_user->get_database();

$customer_regions_table = $database->get_table('hpi_shop_customer_regions');
#$customer_region = $customer_regions_table->get_row_by_id($_SESSION['customer_region_id']);

if ($customer_regions_table->count_all_rows() > 0) {
    $crn_div = new HTMLTags_Div();
    
    $customer_region = $customer_regions_table->get_current_customer_region();
    
    $customer_region_blurb_p = new HTMLTags_P();
    
    if (isset($_GET['customer_region_session'])) {
        $customer_region_blurb_p->append_str_to_content('You have set your region to&nbsp;');
    } else {
        $customer_region_blurb_p->append_str_to_content('Your region is set to&nbsp;');
    }
    
    $customer_region_blurb_p->append_str_to_content($customer_region->get_name_with_the());
    $customer_region_blurb_p->append_str_to_content('.');
    
    $crn_div->append_tag_to_content($customer_region_blurb_p);
    
    echo $crn_div->get_as_string();
}
?>
