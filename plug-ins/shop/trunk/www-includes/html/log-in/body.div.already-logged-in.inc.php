<?php
/**
 * A div that is displayed if the customer is already logged into a shop.
 *
 * @copyright Clear Line Web Design, 2007-08-21
 */

$log_in_manager = Shop_LogInManager::get_instance();

$already_logged_in_div = new HTMLTags_Div();
$already_logged_in_div->set_attribute_str('id', 'already_logged_in_div');
// Already logged in
// You are logged in as Mr. X.
$p_text = <<<TXT
You are logged in as&nbsp;
TXT;

$p_text .=  '&#39;' . $log_in_manager->get_name() . '&#39;';

$already_logged_in_div->append_tag_to_content(new HTMLTags_P($p_text));

echo $already_logged_in_div->get_as_string();
?>
