<?php
/**
 * The div with the link to the log-out redirect script.
 *
 * @copyright Clear Line Web Design, 2007-09-24
 */

$log_in_manager = Shop_LogInManager::get_instance();

$log_out_url = $log_in_manager->get_log_out_url();

$log_out_a = new HTMLTags_A('Log Out');
$log_out_a->set_href($log_out_url);

echo $log_out_a->get_as_string();

?>
