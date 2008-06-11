<?php
$log_in_manager = Shop_LogInManager::get_instance();

$login_form_div = $log_in_manager->get_login_form_div();
echo $login_form_div->get_as_string();
?>
