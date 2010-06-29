<?php
/**
 * VideoLibrary_ManageExternalVideoProvidersAdminRedirectScript
 *
 * @copyright RFI, 2007-01-08
 */

class
	VideoLibrary_ManageExternalVideoProvidersAdminRedirectScript
extends
	Database_CRUDAdminRedirectScript
{
	public function
		add_something()
	{
		//print_r($_POST);exit;

		$dbh = DB::m();
		$name = mysql_real_escape_string($_POST['name']);
		$url = mysql_real_escape_string($_POST['url']);
		$status = mysql_real_escape_string($_POST['status']);
		$haddock_class_name = mysql_real_escape_string($_POST['haddock_class_name']);

		$stmt = <<<SQL
INSERT
INTO
	hpi_video_library_external_video_providers
SET
	name = '$name',
	url = '$url',
	haddock_class_name = '$haddock_class_name',
	status = '$status'

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
		$url = mysql_real_escape_string($_POST['url']);
		$status = mysql_real_escape_string($_POST['status']);
		$haddock_class_name = mysql_real_escape_string($_POST['haddock_class_name']);

		$stmt = <<<SQL
UPDATE
	hpi_video_library_external_video_providers
SET
	name = '$name',
	url = '$url',
	haddock_class_name = '$haddock_class_name',
	status = '$status'
WHERE
	id = $id

SQL;

        // print_r($stmt);exit;

		$result = mysql_query($stmt, $dbh);

		return $id;
	}

	public function
		delete_something()
	{
		// $dbh = DB::m();
		
		// $id = mysql_real_escape_string($_GET['id'], $dbh);
		
		// $stmt = <<<SQL
// DELETE
// FROM
	// hpi_video_library_external_video_providers
// WHERE
	// id = $id
// SQL;
		
		// #echo $stmt; exit;
		
		// mysql_query($stmt, $dbh);

		// $stmt_2 = <<<SQL
// DELETE
// FROM
	// hpi_video_library_ext_vid_to_ext_vid_lib_links
// WHERE
	// external_video_library_id = $id
// SQL;
		
		// #echo $stmt; exit;
		
		// mysql_query($stmt_2, $dbh);
	}
		
	public function
		delete_everything()
	{
		// $dbh = DB::m();
		
		// $stmt = <<<SQL
// TRUNCATE TABLE
	// hpi_video_library_external_video_providers
// SQL;

		// mysql_query($stmt, $dbh);

		// $stmt_2 = <<<SQL
// TRUNCATE TABLE
	// hpi_video_library_ext_vid_to_ext_vid_lib_links
// SQL;

		// mysql_query($stmt_2, $dbh);
	}
	
	protected function
		get_admin_crud_manager_class_name()
	{
		return 'VideoLibrary_ExternalVideoProvidersCRUDManager';
	}
	
	protected function
		get_required_fields()
	{
		return explode(' ', 'name url haddock_class_name status');
	}
}
?>
