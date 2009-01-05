<?php
class
	DBPages_HTMLPage
extends
	PublicHTML_HTMLPage
{
	public function
		content()
	{
		#if (isset($_GET['page'])) {
		#	DBPages_PageRenderer::render_page_section($_GET['page'], 'content');
		#} else {
		#	echo "<p class=\"error\">Please set the page name!</p>\n";
		#}
		
		DBPages_PageRenderer::render_current_page_content();
	}
}
?>