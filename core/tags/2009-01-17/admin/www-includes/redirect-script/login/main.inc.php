<?php
/**
 * The redirect script for the login page for the admin section.
 *
 * @copyright Clear Line Web Design, 2007-08-06
 */

#header('Content-type: text/plain');
#
#echo 'print_r($_GET)' . "\n";
#print_r($_GET);
#echo 'print_r($_POST)' . "\n";
#print_r($_POST);
##exit;
#echo '$_SESSION[\'admin-login-data\']' . "\n";
#print_r($_SESSION['admin-login-data']);
#exit;

if (isset($_GET['login'])) {
    $admin_login_manager = Admin_LoginManager::get_instance();
    
    if (isset($_POST['name']) && (strlen($_POST['name']) > 0)) {
        $_SESSION['admin-login-data']['name'] = $_POST['name'];
        
        if (isset($_POST['password']) && (strlen($_POST['password']) > 0)) {
            try {
                $admin_login_manager->log_in($_POST['name'], $_POST['password']);
                
                unset($_SESSION['admin-login-data']['error-message']);
                unset($_SESSION['admin-login-data']['name']);
                
                $page_manager = PublicHTML_PageManager::get_instance();
                if (isset($_SESSION['admin-login-data']['desired-url'])) {
                    $page_manager->set_return_to_url($_SESSION['admin-login-data']['desired-url']);
                } else {
//                    $page_manager->set_return_to_url(new HTMLTags_URL('/hc/admin/navigation.html'));
                    $page_manager->set_return_to_url(new HTMLTags_URL('/Admin_StartPage'));
                }
            } catch (HaddockProjectOrganisation_LoginException $e) {
				#echo 'print_r($e): ' . "\n";
				#print_r($e);
				#exit;
				
                $_SESSION['admin-login-data']['error-message'] = $e->getMessage();
            }
        } else {
            $_SESSION['admin-login-data']['error-message'] = 'Your password must be entered!';
        }
    } else {
        $_SESSION['admin-login-data']['error-message'] = 'Your username must be entered!';
    }
}

if (isset($_GET['clear-form'])) {
    unset($_SESSION['admin-login-data']['name']);
    unset($_SESSION['admin-login-data']['error-message']);
}

#echo '$_SESSION[\'admin-login-data\']' . "\n";
#print_r($_SESSION['admin-login-data']);
#
#echo 'print_r($page_manager): ' . "\n";
#print_r($page_manager);
#
#exit;
?>
