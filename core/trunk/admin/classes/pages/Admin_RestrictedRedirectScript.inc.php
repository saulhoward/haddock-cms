<?php
/**
 * Admin_RestrictedRedirectScript
 * 
 * @copyright 2007-12-18, RFI
 */

abstract class
	Admin_RestrictedRedirectScript
extends
	PublicHTML_RedirectScript
{
	/**
	 * This where we check whether the user is logged in or not.
	 *
	 * This has been copied directly from Admin_RestrictedHTMLPage.
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
		$alm = Admin_LoginManager::get_instance();
		
		if (!$alm->is_logged_in()) {
			$_SESSION['admin-login-data']['desired-url'] = new HTMLTags_URL();
			
//                        $_SESSION['admin-login-data']['desired-url']->set_file('/hc/admin/navigation.html');
			$_SESSION['admin-login-data']['desired-url']->set_file('/Admin_StartPage');
			
			$redirection_manager = new PublicHTML_RedirectionManager();
			$redirection_url = $redirection_manager->get_url();
			
			$redirection_url->set_file('/hc/admin/login.html');
			
			$location_header_line = 'Location: ' . $redirection_url->get_as_string();
			
			header($location_header_line);
			exit;
		}
	}
}
?>
