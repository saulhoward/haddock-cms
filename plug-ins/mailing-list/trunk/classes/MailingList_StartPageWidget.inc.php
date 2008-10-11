<?php

class 
	MailingList_StartPageWidget
extends
	Admin_StartPageWidget
{
	protected function
		get_widget_title()
	{
		return 'Mailing List';
	}

	protected function
		get_widget_content()
	{
		return MailingList_PeopleHelper::get_widget_content();
	}
}
?>
