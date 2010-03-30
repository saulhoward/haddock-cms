<?php
/**
 * Subclasses of this page can only be accessed once a user
 * name and password have been entered and accepted.
 *
 * @copyright Clear Line Web Design, 2007-12-12
 */

abstract class
	UserLogin_RestrictedHTMLPage
extends
	PublicHTML_HTMLPage
{
	/**
	 * This where we check whether the user is logged in or not.
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
