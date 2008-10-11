<?php
/**
 * MailingList_ListAddressesAdminPage
 *
 * @copyright 2007-12-16, RFI
 */

class
	MailingList_ListAddressesAdminPage
extends
	Admin_RestrictedHTMLPage
{
	
	protected function
		get_body_div_header_heading_content()
	{
		return 'Email Addresses in the Mailing List';
	}


	public function
		content()
	{
		$div = MailingList_PeopleHelper::get_list_addresses_div();

		echo $div;
	}
}

?>
