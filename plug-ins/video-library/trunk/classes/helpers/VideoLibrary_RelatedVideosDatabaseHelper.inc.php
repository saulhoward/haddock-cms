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
        get_related_external_videos_count_for_tag_ids(
            $external_video_library_id,
            $tag_ids,
            $external_video_provider_id = NULL,
            $ignore_video_id = NULL
        )
    {    
        $tag_ids = VideoLibrary_DatabaseHelper::limit_tag_ids($tag_ids);
        $dbh = DB::m();
        $sql = self::get_sql_parts_for_external_videos_matching_any_of_these_tag_ids(
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
        $query .= self::assemble_query_from_sql_parts($sql);
        // echo $query; exit;
        $result = mysql_query($query, $dbh);
        $row = mysql_fetch_assoc($result);
        //print_r($tags);exit;
        return $row['count']
    }

    public static function
        get_related_external_videos_for_tag_ids(
            $external_video_library_id,
            $tag_ids,
            $external_video_provider_id = NULL,
            $ignore_video_id = NULL,
            $start = NULL,
            $duration = NULL
        )
    {    
        $tag_ids = VideoLibrary_DatabaseHelper::limit_tag_ids($tag_ids);
        $dbh = DB::m();
        $principal_sql = self::get_sql_parts_for_external_videos_matching_any_of_these_tag_ids(
            $external_video_library_id,
            $tag_ids,
            $external_video_provider_id,
            $ignore_video_id,
            $start,
            $duration,
            array(
                'principal_tags' => TRUE
            )
        );
        $normal_sql = self::get_sql_parts_for_external_videos_matching_any_of_these_tag_ids(
            $external_video_library_id,
            $tag_ids,
            $external_video_provider_id,
            $ignore_video_id,
            $start,
            $duration,
            array(
                'principal_tags' => FALSE
            )
        );

        $query = '';
        $query .= <<<SQL
SELECT *, SUM(tag_count) as weighted_tag_count FROM(
(
SQL;

        $query .= self::assemble_query_from_sql_parts($principal_sql);
     
        $query .= <<<SQL
)
UNION ALL
(
SQL;

        $query .= self::assemble_query_from_sql_parts($normal_sql);
        $query .= <<<SQL
)

) AS combined_table
GROUP BY id
ORDER BY
     weighted_tag_count DESC
SQL;

        $query .= VideoLibrary_DatabaseHelper::get_limit_sql_for_external_videos(
            $start, $duration
        );
        //echo $query; exit;
        $result = mysql_query($query, $dbh);
        $videos = array();
        while ($row = mysql_fetch_assoc($result)) {
            $videos[] = $row;
        }   
        //print_r($tags);exit;
        return $videos;
    }

    public static function
        get_sql_parts_for_external_videos_matching_any_of_these_tag_ids(
            $external_video_library_id,
            $tag_ids,
            $ignore_video_id = NULL,
            $external_video_provider_id = NULL,
            $start = NULL,
            $duration = NULL,
            $options = array(
                'count' => FALSE,
                'principal_tags' => FALSE
            )
        )
    {
        $sql = array();

        if ($options['count']) {
            $sql['select'] = VideoLibrary_DatabaseHelper::get_select_sql_for_external_videos_count();
        } else {
            $sql['select'] = VideoLibrary_DatabaseHelper::get_select_sql_for_external_videos();
            $sql['select'] .= ' ,' ."\n" . 'COUNT( * ) AS tag_count' . "\n";
        }

        $sql['from'] = VideoLibrary_DatabaseHelper::get_from_sql_for_external_videos();
        $sql['from'] .= <<<SQL
,
    hpi_video_library_tags,
    hpi_video_library_tags_to_ext_vid_links
SQL;

        $external_video_library_id = mysql_real_escape_string($external_video_library_id);
        $sql['where'] = <<<SQL
WHERE
    hpi_video_library_external_video_libraries.id 
    = hpi_video_library_ext_vid_to_ext_vid_lib_links.external_video_library_id
AND
    hpi_video_library_external_videos.id 
    = hpi_video_library_ext_vid_to_ext_vid_lib_links.external_video_id
SQL;

        if ($external_video_provider_id) {

            $sql['where'] .= <<<SQL
AND
    hpi_video_library_external_video_providers.id = '$external_video_provider_id'
SQL;

        }

        $sql['where'] .= <<<SQL
AND
    hpi_video_library_external_video_libraries.id = '$external_video_library_id'
AND
    hpi_video_library_external_videos.external_video_provider_id 
    = hpi_video_library_external_video_providers.id
    AND
    hpi_video_library_external_videos.id = hpi_video_library_tags_to_ext_vid_links.external_video_id
    AND
    hpi_video_library_tags.id = hpi_video_library_tags_to_ext_vid_links.tag_id
    AND
    hpi_video_library_external_videos.status = 'display'

SQL;

        if (count($tag_ids) > 0) {
            $sql['where'] .= <<<SQL
    AND
(

SQL;

            $i = 0;
            foreach ($tag_ids as $tag_id) {
                $tag_id = mysql_real_escape_string($tag_id);
                if ($i != 0){
                    $sql['where'] .= <<<SQL
    OR

SQL;

                }
                $i++;
                if ($options['principal_tags']) {
                    $sql['where'] .= <<<SQL
    ( hpi_video_library_tags.id = '$tag_id' AND hpi_video_library_tags.principal = 'yes' )

SQL;

                } else {
                    $sql['where'] .= <<<SQL
    ( hpi_video_library_tags.id = '$tag_id' )

SQL;

                }
            }
            $sql['where'] .= <<<SQL
)

SQL;
        }

        if ($ignore_video_id > 0) {
            $ignore_video_id = mysql_real_escape_string($ignore_video_id);
            $sql['where'] .= <<<SQL
    AND
    hpi_video_library_external_videos.id <> $ignore_video_id

SQL;

        }

        $sql['group_by'] = <<<SQL
GROUP BY
    hpi_video_library_external_videos.id
SQL;

        if (!($options['count'])) {
            $sql['limit'] = 
                VideoLibrary_DatabaseHelper::get_limit_sql_for_external_videos(
                    $start, $duration
                );
        }
        return $sql;
    }

    /*
     * OLD Functions
     */
    public static function
        old_get_external_videos_for_tag_ids_weighted_for_principal_tags(
            $external_video_library_id,
            $tag_ids,
            $ignore_video_id = NULL,
            $start = NULL,
            $duration = NULL

        )
    {        
        $tag_ids = self::limit_tag_ids($tag_ids);
        
 
        $dbh = DB::m();
        $external_video_library_id = mysql_real_escape_string($external_video_library_id);

        $query = '';
        $query .= <<<SQL
SELECT *, SUM(tag_count) as weighted_tag_count FROM(
(
SQL;

        $query .= self::get_select_sql_for_external_videos();

        $query .= <<<SQL
,
    COUNT( * ) AS tag_count

FROM
    hpi_video_library_external_videos,
    hpi_video_library_external_video_providers,
    hpi_video_library_tags,
    hpi_video_library_tags_to_ext_vid_links,
    hpi_video_library_external_video_libraries,
    hpi_video_library_ext_vid_to_ext_vid_lib_links
WHERE
    hpi_video_library_external_video_libraries.id 
    = hpi_video_library_ext_vid_to_ext_vid_lib_links.external_video_library_id
AND
    hpi_video_library_external_videos.id 
    = hpi_video_library_ext_vid_to_ext_vid_lib_links.external_video_id
AND
    hpi_video_library_external_video_libraries.id = '$external_video_library_id'
AND
    hpi_video_library_external_videos.external_video_provider_id 
    = hpi_video_library_external_video_providers.id
    AND
    hpi_video_library_external_videos.id = hpi_video_library_tags_to_ext_vid_links.external_video_id
    AND
    hpi_video_library_tags.id = hpi_video_library_tags_to_ext_vid_links.tag_id
    AND
    hpi_video_library_external_videos.status = 'display'

SQL;

        if (count($tag_ids) > 0) {
            $query .= <<<SQL
    AND
(

SQL;

            $i = 0;
            foreach ($tag_ids as $tag_id) {
                $tag_id = mysql_real_escape_string($tag_id);
                if ($i != 0){
                    $query .= <<<SQL
    OR

SQL;

                }
                $i++;
                $query .= <<<SQL
    ( hpi_video_library_tags.id = '$tag_id' AND hpi_video_library_tags.principal = 'yes' )

SQL;

            }
            $query .= <<<SQL
)

SQL;
        }


        if ($ignore_video_id > 0) {
            $ignore_video_id = mysql_real_escape_string($ignore_video_id);
            $query .= <<<SQL
    AND
    hpi_video_library_external_videos.id <> $ignore_video_id

SQL;

        }

        $query .= <<<SQL
GROUP BY
    hpi_video_library_external_videos.id
)
UNION ALL
(
SQL;

        $query .= self::get_select_sql_for_external_videos();

        $query .= <<<SQL
,
    COUNT( * ) AS tag_count

FROM
    hpi_video_library_external_videos,
    hpi_video_library_external_video_providers,
    hpi_video_library_tags,
    hpi_video_library_tags_to_ext_vid_links,
    hpi_video_library_external_video_libraries,
    hpi_video_library_ext_vid_to_ext_vid_lib_links
WHERE
    hpi_video_library_external_video_libraries.id 
    = hpi_video_library_ext_vid_to_ext_vid_lib_links.external_video_library_id
AND
    hpi_video_library_external_videos.id 
    = hpi_video_library_ext_vid_to_ext_vid_lib_links.external_video_id
AND
    hpi_video_library_external_video_libraries.id = '$external_video_library_id'
AND
    hpi_video_library_external_videos.external_video_provider_id 
    = hpi_video_library_external_video_providers.id
    AND
    hpi_video_library_external_videos.id = hpi_video_library_tags_to_ext_vid_links.external_video_id
    AND
    hpi_video_library_tags.id = hpi_video_library_tags_to_ext_vid_links.tag_id
    AND
    hpi_video_library_external_videos.status = 'display'

SQL;

        if (count($tag_ids) > 0) {
            $query .= <<<SQL
    AND
(

SQL;


            $i = 0;
            foreach ($tag_ids as $tag_id) {
                $tag_id = mysql_real_escape_string($tag_id);
                if ($i != 0){
                    $query .= <<<SQL
    OR

SQL;

                }
                $i++;
                $query .= <<<SQL
    hpi_video_library_tags.id = '$tag_id' 

SQL;

            }
            $query .= <<<SQL
)

SQL;
        }


        if ($ignore_video_id > 0) {
            $ignore_video_id = mysql_real_escape_string($ignore_video_id);
            $query .= <<<SQL
    AND
    hpi_video_library_external_videos.id <> $ignore_video_id

SQL;

        }

        $query .= <<<SQL
GROUP BY
    hpi_video_library_external_videos.id
)

) AS combined_table
GROUP BY id
ORDER BY
     weighted_tag_count DESC
SQL;

        if (
            ($start != NULL)
            &&
            ($duration != NULL) 
        ){
            $start = mysql_real_escape_string($start);
            $duration = mysql_real_escape_string($duration);
            $query .= <<<SQL

LIMIT
    $start, $duration
SQL;

        // print_r($start . '   ' . $duration);exit;
        // echo $query; exit;
        }


        echo $query; exit;

        $result = mysql_query($query, $dbh);

        $tags = array();

        while ($row = mysql_fetch_assoc($result)) {
            $tags[] = $row;
        }   
        //print_r($tags);exit;
        return $tags;


    }

    public static function
        get_external_videos_for_tag_ids_and_external_video_provider_id_weighted_for_principal_tags(
            $external_video_library_id,
            $tag_ids,
            $external_video_provider_id,
            $ignore_video_id = NULL,
            $start = NULL,
            $duration = NULL

        )
    {
        $tag_ids = self::limit_tag_ids($tag_ids);
        $dbh = DB::m();
        $external_video_library_id = mysql_real_escape_string($external_video_library_id);
        $external_video_provider_id = mysql_real_escape_string($external_video_provider_id);

        $query = '';
        $query .= <<<SQL
SELECT *, SUM(tag_count) as weighted_tag_count FROM(
(
SQL;

        $query .= self::get_select_sql_for_external_videos();

        $query .= <<<SQL
,
    COUNT( * ) AS tag_count

FROM
    hpi_video_library_external_videos,
    hpi_video_library_external_video_providers,
    hpi_video_library_tags,
    hpi_video_library_tags_to_ext_vid_links,
    hpi_video_library_external_video_libraries,
    hpi_video_library_ext_vid_to_ext_vid_lib_links
WHERE
    hpi_video_library_external_video_libraries.id 
    = hpi_video_library_ext_vid_to_ext_vid_lib_links.external_video_library_id
AND
    hpi_video_library_external_videos.id 
    = hpi_video_library_ext_vid_to_ext_vid_lib_links.external_video_id
AND
    hpi_video_library_external_video_providers.id = '$external_video_provider_id'
AND
    hpi_video_library_external_video_libraries.id = '$external_video_library_id'
AND
    hpi_video_library_external_videos.external_video_provider_id 
    = hpi_video_library_external_video_providers.id
    AND
    hpi_video_library_external_videos.id = hpi_video_library_tags_to_ext_vid_links.external_video_id
    AND
    hpi_video_library_tags.id = hpi_video_library_tags_to_ext_vid_links.tag_id
    AND
    hpi_video_library_external_videos.status = 'display'

SQL;

        if (count($tag_ids) > 0) {
            $query .= <<<SQL
    AND
(

SQL;


            $i = 0;
            foreach ($tag_ids as $tag_id) {
                $tag_id = mysql_real_escape_string($tag_id);
                if ($i != 0){
                    $query .= <<<SQL
    OR

SQL;

                }
                $i++;
                $query .= <<<SQL
    ( hpi_video_library_tags.id = '$tag_id' AND hpi_video_library_tags.principal = 'yes' )

SQL;

            }
            $query .= <<<SQL
)

SQL;
        }


        if ($ignore_video_id > 0) {
            $ignore_video_id = mysql_real_escape_string($ignore_video_id);
            $query .= <<<SQL
    AND
    hpi_video_library_external_videos.id <> $ignore_video_id

SQL;

        }

        $query .= <<<SQL
GROUP BY
    hpi_video_library_external_videos.id
)
UNION ALL
(
SQL;

        $query .= self::get_select_sql_for_external_videos();

        $query .= <<<SQL
,
    COUNT( * ) AS tag_count

FROM
    hpi_video_library_external_videos,
    hpi_video_library_external_video_providers,
    hpi_video_library_tags,
    hpi_video_library_tags_to_ext_vid_links,
    hpi_video_library_external_video_libraries,
    hpi_video_library_ext_vid_to_ext_vid_lib_links
WHERE
    hpi_video_library_external_video_libraries.id 
    = hpi_video_library_ext_vid_to_ext_vid_lib_links.external_video_library_id
AND
    hpi_video_library_external_videos.id 
    = hpi_video_library_ext_vid_to_ext_vid_lib_links.external_video_id
AND
    hpi_video_library_external_video_providers.id = '$external_video_provider_id'
AND
    hpi_video_library_external_video_libraries.id = '$external_video_library_id'
AND
    hpi_video_library_external_videos.external_video_provider_id 
    = hpi_video_library_external_video_providers.id
    AND
    hpi_video_library_external_videos.id = hpi_video_library_tags_to_ext_vid_links.external_video_id
    AND
    hpi_video_library_tags.id = hpi_video_library_tags_to_ext_vid_links.tag_id
    AND
    hpi_video_library_external_videos.status = 'display'

SQL;

        if (count($tag_ids) > 0) {
            $query .= <<<SQL
    AND
(

SQL;


            $i = 0;
            foreach ($tag_ids as $tag_id) {
                $tag_id = mysql_real_escape_string($tag_id);
                if ($i != 0){
                    $query .= <<<SQL
    OR

SQL;

                }
                $i++;
                $query .= <<<SQL
    hpi_video_library_tags.id = '$tag_id' 

SQL;

            }
            $query .= <<<SQL
)

SQL;
        }


        if ($ignore_video_id > 0) {
            $ignore_video_id = mysql_real_escape_string($ignore_video_id);
            $query .= <<<SQL
    AND
    hpi_video_library_external_videos.id <> $ignore_video_id

SQL;

        }

        $query .= <<<SQL
GROUP BY
    hpi_video_library_external_videos.id
)

) AS combined_table
GROUP BY id
ORDER BY
     weighted_tag_count DESC
SQL;

        if (
            ($start != NULL)
            &&
            ($duration != NULL) 
        ){
            $start = mysql_real_escape_string($start);
            $duration = mysql_real_escape_string($duration);
            $query .= <<<SQL

LIMIT
    $start, $duration
SQL;

        }


        //echo $query; exit;

        $result = mysql_query($query, $dbh);

        $tags = array();

        while ($row = mysql_fetch_assoc($result)) {
            $tags[] = $row;
        }   
        //print_r($tags);exit;
        return $tags;


    }


}
?>
