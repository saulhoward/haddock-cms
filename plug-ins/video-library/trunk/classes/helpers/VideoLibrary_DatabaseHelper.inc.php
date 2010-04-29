<?php
/**
 * VideoLibrary_DatabaseHelper
 *
 * @copyright 2009-01-10, SANH
 *
 * Contains all MySQL DB functions for the VideoLibrary plugin
 *
 * Where functions have moved to another DB helper, there will be links 
 * to their new homes.
 */

class
VideoLibrary_DatabaseHelper
{
    public static function
        get_external_video_data($id)
    {
        $dbh = DB::m();

        $id = mysql_real_escape_string($id);

        $query = '';
        $query .= self::get_select_sql_for_external_videos();

        $query .= <<<SQL

FROM
        hpi_video_library_external_videos,
        hpi_video_library_external_video_libraries,
        hpi_video_library_ext_vid_to_ext_vid_lib_links,
        hpi_video_library_external_video_providers
WHERE
        hpi_video_library_external_videos.external_video_provider_id = hpi_video_library_external_video_providers.id
AND
        hpi_video_library_ext_vid_to_ext_vid_lib_links.external_video_id = hpi_video_library_external_videos.id
AND
        hpi_video_library_ext_vid_to_ext_vid_lib_links.external_video_library_id = hpi_video_library_external_video_libraries.id
AND
        hpi_video_library_external_videos.id = $id

SQL;

        // echo $query; exit;

        $result = mysql_query($query, $dbh);

        // print_r($result);exit;

        if (
            ($result)
            &&
            (mysql_num_rows($result) > 0)
        ) {

            $video_data = mysql_fetch_assoc($result);
            $video_data['tags'] 
                = self::get_tags_for_external_video_id($video_data['id']);
            //print_r($video_data);exit;
            return $video_data;
        } else {
            throw new VideoLibrary_ExternalVideoNotFoundException($id);
        }
    }

    public static function
        get_external_videos(
            $external_video_library_id,
            $start = NULL,
            $duration = NULL
        )
    {
        $dbh = DB::m();
        $sql = self::get_sql_parts_for_external_videos(
            $external_video_library_id,
            $start,
            $duration
        );
        $query  = self::assemble_query_from_sql_parts($sql);
        // echo $query; exit;
        $result = mysql_query($query, $dbh);
        $videos = array();
        while ($row = mysql_fetch_assoc($result)) {
            $videos[] = $row;
        }   
        return $videos;
    }

    public static function
        get_external_videos_count(
            $external_video_library_id
        )
    {
        $dbh = DB::m();
        $sql = self::get_sql_parts_for_external_videos(
            $external_video_library_id,
            NULL,
            NULL,
            array(
                'count' => TRUE
            )
        );
        $query  = self::assemble_query_from_sql_parts($sql);
        //echo $query; exit;
        $result = mysql_query($query, $dbh);
        $row = mysql_fetch_assoc($result);
        return $row['count'];
    }

    public static function
        get_sql_parts_for_external_videos(
            $external_video_library_id,
            $start = NULL,
            $duration = NULL,
            $options = array(
                'count' => FALSE
            )
        )
    {
        $sql = array();
        if ($options['count']) {
            $sql['select'] = self::get_select_sql_for_external_videos_count();
        } else {
            $sql['select'] = self::get_select_sql_for_external_videos();
        }
        $sql['from'] = self::get_from_sql_for_external_videos();
        $sql['where'] = self::get_where_sql_for_external_videos(
            $external_video_library_id
        );

        if (!($options['count'])) {
            $sql['order_by'] = self::get_order_by_sql_for_external_videos();
            $sql['limit'] = self::get_limit_sql_for_external_videos(
                $start,
                $duration
            );
        }
        return $sql;
   }

    public static function
        get_external_videos_by_searching_in_video_names_count(
            $external_video_library_id,
            $search_string
        )
    {
        $dbh = DB::m();
        $sql = self::get_sql_parts_for_external_videos_by_searching_in_video_names(
            $external_video_library_id,
            $search_string,
            NULL,
            NULL,
            array(
                'count' => TRUE
            )
        );
        $query  = self::assemble_query_from_sql_parts($sql);
        $result = mysql_query($query, $dbh);
        $row = mysql_fetch_assoc($result);
        //print_r($videos);exit;
        return $row['count'];
    }

    public static function
        get_external_videos_by_searching_in_video_names(
            $external_video_library_id,
            $search_string,
            $start = NULL,
            $duration = NULL
        )
    {
        $dbh = DB::m();
        $sql = self::get_sql_parts_for_external_videos_by_searching_in_video_names(
            $external_video_library_id,
            $search_string,
            $start,
            $duration
        );
        $query  = self::assemble_query_from_sql_parts($sql);
        // print_r($query);exit;
        $result = mysql_query($query, $dbh);
        $videos = array();
        while ($row = mysql_fetch_assoc($result)) {
            $videos[] = $row;
        }   
        return $videos;
    }

    public static function
        get_sql_parts_for_external_videos_by_searching_in_video_names(
            $external_video_library_id,
            $search_string,
            $start = NULL,
            $duration = NULL,
            $options = array(
                'count' => FALSE
            )
        )
    {
        $search_string 
            = mysql_real_escape_string($search_string);

        $sql = array();
        if ($options['count']) {
            $sql['select'] = self::get_select_sql_for_external_videos_count();
        } else {
            $sql['select'] = self::get_select_sql_for_external_videos();
        }

        $sql['from'] = self::get_from_sql_for_external_videos();
        $sql['where'] = self::get_where_sql_for_external_videos(
            $external_video_library_id
        );
        $sql['where'] .= <<<SQL
AND
        MATCH (hpi_video_library_external_videos.name)
        AGAINST ('$search_string' IN BOOLEAN MODE)

SQL;

        if (!($options['count'])) {
            $sql['limit'] = self::get_limit_sql_for_external_videos(
                $start,
                $duration
            );
        }

        return $sql;
    }

    public static function
        get_external_videos_count_for_provider_id(
            $external_video_library_id,
            $external_video_provider_id
        )
    {
        $dbh = DB::m();
        $sql = self::get_sql_parts_for_external_videos_for_provider_id(
            $external_video_library_id,
            $external_video_provider_id,
            NULL,
            NULL,
            array(
                'count' => TRUE
            )
        );
        $query  = self::assemble_query_from_sql_parts($sql);
        // print_r($query);exit;
        $result = mysql_query($query, $dbh);
        $row = mysql_fetch_assoc($result);
        return $row['count'];
    }

    public static function
        get_external_videos_for_provider_id(
            $external_video_library_id,
            $external_video_provider_id,
            $start = NULL,
            $duration = NULL
        )
    {
        $dbh = DB::m();
        $sql = self::get_sql_parts_for_external_videos_for_provider_id(
            $external_video_library_id,
            $external_video_provider_id,
            $start,
            $duration
        );
        $query  = self::assemble_query_from_sql_parts($sql);
        // print_r($query);exit;
        $result = mysql_query($query, $dbh);
        $videos = array();
        while ($row = mysql_fetch_assoc($result)) {
            $videos[] = $row;
        }   
        //print_r($videos);exit;
        return $videos;
    }

    public static function
        get_sql_parts_for_external_videos_for_provider_id(
            $external_video_library_id,
            $external_video_provider_id,
            $start = NULL,
            $duration = NULL,
            $options = array(
                'count' => FALSE
            )
        )
    {
        $sql = array();
        if ($options['count']) {
            $sql['select'] = self::get_select_sql_for_external_videos_count();
        } else {
            $sql['select'] = self::get_select_sql_for_external_videos();
        }

        $sql['from'] = self::get_from_sql_for_external_videos();
        $sql['where'] = self::get_where_sql_for_external_videos(
            $external_video_library_id
        );
        $external_video_provider_id 
            = mysql_real_escape_string($external_video_provider_id);
        $sql['where'] .= <<<SQL
AND
    hpi_video_library_external_videos.external_video_provider_id 
    = hpi_video_library_external_video_providers.id
AND
    hpi_video_library_external_video_providers.id = '$external_video_provider_id'
SQL;

        if (!($options['count'])) {
            $sql['order_by'] = self::get_order_by_sql_for_external_videos();
            $sql['limit'] = self::get_limit_sql_for_external_videos(
                $start,
                $duration
            );
        }
        return $sql;
    }

    public static function
        get_external_video_libraries_for_ids(
            $library_ids,
            $ignore_status = FALSE
        )
    {
        $dbh = DB::m();

        //$limit = mysql_real_escape_string($limit);

        $query = <<<SQL
SELECT
    *
FROM
    hpi_video_library_external_video_libraries
WHERE
status = 'display'
AND

SQL;

        $i = 0;
        foreach ($library_ids as $library_id) {
            $library_id = mysql_real_escape_string($library_id);
            if ($i != 0) {

                $query .= <<<SQL
OR

SQL;

            }
            $i++;
            $query .= <<<SQL
id = $library_id

SQL;

        }
        $query .= <<<SQL

ORDER BY
sort_order

SQL;

        //echo $query; exit;
        $result = mysql_query($query, $dbh);
        $libraries = array();
        while ($row = mysql_fetch_assoc($result)) {
            $libraries[] = $row;
        }   
        return $libraries;
    }

    public static function
        get_external_video_libraries(
            $ignore_status = FALSE
        )
    {
        $dbh = DB::m();

        //$limit = mysql_real_escape_string($limit);

        $query = <<<SQL
SELECT
    *
FROM
    hpi_video_library_external_video_libraries
WHERE
status = 'display'
ORDER BY
sort_order

SQL;

        //echo $query; exit;
        $result = mysql_query($query, $dbh);
        $libraries = array();
        while ($row = mysql_fetch_assoc($result)) {
            $libraries[] = $row;
        }   
        return $libraries;
    }

    public static function
        get_tags_for_external_library_id(
            $library_id,
            $principal = FALSE
        )
    {
        $dbh = DB::m();

        $library_id = mysql_real_escape_string($library_id);

        $query = <<<SQL
SELECT * FROM `hpi_video_library_tags`

WHERE EXISTS ( 
    SELECT * FROM 
    hpi_video_library_tags_to_ext_vid_links
    WHERE 
    hpi_video_library_tags.id = hpi_video_library_tags_to_ext_vid_links.tag_id
    AND EXISTS (
        SELECT * FROM 
        hpi_video_library_external_videos
        WHERE 
        hpi_video_library_tags_to_ext_vid_links.external_video_id = hpi_video_library_external_videos.id
        AND
        hpi_video_library_tags.id = hpi_video_library_tags_to_ext_vid_links.tag_id
        AND EXISTS (
            SELECT * FROM 
            hpi_video_library_ext_vid_to_ext_vid_lib_links
            WHERE
            hpi_video_library_external_videos.id = hpi_video_library_ext_vid_to_ext_vid_lib_links.external_video_id
            AND EXISTS (
                SELECT * FROM
                hpi_video_library_external_video_libraries
                WHERE
                hpi_video_library_ext_vid_to_ext_vid_lib_links.external_video_library_id = hpi_video_library_external_video_libraries.id
                AND EXISTS (
                    SELECT * FROM
                    hpi_video_library_tags_to_ext_vid_links
                    WHERE
                    hpi_video_library_external_video_libraries.id = $library_id
                )
            )
        )
    )
)

SQL;

        if ($principal) {
            $query .= <<<SQL
AND
    principal = 'yes'

SQL;

        }

        $query .= <<<SQL
ORDER BY
hpi_video_library_tags.tag ASC

SQL;



        // echo $query; exit;

        $result = mysql_query($query, $dbh);

        $tags = array();

        while ($row = mysql_fetch_assoc($result)) {
            $tags[] = $row;
        }   
        //print_r($tags);exit;
        return $tags;
    }

    public static function
        get_tags_for_external_video_id(
            $video_id,
            $principal = FALSE
        )
    {
        $dbh = DB::m();

        $video_id = mysql_real_escape_string($video_id);

        $query = <<<SQL

SELECT 
    hpi_video_library_tags.id as id,
    hpi_video_library_tags.tag as tag,
    hpi_video_library_tags.principal as principal
FROM 
    `hpi_video_library_tags`,
    hpi_video_library_tags_to_ext_vid_links,
    hpi_video_library_external_videos
WHERE 
    hpi_video_library_tags.id = hpi_video_library_tags_to_ext_vid_links.tag_id
AND 
    hpi_video_library_external_videos.id 
    = hpi_video_library_tags_to_ext_vid_links.external_video_id
AND
    hpi_video_library_external_videos.id = $video_id

SQL;

        if ($principal) {
            $query .= <<<SQL
AND
    hpi_video_library_tags.principal = 'yes'

SQL;

        }

        // echo $query; exit;

        $result = mysql_query($query, $dbh);

        $tags = array();

        if ($result) {
            if (mysql_num_rows($result) > 0) {
                while ($row = mysql_fetch_assoc($result)) {
                    $tags[] = $row;
                }   
            }
        }

        //print_r($tags);exit;
        return $tags;
    }

    public static function
        get_tags_for_tag_ids(
            $tag_ids
        )
    {
        $dbh = DB::m();

        //$limit = mysql_real_escape_string($limit);

        $query = <<<SQL
SELECT
    *
FROM
    hpi_video_library_tags
WHERE

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

        //echo $query; exit;

        $result = mysql_query($query, $dbh);

        $tags = array();

        while ($row = mysql_fetch_assoc($result)) {
            $tags[] = $row;
        }   
        //print_r($tags);exit;
        return $tags;
    }

    public static function
        get_tags(
            $principal = FALSE
        )
    {
        $dbh = DB::m();

        //$limit = mysql_real_escape_string($limit);

        $query = <<<SQL
SELECT
    *
FROM
    hpi_video_library_tags

SQL;

        if ($principal) {
            $query .= <<<SQL
WHERE
    principal = 'yes'

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

    public static function
        get_external_video_providers_for_external_video_library_id(
            $library_id
        )
    {
        $dbh = DB::m();

        $library_id = mysql_real_escape_string($library_id);

        $query = <<<SQL
SELECT * FROM `hpi_video_library_external_video_providers`

WHERE EXISTS ( 
    SELECT * FROM 
    hpi_video_library_external_videos
    WHERE 
    hpi_video_library_external_videos.external_video_provider_id = hpi_video_library_external_video_providers.id
    AND EXISTS (
        SELECT * FROM 
        hpi_video_library_ext_vid_to_ext_vid_lib_links
        WHERE
        hpi_video_library_external_videos.id = hpi_video_library_ext_vid_to_ext_vid_lib_links.external_video_id
        AND EXISTS (
            SELECT * FROM
            hpi_video_library_external_video_libraries
            WHERE
            hpi_video_library_ext_vid_to_ext_vid_lib_links.external_video_library_id = hpi_video_library_external_video_libraries.id
            AND EXISTS (
                SELECT * FROM
                hpi_video_library_tags_to_ext_vid_links
                WHERE
                hpi_video_library_external_video_libraries.id = $library_id
            )
        )
    )
)

SQL;

        //echo $query; exit;

        $result = mysql_query($query, $dbh);

        $providers = array();

        while ($row = mysql_fetch_assoc($result)) {
            $providers[] = $row;
        }   
        //print_r($videos);exit;
        return $providers;
    }

    public static function
        get_external_video_provider_for_id($id)
    {
        $dbh = DB::m();

        $id = mysql_real_escape_string($id);

        $query = <<<SQL
SELECT
    *
FROM
    hpi_video_library_external_video_providers
WHERE
    id = '$id'
SQL;

        //echo $query; exit;

        $result = mysql_query($query, $dbh);

        $provider = mysql_fetch_assoc($result);
        //print_r($videos);exit;
        return $provider;
    }

    public static function
        get_external_video_providers()
    {
        $dbh = DB::m();

        //$limit = mysql_real_escape_string($limit);

        $query = <<<SQL
SELECT
    *
FROM
    hpi_video_library_external_video_providers
SQL;

        //echo $query; exit;

        $result = mysql_query($query, $dbh);

        $providers = array();

        while ($row = mysql_fetch_assoc($result)) {
            $providers[] = $row;
        }   
        //print_r($videos);exit;
        return $providers;
    }

    public static function
        get_external_video_providers_for_videos(
            $videos
        )
    {
        //print_r($videos);exit;
        $providers = array();
        foreach ($videos as $video) {
            $provider = self::get_external_video_provider_for_id(
                $video['external_video_provider_id']
            );
            if (!in_array($provider, $providers)) $providers[] = $provider;
        }
        return $providers;
    }

    public static function
        get_all_external_videos_for_tag_ids_on_admin_page(
            $tag_ids,
            $ignore_video_id = NULL,
            $limit = NULL
        )
    {
        $dbh = DB::m();
        $sql = self::get_sql_parts_for_external_videos_for_tag_ids(
            NULL,
            $tag_ids,
            $ignore_video_id,
            NULL,
            NULL,
            array(
                'admin' => TRUE
            )
        );
        // echo $query; exit;
        $query  = self::assemble_query_from_sql_parts($sql);
        //echo $query; exit;
        $result = mysql_query($query, $dbh);
        $tags = array();
        while ($row = mysql_fetch_assoc($result)) {
            $tags[] = $row;
        }   
        //print_r($tags);exit;
        return $tags;
    }

    public static function
        get_sql_parts_for_external_videos_for_tag_ids(
            $external_video_library_id,
            $tag_ids,
            $ignore_video_id = NULL,
            $start = NULL,
            $duration = NULL,
            $options = array(
                'count' => FALSE,
                'admin' => FALSE
            )
        )
    {
        $query = '';
        $num_tags = count($tag_ids);
        // print_r($num_tags);exit;
        if ($num_tags > 28) {
            $tag_ids = array_slice($tag_ids, 0, 28);
            $num_tags = count($tag_ids);
        }
        // print_r($tag_ids);exit;
        if ($num_tags > 0 && $num_tags <= 58) {
            if ($options['count']) {
                $sql_select = "SELECT COUNT( DISTINCT t2v" . ($num_tags - 1) . ".external_video_id) AS count ";
            } else {
                $sql_select = "SELECT DISTINCT t2v" . ($num_tags - 1) . ".external_video_id, ";
                $sql_select .= self::get_data_for_select_sql_for_external_videos() . "\n";
            }

            $sql_from = " " . self::get_from_sql_for_external_videos() . ", ";
            $sql_where = " WHERE ";
            $sql_joins = "";
            for ($i=0;$i<$num_tags;++$i) {
                if ($i==0) {
                    $sql_from .= " hpi_video_library_tags t0 ";
                    $sql_where .= " t0.id = '" . $tag_ids[0] . "'";
                    $sql_joins .= " INNER JOIN hpi_video_library_tags_to_ext_vid_links t2v0 ON t0.id = t2v0.tag_id ";
                }
                else {
                    $tag_ids[$i] = mysql_real_escape_string($tag_ids[$i]);
                    $sql_from .= " CROSS JOIN hpi_video_library_tags t" . $i;
                    $sql_where .= " AND t" . $i . ".id = '" . $tag_ids[$i] . "'";
                    $sql_joins .= " INNER JOIN hpi_video_library_tags_to_ext_vid_links t2v" 
                        . $i . " ON t2v" . ($i - 1) . ".external_video_id = t2v" . $i . ".external_video_id " . 
                        " AND t2v" . $i . ".tag_id = t" . $i . ".id ";
                }
            }
            $sql_where .= 'AND hpi_video_library_external_videos.id = t2v' . ($i - 1) . '.external_video_id' . "\n";

            $sql_where .= <<<SQL
AND
    hpi_video_library_external_video_libraries.id 
    = hpi_video_library_ext_vid_to_ext_vid_lib_links.external_video_library_id
AND
    hpi_video_library_external_videos.id 
    = hpi_video_library_ext_vid_to_ext_vid_lib_links.external_video_id
AND
    hpi_video_library_external_videos.status = 'display'
SQL;

            if (!($options['admin'])) {
                $external_video_library_id 
                    = mysql_real_escape_string($external_video_library_id);
                $sql_where .= <<<SQL
AND
    hpi_video_library_external_video_libraries.id = '$external_video_library_id'

SQL;

            }

            if ($ignore_video_id > 0) {
                $ignore_video_id = mysql_real_escape_string($ignore_video_id);
                $sql_where .= <<<SQL
AND
    hpi_video_library_external_videos.id <> $ignore_video_id

SQL;

            }


        } else {
            throw new VideoLibrary_Exception('Too many tags searched for simultaneously');
        }

        $sql_group_by = '';
        $sql_order_by = '';
        $sql_limit = '';

        if (!($options['count'])) {
            $sql_group_by .= <<<SQL
GROUP BY
    hpi_video_library_external_videos.id
SQL;

            $sql_order_by = self::get_order_by_sql_for_external_videos();
            $sql_limit = self::get_limit_sql_for_external_videos(
                $start, $duration
            );

        }

        return array(
            'select' => $sql_select,
            'from' => $sql_from,
            'joins' => $sql_joins,
            'where' => $sql_where,
            'group_by' => $sql_group_by,
            'order_by' => $sql_order_by,
            'limit' => $sql_limit
        );
    }

    public static function
        get_external_videos_count_for_tag_ids(
            $external_video_library_id,
            $tag_ids,
            $ignore_video_id = NULL
        )
    {
       // print_r($start . '  ' . $duration);exit;
        $dbh = DB::m();
        $sql = self::get_sql_parts_for_external_videos_for_tag_ids(
            $external_video_library_id,
            $tag_ids,
            $ignore_video_id,
            NULL,
            NULL,
            array(
                'count' => TRUE
            )
        );
        $query = self::assemble_query_from_sql_parts($sql);
        // print_r($query);exit;
        $result = mysql_query($query, $dbh);
        $row = mysql_fetch_assoc($result);
        return $row['count'];
    }

    public static function
        assemble_query_from_sql_parts(
            $sql
        )
    {
        return $sql['select']  . "\n"
            . $sql['from']  . "\n"
            . $sql['joins']  . "\n"
            . $sql['where']  . "\n"
            . $sql['group_by'] . "\n"
            . $sql['limit'] . "\n";
    }

    public static function
        get_external_videos_for_tag_ids(
            $external_video_library_id,
            $tag_ids,
            $ignore_video_id = NULL,
            $start = NULL,
            $duration = NULL
        )
    {
       // print_r($start . '  ' . $duration);exit;
        $dbh = DB::m();
        $sql = self::get_sql_parts_for_external_videos_for_tag_ids(
            $external_video_library_id,
            $tag_ids,
            $ignore_video_id,
            $start,
            $duration
        );
        // echo $query; exit;
        $query  = self::assemble_query_from_sql_parts($sql);
        // print_r($query);exit;
        $result = mysql_query($query, $dbh);

        $videos = array();

        while ($row = mysql_fetch_assoc($result)) {
            $videos[] = $row;
        }   
        //print_r($tags);exit;
        return $videos;
    }

    public static function
        get_external_videos_count_for_tag_ids_and_external_video_provider_id(
            $external_video_library_id,
            $tag_ids,
            $external_video_provider_id,
            $ignore_video_id = NULL
        )
    {
        $dbh = DB::m();
        $sql = self::get_sql_parts_for_external_videos_for_tag_ids_and_external_video_provider_id(
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
        // echo $query; exit;
        $result = mysql_query($query, $dbh);
        $row = mysql_fetch_assoc($result);
        //print_r($tags);exit;
        return $row['count'];
    }

    public static function
        get_external_videos_for_tag_ids_weighted_for_principal_tags(
            $external_video_library_id,
            $tag_ids,
            $ignore_video_id = NULL,
            $start = NULL,
            $duration = NULL

        )
    {        
        if (count($tag_ids) > 28) {
            $tag_ids = array_slice($tag_ids, 0, 28);
        }
 
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


        // echo $query; exit;

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
        if (count($tag_ids) > 28) {
            $tag_ids = array_slice($tag_ids, 0, 28);
        }
 
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

    public static function
        get_sql_parts_for_external_videos_for_tag_ids_and_external_video_provider_id(
            $external_video_library_id,
            $tag_ids,
            $external_video_provider_id,
            $ignore_video_id = NULL,
            $start = NULL,
            $duration = NULL,
            $options = array(
                'count' => FALSE
            )
        )
    {
        $sql = self::get_sql_parts_for_external_videos_for_tag_ids(
            $external_video_library_id,
            $tag_ids,
            $ignore_video_id,
            $start,
            $duration,
            $options 
        );
        $external_video_provider_id = mysql_real_escape_string($external_video_provider_id);
        $sql['where'] .= <<<SQL
AND
    hpi_video_library_external_video_providers.id = '$external_video_provider_id'
AND
    hpi_video_library_external_videos.external_video_provider_id 
    = hpi_video_library_external_video_providers.id
SQL;

        return $sql;
    }


    public static function
        get_external_videos_for_tag_ids_and_external_video_provider_id(
            $external_video_library_id,
            $tag_ids,
            $external_video_provider_id,
            $ignore_video_id = NULL,
            $start = NULL,
            $duration = NULL
        )
    {
        $dbh = DB::m();
        $sql = self::get_sql_parts_for_external_videos_for_tag_ids_and_external_video_provider_id(
            $external_video_library_id,
            $tag_ids,
            $external_video_provider_id,
            $ignore_video_id,
            $start,
            $duration
        );
        $query = '';
        $query = self::assemble_query_from_sql_parts($sql);
        // echo $query; exit;
        $result = mysql_query($query, $dbh);
        $tags = array();
        while ($row = mysql_fetch_assoc($result)) {
            $tags[] = $row;
        }   
        //print_r($tags);exit;
        return $tags;
    }

    public static function
        get_enum_values(
            $table_name,
            $enum_name
        )
    {
        $dbh = DB::m();
        $table_name = mysql_real_escape_string($table_name);
        $enum_name = mysql_real_escape_string($enum_name);

        $query = <<<SQL
SHOW COLUMNS 
FROM 
$table_name LIKE '$enum_name'

SQL;
        //echo $query; exit;

        $result = mysql_query($query, $dbh);

        if(mysql_num_rows($result)>0){
            $row=mysql_fetch_row($result);
            $options=explode("','",preg_replace("/(enum|set)\('(.+?)'\)/","\\2",$row[1]));
        }

        return $options;
    }

    public static function
        get_from_sql_for_external_videos() 
    {
        return <<<SQL
FROM
    hpi_video_library_external_videos,
    hpi_video_library_external_video_providers,
    hpi_video_library_external_video_libraries,
    hpi_video_library_ext_vid_to_ext_vid_lib_links

SQL;

    }
               
    public static function
        get_order_by_sql_for_external_videos()
    {
        return <<<SQL
ORDER BY
    hpi_video_library_external_videos.date_added DESC

SQL;

    }

    public static function
        get_limit_sql_for_external_videos(
            $start = NULL,
            $duration = NULL
        )
    {
        $limit = '';
        if (
            ($start != NULL)
            &&
            ($duration != NULL) 
        ){
            $start = mysql_real_escape_string($start);
            $duration = mysql_real_escape_string($duration);
            $limit = <<<SQL

LIMIT
    $start, $duration
SQL;

        }
        return $limit;
    }


    public static function
        get_where_sql_for_external_videos(
            $external_video_library_id
        )
    {
        $external_video_library_id 
            = mysql_real_escape_string($external_video_library_id);
        return <<<SQL
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
        hpi_video_library_external_videos.status = 'display'

SQL;

    }

    public static function
        get_select_sql_for_external_videos_count() 
    {
        return <<<SQL
SELECT COUNT( DISTINCT hpi_video_library_external_videos.id ) AS count

SQL;

    }

    public static function
        get_select_sql_for_external_videos() 
    {
        return 'SELECT DISTINCT ' . "\n" . self::get_data_for_select_sql_for_external_videos();
    }


    public static function
        get_data_for_select_sql_for_external_videos_count() 
    {
        return <<<SQL
    hpi_video_library_external_videos.id AS id

SQL;

    }


    public static function
        get_data_for_select_sql_for_external_videos() 
    {
        return <<<SQL
    hpi_video_library_external_videos.id AS id,
    hpi_video_library_external_videos.name AS name,
    hpi_video_library_external_videos.thumbnail_url AS thumbnail_url,
    hpi_video_library_external_videos.length_seconds AS length_seconds,
    hpi_video_library_external_videos.status AS status,
    hpi_video_library_external_videos.providers_internal_id AS providers_internal_id,
    hpi_video_library_external_video_libraries.id AS external_video_library_id,
    hpi_video_library_external_video_providers.id AS external_video_provider_id,
    hpi_video_library_external_video_providers.name AS external_video_provider_name,
    hpi_video_library_external_video_providers.haddock_class_name AS haddock_class_name

SQL;

    }

    public static function
        get_external_video_provider_name_for_id($id)
    {
        $dbh = DB::m();

        $id = mysql_real_escape_string($id);

        $query = <<<SQL
SELECT
    name
FROM
    hpi_video_library_external_video_providers
WHERE
id = $id

SQL;

        //echo $query; exit;
        $result = mysql_query($query, $dbh);
        $row = mysql_fetch_assoc($result);
        return $row['name'];
    }

    public static function
        get_tag_id_for_tag_string($tag)
    {
        $dbh = DB::m();

        $tag = mysql_real_escape_string($tag);

        $query = <<<SQL
SELECT
    hpi_video_library_tags.id
FROM
    hpi_video_library_tags
WHERE
hpi_video_library_tags.tag = '$tag'

SQL;

        //echo $query; exit;

        $result = mysql_query($query, $dbh);

        $row = mysql_fetch_assoc($result);
        return $row['id'];

    }

    public static function
        get_external_video_library_id_for_external_video_id($id)
    {
        $dbh = DB::m();

        $id = mysql_real_escape_string($id);

        $query = <<<SQL
SELECT
    hpi_video_library_external_video_libraries.id
FROM
    hpi_video_library_external_videos,
hpi_video_library_external_video_libraries,
hpi_video_library_ext_vid_to_ext_vid_lib_links
WHERE
hpi_video_library_ext_vid_to_ext_vid_lib_links.external_video_id = $id
AND
hpi_video_library_ext_vid_to_ext_vid_lib_links.external_video_library_id 
= hpi_video_library_external_video_libraries.id

SQL;

        //echo $query; exit;

        $result = mysql_query($query, $dbh);

        $row = mysql_fetch_assoc($result);
        return $row['id'];

    }
    public static function
        get_external_video_library_name_for_external_video_id($id)
    {
        $dbh = DB::m();

        $id = mysql_real_escape_string($id);

        $query = <<<SQL
SELECT
    hpi_video_library_external_video_libraries.name
FROM
    hpi_video_library_external_videos,
hpi_video_library_external_video_libraries,
hpi_video_library_ext_vid_to_ext_vid_lib_links
WHERE
hpi_video_library_ext_vid_to_ext_vid_lib_links.external_video_id = $id
AND
hpi_video_library_ext_vid_to_ext_vid_lib_links.external_video_library_id = hpi_video_library_external_video_libraries.id

SQL;

        //echo $query; exit;

        $result = mysql_query($query, $dbh);

        $row = mysql_fetch_assoc($result);
        return $row['name'];

    }

    public static function
        delete_orphaned_tags($include_principal_tags = FALSE)
    {
        $dbh = DB::m();
        $query = <<<SQL
DELETE FROM
    hpi_video_library_tags
WHERE
    hpi_video_library_tags.id
NOT IN (
    SELECT DISTINCT (
    hpi_video_library_tags_to_ext_vid_links.tag_id
    )
    FROM
    hpi_video_library_tags_to_ext_vid_links
)

SQL;

        if ($include_principal_tags == FALSE) {
            $query .= <<<SQL
AND
    hpi_video_library_tags.principal = 'no'

SQL;

        }

        return mysql_query($query, $dbh);
    }

    public function
        get_external_videos_count_for_tag_id($id)
    {
        $dbh = DB::m();
        $id = mysql_real_escape_string($id);
        $query = <<<SQL
SELECT
    count(distinct(hpi_video_library_external_videos.id)) AS 'video_count'
FROM
    hpi_video_library_external_videos,
    hpi_video_library_tags,
    hpi_video_library_tags_to_ext_vid_links
WHERE
    hpi_video_library_tags_to_ext_vid_links.external_video_id = hpi_video_library_external_videos.id
    AND
    hpi_video_library_tags_to_ext_vid_links.tag_id = hpi_video_library_tags.id
    AND
    hpi_video_library_tags.id = '$id' 
GROUP BY
    hpi_video_library_tags.id

SQL;

        //print_r($query);exit;

        $result = mysql_query($query, $dbh);
        $row = mysql_fetch_assoc($result);
        if ( $row['video_count'] == '' ) $row['video_count'] = 0;
        return $row['video_count'];
    }

    public function
        get_tags_with_counts(
            $order_by = 'product_count',
            $direction = 'DESC'
        )
    {
        $query = <<<SQL
SELECT
    count(distinct(hpi_shop_products.id)) AS 'product_count',
    hpi_shop_product_tags.*
FROM
    hpi_shop_products,
    hpi_shop_product_tags,
    hpi_shop_product_tag_links
WHERE
    hpi_shop_product_tag_links.product_id = hpi_shop_products.id
    AND
    hpi_shop_product_tag_links.product_tag_id = hpi_shop_product_tags.id
GROUP BY
    hpi_shop_product_tags.id
ORDER BY
    $order_by $direction
SQL;

        #$tags_table = $this->get_element();

        return $this->get_rows_for_select($query);      

    }

    public static function
        set_external_video_thumbnail_url(
            $video_id,
            $thumbnail_url
        )
    {
        $dbh = DB::m();
        $video_id = mysql_real_escape_string($video_id);
        $thumbnail_url = mysql_real_escape_string($thumbnail_url);

        $stmt = <<<SQL
UPDATE
    hpi_video_library_external_videos
SET
    thumbnail_url = '$thumbnail_url'
WHERE
    id = $video_id

SQL;

        //print_r($stmt);exit;

        $result = mysql_query($stmt, $dbh);
        return $video_id;
    }

    public function
        video_exists_in_external_videos_by_external_video_provider_id_and_providers_internal_id(
            $external_video_provider_id,
            $providers_internal_id
        ) 
    {
        $dbh = DB::m();
        $external_video_provider_id = mysql_real_escape_string($external_video_provider_id);
        $providers_internal_id = mysql_real_escape_string($providers_internal_id);

        $stmt = <<<SQL
SELECT
    COUNT(*) as count
FROM
    hpi_video_library_external_videos
WHERE
    external_video_provider_id = '$external_video_provider_id'
AND
    providers_internal_id = '$providers_internal_id'

SQL;

         // print_r($stmt);exit;

        $result = mysql_query($stmt, $dbh);
        $row = mysql_fetch_assoc($result);
        // print_r($row);exit;

        if ( $row['count'] > 0 ) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /*
     * Links to Frame Grabbing Queue DB functions,
     * now in their own helper
     */
    public static function
        get_external_videos_frame_grabbing_queue(
            $where_clause
        )
    {
        return VideoLibrary_FrameGrabbingQueueDatabaseHelper::
            get_external_videos_frame_grabbing_queue(
                $where_clause
            );
    }

    public static function
        update_external_video_frame_grabbing_queue_for_video(
            $queue_id
        )
    {
        return VideoLibrary_FrameGrabbingQueueDatabaseHelper::
            update_external_video_frame_grabbing_queue_for_video(
                $queue_id
            );
    }

    public static function
        reset_external_videos_frame_grabbing_queue()
    {
        return VideoLibrary_FrameGrabbingQueueDatabaseHelper::
            reset_external_videos_frame_grabbing_queue();
    }

    public static function
		requeue_video_in_external_videos_frame_grabbing_queue_by_external_video_id($id)
	{
        return VideoLibrary_FrameGrabbingQueueDatabaseHelper::
            requeue_video_in_external_videos_frame_grabbing_queue_by_external_video_id($id);
	}

    public function
        video_exists_in_external_videos_frame_grabbing_queue_by_external_video_id($id)
    {
        return VideoLibrary_FrameGrabbingQueueDatabaseHelper::
            video_exists_in_external_videos_frame_grabbing_queue_by_external_video_id($id);
    }

    public function
		add_video_to_external_videos_frame_grabbing_queue($id)
	{
        return VideoLibrary_FrameGrabbingQueueDatabaseHelper::
            add_video_to_external_videos_frame_grabbing_queue($id);
    }
}
?>
