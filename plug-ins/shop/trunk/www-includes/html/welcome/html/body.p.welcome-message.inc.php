<?php
/**
 * The welcome message given to all clients.
 * 
 * @copyright Clear Line Web Design, 2007-07-26
 */

$welcome_message_txt = <<<TXT
Welcome to our shop!
TXT;

$welcome_message_p = new HTMLTags_P($welcome_message_txt);

$welcome_message_p->set_attribute_str('id', 'welcome_message');

echo $welcome_message_p->get_as_string();
?>
