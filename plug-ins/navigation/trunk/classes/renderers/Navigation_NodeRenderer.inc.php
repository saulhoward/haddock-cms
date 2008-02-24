<?php
class
	Navigation_NodeRenderer
{
	public static function
		render_node($node)
	{
		#print_r($node);
		
		echo '<a ';
		echo ' href="' . $node['url_href'] . '" ' ;
		echo ' title="' . $node['url_title'] . '" ';
		
		if ($node['open_in_new_window'] == 'Yes') {
			echo ' target="_blank" ';
		}
		
		echo '>';
		
		echo $node['url_title'];
		
		echo "</a>\n";
	}
}
?>