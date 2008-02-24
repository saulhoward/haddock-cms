<?php
class
	HaddockCMS_DBPage
extends
	HaddockCMS_HTMLPage
{
	public function
		content()
	{
		DBPages_PageRenderer::render_current_page_content();
	}
}
?>