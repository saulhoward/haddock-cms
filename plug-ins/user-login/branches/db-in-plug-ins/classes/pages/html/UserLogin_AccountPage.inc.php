<?php
/**
 * all of these pages are just examples
 * to be copied with proj-spec pages of your own devising
 *
 * @copyright SANH, 2010-03-31
 */

class
UserLogin_AccountPage
extends
UserLogin_RestrictedHTMLPage
{
    public function
        content()
    {
        $div = new HTMLTags_Div();
        $div->append($this->get_log_out_div());
        $div->append($this->get_error_message_div());
        $div->append($this->get_account_div());
        echo $div->get_as_string();

    }

    public function
        get_account_div()
    {
        return UserLogin_DisplayHelper::
            get_account_div(
                $this->get_logged_in_user()
            )->get_as_string();
    }

}
?>
