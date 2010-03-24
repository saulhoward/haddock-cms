<?php
/**
 * FeedAggregator_ProcessRetrievalQueueCLIScript
 *
 * @copyright 2010-03-23, SANH
 */

class
FeedAggregator_ProcessRetrievalQueueCLIScript
extends
CLIScripts_CLIScript
{
    private $feed_parser;

    protected function
        get_feed_parser()
    {
        if (!isset($this->feed_parser)) {
            $this->set_feed_parser();
        }
        return $this->feed_parser;
    }

    protected function
        set_feed_parser()
    {
        $this->feed_parser 
            = FeedAggregator_FeedParsingHelper::get_feed_parser();
    }

    public function
        do_actions()
    {
        try
        {
            /*
             * Get feeds for whom their time has come
             */
            $feeds = FeedAggregator_CLIHelper::
                get_feeds_to_process_from_retrieval_queue();
            //print_r($queued_videos);exit;

            foreach ($feeds as $feed_data) {
                try
                {
                    /**
                     * Download the feed
                     */
                    $xml_data = FeedAggregator_CLIHelper::download_feed($feed_data['url']);
                    FeedAggregator_DatabaseHelper::set_feed_retrieved_date($feed_data['id'], date('Y-m-d h:i:s'));
                    print_r(
                        $this->colour_output("#" . $feed_data['id'] . " Downloaded..." . PHP_EOL, 'green')
                    );

                    /**
                     * Parse the feed object 
                     * and insert the items into the DB
                     */
                    // print_r($xml_data);exit;
                    $this->get_feed_parser()->set_raw_feed_data($xml_data);

                    foreach ($this->get_feed_parser()->get_items() as $item) {
                        // print_r($item);exit;
                        
                        /* TODO:
                         * Currently $item is a SimplePie_Item object,
                         * which would be a problem if another parser is used
                         *
                         * Should implement some helper functions for 
                         * FeedAggregator_SimplePieFeedParser that can 
                         * deal with the items for us abstractly
                         */
                        if (!FeedAggregator_CLIHelper::item_is_in_cache($feed_data['id'], $item->get_id())) {
                            FeedAggregator_CLIHelper::add_feed_item_to_cache($feed_data['id'], $item);
                            print_r(
                                $this->colour_output("#" . $feed_data['id'] . " Added item to database..." . PHP_EOL, 'green')
                            );
                        }
                    }

                }
                catch (Exception $e)
                {
                    $output = "#" . $feed_data['id'] 
                        . ' Failed to retrieve feed "' 
                        . $feed_data['name'] . '" (' . $e->getMessage() . ")" . PHP_EOL;

                    print_r($this->colour_output($output, 'red'));
                }
            }
            print_r('Queue processed. Exiting...' . PHP_EOL);
        }
        catch (VideoLibrary_Exception $e)
        {
            print_r($this->colour_output($e->getMessage() . PHP_EOL, 'red'));
            exit;
        }


    }

    protected function
        colour_output(
            $string,
            $colour
        )
    {
        switch ($colour) {
        case 'red':
            $colour_code = "\033[31m";
            break;
        case 'green':
            $colour_code = "\033[32m";
            break;
        default:
            $colour_code = "\033[37m";
        }
        return $colour_code . $string . "\033[37m";
    }

    protected function
        get_help_message()
    {
        $msg = <<<TXT
Feed Retrieval Script
for the Feed Aggregator Plugin
TXT;

        $msg .= PHP_EOL;
        return $msg;
    }
}
?>
