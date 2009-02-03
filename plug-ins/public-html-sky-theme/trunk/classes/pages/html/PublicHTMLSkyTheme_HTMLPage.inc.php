<?php
/**
 * PublicHTMLSkyTheme_HTMLPage
 *
 * @copyright 2009-02-03, Robert Impey
 */

abstract class
	PublicHTMLSkyTheme_HTMLPage
extends
	PublicHTML_HTMLPage
{
	protected function
		render_head_link_stylesheet()
	{
		HTMLTags_LinkRenderer
			::render_style_sheet_link(
				'http://yui.yahooapis.com/2.3.1/build/reset-fonts-grids/reset-fonts-grids.css'
			);
		HTMLTags_LinkRenderer
			::render_style_sheet_link(
				'http://yui.yahooapis.com/2.3.1/build/base/base-min.css'
			);
		HTMLTags_LinkRenderer
			::render_style_sheet_link(
				'/plug-ins/public-html-sky-theme/public-html/styles/styles.css'
			);
	}
}
?>