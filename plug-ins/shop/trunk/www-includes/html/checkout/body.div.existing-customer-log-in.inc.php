<?php
/**
 * Give the customer a chance to create a new account.
 *
 * @copyright Clear Line Web Design, 2007-09-21
 */

$existing_customer_log_in_div = new HTMLTags_Div();
$existing_customer_log_in_div->set_attribute_str('id', 'existing_customer_log_in_div');

$existing_customer_log_in_p_text = <<<TXT
If you already have a password, please log in here:
TXT;

$existing_customer_log_in_div->append_tag_to_content(new HTMLTags_P($existing_customer_log_in_p_text));

$existing_customer_log_in_link = new HTMLTags_A('Existing Customer Log In');

$existing_customer_log_in_link->set_attribute_str('class', 'cool_button');
$existing_customer_log_in_link->set_attribute_str('id', 'existing_customer_log_in_button');

$existing_customer_log_in_location = new HTMLTags_URL();

$existing_customer_log_in_location->set_file('/');

$existing_customer_log_in_location->set_get_variable('section', 'plug-ins');
$existing_customer_log_in_location->set_get_variable('module', 'shop');
$existing_customer_log_in_location->set_get_variable('page', 'log-in');
$existing_customer_log_in_location->set_get_variable('type', 'html');

if (isset($_GET['return_to'])) {
	$existing_customer_log_in_location->set_get_variable('return_to', $_GET['return_to']);
}

$existing_customer_log_in_link->set_href($existing_customer_log_in_location);

$existing_customer_log_in_div->append_tag_to_content($existing_customer_log_in_link);

echo $existing_customer_log_in_div->get_as_string();
?>
