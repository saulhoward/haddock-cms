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
		get_1d_ol(
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
		
		$ul = new HTMLTags_OL();
		
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
		get_1d_ul_with_spans_and_selected_lines(
			$tree_name,
			$class_name = NULL,
			$page_class_str = NULL
		)
	{
        return self::get_1d_ul_with_selected_lines(
            $tree_name,
            $class_name,
            $page_class_str,
            array(
                'use_span' => TRUE
            )
        );
	}

	public static function
		get_1d_ul_with_selected_lines(
			$tree_name,
			$class_name = NULL,
            $page_class_str = NULL,
            $options = array(
                'use_span' => FALSE
            )
		)
	{
        return self::get_1d_ul_with_selected_lines_using_custom_function(
            $tree_name,
            $class_name,
            $page_class_str,
            $selected_function = 'return Navigation_HTMLListsHelper::is_node_selected($node, $page_class_str);',
            $options
        );

	}

	public static function
		get_1d_ul_with_selected_lines_using_custom_function(
			$tree_name,
			$class_name = NULL,
            $page_class_str = NULL,
            $selected_function = 'return Navigation_HTMLListsHelper::is_node_selected($node, $page_class_str);',
            $options = array(
                'use_span' => FALSE
            )
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
			$li->set_attribute_str(
				'id',
				self::get_line_css_id($node['url_href'])
			);

            // print_r($selected_function);exit;

			if (
				($page_class_str != NULL)
				&& 
				(eval($selected_function))
			)	{
				$li->set_class('selected');
			}
			
            if ($options['use_span']) {
                $li->append(
                    Navigation_NodesHelper
                    ::get_link_a_with_span($node)
                );
            } else {
                $li->append(
                    Navigation_NodesHelper
                    ::get_link_a($node)
                );
            }
			
			$ul->add_li(
				$li
			);
		}
		
		return $ul;
	}

	public static function 
		get_line_css_id(
			$url_href
		)
	{
        /**
         * Guess the most appropriate id attribute to give each line
         * of the ul -- they need to be unique, so we're gonna start
         * by using the url_href
         */
        $url_href = strtolower(str_replace(' ', '', $url_href));
		if ($url_href == '/') {
		       	return 'home';
		} elseif (strpos($url_href, '.html')) {
			preg_match('/\/([^\/]*)\.html/', $url_href, $matches);
			return $matches[1];
		} else {
			preg_match('/\/([^\/]*)$/', $url_href, $matches);
			return $matches[1];
		}


		return 'home';
	}

	public static function 
		is_node_selected(
			$node,
			$page_class_str
		)
	{
        //print_r($node);print_r($page_class_str);
		//print_r($_GET);
		//print_r($_SERVER['SCRIPT_NAME']);exit;
		//print_r($node);print_r($page_class_str);exit;

        /**
		 * This is a best guess attempt at whether this node is the same 
		 * as the page we're currently on. Based on various guesses about
		 * plug-ins and normal practices, it  seems to work so far...
         */

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

		$clean_url_str = str_replace('/', '', $node['url_href']);
		if (
			preg_match('/' . $clean_url_str . '/i', $page_class_str, $matches)
		) {
			return TRUE;
		}

        /**
		 * Site Texts plug in. 
		 * At the mo, ['site-texts'] & ['language']
		 * get info and the .htaccess rule which translates 
		 * them from /en/home.html or /fr/home.html
		 * is only set in one certain proj-spec,
		 * but I wanna move it up so I included this code here
         */
		if (isset($_GET['site-texts'])) {
			if (
				isset($_GET['language'])
				&&
				isset($_GET['page'])
			) {
				if (
					'/' 
					. $_GET['language'] 
					. '/' 
					. $_GET['page'] 
					. '.html' 
					== 
					$node['url_href']
				) {
					return TRUE;
				}
				if (
					($node['url_href'] == '/')
					&&
					($_GET['page'] == 'home')
				) {
					return TRUE;
				}
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
