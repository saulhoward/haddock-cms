<?php
/**
 * HaddockCMS_HTMLPage
 *
 * @copyright 2008-05-01, RFI
 */

abstract class
	HaddockCMS_HTMLPage
extends
	PublicHTMLSkyTheme_HTMLPage
{
	public function
		get_head_meta_keywords()
	{
		return 'haddock, PHP, object-oriented, content management system, head quarters';
	}
	
	public function
		get_head_meta_description()
	{
		return 'Head quarters for the Haddock CMS Framework.';
	}
	
#	protected function
#		render_head_link_stylesheet()
#	{
#		parent::render_head_link_stylesheet();
#		
#		#HTMLTags_LinkRenderer
#		#	::render_style_sheet_link(
#		#		'/styles/layout.css'
#		#	);
#		#HTMLTags_LinkRenderer
#		#	::render_style_sheet_link(
#		#		'/styles/type-face.css'
#		#	);
#		#HTMLTags_LinkRenderer
#		#	::render_style_sheet_link(
#		#		'/styles/rounded-corners.css'
#		#	);
#		
##
##<!--[if lt IE 7.]>
##<link href="/styles/gifs-for-ie6.css" rel="stylesheet" type="text/css" />
##<![endif]-->
##<?php
#	}
	
	#public function
	#	render_head_script_javascript()
	#{
	#	HTMLTags_ScriptRenderer
	#		::render_external_js_script(
	#			'/scripts/rounded-corners.js'
	#		);
	#}
	
	#public function
	#	render_body()
	#{
	#	$this->render_body_tag_open();
	#	
	#	echo "<div id=\"container\">\n";
	#	
	#	$this->render_body_div_header();
	#	
	#	#$this->render_body_div_features_navigation();
	#	
	#	$this->render_body_div_content();
	#	
	#	$this->render_body_div_secondary_navigation();
	#	
	#	$this->render_body_div_footer();
	#	
	#	echo "</div>\n";
	#	
	#	echo "</body>\n";
	#}
	
	#public function
	#	get_body_div_header()
	#{
	#	$div_header = parent::get_body_div_header();
	#	
	#	$div_header->set_attribute_str('class', 'bw-rc');
	#	
	#	$features_navigation_div
	#		= $this
	#			->get_features_navigation_div();
	#	
	#	$div_header->append($features_navigation_div);
	#	
	#	return $div_header;
	#}
	
#	public function
#		render_body_div_content()
#	{
#
#<div id="content" class="bw-rc">
#<?php
#		$this->content();
#
#</div>
#<!-- End of content div -->
#<?php
#	}
	
	#public function
	#	render_body_div_features_navigation()
	#{
	#	#echo __METHOD__; exit;
	#	
	#	//echo "<div id=\"features_navigation\" class=\"bw-rc\">\n";
	#	//
	#	//#Navigation_SPoE::render_tree('Left Nav');
	#	//
	#	//Navigation_1DULRenderer::render_ul('features');
	#	//
	#	//echo "</div>\n";
	#	
	#	$div = $this->get_features_navigation_div();
	#	
	#	echo $div->get_as_string();
	#}
	
	#public function
	#	get_features_navigation_div()
	#{
	#	$div = new HTMLTags_Div();
	#	
	#	$div->set_id('features_navigation');
	#	
	#	$ul
	#		#= Navigation_HTMLListsHelper
	#		#	::get_1d_ul(
	#		#		'features'
	#		#	);
	#		= Navigation_HTMLListsHelper
	#			::get_project_specific_1d_ul(
	#				'features'
	#			);
	#	
	#	$div->append($ul);
	#	
	#	return $div;
	#}
	
	#public function
	#	render_body_div_secondary_navigation()
	#{
	#	#echo __METHOD__; exit;
	#	
	#	echo "<div id=\"secondary_navigation\" class=\"bw-rc\">\n";
	#	
	#	#Navigation_SPoE::render_tree('secondary');
	#	
	#	#Navigation_1DULRenderer
	#	#	::render_ul('secondary');
	#	Navigation_HTMLListsHelper
	#		::render_project_specific_1d_ul(
	#			'secondary'
	#		);
	#	
	#	echo "</div>\n";
	#}
	
	
	protected function
		get_navigation_pages()
	{
		$navigation_pages[] = array(
			'page-class' => 'HaddockCMS_SiteTextsHTMLPage',
			'href' => '/',
			'title' => 'Home',
			'text' => 'Home'
		);
		
		$navigation_pages[] = array(
			'page-class' => 'HaddockCMS_SiteTextsHTMLPage',
			'href' => '/site-texts-pages/example-sites.html',
			'title' => 'Example Sites',
			'text' => 'Example Sites'
		);
		
		$navigation_pages[] = array(
			'page-class' => 'HaddockCMS_SiteTextsHTMLPage',
			'href' => '/site-texts-pages/contact.html',
			'title' => 'Contact',
			'text' => 'Contact'
		);
		
		return $navigation_pages;
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