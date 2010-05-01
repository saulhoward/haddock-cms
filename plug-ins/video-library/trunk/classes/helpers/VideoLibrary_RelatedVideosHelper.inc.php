<?php
/**
 * VideoLibrary_RelatedVideosHelper
 *
 * @copyright 2010-02-24, SANH
 */

class
VideoLibrary_RelatedVideosHelper
{
    public static function
        get_related_videos_count_for_external_video_data(
            $external_video_library_id,
            $video_data,
            $external_video_provider_id = NULL
        )
    {
        /*
         * TODO: Change these to functions that actually count the 
         * number of related videos (ie. tag1 OR tag2 OR tag3)
         * Right now, they are looking for videos that have every tag
         */
        $tag_ids = array();
        foreach ($video_data['tags'] as $tag) {
            $tag_ids[] = $tag['id'];
        }
        if (isset($external_video_provider_id)) {
            return VideoLibrary_DatabaseHelper::
                get_external_videos_count_for_tag_ids_and_external_video_provider_id(
                    $external_video_library_id,
                    $tag_ids,
                    $external_video_provider_id,
                    $video_data['id']
                );
        } else {
            return VideoLibrary_DatabaseHelper::
                get_external_videos_count_for_tag_ids(
                    $external_video_library_id,
                    $tag_ids,
                    $video_data['id']
                );
        }
    }

    public static function
        get_related_videos_for_external_video_data(
            $external_video_library_id,
            $video_data,
            $external_video_provider_id = NULL,
            $start = NULL,
            $duration = NULL
        )
    {
        /*
         * TODO:
         *        Surely a better way of extracting this data?
         */
        $tag_ids = array();
        foreach ($video_data['tags'] as $tag) {
            $tag_ids[] = $tag['id'];
        }

        if (isset($external_video_provider_id)) {
            return VideoLibrary_DatabaseHelper::
                get_external_videos_for_tag_ids_and_external_video_provider_id_weighted_for_principal_tags(
                    $external_video_library_id,
                    $tag_ids,
                    $external_video_provider_id,
                    $video_data['id'],
                    $start,
                    $duration
                );
        } else {
            return VideoLibrary_DatabaseHelper::
                get_related_external_videos_for_tag_ids(
                    $external_video_library_id,
                    $tag_ids,
                    $video_data['id'],
                    $start,
                    $duration
                );
        }
    }

}
?>
