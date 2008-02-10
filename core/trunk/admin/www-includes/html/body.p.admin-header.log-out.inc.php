<?php
/**
 * Link to the log out script of a page in the admin section.
 *
 * @copyright Clear Line Web Design, 2007-08-22
 */

$log_out_p = new HTMLTags_P();
$log_out_p->set_attribute_str('id', 'log_out');

$alm = Admin_LoginManager::get_instance();

$log_out_p->append_tag_to_content($alm->get_log_out_a());

echo $log_out_p->get_as_string();
?>
