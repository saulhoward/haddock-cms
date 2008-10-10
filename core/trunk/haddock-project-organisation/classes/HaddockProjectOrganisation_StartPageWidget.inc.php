<?php

class 
	HaddockProjectOrganisation_StartPageWidget
extends
	Admin_StartPageWidget
{

	public function
		get_widget_title()
	{
		$title =
			HaddockProjectOrganisation_ProjectInformationHelper
				::get_title();
		return $title . '&nbsp;Information';
	}

	public function
		get_widget_content()
	{
		return 
			HaddockProjectOrganisation_ProjectInformationHelper
			::get_start_page_widget_content();
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
