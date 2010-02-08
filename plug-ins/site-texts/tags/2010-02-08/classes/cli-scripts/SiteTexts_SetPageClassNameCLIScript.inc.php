<?php
/**
 * SiteTexts_SetPageClassNameCLIScript
 *
 * @copyright 2010-02-08, Robert Impey
 */

class
	SiteTexts_SetPageClassNameCLIScript
extends
	CLIScripts_CLIScript
{
	public function
		do_actions()
	{
		$page_class_name
			= CLIScripts_UserInterrogationHelper
				::get_validated_input(
					'Please enter the name of page class: ' . PHP_EOL,
					new SiteTexts_PageClassNameValidator()
				);
		
		SiteTexts_PagesHelper::
			set_page_class_name($page_class_name);
	}
}
?>