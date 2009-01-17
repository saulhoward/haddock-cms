<?php
/**
 * PublicHTML_CreateProjectSpecificHTMLPageClassCLIScript
 *
 * @copyright 2008-06-13, Robert Impey
 */

class
	PublicHTML_CreateProjectSpecificHTMLPageClassCLIScript
extends
	CLIScripts_CLIScript
{
	public function
		do_actions()
	{
		PublicHTML_ProjectSpecificHTMLPageClassesHelper
			::create_project_specific_html_page_class();
	}
}
?>