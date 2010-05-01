<?php
/**
 * VideoLibrary_RelatedVideosDatabaseHelper
 *
 * @copyright 2009-01-10, SANH
 *
 * Contains all MySQL DB functions for the Related Videos functionality 
 * of the VideoLibrary plugin
 */

class
VideoLibrary_RelatedVideosDatabaseHelper
{
    public static function
        get_related_external_videos_for_tag_ids(
            $external_video_library_id,
            $tag_ids,
            $ignore_video_id = NULL,
            $start = NULL,
            $duration = NULL

        )
    {    
        $tag_ids = self::limit_tag_ids($tag_ids);
        $dbh = DB::m();
        $sql = self::get_sql_parts_for_external_videos_for_some_tag_ids_and_external_video_provider_id(
            $external_video_library_id,
            $tag_ids,
            $external_video_provider_id,
            $ignore_video_id,
            NULL,
            NULL,
            array(
                'count' => TRUE
            )
        );
        $query = '';
        $query = self::assemble_query_from_sql_parts($sql);
 
     

    }

}
?>
