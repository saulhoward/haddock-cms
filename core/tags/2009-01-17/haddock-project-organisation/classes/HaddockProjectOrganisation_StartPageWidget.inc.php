<?php

class 
	HaddockProjectOrganisation_StartPageWidget
extends
	Admin_StartPageWidget
{
	protected function
		get_widget_title()
	{
		$title =
			HaddockProjectOrganisation_ProjectInformationHelper
				::get_title();
		return $title . '&nbsp;Information';
	}

	protected function
		get_widget_content()
	{
		return 
			HaddockProjectOrganisation_ProjectInformationHelper
			::get_start_page_widget_content();
	}
}
?>
