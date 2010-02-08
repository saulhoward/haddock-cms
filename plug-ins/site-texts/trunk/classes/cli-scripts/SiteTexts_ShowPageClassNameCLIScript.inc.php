<?php
/**
 * SiteTexts_ShowPageClassNameCLIScript
 *
 * @copyright 2010-02-08, Robert Impey
 */

class
	SiteTexts_ShowPageClassNameCLIScript
extends
	CLIScripts_CLIScript
{
	public function
		do_actions()
	{
		echo SiteTexts_PagesHelper::get_page_class_name() . PHP_EOL;
	}
}
?>