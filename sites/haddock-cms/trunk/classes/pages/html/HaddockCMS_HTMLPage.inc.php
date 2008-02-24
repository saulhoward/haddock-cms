<?php
abstract class
	HaddockCMS_HTMLPage
extends
	PublicHTML_HTMLPage
{
	public function
		get_head_meta_keywords()
	{
		return 'haddock, clearlinewebdesign, PHP, object-oriented, content management system, head quarters';
	}
	
	public function
		get_head_meta_description()
	{
		return 'Head quarters for the Haddock CMS Framework.';
	}
	
	protected function
		render_head_link_stylesheet()
	{
		HTMLTags_LinkRenderer
			::render_style_sheet_link(
				'/styles/layout.css'
			);
		HTMLTags_LinkRenderer
			::render_style_sheet_link(
				'/styles/type-face.css'
			);
		HTMLTags_LinkRenderer
			::render_style_sheet_link(
				'/styles/rounded-corners.css'
			);
		
?>
<!--[if lt IE 7.]>
<link href="/styles/gifs-for-ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
<?php
	}
	
	public function
		render_head_script_javascript()
	{
?>
<script type="text/javascript" src="/scripts/rounded-corners.js"></script>
<?php
	}
	
	public function
		render_body()
	{
		$this->render_body_tag_open();
		
		echo "<div id=\"container\">\n";
		
		$this->render_body_div_header();
		
		$this->render_body_div_navigation();
		
		$this->render_body_div_content();
		
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
		#echo __METHOD__; exit;
		
		echo "<div id=\"navigation\" class=\"bw-rc\">\n";
		
		#Navigation_SPoE::render_tree('Left Nav');
		
		Navigation_1DULRenderer::render_ul('Left Nav');
		
		echo "</div>\n";
	}
	
	public function
		render_body_div_footer()
	{
?>
<div id="footer">
	&copy 2008, Robert Impey
</div>
<?php
	}
	
	public function
		render_html()
	{
		parent::render_html();
?>
<script type="text/javascript">
round_all_corners('bw-rc');
</script>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-1939164-4");
pageTracker._initData();
pageTracker._trackPageview();
</script>
<?php
	}
}
?>