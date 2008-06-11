<?php
/**
 * Takes the user to a page where they can request for their password to be
 * reset and a new password be sent to their email address.
 *
 * @copyright Clear Line Web Design, 2007-08-21
 */

$log_in_manager = Shop_LogInManager::get_instance();

$password_reset_confirmation_url = $log_in_manager->get_password_reset_confirmation_url();

$password_reset_confirmation_a = new HTMLTags_A('Forgotten your password?');
$password_reset_confirmation_a->set_href($password_reset_confirmation_url);

echo $password_reset_confirmation_a->get_as_string();
?>
