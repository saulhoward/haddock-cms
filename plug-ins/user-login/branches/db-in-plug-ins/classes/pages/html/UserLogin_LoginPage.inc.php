<?php
/**
 * all of these pages are just examples
 * to be copied with proj-spec pages of your own devising
 *
 * @copyright SANH, 2010-03-31
 */

class
UserLogin_LoginPage
extends
UserLogin_HTMLPage
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
        return UserLogin_DisplayHelper::get_login_div();
    }

}
?>
