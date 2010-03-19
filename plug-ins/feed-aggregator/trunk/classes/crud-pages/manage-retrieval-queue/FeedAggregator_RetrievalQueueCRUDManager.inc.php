<?php
/**
 * al FeedAggegator_RetrievalQueueCRUDManager
 *
 * @copyright RFI, 2007-01-08
 */

class
	FeedAggegator_RetrievalQueueCRUDManager
extends
	Database_CRUDAdminManager
{
	public function
		get_admin_page_class_name()
	{
		return 'FeedAggegator_ManageRetrievalQueueAdminPage';
	}
	
	public function
		get_admin_redirect_script_class_name()
	{
		return 'FeedAggegator_ManageRetrievalQueueAdminRedirectScript';
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
	hpi_feed_aggregator_retrieval_queue
WHERE
	id = $id
SQL;

		}
	}
}
?>
