<?php
/**
 * HaddockCMS_SiteTextsHTMLPage
 *
 * @copyright 2010-03-07, Robert Impey
 */

class
	HaddockCMS_SiteTextsHTMLPage
extends
	HaddockCMS_HTMLPage
{
	public function
		content()
	{
		echo SiteTexts_PagesHelper::get_content_for_current_page();
	}
}
?>