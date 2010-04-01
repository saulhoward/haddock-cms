<?php
/**
 * UserLogin_LogOutRedirectScript
 *
 * @copyright 2009-06-13, Saul Howard
 */


class
UserLogin_LogOutRedirectScript
extends
UserLogin_RestrictedRedirectScript                                                                                                          
{
    protected function
        do_actions() 
    {
        $return_url = $this->get_log_out_redirect_script_return_url();
        $alm = UserLogin_LoginManager::get_instance();

        if ($alm->is_logged_in()) {
            $alm->log_out();
        }
        $this->set_return_to_url($return_url);
    }

    private function     
        get_log_out_redirect_script_return_url()     
    {
        return UserLogin_URLHelper::get_log_out_return_to_page_url();     
    }
}       
?> 
