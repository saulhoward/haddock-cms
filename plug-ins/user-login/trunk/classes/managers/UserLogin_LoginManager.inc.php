<?php
/**
 * UserLogin_LoginManager
 *
 * @copyright 2007-08-06, RFI
 * @copyright 2010-03-30, SANH
 */

class
	UserLogin_LoginManager
extends
	HaddockProjectOrganisation_LoginManager
{
	private function
		__construct()
	{
		#echo "Top of UserLoginLoginManager::__construct()\n";
		
		#$_SESSION['user-login-data']['logged-in'] = FALSE;
		#$this->set_logged_in(FALSE);
	}
	
	public static function
		get_instance()
	{
	
		$svm = Caching_SessionVarManager::get_instance();
		
		if (!$svm->is_set('user-login-manager')) {
			$svm->set('user-login-manager', new UserLogin_LoginManager());
		}
		
		return $svm->get('user-login-manager');
	}
	
	/*
	 * Functions to do with the log in state.
	 */
	
	protected function
		set_logged_in_session_variable()
	{
		//echo "Top of UserLoginLoginManager::set_logged_in_session_variable()\n";
		//exit;
		
		#$_SESSION['user-login-data']['logged-in'] = TRUE;
		#$_SESSION['user-login-data']['logged-in'] = 1;
		
		$svm = Caching_SessionVarManager::get_instance();
		
		if ($svm->is_set('user-login-data')) {
			$user_login_data = $svm->get('user-login-data');
		} else {
			$user_login_data = array();
		}
		
		$user_login_data['logged-in'] = TRUE;
		$svm->set('user-login-data', $user_login_data);
		
		//echo "Bottom of UserLoginLoginManager::set_logged_in_session_variable()\n";
		//echo '$_SESSION[\'user-login-data\']' . "\n";
		//print_r($_SESSION['user-login-data']);
		//exit;
	}

	protected function
		unset_logged_in_session_variable()
	{
		#$_SESSION['user-login-data']['logged-in'] = FALSE;
		#unset($_SESSION['user-login-data']);
		
		$svm = Caching_SessionVarManager::get_instance();
		$svm->delete('user-login-data');
	}
	
	public function
		is_logged_in()
	{
		$svm = Caching_SessionVarManager::get_instance();
		
		if ($svm->is_set('user-login-data')) {
			$user_login_data = $svm->get('user-login-data');
			
			return
				isset($user_login_data['logged-in'])
				&&
				$user_login_data['logged-in'];
		}
		
		return FALSE;
	}
	
	//public function
	//    get_name()
	//{
	//    if ($this->is_logged_in()) {
	//        return $_SESSION['user-login-data']['name'];
	//    } else {
	//        throw new Exception('Name requested for UserLoginLoginManager when not logged in!');
	//    }
	//}
	
	/*
	 * Functions to do with URLs of pages and scripts.
	 */
	
	public function
		get_login_url()
	{
        return UserLogin_URLHelper::get_login_page_url();
    }
	
	public function
		get_login_script_url()
	{
        return UserLogin_URLHelper::get_login_redirect_script_url_for_login();
	}
	
	public function
		get_login_cancel_url()
	{
        return UserLogin_URLHelper::get_login_redirect_script_url_for_cancel();
	}
	
	public function
		get_password_reset_confirmation_url()
	{
        return UserLogin_URLHelper::get_password_reset_confirmation_page_url();
	}
	
	public function
		get_password_reset_script_url()
	{
        return UserLogin_URLHelper::get_password_reset_redirect_script_url();
	}
	
	public function
		get_log_out_url()
	{
        return UserLogin_URLHelper::get_log_out_redirect_script_url();
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
		
		$users_table = $database->get_table('hpi_user_login_users');
		
        // print_r($users_table);exit;
		return $users_table;
	}
	
	/*
	 * ----------------------------------------
	 * Methods to do with the admin config file
	 * ----------------------------------------
	 */
	
	private function
		get_admin_config_file()
	{
        /*
         * Was written to use the old style config files,
         * but should be able to transparently replace it 
         * with the new style config manager
         */
        $cmf = HaddockProjectOrganisation_ConfigManagerFactory::get_instance();
        return $cmf->get_config_manager('plug-ins', 'user-login');
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
		return $config_file
				->get_password_reset_email_message(
					$email,
					$new_password
				);
	}
}
?>
