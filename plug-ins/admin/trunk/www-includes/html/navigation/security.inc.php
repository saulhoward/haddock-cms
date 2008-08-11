<?php
/**
 * Security restrictions for the navigation page.
 *
 * @copyright Clear Line Web Design, 2007-08-19
 */

$alm = Admin_LoginManager::get_instance();

//echo 'print_r($alm)' . "\n";
//print_r($alm);
//echo '$_SESSION[\'admin-login-data\']' . "\n";
//print_r($_SESSION['admin-login-data']);
//echo 'print_r($_SESSION[\'admin-login-manager\'])' . "\n";
//print_r($_SESSION['admin-login-manager']);
//exit;

if (!$alm->is_logged_in()) {
    $redirection_manager = new PublicHTML_RedirectionManager();

    $redirection_url = $redirection_manager->get_url();
    
    $redirection_url->set_file('/hc/admin/login.html');
    
    $location_header_line = 'Location: ' . $redirection_url->get_as_string();
    
    //echo "\$location_header_line: $location_header_line\n";
    //exit;
    
    header($location_header_line);
    exit;
}
?>
