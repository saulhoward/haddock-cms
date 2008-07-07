<?php
/**
 * Navigation_1DTreeRetriever
 *
 * @copyright 2008-07-07, RFI
 */

class
	Navigation_1DTreeRetriever
{
	public static function
		get_tree_nodes($tree_name)
	{
		$dbh = DB::m();
		
		$tree_name = mysql_real_escape_string($tree_name, $dbh);
		
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
		
		return $nodes;
	}
}
?>