<?php
/**
 * The text that is given to the customer if they are logged in that
 * tells them how to log out.
 *
 * @copyright Clear Line Web Design, 2007-08-21
 */

$text = <<<TXT
You are already logged in.
Perhaps you'd like to log out and log in again as someone else...
If so, please click below.
TXT;

$p = new HTMLTags_P($text);

echo $p->get_as_string();
?>
