<?php
/**
 * @copyright Clear Line Web Design, 2007-12-12
 */

class
UserLogin_LoginPage
extends
PublicHTML_HTMLPage
{
    public function
        content()
    {
        $div = new HTMLTags_Div();
        $div->append($this->get_error_message_div());
        $div->append($this->get_login_div());
        echo $div->get_as_string();

    }

    public function
        get_login_div()
    {
        return UserLogin_DisplayHelper::get_login_div()->get_as_string();
    }

    public function
        get_error_message_div()
    {
        return UserLogin_DisplayHelper::get_error_message_div()->get_as_string();
    }
}
?>
