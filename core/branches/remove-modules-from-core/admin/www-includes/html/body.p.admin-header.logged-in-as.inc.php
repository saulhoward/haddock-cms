<?php
/**
 * Link to the log out script of a page in the admin section.
 *
 * @copyright Clear Line Web Design, 2007-08-23
 */

$logged_in_as_p = new HTMLTags_P();
$logged_in_as_p->set_attribute_str('id', 'logged_in_as');

$alm = Admin_LoginManager::get_instance();

$logged_in_as_p->append_str_to_content('<em>User:</em> ' . $alm->get_name());

$logged_in_as_p->append_str_to_content('&nbsp;');

$logged_in_as_p->append_str_to_content('<em>Type:</em> ' . $alm->get_type());

echo $logged_in_as_p->get_as_string();
?>
