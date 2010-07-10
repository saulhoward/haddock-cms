<?php
/**
 * VideoLibrary_SearchHelper
 *
 * @copyright 2009-01-10, SANH
 */

class
VideoLibrary_SearchHelper
{
    public static function
        get_external_videos_for_search_string(
            $external_video_library_id,
            $search_string,
            $start,
            $duration,
            $options = array(
                'count' => FALSE,
                'admin' => FALSE
            )
        )
    {

        /*
         *Prepare the string
         */
        $search_string = strtolower($search_string);

        /*
         * Search Names of the videos
         */
        $named_videos_sql = VideoLibrary_DatabaseHelper::
            get_sql_parts_for_external_videos_by_searching_in_video_names(
                $external_video_library_id,
                $search_string,
                $start,
                $duration,
                array(
                    'count' => $options['count'],
                    'admin' => $options['admin'],
                    'union_query' => TRUE
                )
            );
        if ($options['count'] == FALSE) {
            /*
             * Because the tagged sql has an extra column (for its 
             * quirky merging behaviour) I have to insert a dummy one 
             * here to union them
             */
            $named_videos_sql['select'] .= ',' . "\n" . 'external_video_id';
        }

        /*
         * Search Tags of the videos,
         */
        $tag_names = array(
            VideoLibrary_TagsHelper::filter_tag($search_string)
        );
        $search_string_exploded = explode(' ', trim($search_string));
        foreach ($search_string_exploded as $tag_name) {
            $tag_names[] = VideoLibrary_TagsHelper::filter_tag($tag_name);
        }
        // print_r($tag_names);exit;

        /*
         * Old style, uses tag1 AND tag2, so less results
         */
        // $tagged_videos_sql = VideoLibrary_DatabaseHelper::
            // get_sql_parts_for_external_videos_for_tag_names(
                // $external_video_library_id,
                // $tag_names,
                // NULL,
                // $start,
                // $duration,
                // array(
                    // 'count' => $options['count'],
                    // 'admin' => $options['admin'],
                    // 'union_query' => TRUE
                // )
            // );
        /*
         * This related vids function uses tag1 OR tag2
         */
        $tag_names = VideoLibrary_DatabaseHelper::limit_tags($tag_names);
        $tagged_videos_sql = VideoLibrary_RelatedVideosDatabaseHelper::
            get_sql_parts_for_external_videos_matching_any_of_these_tags(
                $external_video_library_id,
                $tag_names,
                NULL,
                NULL,
                $start,
                $duration,
                array(
                    'count' => $options['count'],
                    'use_ids_for_tags' => FALSE,
                    'union_query' => TRUE
                )
            );

        $videos = self::get_external_videos_through_union_query(
            array(
                $tagged_videos_sql,
                $named_videos_sql
            ),
            array(
                'count' => $options['count']
            )
        );

        // print_r($videos);exit;
        return $videos;
    }

    public static function
        get_external_videos_count_for_search_string(
            $external_video_library_id,
            $search_string
        )
    {
        return VideoLibrary_SearchHelper::
            get_external_videos_for_search_string(
                $external_video_library_id,
                $search_string,
                NULL,
                NULL,
                array(
                    'count' => TRUE
                )
            );   
    }

    public static function
        get_external_videos_through_union_query(
            $sql_parts, // array
            $options = array(
                'count' => FALSE
            )
        )
    {
        $dbh = DB::m();

        $i =0;
        $query = '';
        if ($options['count']) {
            $query .= 'SELECT count(id) AS count FROM (' . "\n";
        }
        foreach ($sql_parts as $sql) {
            if ($i > 0) {
                $query .= "\n" . 'UNION DISTINCT' . "\n";
            }
            $i++;

            $query .= "\n" . '(';
            $query  .= self::assemble_query_from_sql_parts_for_union($sql);
            $query .= ')' . "\n";
        }

        if ($options['count'] == FALSE) {
            /*
             * Use the limit from the first part
             */
            $query .= "\n" . $sql_parts[0]['limit'];
        } else {
            $query .= ') AS count';
            // print_r($query);exit;
        }

        // print_r($query);exit;
        $result = mysql_query($query, $dbh);
        $videos = array();
        while ($row = mysql_fetch_assoc($result)) {
            $videos[] = $row;
        }   
        if ($options['count']) {
            // print_r($videos);exit;
            return $videos[0]['count'];
        }
        return $videos;
    }

    public static function
        assemble_query_from_sql_parts_for_union(
            $sql
    )
    {
        /**
         * Basically, don't include the 'limit' sql.
         * The 'select' sql is already correct, as we passed the 
         * 'union_query' option when retrieving the sql
         */
        return $sql['select']  . "\n"
            . $sql['from']  . "\n"
            . $sql['joins']  . "\n"
            . $sql['where']  . "\n"
            . $sql['group_by'] . "\n"
            . $sql['order_by'] . "\n";
    }

}
?>
