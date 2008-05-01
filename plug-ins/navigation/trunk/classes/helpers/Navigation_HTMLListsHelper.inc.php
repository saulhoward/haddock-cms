<?php
/**
 * Navigation_HTMLListsHelper
 *
 * @copyright 2008-05-01, RFI
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
}
?>