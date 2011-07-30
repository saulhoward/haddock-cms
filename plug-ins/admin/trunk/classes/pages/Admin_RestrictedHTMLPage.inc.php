<?php
/**
 * Subclasses of this page can only be accessed once a user
 * name and password have been entered and accepted.
 *
 * @copyright Clear Line Web Design, 2007-12-12
 * @copyright 2009-10-08, Robert Impey
 */

abstract class
	Admin_RestrictedHTMLPage
extends
	Admin_HTMLPage
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
		$alm = Admin_LoginManager::get_instance();
		
		if (!$alm->is_logged_in()) {
			$_SESSION['admin-login-data']['desired-url'] = new HTMLTags_URL();
			$_SESSION['admin-login-data']['desired-url']->set_file('/Admin_StartPage');
			
			$redirection_manager = new PublicHTML_RedirectionManager();
			$redirection_url = $redirection_manager->get_url();
			
			$redirection_url->set_file('/admin.html');
			
			$location_header_line = 'Location: ' . $redirection_url->get_as_string();
			
			header($location_header_line);
			exit;
		}
	}
	
	public function
		render_body_div_navigation()
	{
		$navigation_div = new HTMLTags_Div();
		$navigation_div->set_attribute_str('id', 'navigation');
		
		ob_start();
		
		require PROJECT_ROOT
			. '/plug-ins/admin/www-includes/html/'
			. 'body.div.nav-or-error-msg.inc.php';
		
		$str = ob_get_clean();
		$navigation_div->append_str_to_content($str);
		
		echo $navigation_div->get_as_string();
	}
}
?>
