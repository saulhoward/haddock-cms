<?php
/**
 * A div that is displayed if the customer is not logged into a shop.
 *
 * @copyright Clear Line Web Design, 2007-08-21
 */

$not_logged_in_div = new HTMLTags_Div();
$not_logged_in_div->set_attribute_str('id', 'not_logged_in_div');
// Already logged in
// You are logged in as Mr. X.
$p_text = <<<TXT
You are not logged in. Therefore, you cannot manage your account.
TXT;

$not_logged_in_div->append_tag_to_content(new HTMLTags_P($p_text));

echo $not_logged_in_div->get_as_string();
?>
