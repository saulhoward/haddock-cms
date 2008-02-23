<?php
/**
 * News_NewsItemsCRUDManager
 *
 * @copyright RFI, 2007-01-08
 */

class
	News_NewsItemsCRUDManager
extends
	Database_CRUDAdminManager
{
	public function
		get_admin_page_class_name()
	{
		return 'News_ManageNewsItemsAdminPage';
	}
	
	public function
		get_admin_redirect_script_class_name()
	{
		return 'News_ManageNewsItemsAdminRedirectScript';
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
	hpi_news_items
WHERE
	id = $id
SQL;

		}
	}
}
?>