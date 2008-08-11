<?php
/**
 * Security for the admin pages.
 *
 * @copyright Clear Line Web Design, 2007-08-06
 */

$admin_login_manager = Admin_LoginManager::get_instance();

if (!$admin_login_manager->is_logged_in()) {
    $page_manager =  PublicHTML_PageManager::get_instance();
    
    unset($_SESSION['admin-login-data']);
    
    #$_SESSION['admin-login-data']['desired-url'] = $page_manager->get_script_uri();
    $script_uri = $page_manager->get_script_uri();
    
    $desired_uri = new HTMLTags_URL();
    $desired_uri->set_file('/');
    
    foreach (array_keys($_GET) as $key) {
        $desired_uri->set_get_variable($key, $_GET[$key]);
    }
    
    $suggv = $script_uri->get_get_variables();
    foreach (array_keys($suggv) as $key) {
        $desired_uri->set_get_variable($key, $suggv[$key]);
    }
    
    //$_SESSION['admin-login-data']['desired-url'] = '/';
    //
    //$first = TRUE;
    //foreach (array_keys($desired_get_vars) as $key) {
    //    if ($first) {
    //        $first = FALSE;
    //    } else {
    //        $_SESSION['admin-login-data']['desired-url'] = '&';
    //    }
    //    
    //    $_SESSION['admin-login-data']['desired-url'] = $key . '=' . $desired_get_vars[$key];
    //}
    $_SESSION['admin-login-data']['desired-url'] = $desired_uri;
    
    $login_url = $admin_login_manager->get_login_url();
    
    $login_url_str = $login_url->get_as_string();
    
    header("Location: $login_url_str");
    exit;
}
?>
