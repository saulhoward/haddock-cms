<?php
/**
 * UserLogin_CreateHtmlPagesCLIScript
 *
 * @copyright 2011-07-30, Robert Impey
 */

class
	UserLogin_CreateHtmlPagesCLIScript
extends
	CLIScripts_CLIScript
{
	public function
		do_actions()
	{
		UserLogin_HtmlPagesHelper::create_html_pages();
	}
}
?>