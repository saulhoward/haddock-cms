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
		$providers_url = mysql_real_escape_string($_POST['providers_url']);
		$status = mysql_real_escape_string($_POST['status']);
		$length_seconds = mysql_real_escape_string($_POST['length_seconds']);

		$stmt = <<<SQL
INSERT
INTO
	hpi_video_library_external_videos
SET
	name = '$name',
	external_video_provider_id = '$external_video_provider_id',
	providers_internal_id = '$providers_internal_id',
	providers_url = '$providers_url',
	length_seconds = '$length_seconds',
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
		$providers_url = mysql_real_escape_string($_POST['providers_url']);
		$status = mysql_real_escape_string($_POST['status']);
		$length_seconds = mysql_real_escape_string($_POST['length_seconds']);

		$stmt = <<<SQL
UPDATE
	hpi_video_library_external_videos
SET
	name = '$name',
	external_video_provider_id = '$external_video_provider_id',
	providers_internal_id = '$providers_internal_id',
	providers_url = '$providers_url',
	length_seconds = '$length_seconds',
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
		return explode(' ', 'date_added name external_video_provider_id providers_internal_id providers_url length_seconds status');
	}
}
?>
