<?php
/**
 * FeedAggregator_CLIHelper
 *
 * @copyright 2010-03-19, SANH
 */

class
FeedAggregator_CLIHelper
{
	public function
        get_feeds_to_process_from_retrieval_queue()
    {
        $dbh = DB::m();

        $id = mysql_real_escape_string($id);

        $query = <<<SQL
SELECT
    hpi_feed_aggregator_feeds.id,
    hpi_feed_aggregator_feeds.name,
    hpi_feed_aggregator_feeds.url,
    hpi_feed_aggregator_feeds.format
FROM
    hpi_feed_aggregator_retrieval_queue,
    hpi_feed_aggregator_feeds
WHERE
    hpi_feed_aggregator_retrieval_queue.status = 'retrieve'
AND
    (
        (
            IFNULL(hpi_feed_aggregator_retrieval_queue.last_retrieved, '1970-01-01 00:00:00')
            + 
            INTERVAL hpi_feed_aggregator_retrieval_queue.frequency_minutes MINUTE
        ) 
        <= NOW()
    )

SQL;

        // print_r($query); exit;

        $result = mysql_query($query, $dbh);
        $feeds = array();
        while ($row = mysql_fetch_assoc($result)) {
            $feeds[] = $row;
        }   
        //print_r($feeds);exit;
        return $feeds;
    }

    public static function
        download_feed($url)
    {
        $timeout = 1;

        # INSTANTIATE CURL.
        $curl = curl_init();

        # CURL SETTINGS.
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout);

        # GRAB THE XML FILE.
        $xml_data = curl_exec($curl);

        curl_close($curl);

        if (empty($xml_data)) {
            throw new FeedAggregator_DownloadException('Curl returned empty file');
        }
        return $xml_data;
    }

    public static function
        get_class_name_for_format($format)
    {
        switch ($format) {
        case 'atom':
            return 'FeedAggregator_AtomSimpleXMLElement';
        case 'rss2':
            return 'FeedAggregator_RSSSimpleXMLElement';
        default:
            return 'FeedAggregator_RSSSimpleXMLElement';
        }
    }

    public static function
        add_feed_item_to_cache(
            $feed_id,
            $item       // SimplePie_Item -- NOT GOOD
        )
    {
        $dbh = DB::m();

        $feed_id = mysql_real_escape_string($feed_id, $dbh);
        $full_content = mysql_real_escape_string($item->get_content(), $dbh);
        $unique_item_id = mysql_real_escape_string($item->get_id(), $dbh);
        $summary = mysql_real_escape_string($item->get_description(), $dbh);
        $title = mysql_real_escape_string($item->get_title(), $dbh);
        $link = mysql_real_escape_string($item->get_link(), $dbh);

        $stmt = <<<SQL
INSERT
INTO
    hpi_feed_aggregator_cache
SET
    feed_id = '$feed_id',
    unique_item_id = '$unique_item_id',
    date_retrieved = NOW(),
    full_content = '$full_content',
    title = '$title',
    link = '$link',
    summary = '$summary'

SQL;

        // print_r($stmt);exit;

        $result = mysql_query($stmt, $dbh);

        $id =  mysql_insert_id($dbh);
        return $id;
    }

    public static function
        item_is_in_cache(
            $feed_id,
            $item_id
        )
    {
        $dbh = DB::m();
        $feed_id = mysql_real_escape_string($feed_id);

        $stmt = <<<SQL
SELECT
    COUNT(*) as count
FROM
    hpi_feed_aggregator_cache
WHERE
    feed_id = '$feed_id'
AND
    unique_item_id = '$item_id'

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
}
?>
