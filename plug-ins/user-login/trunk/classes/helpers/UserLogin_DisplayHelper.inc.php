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
        get_login_status_div()
    {
        $user_login_manager = UserLogin_LoginManager::get_instance();

        $div = new HTMLTags_Div();
        $div->set_attribute_str('id', 'login-status');
        $ul = new HTMLTags_UL();

        if (!$user_login_manager->is_logged_in()) {
            $login_li = new HTMLTags_LI();
            $login_url = UserLogin_URLHelper::get_login_page_url();
            $login_a = new HTMLTags_A('Login');
            $login_a->set_href($login_url);
            $login_li->append($login_a);
            $ul->append($login_li);

            $register_li = new HTMLTags_LI();
            $register_url = UserLogin_URLHelper::get_registration_page_url();
            $register_a = new HTMLTags_A('Register');
            $register_a->set_href($register_url);
            $register_li->append($register_a);
            $ul->append($register_li);


        } else {
            $name_li = new HTMLTags_LI();
            $name_li->set_attribute_str('id', 'user-name');
            $name_li->append(
                $user_login_manager->get_name()
            );
            $ul->append($name_li);
 
            $log_out_li = new HTMLTags_LI();
            $log_out_li->append(
                $user_login_manager->get_log_out_a()
            );
            $ul->append($log_out_li);
        }

        $div->append($ul);
        return $div;
    }


    public static function
        get_log_out_div()
    {
        $user_login_manager = UserLogin_LoginManager::get_instance();

        $div = new HTMLTags_Div();
        $div->set_attribute_str('id', 'log-out');

        if (!$user_login_manager->is_logged_in()) {
            $div->append(new HTMLTags_P('You are not yet logged in.'));
        } else {
            $div->append(
                $user_login_manager->get_log_out_a()
            );
        }

        return $div;
    }


    public static function
        get_error_message_div()
    {
        $div = new HTMLTags_Div();
        if (isset($_SESSION['user-login-data']['error-message'])) {
            $div->append(new HTMLTags_P($_SESSION['user-login-data']['error-message']));
        } 
        if (isset($_GET['error_message'])) {
            $div->set_attribute_str('class', 'error');
            $div->append(new HTMLTags_P($_GET['error_message']));
        }
        return $div;
    }

    public static function
        get_registration_div()
    {
        return self::get_registration_div_with_extra_line(NULL);
    }

    public static function
        get_registration_div_with_captcha(
           $captcha_html 
       )
    {
        return self::get_registration_div_with_extra_line('<li>' . $captcha_html . '</li>');

    }

    public static function
        get_registration_div_with_extra_line(
            $extra_li = NULL
        )
    {
        $div = new HTMLTags_Div();
        $div->set_attribute_str('class', 'registration');

        $svm = Caching_SessionVarManager::get_instance();
        if ($svm->is_set('manage-users-form: name')) $name = $svm->get('manage-users-form: name');
        if ($svm->is_set('manage-users-form: email')) $email = $svm->get('manage-users-form: email');
        if ($svm->is_set('manage-users-form: real_name')) $real_name = $svm->get('manage-users-form: real_name');
        // print_r($_SESSION);exit;
        

        $form = <<<HTML
<form 
  name = "registration"
  method = "POST"
  class = "basic-form"
  id = "registration-form"
  action = "/?oo-page=1&page-class=UserLogin_ManageUsersRedirectScript&add-new-user=1"
>
<fieldset>
<legend>Register</legend> 

    <ul>
        <li>
            <label for="email" >Email</label> 
            <input 
            type = "text"
            id = "email"
            name = "email"
            value = "$email"
            /> 
        </li>
        <li>
            <label for="name" >Username</label> 
            <input 
            type = "text"
            id = "name"
            name = "name"
            value = "$name"
            /> 
        </li>
        <li>
            <label for="real_name" >Real Name</label> 
            <input 
            type = "text"
            id = "real_name"
            name = "real_name"
            value = "$real_name"
            /> 
        </li>
        <li>
            <label for="password" >Password</label> 
            <input 
            type = "password"
            id = "password"
            name = "password"
            /> 
        </li>
        <li>
            <label for="confirm_password" >Repeat Password</label> 
            <input 
            type = "password"
            id = "confirm_password"
            name = "confirm_password"
            /> 
        </li>
HTML;

        if (!is_null($extra_li)) {
            $form .= "\n" . $extra_li . "\n";
        }

        $form .= <<<HTML
    </ul>
    <div class="submit_buttons_div">
        <input 
        type = "submit"
        value = "Register"
        class = "submit"
        /> 
    </div>
</fieldset>
</form>

HTML;

        $div->append($form);
        return $div;
    }

    public static function
        get_account_div(
            $user_name
        )
    {
        $div = new HTMLTags_Div();
$html = <<<HTML
<p>Welcome $user_name.</p>

HTML;

        $div->append($html);
        return $div;
    }

}
?>
