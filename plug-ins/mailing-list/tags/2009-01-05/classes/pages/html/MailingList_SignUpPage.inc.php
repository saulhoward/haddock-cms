<?php
/**
 * MailingList_SignUpPage
 *
 * @copyright 2008-03-30, RFI
 */

class
	MailingList_SignUpPage
extends
	PublicHTML_HTMLPage
{
	public function
		content()
	{
		MailingList_SignUpRenderer
			::render_body_div_email_adding();
	}
}
?>