<?php
/**
 * FeedAggegator_ManageRetrievalQueueAdminRedirectScript
 *
 * @copyright RFI, 2007-01-08
 */

class
	FeedAggegator_ManageRetrievalQueueAdminRedirectScript
extends
	Database_CRUDAdminRedirectScript
{

    protected function
		get_action_method_map()
	{
		$crmm = parent::get_action_method_map();
		// $crmm['add_video_to_thumbnail_queue'] = 'add_video_to_thumbnail_queue';
		
		return $crmm;
    }

	public function
		add_something()
    {
        //print_r($_POST);exit;
        throw new FeedAggregator_Exception(
            "Tried to add something to the Feed Retrieval Queue from the admin page."
        );
    }

	public function
		edit_something()
	{
        //print_r($_POST);exit;
        $id = FeedAggegator_DatabaseHelper::
            edit_feed_status_and_frequency_in_retrieval_queue(
            $_POST['id'],
            $_post['status'],
            $_POST['frequency_minutes']
        );
		return $id;
	}

	public function
		delete_something()
	{
        throw new FeedAggregator_Exception(
            "Tried to delete something from the Feed Retrieval Queue from the admin page."
        );
	}
		
	public function
		delete_everything()
	{
        throw new FeedAggregator_Exception(
            "Tried to delete all Feeds from the Feed Retrieval Queue from the admin page."
        );
	}
	
	protected function
		get_admin_crud_manager_class_name()
	{
		return 'FeedAggegator_RetrievalQueueCRUDManager';
	}
	
	protected function
		get_required_fields()
	{
		return explode(' ', ' feed_id last_retrieved status frequency_minutes');
	}
}
?>
