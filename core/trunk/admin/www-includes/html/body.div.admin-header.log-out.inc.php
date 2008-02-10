<?php
/**
 * Link to the log out script of a page in the admin section.
 *
 * @copyright Clear Line Web Design, 2007-08-22
 */

$log_out_div = new HTMLTags_Div();
$log_out_div->set_attribute_str('id', 'log_out');

$alm = Admin_LoginManager::get_instance();

$log_out_div->append_tag_to_content($alm->get_log_out_a());

echo $log_out_div->get_as_string();
?>
