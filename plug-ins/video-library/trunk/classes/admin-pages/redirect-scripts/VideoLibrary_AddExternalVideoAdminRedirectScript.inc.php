<?php
/**
 * VideoLibrary_AddExternalVideoAdminRedirectScript
 *
 * @copyright 2010-06-19, Saul Howard
 */


class
VideoLibrary_AddExternalVideoAdminRedirectScript
extends
PublicHTML_RedirectScript                                                                                                          
{
    protected function
        do_actions() 
    {
        //print_r($_POST);exit;

        /** EXAMPLE FORM POST
         *<textarea name="contents">
         *$contents
         *</textarea>
         *<input type="hidden" name="filter_function" value="$filter_function" />
         *<input type="hidden" name="page" value="$page" />
         *<input type="hidden" name="section" value="$section" />
         *<input type="hidden" name="language" value="$name" />
         *<input type="hidden" name="path" value="$path" />
         *<input type="submit" value="Edit" /> 
         */

        $return_url = VideoLibrary_URLHelper::get_home_page_url();     

        if (Admin_LogInHelper::is_logged_id()) {

            $return_url = $this->get_redirect_script_return_url();
            // print_r($return_url);exit;

            try
            {
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
                } else {
                    throw new VideoLibrary_AddVideoDataNotSetException();
                }
            }
            catch (VideoLibrary_Exception $e)
            {
                $return_url->set_get_variable('error', urlencode($e->getMessage()));

            }
            $return_url->set_get_variable('edited', '1');
            $return_url->set_get_variable('message', 'Added Video ' . urlencode('#') . $id);
        }
        $this->set_return_to_url($return_url);
    }

    private function     
        get_redirect_script_return_url()     
    {
        return VideoLibrary_URLHelper::get_add_external_video_admin_page_url();     
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



}       
?> 
