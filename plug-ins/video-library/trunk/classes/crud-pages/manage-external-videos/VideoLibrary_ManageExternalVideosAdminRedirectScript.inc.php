<?php
/**
 * VideoLibrary_ManageExternalVideosAdminRedirectScript
 *
 * @copyright RFI, 2007-01-08
 */

class
	VideoLibrary_ManageExternalVideosAdminRedirectScript
extends
	Database_CRUDAdminRedirectScript
{
	public function
		add_something()
	{
		//print_r($_POST);exit;

		$dbh = DB::m();
		$name = mysql_real_escape_string($_POST['name']);
		$external_video_library_id = mysql_real_escape_string($_POST['external_video_library_id']);
		$external_video_provider_id = mysql_real_escape_string($_POST['external_video_provider_id']);
		$providers_internal_id = mysql_real_escape_string($_POST['providers_internal_id']);
		$status = mysql_real_escape_string($_POST['status']);

		$tags = VideoLibrary_TagsHelper::get_tags_array_for_admin_post_input($_POST['tags']);
		//print_r($tags);exit;


		$stmt = <<<SQL
INSERT
INTO
	hpi_video_library_external_videos
SET
	name = '$name',
	external_video_provider_id = '$external_video_provider_id',
	providers_internal_id = '$providers_internal_id',
	status = '$status',
	date_added = NOW()

SQL;

		//print_r($stmt);exit;

		$result = mysql_query($stmt, $dbh);

		$id =  mysql_insert_id($dbh);

		$stmt_2 = <<<SQL
INSERT
INTO
	hpi_video_library_ext_vid_to_ext_vid_lib_links
SET
	external_video_id = '$id',
	external_video_library_id = '$external_video_library_id'

SQL;

		//print_r($stmt);exit;

		$result = mysql_query($stmt_2, $dbh);

		foreach ($tags as $tag) {
			$tag = mysql_real_escape_string($tag);

			$tag_query_1 = <<<SQL
INSERT
INTO
	hpi_video_library_tags
SET
	tag = '$tag',
	principal = 'no'

SQL;
			$result = mysql_query($tag_query_1, $dbh);
			if ($result) {
				$tag_id =  mysql_insert_id($dbh);
			} else {
				if (mysql_errno() == 1062) { #duplicate
					$tag_id 
						= VideoLibrary_DatabaseHelper
						::get_tag_id_for_tag_string($tag); 
				}
			}

			$tag_query_2 = <<<SQL
INSERT
INTO
	hpi_video_library_tags_to_ext_vid_links
SET
	tag_id = '$tag_id',
	external_video_id = '$id'

SQL;

			$result = mysql_query($tag_query_2, $dbh);
			if (!$result) {
				if (mysql_errno() == 1062) { #duplicate
					# Do nothing, link already exists			
				}
			}
		}

		return $id;
	}

	public function
		edit_something()
	{
		//print_r($_POST);exit;
		//print_r($_GET);exit;

		$dbh = DB::m();
		$id = mysql_real_escape_string($_GET['id']);
		$name = mysql_real_escape_string($_POST['name']);
		$external_video_provider_id = mysql_real_escape_string($_POST['external_video_provider_id']);
		$external_video_library_id = mysql_real_escape_string($_POST['external_video_library_id']);
		$providers_internal_id = mysql_real_escape_string($_POST['providers_internal_id']);
		$status = mysql_real_escape_string($_POST['status']);

		$tags = VideoLibrary_TagsHelper::get_tags_array_for_admin_post_input($_POST['tags']);

		$stmt = <<<SQL
UPDATE
	hpi_video_library_external_videos
SET
	name = '$name',
	external_video_provider_id = '$external_video_provider_id',
	providers_internal_id = '$providers_internal_id',
	status = '$status'
WHERE
	id = $id

SQL;

		//print_r($stmt);exit;

		$result = mysql_query($stmt, $dbh);

		$stmt_2 = <<<SQL
UPDATE
	hpi_video_library_ext_vid_to_ext_vid_lib_links
SET
	external_video_library_id = '$external_video_library_id'
WHERE
	external_video_id = '$id'

SQL;

		//print_r($stmt);exit;

		$result = mysql_query($stmt_2, $dbh);

		/*
		 * TAGS
		 */
		$stmt_3 = <<<SQL
DELETE
FROM
	hpi_video_library_tags_to_ext_vid_links
WHERE
	external_video_id = $id
SQL;
		
		#echo $stmt; exit;
		
		mysql_query($stmt_3, $dbh);


		foreach ($tags as $tag) {
			$tag = mysql_real_escape_string($tag);

			$tag_query_1 = <<<SQL
INSERT
INTO
	hpi_video_library_tags
SET
	tag = '$tag',
	principal = 'no'

SQL;

			//print_r($tag_query_1);exit;
			$result = mysql_query($tag_query_1, $dbh);
			if ($result) {
				$tag_id =  mysql_insert_id($dbh);
			} else {
				if (mysql_errno() == 1062) { #duplicate
					$tag_id 
						= VideoLibrary_DatabaseHelper
						::get_tag_id_for_tag_string($tag); 
				}
			}

			$tag_query_2 = <<<SQL
INSERT
INTO
	hpi_video_library_tags_to_ext_vid_links
SET
	tag_id = '$tag_id',
	external_video_id = '$id'

SQL;

			$result = mysql_query($tag_query_2, $dbh);
			if (!$result) {
				if (mysql_errno() == 1062) { #duplicate
					# Do nothing, link already exists			
				}
			}
		}

		VideoLibrary_DatabaseHelper::delete_orphaned_tags();

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
	hpi_video_library_external_videos
WHERE
	id = $id
SQL;
		
		#echo $stmt; exit;
		
		mysql_query($stmt, $dbh);

		$stmt_2 = <<<SQL
DELETE
FROM
	hpi_video_library_ext_vid_to_ext_vid_lib_links
WHERE
	external_video_id = $id
SQL;
		
		#echo $stmt; exit;
		
		mysql_query($stmt_2, $dbh);

		$stmt_3 = <<<SQL
DELETE
FROM
	hpi_video_library_tags_to_ext_vid_links
WHERE
	external_video_id = $id
SQL;
		
		#echo $stmt; exit;
		
		mysql_query($stmt_3, $dbh);

		VideoLibrary_DatabaseHelper::delete_orphaned_tags();
	}
		
	public function
		delete_everything()
	{
		$dbh = DB::m();
		
		$stmt = <<<SQL
TRUNCATE TABLE
	hpi_video_library_external_video_libraries
SQL;

		mysql_query($stmt, $dbh);

		$stmt_2 = <<<SQL
TRUNCATE TABLE
	hpi_video_library_ext_vid_to_ext_vid_lib_links
SQL;

		mysql_query($stmt_2, $dbh);

		$stmt_3 = <<<SQL
TRUNCATE TABLE
	hpi_video_library_tags_to_ext_vid_links
SQL;

		mysql_query($stmt_3, $dbh);

	}
	
	protected function
		get_admin_crud_manager_class_name()
	{
		return 'VideoLibrary_ExternalVideosCRUDManager';
	}
	
	protected function
		get_required_fields()
	{
		return explode(' ', 'date_added name external_video_provider_id providers_internal_id length_seconds status');
	}
}
?>
