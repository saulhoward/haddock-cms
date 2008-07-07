<?php
/**
 * HaddockCMS_DBPage
 *
 * @copyright 2008-07-07, RFI
 */

class
	HaddockCMS_DBPage
extends
	HaddockCMS_HTMLPage
{
	public function
		content()
	{
		DBPages_PageRenderer
			::render_current_page_content();
	}
}
?>