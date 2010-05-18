<?php
/**
 * HaddockProjectOrganisation_LoginManager
 *
 * @copyright 2007-08-06, RFI
 */

/**
 * The class that should be extended to make log-in managers.
 * 
 * See: http://wiki.haddock-cms.com/wiki/HaddockProjectOrganisation_LoginManager
 */
abstract class
	HaddockProjectOrganisation_LoginManager
{
	#private $logged_in;
	
	private $name;
	private $type;
	
	/*
	 * ------------------------------------------------------------
	 * Abstract functions.
	 * ------------------------------------------------------------
	 */
	
	/**
	 * Classes that extend this class should use the Singleton Pattern.
	 *
	 * See: http://wiki.haddock-cms.com/index.php/Singleton_Design_Pattern
	 */
	public abstract static function
		get_instance();
	
	/*
	 * Functions to do with the log in state.
	 */
	
	protected abstract function
		set_logged_in_session_variable();
	protected abstract function
		unset_logged_in_session_variable();
	public abstract function
		is_logged_in();
	//public abstract function
	//    get_name();
		
	/*
	 * Functions to do with URLs for pages and scripts.
	 */
	
	public abstract function
		get_login_url();
	public abstract function
		get_login_script_url();
	public abstract function
		get_login_cancel_url();
	public abstract function
		get_log_out_url();
	public abstract function
		get_password_reset_confirmation_url();
	public abstract function
		get_password_reset_script_url();
		
	/*
	 * Functions to do with database elements.
	 */
	public abstract function
		get_users_table();
	
	/*
	 * ------------------------------------------------------------
	 * Implemented functions.
	 * ------------------------------------------------------------
	 */
	
	/*
	 * Functions to do with the log in state.
	 */
	
	//protected function
	//    set_logged_in($logged_in)
	//{
	//    $this->logged_in = $logged_in;
	//}
	
	public function
		log_in($name, $password)
	{
		$admin_users_table = $this->get_users_table();
		
		$conditions = array();
		#$conditions['name'] = $name;
		$conditions[$this->get_login_name_field_name()] = $name;
		$encrypted_password = $this->encrypt_password($password);
		#$conditions['password'] = $encrypted_password;
		$conditions[$this->get_login_password_field_name()] = $encrypted_password;
		
		$users = $admin_users_table->get_rows_where($conditions);
		
		#echo __METHOD__ . "\n";
		#echo 'count($users): ' . count($users) . "\n";
		#exit;
		//echo 'print_r($users): ' . "\n";
		//print_r($users);
		//exit;
		
		if (count($users) == 1) {
			#$_SESSION['admin-login-data']['logged-in'] = TRUE;
			$this->set_logged_in_session_variable();
			#$this->set_logged_in(TRUE);
			
			$this->set_name($users[0]->get($this->get_login_name_field_name()));
			$this->set_type($users[0]->get('type'));
			
			//echo 'print_r($this): ' . "\n";
			//print_r($this);
			//exit;
			
			return TRUE;
		} else {
			throw new HaddockProjectOrganisation_LoginException($name);
		}
	}
	
	/**
	 * Should an exception be thrown if this is called and nobody's logged in.
	 */
	public function
		log_out()
	{
		$this->unset_logged_in_session_variable();
		#$this->set_logged_in(FALSE);
		
		return TRUE;
	}
	
	//public function
	//    is_logged_in()
	//{
	//    return $this->logged_in;
	//}
	
	public function
		get_name()
	{
		if ($this->is_logged_in()) {
			return $this->name;
		} else {
			throw new Exception('Attempt to get name when not logged in!');
		}
	}
	
	protected function
		set_name($name)
	{
		$this->name = $name;
	}
	
	public function
		get_type()
	{
		if ($this->is_logged_in()) {
			return $this->type;
		} else {
			throw new Exception('Attempt to get type when not logged in!');
		}
	}
	
	protected function
		set_type($type)
	{
		$this->type = $type;
	}
	
	/*
	 * Functions to do with HTML elements for pages.
	 */

	public function
		get_login_form_css_class()
	{
		return 'basic-form';
	}


	public function
		get_login_form_id()
	{
		return 'login-form';
	}

	public function
		get_login_form_legend_text()
	{
		return 'Login';
	}
	
	public function
		get_login_form_div($name = NULL)
	{
		$login_form_div = new HTMLTags_Div();
		
		$login_form = new HTMLTags_SimpleOLForm('login');
		
		$login_form->set_attribute_str(
			'class',
			$this->get_login_form_css_class()
		); 
		
		$login_form->set_attribute_str('id', $this->get_login_form_id()); 

		$login_form->set_action($this->get_login_script_url());
		
		$login_form->set_legend_text($this->get_login_form_legend_text());
		
		if ($name == NULL) {
			$login_form->add_input_name($this->get_login_name_field_name());
		} else {
			$login_form->add_input_name_with_value(
				$this->get_login_name_field_name(),
				$name
			);
		}
		
		$password_input = new HTMLTags_Input();
		$password_input->set_attribute_str('name', 'password');
		$password_input->set_attribute_str('type', 'password');
		
		$login_form->add_input_tag('password', $password_input);
		
		$login_form->set_submit_text('Login');
		
		$login_form->set_cancel_location($this->get_login_cancel_url());
		
		$login_form_div->append_tag_to_content($login_form);
		
		return $login_form_div;
	}
	
	protected function
		get_log_out_a_text()
	{
		return 'Log Out';
	}
	
	public function
		get_log_out_a()
	{
		$log_out_a = new HTMLTags_A($this->get_log_out_a_text());
		
		$log_out_a->set_href($this->get_log_out_url());
		
		return $log_out_a;
	}
	
	/*
	 * Functions to do with whether log in details are valid or not.
	 */
	
	public function
		get_min_name_length()
	{
		return 4;
	}
	
	public function
		get_max_name_length()
	{
		return 20;
	}
	
	/**
	 * @return boolean
	 *  Does the given name meet string requirements.
	 */
	public function
		is_name_valid($name)
	{
		$string_validator = new InputValidation_StringValidator();
		
		$string_validator->validate_length(
			$name,
			'name',
			$this->get_min_name_length(),
			$this->get_max_name_length()
		);
		
		$string_validator->validate_alphanumeric_or_dashes(
			$name,
			'name',
			$ignore_leading_white_space = FALSE,
			$ignore_trailing_white_space = FALSE,
			$spaces = FALSE,
			$zero_lenghth_allowed = FALSE
		);
		
		return TRUE;
	}
	
	public function
		get_min_password_length()
	{
		return 4;
	}
	
	public function
		get_max_password_length()
	{
		return 20;
	}
	
	/**
	 * @return boolean
	 *  Does the given password meet string requirements.
	 */
	public function
		is_password_valid($password)
	{
		$string_validator = new InputValidation_StringValidator();
		
		$string_validator->validate_length(
			$password,
			'password',
			$this->get_min_password_length(),
			$this->get_max_password_length()
		);
		
		return TRUE;
	}
	
	public function
		get_user_types()
	{
		$users_table = $this->get_users_table();
		
		$types_field = $users_table->get_field('type');
		
		return $types_field->get_options();
	}
	
	public function
		is_type_valid($type)
	{
		$types = $this->get_user_types();
		
		return in_array($type, $types);
	}
	
	/*
	 * Functions do with the database.
	 */
	
	protected function
		get_login_name_field_name()
	{
		return 'name';
	}
	
	protected function
		get_login_password_field_name()
	{
		return 'password';
	}
	
	public function
		encrypt_password($password)
	{
		return sha1($password);
	}
	
	public function
		add_new_user(
			$name,
			$password,
			$type,
			$real_name,
			$email
		)
	{
		$eav = new InputValidation_EmailAddressValidator();
		
		if (
            $this->is_name_valid($name) &&
            $this->is_name_available($name) &&
            $this->is_password_valid($password) &&
            $this->is_type_valid($type) &&
			$eav->validate($email)
		) {
			$users_table = $this->get_users_table();
			
			$values['name'] = $name;
			$values['password'] = $this->encrypt_password($password);
			$values['type'] = $type;
			$values['real_name'] = $real_name;
			$values['email'] = $email;
			
			$users_table->add($values);
		} else {
            throw new InputValidation_InvalidInputException('Unable to add new user!');
		}
	}
	
	public function
		update_user(
			$user_id,
			$name,
			$type,
			$real_name,
			$email
		)
	{
		$eav = new InputValidation_EmailAddressValidator();
		
		$users_table = $this->get_users_table();
		
		$user_row = $users_table->get_row_by_id($user_id);
		
		if (
			$this->is_name_valid($name)
			&&
			(
				($name == $user_row->get_name())
				||
				$this->is_name_available($name)
			)
			&&
			$this->is_type_valid($type) &&
			$eav->validate($email)
		) {
			$values['name'] = $name;
			$values['type'] = $type;
			$values['real_name'] = $real_name;
			$values['email'] = $email;
			
			$users_table->update_by_id($user_id, $values);
		} else {
			throw new InputValidation_InvalidInputException('Unable to update the user!');
		}
	}
	
	public function
		set_password(
			$name,
			$new_password
		)
	{
		if (!$this->is_password_valid($new_password)) {
			throw new Exception("'$new_password' is not a valid password!");
		}

		$users_table = $this->get_users_table();

		$conditions[$this->get_login_name_field_name()] = $name;

		$user_rows = $users_table->get_rows_where($conditions);

		if (count($user_rows) == 1) {
			$values['password'] = $this->encrypt_password($new_password);
			
			$users_table->update_by_id($user_rows[0]->get_id(), $values);
		} elseif (count($user_rows) == 1) {
			throw new Exception("No user called '$name'!");
		} else {
			throw new Exception("More than one user called '$name'!");
		}
	}

	public function
		is_name_available($name)
	{
		$admin_users_table = $this->get_users_table();
		
		$conditions[$this->get_login_name_field_name()] = $name;
		
		return $admin_users_table->count_rows_where($conditions) == 0;
	}
	
	public function
		is_user($name)
	{
		$admin_users_table = $this->get_users_table();
		
		$conditions[$this->get_login_name_field_name()] = $name;
		
		return $admin_users_table->count_rows_where($conditions) == 1;
	}
	
	/**
	 * Resets the password of the user with the given name.
	 *
	 * First checks that their is an account with that name,
	 * throws a HaddockProjectOrganisation_PasswordResetException
	 * if there isn't.
	 *
	 * Then it generates a new password.
	 *
	 * The password is emailed to the user.
	 *
	 * The password is then set to the encrypted form of the password.
	 */
	public function
		reset_password($name)
	{
		//throw
		//    new HaddockProjectOrganisation_PasswordResetException($name);
		
		/*
		 * Check is user.
		 */
		if (!$this->is_user($name)) {
			throw
				new HaddockProjectOrganisation_PasswordResetException($name);            
		}
		
		/*
		 * Generate a new password.
		 */
		$password_generator = Security_PasswordGenerator::get_instance();
		$new_password =
			$password_generator
				->get_password($this->get_new_password_length());
				
		/*
		 * Email the password to the user.
		 */
		$this->email_user_new_password(
		$name,
		$new_password
	);

		/*
		 * Update the values in the database.
		 */
		$this->set_password($name, $new_password);
	}
	
	protected function
		get_new_password_length()
	{
		return 8;
	}

	protected function
		email_user_new_password(
					$email,
					$new_password
		)
	{
		$subject = $this->get_password_reset_email_subject();
		$message = $this->get_password_reset_email_message($email, $new_password);
		$headers = 'From: ' . $this->get_password_reset_email_reply_address() . "\r\n" .
				'Reply-To: ' . $this->get_password_reset_email_reply_address() . "\r\n" .
			'X-Mailer: PHP/' . phpversion();
			
		//echo "\$email: $email\n";
		//echo "\$subject: $subject\n";
		//echo "\$message: $message\n";
		//echo "\$headers: $headers\n";
		//exit;
		
		mail($email, $subject, $message, $headers);
	}

//	protected function
//		get_password_reset_email_reply_address()
//	{
//		return 'shop-passwords@connectedfilms.com';
//	}
//
//	protected function
//		get_password_reset_email_subject()
//	{
//		return 'Password for the Connected Films Shop Reset';
//	}
//
//	protected function
//		get_password_reset_email_message(
//                        $email,
//                        $new_password
//                )
//        {
//		$message = <<<MSG
//You requested a new password to access the Connected Films Shop
//using '$email' as a user name.
//
//Your new password is '$new_password'.
//
//You can log in to your account at:
//
//http://shop.connectedfilms.com/hpi/shop/log-in.html
//
//Thanks,
//
//The Connected Films Shop Team.
//
//MSG;
//		$message = wordwrap($message, 70);
//
//		return $message;
//	}
	abstract protected function
		get_password_reset_email_reply_address();
	abstract protected function
		get_password_reset_email_subject();
	abstract protected function
		get_password_reset_email_message($email, $new_password);
}
?>
