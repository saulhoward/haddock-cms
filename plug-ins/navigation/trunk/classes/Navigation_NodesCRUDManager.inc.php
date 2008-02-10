<?php
class
	Navigation_NodesCRUDManager
extends 
	Database_CRUDAdminManager
{
	public function
		get_admin_page_class_name()
	{
		return 'Navigation_ManageNodesAdminPage';
	}
	
	public function
		get_admin_redirect_script_class_name()
	{
		return 'Navigation_ManageNodesAdminRedirectScript';
	}
	
	public function
		get_query_for_something()
	{
		if ($key_values = $this->get_key_values_from_get_vars()) {
			$id = $key_values['id'];
			
			return <<<SQL
SELECT
	hpi_navigation_nodes.id AS id,
	hpi_navigation_nodes.sort_order AS sort_order,
	hpi_navigation_nodes.added AS added,
	hpi_navigation_urls.title AS url_title,
	hpi_navigation_urls.id AS url_id,
	hpi_navigation_trees.title AS tree_title,
	hpi_navigation_trees.id AS tree_id,
	hpi_navigation_nodes.parent_id AS parent_id
FROM
	hpi_navigation_nodes
		INNER JOIN hpi_navigation_urls ON
			hpi_navigation_nodes.url_id = hpi_navigation_urls.id
		INNER JOIN hpi_navigation_trees ON
			hpi_navigation_nodes.tree_id = hpi_navigation_trees.id
WHERE
	hpi_navigation_nodes.id = $id
SQL;

		}
	}
}
?>