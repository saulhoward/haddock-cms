<?php
class
	Navigation_1DULRenderer
{
	public static function
		render_ul(
			$tree_name,
			$class_name = 'navigation'
		)
	{
		$nodes = Navigation_1DTreeRetriever::get_tree_nodes($tree_name);
		
		#print_r($nodes);
		
		echo "<!-- $tree_name navigation UL -->\n";
		
		echo "<ul class=\"$class_name\">\n";
		
		foreach ($nodes as $node) {
			echo "<li>\n";
			
			Navigation_NodeRenderer::render_node($node);
			
			echo "</li>\n";
		}
		
		echo "</ul>\n";
	}
}
?>