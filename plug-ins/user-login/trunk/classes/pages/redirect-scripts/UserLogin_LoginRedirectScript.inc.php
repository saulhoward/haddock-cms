<?php
/**
 * UserLogin_LoginRedirectScript
 *
 * @copyright 2009-06-13, Saul Howard
 */


class
UserLogin_LoginRedirectScript
extends
PublicHTML_RedirectScript                                                                                                          
{
    protected function
        do_actions() 
    {
        //print_r($_POST);exit;

        $return_url = $this->get_default_redirect_script_return_url();

        if (isset($_GET['login'])) {
            $admin_login_manager = UserLogin_LoginManager::get_instance();

            if (isset($_POST['name']) && (strlen($_POST['name']) > 0)) {
                $_SESSION['user-login-data']['name'] = $_POST['name'];

                if (isset($_POST['password']) && (strlen($_POST['password']) > 0)) {
                    try {
                        $admin_login_manager->log_in($_POST['name'], $_POST['password']);

                        unset($_SESSION['user-login-data']['error-message']);

                        if (isset($_SESSION['user-login-data']['desired-url'])) {
                            $return_url = UserLogin_URLHelper::
                                get_url_for_string($_SESSION['user-login-data']['desired-url']);
                        }
                    } catch (HaddockProjectOrganisation_LoginException $e) {
                        $_SESSION['user-login-data']['error-message'] = $e->getMessage();
                    }
                } else {
                    $_SESSION['user-login-data']['error-message'] = 'Your password must be entered!';
                }
            } else {
                $_SESSION['user-login-data']['error-message'] = 'Your username must be entered!';
            }
        }

        if (isset($_GET['clear-form'])) {
            unset($_SESSION['user-login-data']['name']);
            unset($_SESSION['user-login-data']['error-message']);
        }

        $this->set_return_to_url($return_url);
    }

    private function     
        get_default_redirect_script_return_url()     
    {
        return UserLogin_URLHelper::get_login_page_url();     
    }
}       
?> 
