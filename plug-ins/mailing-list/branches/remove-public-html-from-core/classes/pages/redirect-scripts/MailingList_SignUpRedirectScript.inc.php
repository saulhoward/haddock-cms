<?php
/**
 * MailingList_SignUpRedirectScript
 *
 * @copyright 2009-10-06, Robert Impey
 */

class
	MailingList_SignUpRedirectScript
extends
	PublicHTML_RedirectScript
{
	protected function
		do_actions()
	{
		$return_to_url = MailingList_PeopleHelper::attemp_to_add_person();
		$this->set_return_to_url($return_to_url);
	}
}
?>