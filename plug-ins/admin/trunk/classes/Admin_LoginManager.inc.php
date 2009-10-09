<?php
/**
 * Admin_LoginManager
 *
 * @copyright 2007-08-06, RFI
 */

class
	Admin_LoginManager
extends
	HaddockProjectOrganisation_LoginManager
{
	private function
		__construct()
	{
		#echo "Top of Admin_LoginManager::__construct()\n";
		
		#$_SESSION['admin-login-data']['logged-in'] = FALSE;
		#$this->set_logged_in(FALSE);
	}
	
	public static function
		get_instance()
	{
		//if (!isset($_SESSION['admin-login-manager'])) {
		//    $_SESSION['admin-login-manager'] = new Admin_LoginManager();
		//}
		//
		//return $_SESSION['admin-login-manager'] = new Admin_LoginManager();
		
		$svm = Caching_SessionVarManager::get_instance();
		
		if (!$svm->is_set('admin-login-manager')) {
			$svm->set('admin-login-manager', new Admin_LoginManager());
		}
		
		#return $_SESSION['admin-login-manager'] = new Admin_LoginManager();
		return $svm->get('admin-login-manager');
	}
	
	/*
	 * Functions to do with the log in state.
	 */
	
	protected function
		set_logged_in_session_variable()
	{
		//echo "Top of Admin_LoginManager::set_logged_in_session_variable()\n";
		//exit;
		
		#$_SESSION['admin-login-data']['logged-in'] = TRUE;
		#$_SESSION['admin-login-data']['logged-in'] = 1;
		
		$svm = Caching_SessionVarManager::get_instance();
		
		if ($svm->is_set('admin-login-data')) {
			$admin_login_data = $svm->get('admin-login-data');
		} else {
			$admin_login_data = array();
		}
		
		$admin_login_data['logged-in'] = TRUE;
		$svm->set('admin-login-data', $admin_login_data);
		
		//echo "Bottom of Admin_LoginManager::set_logged_in_session_variable()\n";
		//echo '$_SESSION[\'admin-login-data\']' . "\n";
		//print_r($_SESSION['admin-login-data']);
		//exit;
	}

	protected function
		unset_logged_in_session_variable()
	{
		#$_SESSION['admin-login-data']['logged-in'] = FALSE;
		#unset($_SESSION['admin-login-data']);
		
		$svm = Caching_SessionVarManager::get_instance();
		$svm->delete('admin-login-data');
	}
	
	public function
		is_logged_in()
	{
		$svm = Caching_SessionVarManager::get_instance();
		
		if ($svm->is_set('admin-login-data')) {
			$admin_login_data = $svm->get('admin-login-data');
			
			return
				isset($admin_login_data['logged-in'])
				&&
				$admin_login_data['logged-in'];
		}
		
		return FALSE;
	}
	
	//public function
	//    get_name()
	//{
	//    if ($this->is_logged_in()) {
	//        return $_SESSION['admin-login-data']['name'];
	//    } else {
	//        throw new Exception('Name requested for Admin_LoginManager when not logged in!');
	//    }
	//}
	
	/*
	 * Functions to do with URLs of pages and scripts.
	 *
	 * The admin module has been moved from the core to the plug-ins.
	 *
	 * The 'section' fields have be updated accordingly.
	 * RFI 2009-10-08
	 */
	
	public function
		get_login_url()
	{
		$login_url = new HTMLTags_URL();
		
		$login_url->set_file('/');
		
		# RFI 2009-10-08
		#$login_url->set_get_variable('section', 'haddock');
		$login_url->set_get_variable('section', 'plug-ins');
		
		$login_url->set_get_variable('module', 'admin');
		$login_url->set_get_variable('page', 'login');
		$login_url->set_get_variable('type', 'html');
		
		return $login_url;
	}
	
	public function
		get_login_script_url()
	{
		#$login_url = new HTMLTags_URL();
		
		/*
		 * Require HTTPS?
		 */
		
		#$login_url->set_file('/');
		#
		#$login_url->set_get_variable('section', 'haddock');
		#$login_url->set_get_variable('module', 'admin');
		#$login_url->set_get_variable('page', 'login');
		#$login_url->set_get_variable('type', 'redirect-script');
		#
		#$login_url->set_get_variable('login');
		
		#return $login_url;
		
		# RFI 2009-10-08
		#$login_url = PublicHTML_URLHelper
		#	::get_pm_page_url(
		#		'login',
		#		'redirect-script',
		#		'haddock',
		#		'admin'
		#	);
		$login_script_url = PublicHTML_URLHelper
			::get_pm_page_url(
				'login',
				'redirect-script',
				'plug-ins',
				'admin'
			);
			
		$login_script_url->set_get_variable('login');
		
		return $login_script_url;
	}
	
	public function
		get_login_cancel_url()
	{
		$login_cancel_url = new HTMLTags_URL();
		
		$login_cancel_url->set_file('/');
		
		# RFI 2009-10-08
		#$login_url->set_get_variable('section', 'haddock');
		$login_cancel_url->set_get_variable('section', 'plug-ins');
		
		$login_cancel_url->set_get_variable('module', 'admin');
		$login_cancel_url->set_get_variable('page', 'login');
		$login_cancel_url->set_get_variable('type', 'redirect-script');
		
		$login_cancel_url->set_get_variable('clear-form');
		
		return $login_cancel_url;
	}
	
	public function
		get_password_reset_confirmation_url()
	{
		$password_reset_confirmation_url = new HTMLTags_URL();
		
		$password_reset_confirmation_url->set_file('/');
		
		# RFI 2009-10-08
		#$login_url->set_get_variable('section', 'haddock');
		$password_reset_confirmation_url->set_get_variable('section', 'plug-ins');
		
		$password_reset_confirmation_url->set_get_variable('module', 'admin');
		$password_reset_confirmation_url->set_get_variable('page', 'password-reset-confirmation');
		$password_reset_confirmation_url->set_get_variable('type', 'html');
		
		return $password_reset_confirmation_url;
	}
	
	public function
		get_password_reset_script_url()
	{
		$password_reset_script_url = new HTMLTags_URL();
		
		$password_reset_script_url->set_file('/');
		
		# RFI 2009-10-08
		#$login_url->set_get_variable('section', 'haddock');
		$password_reset_script_url->set_get_variable('section', 'plug-ins');
		
		$password_reset_script_url->set_get_variable('module', 'admin');
		$password_reset_script_url->set_get_variable('page', 'password-reset');
		$password_reset_script_url->set_get_variable('type', 'redirect-script');
		
		return $password_reset_script_url;
	}
	
	public function
		get_log_out_url()
	{
		$log_out_url = new HTMLTags_URL();
		
		$log_out_url->set_file('/');
		
		# RFI 2009-10-08
		#$login_url->set_get_variable('section', 'haddock');
		$log_out_url->set_get_variable('section', 'plug-ins');
		
		$log_out_url->set_get_variable('module', 'admin');
		$log_out_url->set_get_variable('page', 'log-out');
		$log_out_url->set_get_variable('type', 'redirect-script');
		
		return $log_out_url;
	}
	
	/*
	 * Functions to do with the database.
	 */
	
	public function
		get_users_table()
	{
		$muf = Database_MySQLUserFactory::get_instance();
		$mu = $muf->get_for_this_project();
		$database = $mu->get_database();
		
		$admin_users_table = $database->get_table('hc_admin_users');
		
		return $admin_users_table;
	}
	
	/*
	 * ----------------------------------------
	 * Methods to do with the admin config file
	 * ----------------------------------------
	 */
	
	private function
		get_admin_config_file()
	{
		$pdf =
			HaddockProjectOrganisation_ProjectDirectoryFinder
				::get_instance();
		$pd = $pdf->get_project_directory_for_this_project();
		$psd = $pd->get_project_specific_directory();
		
		return $psd->get_config_file('haddock', 'admin');
	}
	
	/*
	 * ----------------------------------------
	 * Methods to do with data for resetting the users's password
	 * ----------------------------------------
	 */
	
	protected function
		get_password_reset_email_reply_address()
	{
		$config_file = $this->get_admin_config_file();
		
		return $config_file->get_password_reset_email_reply_address();
	}
	
	protected function
		get_password_reset_email_subject()
	{
		$config_file = $this->get_admin_config_file();
		
		return $config_file->get_password_reset_email_subject();		
	}
	
	protected function
		get_password_reset_email_message($email, $new_password)
	{
		$config_file = $this->get_admin_config_file();
		
		return
			$config_file
				->get_password_reset_email_message(
					$email,
					$new_password
				);
	}
}
?>