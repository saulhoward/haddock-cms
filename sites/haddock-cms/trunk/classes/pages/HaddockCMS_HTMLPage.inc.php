<?php
abstract class
	HaddockCMS_HTMLPage
extends
	PublicHTML_HTMLPage
{
	public function
		render_body_div_navigation()
	{
		#echo __METHOD__; exit;
		
		echo "<div id=\"navigation\">\n";
		
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
}
?>