<?php
/**
 * UserLogin_RestrictedRedirectScript
 * 
 * @copyright 2007-12-18, RFI
 */

abstract class
UserLogin_RestrictedRedirectScript
extends
PublicHTML_RedirectScript
{
    /**
     * This where we check whether the user is logged in or not.
     *
     * This has been copied directly from UserLogin_RestrictedHTMLPage.
     *
     * Delegation refactoring, anyone?
     */
    public function
        send_http_headers()
    {
        parent::send_http_headers();

        /*
         * Make sure that the user is logged in.
         */
        $alm = UserLogin_LoginManager::get_instance();

        if (!$alm->is_logged_in()) {
            $_SESSION['user-login-data']['desired-url'] = new HTMLTags_URL();

            $_SESSION['user-login-data']['desired-url']->set_file('/');

            $redirection_manager = new PublicHTML_RedirectionManager();
            $redirection_url = $redirection_manager->get_url();

            $redirection_url->set_file('/');

            $location_header_line = 'Location: ' . $redirection_url->get_as_string();

            header($location_header_line);
            exit;
        }
    }
}
?>
