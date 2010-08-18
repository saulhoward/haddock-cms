<?php
class
	HaddockCMS_ExceptionPage
extends
	HaddockCMS_HTMLPage
{
	protected function
		render_head_link_stylesheet()
	{
		parent::render_head_link_stylesheet();
		
		HTMLTags_LinkRenderer
			::render_style_sheet_link(
				'/styles/exception-page.css'
			);
	}
	
	public function
		content()
	{
		PublicHTML_ExceptionRenderer::render_exception_div_from_session();
	}
}
?>