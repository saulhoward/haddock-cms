<?php
/**
 * FeedAggegator_ManageFeedsAdminRedirectScript
 *
 * @copyright RFI, 2007-01-08
 */

class
	FeedAggegator_ManageFeedsAdminRedirectScript
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
        $id = FeedAggegator_DatabaseHelper::add_feed(
            $_POST['name'],
            $_POST['title'],
            $_POST['description'],
            $_POST['url'],
            $_POST['format']
        );
        return $id;
    }

	public function
		edit_something()
	{
        //print_r($_POST);exit;
        $id = FeedAggegator_DatabaseHelper::edit_feed(
            $_POST['id'],
            $_POST['name'],
            $_POST['title'],
            $_POST['description'],
            $_POST['url'],
            $_POST['format']
        );
		return $id;
	}

	public function
		delete_something()
	{
        $id = FeedAggegator_DatabaseHelper::delete_feed(
            $_POST['id']
        );
		return $id;
	}
		
	public function
		delete_everything()
	{
        FeedAggegator_DatabaseHelper::delete_all_feeds();
	}
	
	protected function
		get_admin_crud_manager_class_name()
	{
		return 'FeedAggegator_FeedsCRUDManager';
	}
	
	protected function
		get_required_fields()
	{
		return explode(' ', 'name title description url format');
	}
}
?>
