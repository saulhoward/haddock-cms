<?php
/**
 * VideoLibrary_ManageExternalVideoLibrariesAdminRedirectScript
 *
 * @copyright RFI, 2007-01-08
 */

class
	VideoLibrary_ManageExternalVideoLibrariesAdminRedirectScript
extends
	Database_CRUDAdminRedirectScript
{
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
	hpi_video_library_external_video_libraries
SET
	name = '$name',
	description = '$description',
	sort_order = $sort_order,
	status = '$status',
	date_added = NOW()

SQL;

		//print_r($stmt);exit;

		$result = mysql_query($stmt, $dbh);

		return mysql_insert_id($dbh);
	}

	public function
		edit_something()
	{
		//print_r($_POST);exit;
		//print_r($_GET);exit;

		$dbh = DB::m();
		$id = mysql_real_escape_string($_GET['id']);
		$name = mysql_real_escape_string($_POST['name']);
		$description = mysql_real_escape_string($_POST['description']);
		$status = mysql_real_escape_string($_POST['status']);
		$sort_order = mysql_real_escape_string($_POST['sort_order']);

		$stmt = <<<SQL
UPDATE
	hpi_video_library_external_video_libraries
SET
	name = '$name',
	description = '$description',
	sort_order = $sort_order,
	status = '$status'
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
	hpi_video_library_external_video_libraries
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
	external_video_library_id = $id
SQL;
		
		#echo $stmt; exit;
		
		mysql_query($stmt_2, $dbh);
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
	}
	
	protected function
		get_admin_crud_manager_class_name()
	{
		return 'VideoLibrary_ExternalVideoLibrariesCRUDManager';
	}
	
	protected function
		get_required_fields()
	{
		return explode(' ', 'date_added name description sort-order status');
	}
}
?>
