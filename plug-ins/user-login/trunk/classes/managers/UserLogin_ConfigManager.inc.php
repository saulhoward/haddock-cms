<?php
/**
 * UserLogin_ConfigManager
 *
 * @copyright 2010-03-19, SANH
 */

class
UserLogin_ConfigManager
extends
HaddockProjectOrganisation_ConfigManager
{
    protected function
        get_module_prefix_string()
    {
        return '/plug-ins/user-login/';
    }

    public function
        get_login_page_class_name()
    {
        return trim(
            $this->get_config_value('page-classes/login')
        );
    }

    public function
        get_password_rest_confirmation_page_class_name()
    {
        return trim(
            $this->get_config_value('page-classes/password-reset-confirmation')
        );
    }

    public function
        get_password_reset_email_reply_address()
    {
        return trim(
            $this->get_config_value('email/password-reset-email/reply-to-address')
        );
    }

    public function
        get_password_reset_email_subject()
    {
        return trim(
            $this->get_config_value('email/password-reset-email/subject')
        );
    }

    public function
        get_password_reset_email_message(
            $email,
            $new_password
        )
    {
        $body = $this->get_config_value('email/password-reset-email/body');
        $body = str_replace('$email', $email, $body);
        $body = str_replace('$new_password', $new_password, $body);
        return $body;
    }
}
?>
