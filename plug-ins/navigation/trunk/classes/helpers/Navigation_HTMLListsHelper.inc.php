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
		get_1d_ul_with_selected_lines(
			$tree_name,
			$class_name = NULL,
			$page_class_str = NULL
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

			if (
				($page_class_str != NULL)
				&& 
				(self::is_node_selected($node, $page_class_str))
			)	{
				$li->set_class('selected');
			}
			
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
		is_node_selected(
			$node,
			$page_class_str
		)
	{
		//print_r($node);print_r($page_class_str);exit;
		//print_r($node);print_r($page_class_str);

                /*
		 *Home Page, if it's the Default page and the href is '/'
                 */
		if ($node['url_href'] == '/') {
			$cmf = HaddockProjectOrganisation_ConfigManagerFactory::get_instance();
			$pm = $cmf->get_config_manager('haddock', 'public-html');
			if ('/' . $page_class_str == $pm->get_default_url()) {
				return TRUE;
			}
		}

                /*
		 *DB Page, if the url starts with '/db-pages/'
                 */
		if (substr($node['url_href'], 0, 10) == '/db-pages/') {
			try
			{
				//print_r(
						//strtolower($_GET['page']) . '.html'
						//.
						       //substr($node['url_href'], 11)
					//);
				$cmf = HaddockProjectOrganisation_ConfigManagerFactory::get_instance();
				$config_manager = $cmf->get_config_manager('plug-ins', 'db-pages');
				if ($page_class_str == $config_manager->get_html_page_class_name()) {
					if (
						strtolower($_GET['page']) . '.html'
					       	==
					       	substr($node['url_href'], 10)
					) {
						return TRUE;
					}
				}
			}
			catch (Exception $e)
			{

			}
		}	
		return FALSE;

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
