<?php
/**
 * VideoLibrary_ManageExternalVideosFrameGrabbingQueueAdminRedirectScript
 *
 * @copyright RFI, 2007-01-08
 */

class
	VideoLibrary_ManageExternalVideosFrameGrabbingQueueAdminRedirectScript
extends
	Database_CRUDAdminRedirectScript
{
    protected function
		get_action_method_map()
	{
		$crmm = parent::get_action_method_map();
		
		$crmm['requeue_video'] = 'requeue_video';
		
		return $crmm;
	}
	public function
		reset_everything()
	{
		//print_r($_POST);exit;
		//print_r($_GET);exit;

		$dbh = DB::m();
		$stmt = <<<SQL
UPDATE
	hpi_video_library_external_videos_frame_grabbing_queue
SET
	last_processed IS NULL
SQL;

		//print_r($stmt);exit;

		$result = mysql_query($stmt, $dbh);

		//return $id;
	}

		
	public function
		delete_everything()
	{
		$dbh = DB::m();
		
		$stmt = <<<SQL
TRUNCATE TABLE
	hpi_video_library_external_videos_frame_grabbing_queue
SQL;

		mysql_query($stmt, $dbh);
	}

    public function
		edit_something()
	{
		//print_r($_POST);exit;
		//print_r($_GET);exit;

		$dbh = DB::m();
		$id = mysql_real_escape_string($_GET['id']);

		$stmt = <<<SQL
UPDATE
	hpi_video_library_external_videos_frame_grabbing_queue
SET
	last_processed = NULL
WHERE
	id = $id

SQL;

		//print_r($stmt);exit;

		$result = mysql_query($stmt, $dbh);

		return $id;
	}
    public function
		requeue_video()
	{
		//print_r($_POST);exit;
        // print_r($_GET);exit;

		$dbh = DB::m();
		$id = mysql_real_escape_string($_GET['id']);

		$stmt = <<<SQL
UPDATE
	hpi_video_library_external_videos_frame_grabbing_queue
SET
	last_processed = NULL
WHERE
	id = $id

SQL;

		//print_r($stmt);exit;

		$result = mysql_query($stmt, $dbh);

		return $id;
	}

	public function
		delete_something()
	{
		$dbh = DB::m();
		
		$id = mysql_real_escape_string($_GET['id'], $dbh);
		
		$stmt = <<<SQL
DELETE
FROM
	hpi_video_library_external_videos_frame_grabbing_queue
WHERE
	id = $id
SQL;
		
		#echo $stmt; exit;
		$result = mysql_query($stmt, $dbh);
    }

	public function
		add_something()
	{
		//print_r($_POST);exit;

		$dbh = DB::m();
		$name = mysql_real_escape_string($_POST['name']);
		$description = mysql_real_escape_string($_POST['description']);
		$status = mysql_real_escape_string($_POST['status']);
		$sort_order = mysql_real_escape_string($_POST['sort_order']);

		$stmt = <<<SQL
INSERT
INTO
	hpi_video_library_external_videos_frame_grabbing_queue
SET
	date_added = NOW()

SQL;

		//print_r($stmt);exit;

		$result = mysql_query($stmt, $dbh);

		return mysql_insert_id($dbh);
	}

	protected function
		get_admin_crud_manager_class_name()
	{
		return 'VideoLibrary_ExternalVideosFrameGrabbingQueueCRUDManager';
	}
	
	protected function
		get_required_fields()
	{
		return explode(' ', 'id external_video_id');
	}
}
?>
