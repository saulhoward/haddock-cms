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
		add_something()
	{
		//print_r($_POST);exit;

		$dbh = DB::m();
		$tag = mysql_real_escape_string($_POST['tag']);
		$principal = mysql_real_escape_string($_POST['principal']);

		$stmt = <<<SQL
INSERT
INTO
	hpi_video_library_tags
SET
	tag = '$tag',
	principal = '$principal'

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
		$tag = mysql_real_escape_string($_POST['tag']);
		$principal = mysql_real_escape_string($_POST['principal']);

		$stmt = <<<SQL
UPDATE
	hpi_video_library_tags
SET
	tag = '$tag',
	principal = '$principal'
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
	hpi_video_library_tags
WHERE
	id = $id
SQL;
		
		#echo $stmt; exit;
		
		mysql_query($stmt, $dbh);

		$stmt_2 = <<<SQL
DELETE
FROM
	hpi_video_library_tags_to_ext_vid_links
WHERE
	tag_id = $id
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
	hpi_video_library_tags
SQL;

		mysql_query($stmt, $dbh);

		$stmt_2 = <<<SQL
TRUNCATE TABLE
	hpi_video_library_tags_to_ext_vid_links
SQL;

		mysql_query($stmt_2, $dbh);
	}
	
	protected function
		get_admin_crud_manager_class_name()
	{
		return 'VideoLibrary_TagsCRUDManager';
	}
	
	protected function
		get_required_fields()
	{
		return explode(' ', 'tag principal');
	}
}
?>
