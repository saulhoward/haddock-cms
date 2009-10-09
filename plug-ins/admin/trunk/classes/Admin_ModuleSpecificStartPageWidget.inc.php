<?php
/**
 * Admin_ModuleSpecificStartPageWidget
 *
 * @copyright 2009-10-10, Robert Impey
 * Based on code from Saul Howard.
 */

class 
	Admin_ModuleSpecificStartPageWidget
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
			Admin_ProjectInformationHelper
				::get_start_page_widget_content();
	}
}
?>