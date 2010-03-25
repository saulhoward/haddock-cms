<?php
/**
 * FeedAggregator_DatabaseHelper
 *
 * @copyright 2010-03-19, SANH
 */

class
FeedAggregator_DatabaseHelper
{
    public static function
        add_feed(
            $name,
            $title,
            $description,
            $url,
            $format,
            $tags           // array
        )
    {
        $dbh = DB::m();
        $name = FeedAggregator_FeedHelper::correct_feed_name($name);
        $name = mysql_real_escape_string($name);
        $title = mysql_real_escape_string($title);
        $description = mysql_real_escape_string($description);
        $url = mysql_real_escape_string($url);
        $format = mysql_real_escape_string(trim($format));

        $stmt = <<<SQL
INSERT
INTO
    hpi_feed_aggregator_feeds
SET
    name = '$name',
    title = '$title',
    description = '$description',
    url = '$url',
    format = '$format'

SQL;

        //print_r($stmt);exit;

        $result = mysql_query($stmt, $dbh);
        $id =  mysql_insert_id($dbh);

        self::add_tags_to_feed($id, $tags);
        self::add_feed_to_retrieval_queue($id);
        return $id;
    }

    public static function
        add_tags_to_feed(
            $id,
            $tags // array
        )
    {
        $dbh = DB::m();
        foreach ($tags as $tag) {
            $tag = mysql_real_escape_string($tag);

            $tag_query_1 = <<<SQL
INSERT
INTO
    hpi_feed_aggregator_tags
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
                        = FeedAggregator_DatabaseHelper
                        ::get_tag_id_for_tag_string($tag); 
                }
            }
            $tag_id = mysql_real_escape_string($tag_id);

            $tag_query_2 = <<<SQL
INSERT
INTO
    hpi_feed_aggregator_tags_to_feed_links
SET
    tag_id = '$tag_id',
    feed_id = '$id'

SQL;

            $result = mysql_query($tag_query_2, $dbh);
            if (!$result) {
                if (mysql_errno() == 1062) { #duplicate
                    # Do nothing, link already exists			
                }
            }
        }
        return $id;
    }

    public static function
        add_feed_to_retrieval_queue(
            $id
        )
    {
        $dbh = DB::m();
        $id = mysql_real_escape_string($id);

        $cmf = HaddockProjectOrganisation_ConfigManagerFactory::get_instance();
        $config_manager = 
            $cmf->get_config_manager('plug-ins', 'feed-aggregator');
        $frequency_minutes = mysql_real_escape_string(
            $config_manager->get_default_feed_retrieval_frequency_in_minutes()
        );

        $stmt = <<<SQL
INSERT
INTO
    hpi_feed_aggregator_retrieval_queue
SET
    feed_id = '$id',
    frequency_minutes = '$frequency_minutes',
    last_retrieved = NULL,
    status = 'skip'

SQL;

        // print_r($stmt);exit;

        $result = mysql_query($stmt, $dbh);

        $id =  mysql_insert_id($dbh);
        return $id;
    }

    public static function
        edit_feed_status_and_frequency_in_retrieval_queue(
            $id,
            $status,
            $frequency_minutes
        )
    {
        return self::edit_feed_in_retrieval_queue(
            $id,
            $frequency_minutes,
            $status
        );
    }

    public static function
        edit_feed_in_retrieval_queue(
            $id,
            $frequency_minutes,
            $status,
            $last_retrieved = NULL
        )
    {
        $dbh = DB::m();
        $id = mysql_real_escape_string($id, $dbh);
        $frequency_minutes = mysql_real_escape_string($frequency_minutes, $dbh);
        $status = mysql_real_escape_string($status, $dbh);
        if ($last_retrieved != NULL) {
            $last_retrieved = mysql_real_escape_string($last_retrieved, $dbh);
        }

        $stmt = <<<SQL
UPDATE 
    hpi_feed_aggregator_retrieval_queue
SET
    frequency_minutes = '$frequency_minutes',
SQL;

        if ($last_retrieved != NULL) {

            $stmt .= <<<SQL
    last_retrieved = '$last_retrieved',
SQL;

        }

$stmt .= <<<SQL
    status = '$status'
WHERE
    id = '$id'

SQL;

        // print_r($stmt);exit;

        $result = mysql_query($stmt, $dbh);

        $id =  mysql_insert_id($dbh);
        return $id;
    }

    public static function
        set_feed_retrieved_date(
            $id,
            $date
        )
    {
        $dbh = DB::m();
        $id = mysql_real_escape_string($id, $dbh);
        $date = mysql_real_escape_string($date, $dbh);

        $stmt = <<<SQL
UPDATE 
    hpi_feed_aggregator_retrieval_queue
SET
    last_retrieved = '$date'
WHERE
    feed_id = '$id'

SQL;

        // print_r($stmt);exit;

        $result = mysql_query($stmt, $dbh);
        return $id;
    }

    public static function
        edit_feed(
            $id,
            $name,
            $title,
            $description,
            $url,
            $format,
            $tags              // array
        )
    {
        //print_r($_POST);exit;
        //print_r($_GET);exit;
        $dbh = DB::m();
        $id = mysql_real_escape_string($id, $dbh);
        $name = FeedAggregator_FeedHelper::correct_feed_name($name);
        $name = mysql_real_escape_string($name, $dbh);
        $title = mysql_real_escape_string($title, $dbh);
        $description = mysql_real_escape_string($description, $dbh);
        $url = mysql_real_escape_string($url, $dbh);
        $format = mysql_real_escape_string(trim($format), $dbh);

        $stmt = <<<SQL
UPDATE
    hpi_feed_aggregator_feeds
SET
    name = '$name',
    title = '$title',
    description = '$description',
    url = '$url',
    format = '$format'
WHERE
    id = $id
SQL;

        // print_r($stmt);exit;
        $result = mysql_query($stmt, $dbh);

		/**
         * Tags 
         * ----
         * delete all the links 
         * then add them again
         * then run the orphaned tags func
		 */
        self::delete_tag_to_feed_links_for_feed_id($id);
        self::add_tags_to_feed($id, $tags);
		self::delete_orphaned_tags();
        return $id;
    }

    public static function
        delete_tag_to_feed_links_for_feed_id($id)
    {
        $dbh = DB::m();
        $id = mysql_real_escape_string($id, $dbh);
		$stmt = <<<SQL
DELETE
FROM
	hpi_feed_aggregator_tags_to_feed_links
WHERE
	feed_id = $id
SQL;
		
		#echo $stmt; exit;
		mysql_query($stmt, $dbh);

        return $id;
    }

    public static function
        delete_feed(
            $id
        )
    {
        $dbh = DB::m();
        $id = mysql_real_escape_string($id, $dbh);

        $stmt = <<<SQL
DELETE
FROM
    hpi_feed_aggregator_feeds
WHERE
    id = '$id'
SQL;

        // echo $stmt; exit;
        mysql_query($stmt, $dbh);
        self::delete_feed_from_retrieval_queue($id);
        self::delete_tag_to_feed_links_for_feed_id($id);
		self::delete_orphaned_tags();
        return $id;
    }

    public static function
        delete_feed_from_retrieval_queue(
            $id
        )
    {
        $dbh = DB::m();
        $id = mysql_real_escape_string($id, $dbh);

        $stmt = <<<SQL
DELETE
FROM
    hpi_feed_aggregator_retrieval_queue
WHERE
    feed_id = $id
SQL;

        #echo $stmt; exit;
        mysql_query($stmt, $dbh);
        return $id;
    }

    public static function
        delete_all_feeds()
    {
        $dbh = DB::m();

        $stmt = <<<SQL
TRUNCATE TABLE
    hpi_feed_aggregator_feeds
SQL;

        mysql_query($stmt, $dbh);
        FeedAggregator_DatabaseHelper::delete_all_feeds_from_retrieval_queue();
        FeedAggregator_DatabaseHelper::delete_all_tags();
    }

    public static function
        delete_all_tags()
    {
        $dbh = DB::m();

        $stmt = <<<SQL
TRUNCATE TABLE
    hpi_feed_aggregator_tags
SQL;

        mysql_query($stmt, $dbh);

        $stmt_2 = <<<SQL
TRUNCATE TABLE
    hpi_feed_aggregator_tags_to_feed_links
SQL;

        mysql_query($stmt_2, $dbh);
    }

    public static function
        delete_all_feeds_from_retrieval_queue()
    {
        $dbh = DB::m();

        $stmt = <<<SQL
TRUNCATE TABLE
    hpi_feed_aggregator_retrieval_queue
SQL;

        mysql_query($stmt, $dbh);
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
        get_feed_name_for_feed_id(
            $id
        )
    {
        $dbh = DB::m();

        $id = mysql_real_escape_string($id);

        $query = <<<SQL
SELECT
    hpi_feed_aggregator_feeds.name
FROM
    hpi_feed_aggregator_feeds
WHERE
    hpi_feed_aggregator_feeds.id = $id

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
    hpi_feed_aggregator_tags
WHERE
    hpi_feed_aggregator_tags.id
NOT IN (
    SELECT DISTINCT (
    hpi_feed_aggregator_tags_to_feed_links.tag_id
    )
    FROM
    hpi_feed_aggregator_tags_to_feed_links
)

SQL;

        if ($include_principal_tags == FALSE) {
            $query .= <<<SQL
AND
    hpi_feed_aggregator_tags.principal = 'no'

SQL;

        }

        return mysql_query($query, $dbh);
    }

    public function
        get_feed_count_for_tag_id($id)
    {
        $dbh = DB::m();
        $id = mysql_real_escape_string($id);
        $query = <<<SQL
SELECT
    count(distinct(hpi_video_library_external_videos.id)) AS 'video_count'
FROM
    hpi_video_library_external_videos,
    hpi_video_library_tags,
    hpi_video_library_tags_to_feed_links
WHERE
    hpi_video_library_tags_to_feed_links.external_video_id = hpi_video_library_external_videos.id
    AND
    hpi_video_library_tags_to_feed_links.tag_id = hpi_video_library_tags.id
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
}

    public static function
        get_tags_for_feed_id(
            $video_id,
            $principal = FALSE
        )
    {
        $dbh = DB::m();

        $video_id = mysql_real_escape_string($video_id);

        $query = <<<SQL

SELECT 
    hpi_feed_aggregator_tags.id as id,
    hpi_feed_aggregator_tags.tag as tag,
    hpi_feed_aggregator_tags.principal as principal
FROM 
    `hpi_feed_aggregator_tags`,
    hpi_feed_aggregator_tags_to_feed_links,
    hpi_feed_aggregator_feeds
WHERE 
    hpi_feed_aggregator_tags.id = hpi_feed_aggregator_tags_to_feed_links.tag_id
AND 
    hpi_feed_aggregator_feeds.id 
    = hpi_feed_aggregator_tags_to_feed_links.feed_id
AND
    hpi_feed_aggregator_feeds.id = $video_id

SQL;

        if ($principal) {
            $query .= <<<SQL
AND
    hpi_feed_aggregator_tags.principal = 'yes'

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
    hpi_feed_aggregator_tags
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
    hpi_feed_aggregator_tags.id = '$tag_id'

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
    hpi_feed_aggregator_tags

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




}
?>
