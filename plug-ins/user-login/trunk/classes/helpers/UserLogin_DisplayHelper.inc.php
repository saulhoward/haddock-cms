<?php
/**
 * UserLogin_DisplayHelper
 *
 * @copyright 2010-03-26, SANH
 */

class
UserLogin_DisplayHelper
{
    public static function
        get_login_div()
    {
        $user_login_manager = UserLogin_LoginManager::get_instance();

        $div = new HTMLTags_Div();
        $div->set_attribute_str('id', 'login');

        if ($user_login_manager->is_logged_in()) {
            $div->append(new HTMLTags_P('You are already logged in.'));
        } else {
            $div->append(
                $user_login_manager->get_login_form_div(
                    isset($_SESSION['user-login-data']['name'])
                    ? $_SESSION['user-login-data']['name'] : NULL
                )
            );
        }

        return $div;
    }

    public static function
        get_error_message_div()
    {
        $div = new HTMLTags_Div();
        $div->set_attribute_str('class', 'error');
        if (isset($_SESSION['user-login-data']['error-message'])) {
            $div->append(new HTMLTags_P($_SESSION['user-login-data']['error-message']));
        }
        return $div;
    }

}
?>
