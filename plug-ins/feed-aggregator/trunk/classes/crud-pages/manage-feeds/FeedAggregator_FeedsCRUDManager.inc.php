<?php
/**
 * al FeedAggregator_FeedsCRUDManager
 *
 * @copyright RFI, 2007-01-08
 */

class
	FeedAggregator_FeedsCRUDManager
extends
	Database_CRUDAdminManager
{
	public function
		get_admin_page_class_name()
	{
		return 'FeedAggregator_ManageFeedsAdminPage';
	}
	
	public function
		get_admin_redirect_script_class_name()
	{
		return 'FeedAggregator_ManageFeedsAdminRedirectScript';
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
	hpi_feed_aggregator_feeds
WHERE
	id = $id
SQL;

		}
	}
}
?>
