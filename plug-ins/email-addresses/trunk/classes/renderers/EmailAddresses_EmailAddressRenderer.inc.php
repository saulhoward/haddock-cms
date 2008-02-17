<?php
/**
 * EmailAddresses_EmailAddressRenderer
 *
 * @copyright RFI, 2008-02-17
 */

class
	EmailAddresses_EmailAddressRenderer
{
	public static function
		render_mailto_a($email_address)
	{
		#echo "<a href=\"mailto:$email_address\">$email_address</a>\n";
		
		#$mail_to_a = new EmailAddresses_MailToA($str);
		#
		#echo $mail_to_a->get_as_string();
		
		echo EmailAddresses_EmailAddressHelper::get_mail_to_a_as_string($email_address);
	}
}
?>