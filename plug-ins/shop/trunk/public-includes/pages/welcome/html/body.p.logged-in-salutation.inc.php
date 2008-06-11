<?php
/**
 * The Salutation that is offered to a customer if they are logged in.
 *
 * @copyright Clear Line Web Design, 2007-07-26
 */

$if_logged_in_message_txt = <<<TXT
Hello&nbsp;
TXT;

$customer = $log_in_manager->get_customer();

$if_logged_in_message_txt .= $customer->get_full_name();
$if_logged_in_message_p = new HTMLTags_P($if_logged_in_message_txt);

echo $if_logged_in_message_p->get_as_string();
?>
