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
    hpi_feed_aggregator_feeds.type
FROM
    hpi_feed_aggregator_retrieval_queue,
    hpi_feed_aggregator_feeds
WHERE
    hpi_feed_aggregator_retrieval_queue.feed_id = 
    hpi_feed_aggregator_feeds.id
AND
    (
        (
            hpi_feed_aggregator_retrieval_queue.last_retrieved 
            + 
            INTERVAL hpi_feed_aggregator_retrieval_queue.frequency_minutes MINUTE
        ) 
        <= DATE()
    )

SQL;

        //echo $query; exit;

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
        add_feed_object_to_cache(
            $feed   //FeedAggegator_Feed 
        )
    {
        foreach ($feed->get_items() as $item) {

            print_r($item);exit;

            FeedAggregator_CLIHelper::add_feed_item_to_cache(
                $item->get_title()
            )
        }
    }
}
?>
