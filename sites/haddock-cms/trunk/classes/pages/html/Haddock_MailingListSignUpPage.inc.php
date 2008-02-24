<?php
class
	Haddock_MailingListSignUpPage
extends
	HaddockCMS_HTMLPage
{
	protected function
		render_head_link_stylesheet()
	{
		parent::render_head_link_stylesheet();
		
		HTMLTags_LinkRenderer
			::render_style_sheet_link(
				'/styles/mailing-list-sign-up.css'
			);
	}
	
	public function
		content()
	{
		MailingList_SignUpRenderer::render_body_div_email_adding();
	}
}
?>