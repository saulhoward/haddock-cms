<?php
/**
 * Base class for UserLogin pages
 *
 * all of these pages are just examples
 * to be copied with proj-spec pages of your own devising
 *
 * @copyright SANH, 2010-03-31
 */

abstract class
UserLogin_HTMLPage
extends
PublicHTML_HTMLPage
{
    public function
        get_error_message_div()
    {
        return UserLogin_DisplayHelper::get_error_message_div();
    }

    public function
        get_login_status_div()
    {
        return UserLogin_DisplayHelper::get_login_status_div();
    }
}
?>
