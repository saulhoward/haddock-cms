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
                    'admin' => $options['admin']
                )
            );
        if ($options['count'] == FALSE) {
            /*
             * Because the tagged sql has an extra column, for its 
             * quirky merging behaviour, I have to insert a dummy one 
             * here to union them
             */
            $named_videos_sql['select'] .= ',' . "\n" . 'external_video_id';
        }

        /*
         * Search Tags of the videos,
         * currently only matches if the search str is an exact tag
         */
        $tag_names = array(
            VideoLibrary_TagsHelper::filter_tag($search_string)
        );
        $tagged_videos_sql = VideoLibrary_DatabaseHelper::
            get_sql_parts_for_external_videos_for_tag_names(
                $external_video_library_id,
                $tag_names,
                NULL,
                $start,
                $duration,
                array(
                    'count' => $options['count'],
                    'admin' => $options['admin']
                )
            );

        $videos = self::get_videos_for_union(
            array(
                $named_videos_sql,
                $tagged_videos_sql
            ),
            array(
                'count' => $options['count']
            )
        );

        if ($options['count']) {
            return $videos[0]['count'];
        }
        // print_r($videos);exit;
        return $videos;

    }

    public static function
        get_external_videos_count_for_search_string(
            $external_video_library_id,
            $search_string
        )
    {
        $count = VideoLibrary_SearchHelper::
            get_external_videos_for_search_string(
                $external_video_library_id,
                $search_string,
                NULL,
                NULL,
                array(
                    'count' => TRUE
                )
            );   

        // print_r($count);exit;

        return $count;

    }

    public static function
        get_videos_for_union(
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
            $query .= 'SELECT SUM(count) AS count FROM (' . "\n";
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
        $result = mysql_query($query, $dbh);

        $videos = array();

        while ($row = mysql_fetch_assoc($result)) {
            $videos[] = $row;
        }   
        //print_r($tags);exit;
        if ($options['count']) {
            // print_r($videos);exit;
            // return array($videos);
        } 
        return $videos;
    }

    public static function
        assemble_query_from_sql_parts_for_union($sql)
    {
        return $sql['select']  . "\n"
            . $sql['from']  . "\n"
            . $sql['joins']  . "\n"
            . $sql['where']  . "\n"
            . $sql['group_by'] . "\n"
            . $sql['order_by'] . "\n";
    }

}
?>
