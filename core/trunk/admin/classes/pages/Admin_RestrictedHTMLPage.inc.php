<?php
/**
 * Subclasses of this page can only be accessed once a user
 * name and password have been entered and accepted.
 *
 * @copyright Clear Line Web Design, 2007-12-12
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
			
			$_SESSION['admin-login-data']['desired-url']->set_file('/hc/admin/navigation.html');
			
			$redirection_manager = new PublicHTML_RedirectionManager();
			$redirection_url = $redirection_manager->get_url();
			
			$redirection_url->set_file('/hc/admin/login.html');
			
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
		
		#$pdf = HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();
		#$pd = $pdf->get_project_directory_for_this_project();
		#
		#$anxf = $pd->get_admin_navigation_xml_file();
		#
		#$site_map_ul = new Admin_SiteMapUL($anxf);
		#
		#$navigation_div->append_tag_to_content($site_map_ul);
		
		ob_start();
		require PROJECT_ROOT
			. '/haddock/admin/www-includes/html/'
			. 'body.div.nav-or-error-msg.inc.php';
		$str = ob_get_clean();
		$navigation_div->append_str_to_content($str);
		
		echo $navigation_div->get_as_string();
	}
}
?>