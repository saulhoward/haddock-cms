<?php
/**
 * FeedAggregator_ManageFeedsAdminRedirectScript
 *
 * @copyright RFI, 2007-01-08
 */

class
	FeedAggregator_ManageFeedsAdminRedirectScript
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
        $id = FeedAggregator_DatabaseHelper::add_feed(
            $_POST['name'],
            $_POST['title'],
            $_POST['description'],
            $_POST['url'],
            $_POST['format'],
            $_POST['sort_order'],
            FeedAggregator_TagsHelper::get_tags_array_for_admin_post_input($_POST['tags'])
        );
        return $id;
    }

	public function
		edit_something()
	{
        // print_r($_POST);exit;
        $id = FeedAggregator_DatabaseHelper::edit_feed(
            $_GET['id'],
            $_POST['name'],
            $_POST['title'],
            $_POST['description'],
            $_POST['url'],
            $_POST['format'],
            $_POST['sort_order'],
            FeedAggregator_TagsHelper::get_tags_array_for_admin_post_input($_POST['tags'])
        );
		return $id;
	}

	public function
		delete_something()
	{
        FeedAggregator_DatabaseHelper::delete_feed($_GET['id']);
		return $_GET['id'];
	}
		
	public function
		delete_everything()
	{
        FeedAggregator_DatabaseHelper::delete_all_feeds();
	}
	
	protected function
		get_admin_crud_manager_class_name()
	{
		return 'FeedAggregator_FeedsCRUDManager';
	}
	
	protected function
		get_required_fields()
	{
		return explode(' ', 'name title description url format');
	}
}
?>
