<?php
/**
 * Navigation_HTMLListsHelper
 *
 * @copyright 2008-05-01, RFI
 */

/**
 * Provides static functions that help with
 * HTML navigation lists.
 *
 * TO DO:
 * 	Refactor the common elements of get_1d_ul and get_project_specific_1d_ul
 */
class
	Navigation_HTMLListsHelper
{
	public static function
		get_1d_ul(
			$tree_name,
			$class_name = NULL
		)
	{
		if (!isset($class_name)) {
			$class_name = 'navigation';
		}
		
		$nodes
			= Navigation_1DTreeRetriever
				::get_tree_nodes($tree_name);
				
		#print_r($nodes);
		
		#echo "<ul class=\"$class_name\">\n";
		
		$ul = new HTMLTags_UL();
		
		$ul->set_class($class_name);
		
		foreach ($nodes as $node) {
			#Navigation_NodeRenderer::render_node($node);
			
			$li = new HTMLTags_LI();
			
			$li->append(
				Navigation_NodesHelper
					::get_link_a($node)
			);
			
			$ul->add_li(
				$li
			);
		}
		
		return $ul;
	}
	
	public static function
		get_project_specific_1d_ul(
			$tree_name,
			$class_name = NULL
		)
	{
		if (!isset($class_name)) {
			$class_name = 'navigation';
		}
		
		$nodes
			= Navigation_ListsHelper
				::get_project_specific_1d_tree_nodes($tree_name);
		
		$ul = new HTMLTags_UL();
		
		$ul->set_class($class_name);
		
		foreach ($nodes as $node) {
			$li = new HTMLTags_LI();
			
			$li->append(
				Navigation_NodesHelper
					::get_link_a($node)
			);
			
			$ul->add_li(
				$li
			);
		}
		
		return $ul;
	}
	
	public static function
		render_project_specific_1d_ul(
			$tree_name,
			$class_name = NULL
		)
	{
		$project_specific_1d_ul
			= self
				::get_project_specific_1d_ul(
					$tree_name,
					$class_name
				);
		
		echo $project_specific_1d_ul->get_as_string();
	}
}
?>