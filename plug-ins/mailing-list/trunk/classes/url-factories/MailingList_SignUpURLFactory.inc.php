<?php
/**
 * MailingList_SignUpURLFactory
 *
 * @copyright 2008-05-07, RFI
 */

class
	MailingList_SignUpURLFactory
{
	public static function
		get_email_adding_html_page()
	{
		#$form_action = new HTMLTags_URL();
		
		#$form_action->set_file('/');
		
		$form_action
			= PublicHTML_URLHelper
				::get_base_url();
		
		$form_action->set_get_variable('oo-page');
		$form_action->set_get_variable('pcro-factory', 'MailingList_PCROFactory');
		$form_action->set_get_variable('page', 'sign-up');
		$form_action->set_get_variable('type', 'html');
		
		return $form_action;
	}
	
	public static function
		get_email_adding_redirect_script()
	{
		#$form_action = new HTMLTags_URL();
		#
		#$form_action->set_file('/');
		
		$form_action
			= PublicHTML_URLHelper
				::get_base_url();
		
		#$form_action->set_get_variable('section', 'plug-ins');
		#$form_action->set_get_variable('module', 'mailing-list');
		#$form_action->set_get_variable('page', 'sign-up');
		#$form_action->set_get_variable('type', 'redirect-script');
		#$form_action->set_get_variable('add_person');
		
		$form_action->set_get_variable('oo-page');
		$form_action->set_get_variable('pcro-factory', 'MailingList_PCROFactory');
		$form_action->set_get_variable('page', 'sign-up');
		$form_action->set_get_variable('type', 'redirect-script');
		$form_action->set_get_variable('add_person');
		
		return $form_action;
	}
}
?>