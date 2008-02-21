<?php
/**
 * Security restrictions for the admin-includer page.
 *
 * @copyright Clear Line Web Design, 2007-08-19
 */

$alm = Admin_LoginManager::get_instance();

if (!$alm->is_logged_in()) {
    $_SESSION['admin-login-data']['desired-url'] = new HTMLTags_URL();
    
    $_SESSION['admin-login-data']['desired-url']->set_file('/hc/admin/navigation.html');
    
    $redirection_manager = new PublicHTML_RedirectionManager();

    $redirection_url = $redirection_manager->get_url();
    
    $redirection_url->set_file('/hc/admin/login.html');
    
    $location_header_line = 'Location: ' . $redirection_url->get_as_string();
    
    header($location_header_line);
    exit;
}
?>
