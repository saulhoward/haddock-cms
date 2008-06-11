<?php
/**
 * Account management options for the My Account Page
 *
 * @copyright Clear Line Web Design, 2007-08-21
 */

/*
 * Create the singleton objects.
 */
$page_manager = PublicHTML_PageManager::get_instance();

$account_management_div = new HTMLTags_Div();
$account_management_div->set_attribute_str('id', 'account_management_div');

//$account_management_div->append_tag_to_content(new HTMLTags_P($p_text));
$account_management_div->append_tag_to_content(
	new HTMLTags_Heading(3, 'Account Management')
);
$options_ul = new HTMLTags_UL();

/*
 * Link to change your password
 */
$password_reset_li = new HTMLTags_LI();
$password_reset_li->append_str_to_content(
	$page_manager->get_inc_file_as_string('body.a.password-reset')
);
$options_ul->append_tag_to_content($password_reset_li);


/*
 * Link to change your customer_region
 */
$customer_region_li = new HTMLTags_LI();
$customer_region_li->append_str_to_content(
	$page_manager->get_inc_file_as_string('body.a.shipping-details-link')
);
$options_ul->append_tag_to_content($customer_region_li);


$account_management_div->append_tag_to_content($options_ul);
echo $account_management_div->get_as_string();
?>
