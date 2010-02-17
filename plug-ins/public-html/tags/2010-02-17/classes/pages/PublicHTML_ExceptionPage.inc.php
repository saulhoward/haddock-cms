<?php
/**
 * PublicHTML_ExceptionPage
 *
 * @copyright Clear Line Web Design, 2008-02-05
 */

class
	PublicHTML_ExceptionPage
extends
	PublicHTML_HTMLPage
{
	protected function
		render_head_link_stylesheet()
	{
		parent::render_head_link_stylesheet();
		
		HTMLTags_LinkRenderer
			::render_style_sheet_link(
				'/haddock/public-html/public-html/styles/error.css'
			);
	}
	
	public function
		content()
	{
		PublicHTML_ExceptionRenderer::render_exception_div_from_session();
	}
}
?>