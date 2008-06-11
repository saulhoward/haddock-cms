<?php
/**
 * Give the customer a chance to create a new account.
 *
 * @copyright Clear Line Web Design, 2007-09-21
 */

$create_new_customer_div = new HTMLTags_Div();
$create_new_customer_div->set_attribute_str('id', 'create_new_customer_div');

$create_new_customer_link = new HTMLTags_A('Create New Account');

$create_new_customer_link->set_attribute_str('class', 'cool_button');
$create_new_customer_link->set_attribute_str(
    'id',
    'create_new_customer_button'
);

$create_new_customer_location = new HTMLTags_URL();

$create_new_customer_location->set_file('/');

$create_new_customer_location->set_get_variable('section', 'plug-ins');
$create_new_customer_location->set_get_variable('module', 'shop');
#$create_new_customer_location->set_get_variable('page', 'customer-details');
$create_new_customer_location->set_get_variable('page', 'create-new-account');
$create_new_customer_location->set_get_variable('type', 'html');

if (isset($_GET['return_to'])) {
	$create_new_customer_location->set_get_variable(
		'return_to', $_GET['return_to']);
}

$create_new_customer_link->set_href($create_new_customer_location);

$create_new_customer_div->append_tag_to_content($create_new_customer_link);

echo $create_new_customer_div->get_as_string();
?>
