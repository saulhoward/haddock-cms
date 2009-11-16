<?php
/**
 * VideoLibrary_ManageTagsAdminRedirectScript
 *
 * @copyright RFI, 2007-01-08
 */

class
	VideoLibrary_ManageTagsAdminRedirectScript
extends
	Database_CRUDAdminRedirectScript
{


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
