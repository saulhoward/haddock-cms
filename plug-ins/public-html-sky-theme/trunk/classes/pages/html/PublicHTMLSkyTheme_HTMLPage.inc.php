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
				'/plug-ins/public-html-sky-theme/public-html/styles/styles.css'
			);
		HTMLTags_LinkRenderer
			::render_style_sheet_link(
				'/plug-ins/public-html-sky-theme/public-html/styles/layout.css'
			);
		HTMLTags_LinkRenderer
			::render_style_sheet_link(
				'/plug-ins/public-html-sky-theme/public-html/styles/type-face.css'
			);
		HTMLTags_LinkRenderer
			::render_style_sheet_link(
				'/plug-ins/public-html-sky-theme/public-html/styles/rounded-corners.css'
			);
		
?>
<!--[if lt IE 7.]>
<link
	href="/plug-ins/public-html-sky-theme/public-html/styles/gifs-for-ie6.css"
	rel="stylesheet"
	type="text/css"
/>
<![endif]-->
<?php
	}
		
	public function
		render_head_script_javascript()
	{
		HTMLTags_ScriptRenderer
			::render_external_js_script(
				'/plug-ins/public-html-sky-theme/public-html/scripts/rounded-corners.js'
			);
		HTMLTags_ScriptRenderer
			::render_external_js_script(
				'/plug-ins/run-on-load/public-html/scripts/run-on-load.js'
			);
		HTMLTags_ScriptRenderer
			::render_external_js_script(
				'/plug-ins/public-html-sky-theme/public-html/scripts/register-functions-to-run-on-load.js'
			);
	}
	
	public function
		render_body()
	{
		$this->render_body_tag_open();
		
		echo "<div id=\"container\">\n";
		
		$this->render_body_div_header();
		
		$this->render_body_div_content();
		
		$this->render_body_div_navigation();
		
		$this->render_body_div_footer();
		
		echo "</div>\n";
		
		echo "</body>\n";
	}
	
	public function
		get_body_div_header()
	{
		$div_header = parent::get_body_div_header();
		
		$div_header->set_attribute_str('class', 'bw-rc');
		
		return $div_header;
	}
	
	public function
		render_body_div_content()
	{
?>
<div id="content" class="bw-rc">
<?php
		$this->content();
?>
</div>
<!-- End of content div -->
<?php
	}
	
	public function
		render_body_div_navigation()
	{
		echo '<div id="navigation" class="bw-rc">' . PHP_EOL;
		$this->render_content_of_body_div_navigation();
		echo '</div>' . PHP_EOL;
	}
}
?>
