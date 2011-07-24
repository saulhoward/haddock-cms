<?php
/**
 * UserLogin_URLHelper
 *
 * @copyright 2010-03-26, SANH
 */

class
UserLogin_URLHelper
{
    public static function
        get_url_for_string($string)
    {
        $url = new HTMLTags_URL();
        $url->set_file($string);
        return $url;
    }

    public static function
        get_log_out_return_to_page_url()
    {
        return PublicHTML_URLHelper
            ::get_oo_page_url(
                self::get_config_manager()->get_log_out_return_to_page_class_name()
            );
    }

    public static function
        get_login_page_url()
    {
        $cmf = HaddockProjectOrganisation_ConfigManagerFactory::get_instance();
        $config_manager = 
            $cmf->get_config_manager('plug-ins', 'user-login');
        $login_page_class_name= $config_manager->get_login_page_class_name();

        // print_r($login_page_class_name);exit;
        return PublicHTML_URLHelper
            ::get_oo_page_url(
        $login_page_class_name
            );
                // self::get_config_manager()->get_login_page_class_name()
    }

    public static function
        get_config_manager()
    {
        $cmf = HaddockProjectOrganisation_ConfigManagerFactory::get_instance();
        return $cmf->get_config_manager('plug-ins', 'user-login');
    }

    public static function
        get_password_reset_confirmation_url()
    {
        return PublicHTML_URLHelper
            ::get_oo_page_url(
                self::get_config_manager()->get_password_rest_confirmation_page_class_name()
            );
    }

    public static function
        get_login_redirect_script_url()
    {
        return PublicHTML_URLHelper
            ::get_oo_page_url(
                'UserLogin_LoginRedirectScript'
            );
    }

    public static function
        get_login_redirect_script_url_for_login()
    {
        $url = self::get_login_redirect_script_url();
        $url->set_get_variable("login", 1);
        return $url;
    }

    public static function
        get_login_redirect_script_url_for_cancel()
    {
        $url = self::get_login_redirect_script_url();
        $url->set_get_variable("clear-form", 1);
        return $url;
    }

    public static function
        get_password_reset_redirect_script_url()
    {
        return PublicHTML_URLHelper
            ::get_oo_page_url(
                'UserLogin_PasswordResetRedirectScript'
            );
    }

    public static function
        get_log_out_redirect_script_url()
    {
        return PublicHTML_URLHelper
            ::get_oo_page_url(
                'UserLogin_LogOutRedirectScript'
            );
    }

    public static function
        get_registration_page_url()
    {
        return PublicHTML_URLHelper
            ::get_oo_page_url(
                self::get_config_manager()->get_registration_page_class_name()
            );
    }

    public static function
        get_account_page_url()
    {
        return PublicHTML_URLHelper
            ::get_oo_page_url(
                self::get_config_manager()->get_account_page_class_name()
            );
    }
    public static function
        get_account_page_url_for_new_accounts()
    {
        $url = self::get_account_page_url();
        $url->set_get_variable("new_account", 1);
        return $url;
    }

}
?>
