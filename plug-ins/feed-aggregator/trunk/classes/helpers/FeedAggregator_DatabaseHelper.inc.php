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
            $format
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
        self::add_feed_to_retrieval_queue($id);
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
            $format
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

}
?>
