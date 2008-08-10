<?php
/**
 * If the user is already logged in, they should be redirected to the navigation page.
 *
 * @copyright Clear Line Web Design, 2007-08-23
 */

$alm = Admin_LoginManager::get_instance();

if ($alm->is_logged_in()) {
    $redirection_manager = new PublicHTML_RedirectionManager();
    
    $redirection_url = $redirection_manager->get_url();
    
    $redirection_url->set_file('/hc/admin/navigation.html');
    
    $location_header_line = 'Location: ' . $redirection_url->get_as_string();
    
    header($location_header_line);
    exit;
}

?>
