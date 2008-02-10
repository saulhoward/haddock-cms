<?php
class
	Navigation_SPoE
{
	public static function
		render_tree($tree_name)
	{
		$dbh = DB::m();
		
		$query = <<<SQL
SELECT
	hpi_navigation_trees.title AS tree_title,
	hpi_navigation_nodes.id AS node_id,
	hpi_navigation_nodes.parent_id AS parent_id,
	hpi_navigation_nodes.sort_order AS sort_order,	
	hpi_navigation_nodes.open_in_new_window AS open_in_new_window,
	hpi_navigation_urls.title AS url_title,
	hpi_navigation_urls.href AS url_href
FROM
	hpi_navigation_trees
		INNER JOIN hpi_navigation_nodes ON
			hpi_navigation_trees.id = hpi_navigation_nodes.tree_id
		INNER JOIN hpi_navigation_urls ON
			hpi_navigation_nodes.url_id = hpi_navigation_urls.id
WHERE
	hpi_navigation_trees.title = '$tree_name'
ORDER BY
	sort_order ASC
	
SQL;

		#echo $query; exit;
		
		$result = mysql_query($query, $dbh);
		
		$nodes = array();
		
		while ($row = mysql_fetch_assoc($result)) {
			$nodes[] = $row;
		}
		
		#print_r($nodes);
		#exit;
		
		$links_tree = new Navigation_LinksTree($node);
		
		$links_tree->render_ol();
	}
}
?>