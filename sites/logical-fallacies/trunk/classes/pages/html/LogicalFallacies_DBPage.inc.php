<?php
class
	LogicalFallacies_DBPage
extends
	LogicalFallacies_HTMLPage
{
	public function
		content()
	{
		DBPages_PageRenderer::render_current_page_content();
	}
}
?>