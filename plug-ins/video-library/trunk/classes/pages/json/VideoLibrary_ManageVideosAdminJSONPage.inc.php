<?php
/**
 * VideoLibrary_ManageVideosAdminJSONPage
 * 
 * @copyright SANH, 2010-04-08
 *
 */
class
VideoLibrary_ManageVideosAdminJSONPage
extends
VideoLibrary_JSONPage
{
     public function
        render_json()
    {
        if (
            (isset($_GET['ajax']))
            &&
            (isset($_GET['check_providers_internal_id']))
            &&
            (isset($_GET['providers_internal_id']))
            &&
            (isset($_GET['external_video_provider_id']))
        ) {
            $result = VideoLibrary_DatabaseHelper::
                video_exists_in_external_videos_by_external_video_provider_id_and_providers_internal_id(
                    $_GET['external_video_provider_id'],
                    $_GET['providers_internal_id']
                );

            echo '{ "result" : ';
            if ($result) {
                echo 'true';
            } else {
                echo 'false';
            }
            echo ' }';
        }
    }
}
?>
