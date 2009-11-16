<?php
/**
 * VideoLibrary_ExternalVideosFrameGrabbingQueueCRUDManager
 *
 * @copyright RFI, 2007-01-08
 */

class
	VideoLibrary_ExternalVideosFrameGrabbingQueueCRUDManager
extends
	Database_CRUDAdminManager
{
	public function
		get_admin_page_class_name()
	{
		return 'VideoLibrary_ManageExternalVideosFrameGrabbingQueueAdminPage';
	}
	
	public function
		get_admin_redirect_script_class_name()
	{
		return 'VideoLibrary_ManageExternalVideosFrameGrabbingQueueAdminRedirectScript';
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
	hpi_video_library_external_videos_frame_grabbing_queue
WHERE
	id = $id
SQL;

		}
	}
}
?>
