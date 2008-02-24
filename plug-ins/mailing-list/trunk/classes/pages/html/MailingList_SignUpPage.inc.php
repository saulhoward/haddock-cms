<?php
class
	MailingList_SignUpPage
extends
	PublicHTML_HTMLPage
{
	public function
		content()
	{
		MailingList_SignUpRenderer::render_body_div_email_adding();
	}
}
?>