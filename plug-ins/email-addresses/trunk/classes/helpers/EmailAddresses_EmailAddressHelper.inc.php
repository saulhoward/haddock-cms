<?php
/**
 * EmailAddresses_EmailAddressHelper
 *
 * @copyright RFI, 2008-02-17
 */

class
	EmailAddresses_EmailAddressHelper
{
	public static function
		get_mail_to_a_as_string($email_address)
	{
		$mail_to_a = new EmailAddresses_MailToA($email_address);
		
		return $mail_to_a->get_as_string();
	}
}
?>