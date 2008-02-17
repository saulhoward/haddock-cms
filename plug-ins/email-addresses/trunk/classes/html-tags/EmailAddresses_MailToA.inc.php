<?php
/**
 * EmailAddresses_MailToA
 *
 * @copyright RFI, 2008-02-17
 */

class
	EmailAddresses_MailToA
extends
	HTMLTags_A
{
	public function
		__construct($email_address)
	{
		parent::__construct($email_address);
		
		$this->set_href(new HTMLTags_URL("mailto:$email_address"));
	}
}
?>