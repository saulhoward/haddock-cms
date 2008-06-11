<?php
/**
 * Shop_LogInManager
 *
 * @copyright Clear Line Web Design, 2007-03-07
 */

#require_once PROJECT_ROOT
#	. '/haddock/haddock-project-organisation/classes/'
#	. 'HaddockProjectOrganisation_LoginManager.inc.php';

class
	Shop_LogInManager
extends
	HaddockProjectOrganisation_LoginManager
{
	private $logged_in;

	private function
		__construct()
	{
		$this->logged_in = FALSE;
	}

	public static function
		get_instance()
	{
		if (!isset($_SESSION['shop-login-manager'])) {
			$_SESSION['shop-login-manager'] = new Shop_LogInManager();
		}

		return $_SESSION['shop-login-manager'];
	}

	protected function
		get_login_name_field_name()
	{
		return 'email_address';
	}

	public function
		set_logged_in_session_variable()
	{
		$_SESSION['shop-login-data']['logged-in'] = TRUE;
	}

	public function
		unset_logged_in_session_variable()
	{
		$_SESSION['shop-login-data']['logged-in'] = FALSE;
	}

	public function
		is_logged_in()
	{
		return
            isset($_SESSION['shop-login-data']['logged-in'])
            &&
            $_SESSION['shop-login-data']['logged-in'];
	}

	public function
		get_login_url()
	{
		$login_url = new HTMLTags_URL();

		$login_url->set_file('/');

		$login_url->set_get_variable('section', 'plug-ins');
		$login_url->set_get_variable('module', 'shop');
		$login_url->set_get_variable('page', 'login');
		$login_url->set_get_variable('type', 'html');

		return $login_url;
	}

	public function
		get_login_script_url()
	{
		$login_url = new HTMLTags_URL();

		/*
		 * Require HTTPS?
		 */

		$login_url->set_file('/');

		$login_url->set_get_variable('section', 'plug-ins');
		$login_url->set_get_variable('module', 'shop');
		$login_url->set_get_variable('page', 'log-in');
		$login_url->set_get_variable('type', 'redirect-script');

		$login_url->set_get_variable('login');

		return $login_url;
	}

	public function
		get_login_cancel_url()
	{
		$login_cancel_url = new HTMLTags_URL();

		/*
		 * Require HTTPS?
		 */

		$login_cancel_url->set_file('/');

		$login_cancel_url->set_get_variable('section', 'plug-ins');
		$login_cancel_url->set_get_variable('module', 'shop');
		$login_cancel_url->set_get_variable('page', 'log-in');
		$login_cancel_url->set_get_variable('type', 'redirect-script');

		$login_cancel_url->set_get_variable('clear-form');

		return $login_cancel_url;
	}

	public function
		get_log_out_url()
	{
		$log_out_url = new HTMLTags_URL();

		$log_out_url->set_file('/');

		$log_out_url->set_get_variable('section', 'plug-ins');
		$log_out_url->set_get_variable('module', 'shop');
		$log_out_url->set_get_variable('page', 'log-in');
		$log_out_url->set_get_variable('type', 'redirect-script');

		$log_out_url->set_get_variable('log_out');

		return $log_out_url;
	}

	public function
		get_users_table()
	{
		$muf = Database_MySQLUserFactory::get_instance();
		$mu = $muf->get_for_this_project();
		$database = $mu->get_database();

		$customers_users_table = $database->get_table('hpi_shop_customers');

		return $customers_users_table;
	}

	public function
		get_password_reset_confirmation_url()
	{
		$password_reset_confirmation_url = new HTMLTags_URL();

		$password_reset_confirmation_url->set_file('/');

		$password_reset_confirmation_url->set_get_variable('section', 'plug-ins');
		$password_reset_confirmation_url->set_get_variable('module', 'shop');
		$password_reset_confirmation_url->set_get_variable('page', 'password-reset-confirmation');
		$password_reset_confirmation_url->set_get_variable('type', 'html');

		return $password_reset_confirmation_url;
	}

	public function
		get_password_reset_script_url()
	{
		$password_reset_script_url = new HTMLTags_URL();

		$password_reset_script_url->set_file('/');

		$password_reset_script_url->set_get_variable('section', 'plug-ins');
		$password_reset_script_url->set_get_variable('module', 'shop');
		$password_reset_script_url->set_get_variable('page', 'reset-password');
		$password_reset_script_url->set_get_variable('type', 'redirect-script');

		$password_reset_script_url->set_get_variable('reset_password');

		return $password_reset_script_url;
	}


	public function
		get_login_form_css_class()
	{
		return 'cmxform';
	}

	//public function 
	//	get_email_address()
	//{
	//	return $this->email_address;
	//}
	//
	//public function
	//	get_email_address_id()
	//{
	//	$email_addresses_table = $this->get_email_addresses_table();
	//	$email_address_conditions['email_address'] = $this->get_email_address();
	//	$email_addresses = $email_addresses_table->get_rows_where($email_address_conditions);
	//
	//	if (count($email_addresses) > 1) {
	//		throw new Exception(
	//			'More than one email address ' . $this->get_email_address() . '!');
	//	} elseif(count($email_addresses) == 0) {
	//		throw new Exception('No email addresses matching ' . $this->get_email_address() . '!');
	//	} else {
	//		return $email_addresses[0]->get_id();
	//	}
	//}
	//
	//public function 
	//	set_email_address($email_address)
	//{
	//	$this->email_address = $email_address;
	//}
	//
	//public function
	//	is_email_address_set()
	//{
	//	return isset($this->email_address);
	//}
	//
	//public static function
	//	encrypt_password($password)
	//{
	//	//        return md5($password . "clearlinewebdesign.com login");
	//	return hash('sha256', $password);
	//}
	//
	//public function 
	//	get_encrypted_password()
	//{
	//	return $this->encrypted_password;
	//}
	//
	//public function 
	//	set_encrypted_password($encrypted_password)
	//{
	//	$this->encrypted_password = $encrypted_password;
	//}
	//
	//public function
	//	get_log_in_url()
	//{
	//	$log_in_url = 'http';
	//
	//	if (isset($_SERVER['HTTPS'])) {
	//		$log_in_url .= 's';
	//	}
	//
	//	$log_in_url .= '://';
	//
	//	$log_in_url .= $_SERVER['HTTP_HOST'];
	//
	//	$log_in_url .= '/log-in.html';
	//
	//	return $log_in_url;
	//}

	//public function
	//	log_in($email_address, $password)
	//{
	//	$this->set_email_address($email_address);
	//	$this->set_encrypted_password(self::encrypt_password($password));
	//
	//	if ($this->verify_logged_in()) {
	//		return TRUE;
	//	} else {
	//		throw new Shop_LogInException($email_address);
	//	}
	//}

	//public function
	//	get_users_table()
	//{
	//	$mysql_user_factory = Database_MySQLUserFactory::get_instance();
	//	$mysql_user = $mysql_user_factory->get_for_this_project();
	//
	//	$database = $mysql_user->get_database();
	//
	//	$users_table = $database->get_table('hpi_shop_customers');
	//
	//	return $users_table;
	//}
	//
	//
	//public function
	//	get_email_addresses_table()
	//{
	//	$mysql_user_factory = Database_MySQLUserFactory::get_instance();
	//	$mysql_user = $mysql_user_factory->get_for_this_project();
	//
	//	$database = $mysql_user->get_database();
	//
	//	$email_addresses_table = $database->get_table('hpi_shop_email_addresses');
	//
	//	return $email_addresses_table;
	//}
	//
	//public function
	//	verify_logged_in()
	//{
	//	#echo "LogIn_LogInManager::verify_logged_in()\n";
	//	#print_r($_SESSION['log-in-manager']);
	//	#echo $this->logged_in;
	//
	//	if ($this->logged_in) {
	//		return TRUE;
	//	} else {
	//		if ($this->login_details_entered()) {
	//			$users_table = $this->get_users_table();
	//
	//			$conditions = array();
	//
	//			$conditions['email_address_id'] = $this->get_email_address_id();
	//			$conditions['password'] = $this->get_encrypted_password();
	//
	//			$user_count = $users_table->count_rows_where($conditions);
	//
	//			if ($user_count == 1) {
	//				#echo "User name and password are correct.\n";
	//
	//				$this->logged_in = TRUE;
	//
	//				#print_r($this);
	//				#print_r($_SESSION['log-in-manager']);
	//
	//				return TRUE;                
	//			} else {
	//				throw new Shop_LogInException($this->get_email_address());
	//			}
	//		}
	//	}
	//
	//	return FALSE;
	//}
	//
	//public function
	//	login_details_entered()
	//{
	//	return isset($this->email_address) && isset($this->encrypted_password);
	//}
	//
	//public function
	//	get_customer()
	//{
	//	$users_table = $this->get_users_table();
	//	$email_addresses_table = $this->get_email_addresses_table();
	//
	//	$email_address_conditions['email_address'] = $this->get_email_address();
	//	$email_addresses = $email_addresses_table->get_rows_where($email_address_conditions);
	//
	//	if (count($email_addresses) > 1) {
	//		throw new Exception(
	//			'More than one email address ' . $this->get_email_address() . '!');
	//	} elseif(count($email_addresses) == 0) {
	//		throw new Exception('No email addresses matching ' . $this->get_email_address() . '!');
	//	} else {
	//		$user_conditions['email_address_id'] = $email_addresses[0]->get_id();
	//
	//		$users = $users_table->get_rows_where($user_conditions);
	//
	//		if (count($users) > 1) {
	//			throw new Exception(
	//				'More than one user with the email address ' 
	//				. $this->get_email_address() . '!');
	//		} elseif(count($users) == 0) {
	//			throw new Exception('No users with the email address ' 
	//				. $this->get_email_address() . '!');
	//		} else {
	//			return $users[0];
	//		}
	//	}
	//}
	//
	///*
	// * -------------------------------------------------------------------------
	// * Validation functions
	// * -------------------------------------------------------------------------
	// */
	//
	//public static function
	//	validate_email_address($email_address)
	//{
	//	/*
	//	 * Length.
	//	 */
	//	$min_length = 4;
	//	$max_length = 12;
	//	if (
	//		(strlen($email_address) < $min_length)
	//		||
	//		(strlen($email_address) > $max_length)
	//	) {
	//		throw new Exception("The login name must be between $min_length and $max_length characters long.");
	//	}
	//
	//	/*
	//	 * Characters.
	//	 */
	//	if (!preg_match('/^\w+$/', $email_address)) {
	//		throw new Exception('The login name must only contain letters, numbers or underscores.');
	//	}
	//
	//	return TRUE;
	//}
	//
	//public static function
	//	validate_passwords(
	//		$password,
	//		$confirm_password
	//	)
	//{
	//	/*
	//	 * The passwords match.
	//	 */
	//	if ($password != $confirm_password) {
	//		throw new Exception("The passwords don't match.");
	//	}
	//
	//	/*
	//	 * Length.
	//	 */
	//	$min_length = 4;
	//	$max_length = 12;
	//	if (
	//		(strlen($password) < $min_length)
	//		||
	//		(strlen($password) > $max_length)
	//	) {
	//		throw new Exception("The password must be between $min_length and $max_length characters long.");
	//	}
	//
	//	return TRUE;
	//}
	//
	//public static function
	//	validate_user_level(
	//		$user_level
	//	)
	//{
	//	$mysql_user_factory = Database_MySQLUserFactory::get_instance();
	//	$mysql_user = $mysql_user_factory->get_for_this_project();
	//	$database = $mysql_user->get_database();
	//
	//	$users_table = $database->get_table('users');
	//
	//	$user_level_field = $users_table->get_field('user_level');
	//
	//	$user_levels = $user_level_field->get_options();
	//
	//	if (!in_array($user_level, $user_levels)) {
	//		$message = 'The user level must be ';
	//
	//		for ($i = 0; $i < count($user_levels); $i++) {
	//			if ($i == (count($user_levels) - 1)) {
	//				$message .= ' or ';
	//			}
	//
	//			$message .= $user_levels[$i];
	//
	//			if ($i < (count($user_levels) - 2)) {
	//				$message .= ', ';
	//			}
	//		}
	//
	//		$message .= '.';
	//
	//		throw new Exception($message);
	//	}
	//
	//	return TRUE;
	//}
	//
	//public static function
	//	validate_full_name(
	//		$full_name
	//	)
	//{
	//	if (strlen($full_name) < 1) {
	//		throw new Exception("The full name must be at least one characters long.");
	//	}
	//
	//	return TRUE;
	//}
    
    public function
        get_create_new_account_form(
            HTMLTags_URL $form_location,
            HTMLTags_URL $redirect_script_location,
            HTMLTags_URL $desired_location,
            HTMLTags_URL $cancel_page_location
        )
    {
        $create_new_account_form
            = new HTMLTags_SimpleOLForm('create_new_account');
        
        $create_new_account_form->set_attribute_str('id', 'create_new_account');
        $create_new_account_form->set_attribute_str('class', 'cmxform');
        
        $svm = Caching_SessionVarManager::get_instance();
        
        /*
         * The action.
         */
        $add_account_script_location = clone $redirect_script_location;
        $add_account_script_location->set_get_variable('create_new_account');
        
        $add_account_script_location->set_get_variable(
            'desired_location',
            urlencode($desired_location->get_as_string())
        );
        
        $add_account_script_location->set_get_variable(
            'form_location',
            urlencode($form_location->get_as_string())
        );
        
        $create_new_account_form->set_action($add_account_script_location);
        
        $create_new_account_form->set_legend_text('Create New Account');
        
        /*
         * The input tags.
         */
        if ($svm->is_set('create-new-account: email')) {
            $create_new_account_form->add_input_name_with_value(
                'email',
                $svm->get('create-new-account: email')
            );
        } else {
            $create_new_account_form->add_input_name('email');
        }
        
        if ($svm->is_set('create-new-account: confirm_email')) {
            $create_new_account_form->add_input_name_with_value(
                'confirm_email',
                $svm->get('create-new-account: confirm_email')
            );
        } else {
            $create_new_account_form->add_input_name('confirm_email');
        }
        
        $password_input = new HTMLTags_Input();
        $password_input->set_attribute_str('type', 'password');
        $password_input->set_attribute_str('id', 'password');
        $password_input->set_attribute_str('name', 'password');
        $create_new_account_form
            ->add_input_tag('password', $password_input);
        
        $password_confirm_input = new HTMLTags_Input();
        $password_confirm_input->set_attribute_str('type', 'password');
        $password_confirm_input->set_attribute_str('id', 'confirm_password');
        $password_confirm_input->set_attribute_str('name', 'confirm_password');
        $create_new_account_form
            ->add_input_tag('confirm_password', $password_confirm_input);
        
        /*
         * The submit button.
         */
        $create_new_account_form->set_submit_text('Create');
        
        /*
         * The cancel button
         */
        $cancel_location = clone $redirect_script_location;
        
        $cancel_location->set_get_variable('cancel');
        $cancel_location->set_get_variable(
            'cancel_page_location',
            urlencode($cancel_page_location->get_as_string())
        );
        
        $create_new_account_form->set_cancel_location($cancel_location);
        
        return $create_new_account_form;
    }
    
    public function
        add_new_user(
            $email,
            $password
        )
    {
        #echo 'In Shop_LogInManager::add_new_user(...)' . "\n";
		#exit;
		
		$eav = new InputValidation_EmailAddressValidator();
        
        if (!$this->is_email_available($email)) {
            throw
                new InputValidation_InvalidInputException(
                    sprintf(
                        'An account already exists for \'%s\'.',
                        $email
                    )
                );
        }
        
        if (
            $this->is_password_valid($password) &&
            $eav->validate($email)
        ) {
            $users_table = $this->get_users_table();
            
            $values['password'] = $this->encrypt_password($password);
            $values['email_address'] = $email;
            $values['added'] = 'NOW()';
            
            $users_table->add($values);
        } else {
            throw
                new InputValidation_InvalidInputException(
                    'Unable to add new customer!'
                );
        }
    }
    
	public function
        is_email_available($email)
    {
        $admin_users_table = $this->get_users_table();
        
        $conditions['email_address'] = $email;
        
        return $admin_users_table->count_rows_where($conditions) == 0;
    }
    
    public function
	    get_user()
    {
        $users_table = $this->get_users_table();
        
        $conditions = array();
        $conditions['email_address'] = $this->get_name();
        
        $users = $users_table->get_rows_where($conditions);

		#print_r($users);exit;
		return $users[0];
    }

    public function
        log_in($email_address, $password)
    {
		//echo 'In Shop_LogInManager::log_in(...)' . "\n";
		//exit;
		
        $users_table = $this->get_users_table();
        
        $conditions = array();
        $conditions['email_address'] = $email_address;
        $encrypted_password = $this->encrypt_password($password);
        $conditions['password'] = $encrypted_password;
        
        $users = $users_table->get_rows_where($conditions);
        
        if (count($users) == 1) {
            $this->set_logged_in_session_variable();
            
            $this->set_name($users[0]->get_email_address());
            
            $values = array();
            
            $values['last_logged_in'] = 'NOW()';
            
            $users_table->update_by_id(
                $users[0]->get_id(),
                $values
            );
            
            return TRUE;
        } else {
            throw
                new HaddockProjectOrganisation_LoginException($email_address);
        }
    }
    
    public function
        get_log_in_form(
            HTMLTags_URL $form_location,
            HTMLTags_URL $redirect_script_location,
            HTMLTags_URL $desired_location,
            HTMLTags_URL $cancel_page_location
        )
    {
        $log_in_form
            = new HTMLTags_SimpleOLForm('create_new_account');
        
        $log_in_form->set_attribute_str('id', $this->get_login_form_id());
        
        $log_in_form->set_attribute_str(
            'class',
            $this->get_login_form_css_class()
        ); 
        
        $svm = Caching_SessionVarManager::get_instance();
        
        /*
         * The action.
         */
        $log_in_script_location = clone $redirect_script_location;
        $log_in_script_location->set_get_variable('log_in');
        
        $log_in_script_location->set_get_variable(
            'desired_location',
            urlencode($desired_location->get_as_string())
        );
        
        $log_in_script_location->set_get_variable(
            'form_location',
            urlencode($form_location->get_as_string())
        );
        
        $log_in_form->set_action($log_in_script_location);
        
        $log_in_form->set_legend_text('Log In');
        
        /*
         * The input tags.
         */
        if ($svm->is_set('log-in: email')) {
            $log_in_form->add_input_name_with_value(
                'email',
                $svm->get('log-in: email')
            );
        } else {
            $log_in_form->add_input_name('email');
        }
        
        $password_input = new HTMLTags_Input();
        $password_input->set_attribute_str('type', 'password');
        $password_input->set_attribute_str('id', 'password');
        $password_input->set_attribute_str('name', 'password');
        $log_in_form
            ->add_input_tag('password', $password_input);
        
        /*
         * The submit button.
         */
        $log_in_form->set_submit_text('Log In');
        
        /*
         * The cancel button
         */
        $cancel_location = clone $redirect_script_location;
        
        $cancel_location->set_get_variable('cancel');
        $cancel_location->set_get_variable(
            'cancel_page_location',
            urlencode($cancel_page_location->get_as_string())
        );
        
        $log_in_form->set_cancel_location($cancel_location);
        
        return $log_in_form;
    }
    
    public function
        get_password_reset_form(
            HTMLTags_URL $form_location,
            HTMLTags_URL $redirect_script_location,
            HTMLTags_URL $desired_location,
            HTMLTags_URL $cancel_page_location
        )
    {
        $password_reset_form
            = new HTMLTags_SimpleOLForm('create_new_account');
        
        $password_reset_form->set_attribute_str(
            'id',
            $this->get_password_reset_form_id()
        );
        
        $password_reset_form->set_attribute_str(
            'class',
            $this->get_password_reset_form_css_class()
        ); 
        
        $svm = Caching_SessionVarManager::get_instance();
        
        /*
         * The action.
         */
        $password_reset_script_location = clone $redirect_script_location;
        $password_reset_script_location->set_get_variable('password_reset');
        
        $password_reset_script_location->set_get_variable(
            'desired_location',
            urlencode($desired_location->get_as_string())
        );
        
        $password_reset_script_location->set_get_variable(
            'form_location',
            urlencode($form_location->get_as_string())
        );
        
        $password_reset_form->set_action($password_reset_script_location);
        
        $password_reset_form->set_legend_text('Reset Password');
        
        /*
         * The input tags.
         */
        if ($svm->is_set('password-reset: email')) {
            $password_reset_form->add_input_name_with_value(
                'email',
                $svm->get('password-reset: email')
            );
        } else {
            if ($this->is_logged_in()) {
                $password_reset_form->add_input_name_with_value(
                    'email',
                    $this->get_name()
                );
            } else {
                $password_reset_form->add_input_name('email');
            }
        }
        
        /*
         * The submit button.
         */
        $password_reset_form->set_submit_text('Reset');
        
        /*
         * The cancel button
         */
        $cancel_location = clone $redirect_script_location;
        
        $cancel_location->set_get_variable('cancel');
        $cancel_location->set_get_variable(
            'cancel_page_location',
            urlencode($cancel_page_location->get_as_string())
        );
        
        $password_reset_form->set_cancel_location($cancel_location);
        
        return $password_reset_form;
    }
    
    protected function
        get_password_reset_form_id()
    {
        return 'password_reset';
    }
    
    protected function
        get_password_reset_form_css_class()
    {
        return 'cmxform';
    }
	
	/*
	 * ----------------------------------------
	 * Methods to do with the shop config file
	 * ----------------------------------------
	 */
	
//	private function
//		get_shop_config_file()
//	{
//		$pdf =
//			HaddockProjectOrganisation_ProjectDirectoryFinder
//				::get_instance();
//		$pd = $pdf->get_project_directory_for_this_project();
//		$psd = $pd->get_project_specific_directory();
//		
//        $shop_config_file = $psd->get_module_config_file('plug-ins', 'shop');
//        
//        echo '\$shop_config_file->get_name(): ' . "\n";
//        echo $shop_config_file->get_name() . "\n";
//        
//		return $shop_config_file;
//	}

//	private function
//		get_shop_config_manager()
//	{
//		$pdf =
//			HaddockProjectOrganisation_ProjectDirectoryFinder
//				::get_instance();
//		$pd = $pdf->get_project_directory_for_this_project();
//		$psd = $pd->get_project_specific_directory();
//		
//        $shop_config_manager
//			= $psd->get_module_config_manager('plug-ins', 'shop');
//                
//		return $shop_config_manager;
//	}

	private function
		get_shop_module_directory()
	{
		$pdf =
			HaddockProjectOrganisation_ProjectDirectoryFinder
				::get_instance();
		$pd = $pdf->get_project_directory_for_this_project();
		$smd = $pd->get_plug_in_module_directory('shop');
        
		return $smd;
	}
	
	/*
	 * ----------------------------------------
	 * Methods to do with data for resetting the customer's password
	 * ----------------------------------------
	 */
	protected function
		get_password_reset_email_reply_address()
	{
		$smd = $this->get_shop_module_directory();
		
		//$password_reset_email_reply_address
		//	= $shop_config_manager->get_password_reset_email_reply_address();
		
		$password_reset_email_reply_address
			= $smd->get_nested_config_variable(
				array(
					'password-reset',
					'email-reply-address'
				)
			);
		
		//echo '$password_reset_email_reply_address: ' . "\n";
		//echo "$password_reset_email_reply_address\n";
		//exit;
		
		return $password_reset_email_reply_address;
	}

	protected function
		get_password_reset_email_reply_name()
	{
		$smd = $this->get_shop_module_directory();
		
		//$password_reset_email_reply_name
		//	= $shop_config_manager->get_password_reset_email_reply_name();
		
		$password_reset_email_reply_name
			= $smd->get_nested_config_variable(
				array(
					'password-reset',
					'email-reply-name'
				)
			);
		
		//echo '$password_reset_email_reply_name: ' . "\n";
		//echo "$password_reset_email_reply_name\n";
		//exit;
		
		return $password_reset_email_reply_name;
	}

	protected function
		get_password_reset_email_subject()
	{
		//$shop_config_file = $this->get_shop_config_file();
		//
		//return $shop_config_file->get_password_reset_email_subject();
	
		$smd = $this->get_shop_module_directory();
		
		//$password_reset_email_reply_address
		//	= $shop_config_manager->get_password_reset_email_reply_address();
		
		$password_reset_email_subject
			= $smd->get_nested_config_variable(
				array(
					'password-reset',
					'email-subject'
				)
			);
		
		//echo '$password_reset_email_subject: ' . "\n";
		//echo "$password_reset_email_subject\n";
		//exit;
		
		return $password_reset_email_subject;
	}
	
	protected function
		get_password_reset_email_message($email, $new_password)
	{
		//$shop_config_file = $this->get_shop_config_file();
		//
		//return
		//	$shop_config_file
		//		->get_password_reset_email_message(
		//			$email,
		//			$new_password
		//		);
		$smd = $this->get_shop_module_directory();
		
		//$password_reset_email_reply_address
		//	= $shop_config_manager->get_password_reset_email_reply_address();
		
		$password_reset_email_message
			= $smd->get_nested_config_variable(
				array(
					'password-reset',
					'email-message'
				)
			);
		
		$password_reset_email_message
			= preg_replace('/(?<!\\\\)\\$email/', $email, $password_reset_email_message);
		$password_reset_email_message
			= preg_replace('/(?<!\\\\)\\$new_password/', $new_password, $password_reset_email_message);
		
		$password_reset_email_message
			= preg_replace('/(?<!\\\\)\\\\(?=\\$)/', '', $password_reset_email_message);
		$password_reset_email_message
			= preg_replace('/\\\\\\\\/', '\\', $password_reset_email_message);
		
		//echo '$password_reset_email_message: ' . "\n";
		//echo "$password_reset_email_message\n";
		//exit;
		
		return $password_reset_email_message;
	}
}
?>