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

    protected function
		get_action_method_map()
	{
		$crmm = parent::get_action_method_map();
		
		// $crmm['add_video_to_thumbnail_queue'] = 'add_video_to_thumbnail_queue';
		$crmm['requeue_video_in_thumbnail_queue'] = 'requeue_video_in_thumbnail_queue';
		
		return $crmm;
    }

    public function
		add_video_to_thumbnail_queue($id)
	{
        return VideoLibrary_DatabaseHelper::
            add_video_to_external_videos_frame_grabbing_queue($id);
	}

    public function
		requeue_video_in_thumbnail_queue()
	{
        return VideoLibrary_DatabaseHelper::
            requeue_video_in_external_videos_frame_grabbing_queue_by_external_video_id($_GET['id']);
	}

	public function
		add_something()
	{
		//print_r($_POST);exit;
            if (
            (isset($_POST['name']) && ($_POST['name'] != '')) 
            &&
            (isset($_POST['length']) && ($this->validate_length($_POST['length'])))
            &&
            (isset($_POST['external_video_provider_id']) && ($_POST['external_video_provider_id'] != '')) 
            &&
            (isset($_POST['external_video_library_id']) && ($_POST['external_video_library_id'] != '')) 
            &&
            (isset($_POST['providers_internal_id']) && ($_POST['providers_internal_id'] != '')) 
            &&
            (isset($_POST['status']) && ($_POST['status'] != '')) 
            &&
            ($this->is_video_unique($_POST['external_video_provider_id'], $_POST['providers_internal_id']))
        ) {
            $dbh = DB::m();
            $name = htmlentities($_POST['name']);
            $name = mysql_real_escape_string($name, $dbh);
            $length_seconds = $this->get_length_in_seconds_from_input($_POST['length']);
            $length_seconds = mysql_real_escape_string($length_seconds);
            $external_video_library_id = mysql_real_escape_string($_POST['external_video_library_id']);
            $external_video_provider_id = mysql_real_escape_string($_POST['external_video_provider_id']);
            $providers_internal_id = mysql_real_escape_string($_POST['providers_internal_id']);
            $status = mysql_real_escape_string($_POST['status']);
            $added_by = mysql_real_escape_string(
                VideoLibrary_AdminHelper::get_logged_in_admin_user_name()
            );

            $tags = VideoLibrary_TagsHelper::get_tags_array_for_admin_post_input($_POST['tags']);
            //print_r($tags);exit;

            $stmt = <<<SQL
INSERT
INTO
    hpi_video_library_external_videos
SET
    name = '$name',
    length_seconds = '$length_seconds',
    external_video_provider_id = '$external_video_provider_id',
    providers_internal_id = '$providers_internal_id',
    status = '$status',
    date_added = NOW(),
    added_by = '$added_by'

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

            $this->add_video_to_thumbnail_queue($id);
            return $id;
        } else {
            throw new VideoLibrary_AddVideoDataNotSetException();
        }
	}

    public function
        is_video_unique(
            $external_video_provider_id,
            $providers_internal_id
        )
    {
        if (
            VideoLibrary_DatabaseHelper::
            video_exists_in_external_videos_by_external_video_provider_id_and_providers_internal_id(
                $external_video_provider_id,
                $providers_internal_id
            )
        ) {
            throw new VideoLibrary_VideoAlreadyExistsInDatabaseException();
        }
        return TRUE;
    }

    public function
        get_length_in_seconds_from_input($input)
    {
        /**
         * Nifty regex from:
         *     http://stackoverflow.com/questions/1400297/matching-hours-minutes-seconds-in-regular-expressions-a-better-way
         */
        preg_match('/(?:(?:(?<hh>\d{1,2})[:.])?(?<mm>[0-5]?\d)[:.])?(?<ss>[0-5]?\d)/', $input, $matches);

        // print_r($matches);exit;
        return
            ($matches['hh'] * 3600)
            +
            ($matches['mm'] * 60)
            +
            ($matches['ss']);
    }

	public function
		edit_something()
	{
		//print_r($_POST);exit;
		//print_r($_GET);exit;
        if (
            (isset($_POST['name']) && ($_POST['name'] != '')) 
            &&
            (isset($_POST['length']) && ($this->validate_length($_POST['length'])))
            &&
            (isset($_POST['external_video_provider_id']) && ($_POST['external_video_provider_id'] != '')) 
            &&
            (isset($_POST['external_video_library_id']) && ($_POST['external_video_library_id'] != '')) 
            &&
            (isset($_POST['providers_internal_id']) && ($_POST['providers_internal_id'] != '')) 
            &&
            (isset($_POST['status']) && ($_POST['status'] != '')) 
        ) {

            $dbh = DB::m();
            $id = mysql_real_escape_string($_GET['id']);
            $name = htmlentities($_POST['name']);
            $name = mysql_real_escape_string($name);
            $length_seconds = $this->get_length_in_seconds_from_input($_POST['length']);
            $length_seconds = mysql_real_escape_string($length_seconds);
            $external_video_provider_id = mysql_real_escape_string($_POST['external_video_provider_id']);
            $external_video_library_id = mysql_real_escape_string($_POST['external_video_library_id']);
            $providers_internal_id = mysql_real_escape_string($_POST['providers_internal_id']);
            $status = mysql_real_escape_string($_POST['status']);
            $last_edited_by = mysql_real_escape_string(
                VideoLibrary_AdminHelper::get_logged_in_admin_user_name()
            );

            $tags = VideoLibrary_TagsHelper::get_tags_array_for_admin_post_input($_POST['tags']);

            $stmt = <<<SQL
UPDATE
    hpi_video_library_external_videos
SET
    name = '$name',
    length_seconds = '$length_seconds',
    external_video_provider_id = '$external_video_provider_id',
    providers_internal_id = '$providers_internal_id',
    status = '$status',
    last_edited_by = '$last_edited_by',
    date_last_edited = NOW()

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
        } else {
            throw new VideoLibrary_EditVideoDataNotSetException();
        }
	}

    public function
        validate_length($length)
    {
        /*
         * Should be just 0-9 and : or .
         */
        preg_match('/[^0-9:.]/', $length, $matches);
        // print_r($matches);exit;
        if (isset($matches[0])) throw new VideoLibrary_LengthValidationFailException();
        return TRUE;
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
