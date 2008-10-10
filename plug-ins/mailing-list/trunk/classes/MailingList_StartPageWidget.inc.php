<?php

class 
	MailingList_StartPageWidget
extends
	Admin_StartPageWidget
{

	public function
		get_widget_title()
	{
		return 'Mailing List';
	}

	public function
		get_widget_content()
	{
		return MailingList_PeopleHelper::get_widget_content();
	}

	public function
		get_widget_div()
	{
		$div = new HTMLTags_Div();
		$div->set_attribute_str('class', 'StartPageWidget');

		$heading = new HTMLTags_Heading(3, self::get_widget_title());
		$div->append($heading);

		$div->append(self::get_widget_content());

		return $div;
	}

}



?>
