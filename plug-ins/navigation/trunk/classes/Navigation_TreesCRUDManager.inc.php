<?php
class
	Navigation_TreesCRUDManager
extends
	Database_CRUDAdminManager
{
	public function
		get_admin_page_class_name()
	{
		return 'Navigation_ManageTreesAdminPage';
	}
	
	public function
		get_admin_redirect_script_class_name()
	{
		return 'Navigation_ManageTreesAdminRedirectScript';
	}
	
	public function
		get_query_for_something()
	{
		if ($key_values = $this->get_key_values_from_get_vars()) {
			$id = $key_values['id'];
			
			return <<<SQL
SELECT
	*
FROM
	hpi_navigation_trees
WHERE
	id = $id
SQL;

		}
	}
}
?>