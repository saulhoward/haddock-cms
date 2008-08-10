<?php
/**
 * Admin_UserRow
 *
 * @copyright 2007-08-27, Robert Impey
 */

class
	Admin_UserRow
extends
    Database_Row
{
    public function
        get_name()
    {
        return $this->get('name');
    }
    
    public function
        get_email()
    {
        return $this->get('email');
    }
    
    public function
        get_real_name()
    {
        return $this->get('real_name');
    }
    
    public function
        get_type()
    {
        return $this->get('type');
    }
	
	public function
		reset_password()
	{
		$real_name = $this->get_real_name();
		/*
		 * Check that the user has an email address to send the new password to.
		 */
		if (strlen($this->get_email()) == 0) {
			throw new Exception(
				'Unable to reset the password of ' 
				. $this->get_real_name() 
				. ' as no email address has been set!'
			);
		}

		/*
		 * Generate the new password.
		 */
		$pwg = Security_PasswordGenerator::get_instance();
		$pw = $pwg->get_password();
		
		/*
 		 * Check that there is an admin for this site.
		 */		
		$from_email = '';

		/*
		 * Compose an email.
		 *
		 * How can this be edited and overridden?
		 */
		$email_title = 'New password for ' . $this->get_real_name();
		$to_email = $this->get_email();

		$email_body = <<<EML
Dear $real_name,

Your password has been reset to '$pw'.
EML;
		
		if (mail($to_email, $from_email, $email_body, "From: $from_email;\r\nReply-To: $from_email")) {
			$alm = Admin_LoginManager::get_instance();

			$alm->set_password($this->get_name(), $pw);
		} else {	
			throw new Exception("Unable to send a password reset email to $to_email!");
		}		
	}
}
?>
