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
    $feed_parser

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
            = VideoLibrary_PageBuildingHelper::get_feed_parser();
        $this->feed_parser->set_current_page_class(get_class($this));
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
                get_feeds_to_process_from_retrieval_queue(
                    date()
                );
            //print_r($queued_videos);exit;

            foreach ($feeds as $feed_data) {
                try
                {
                    /**
                     * Download the feed
                     */
                    $xml_data = FeedAggregator_CLIHelper::download_feed($feed_data['url']);
                    print_r(
                        $this->colour_output("#" . $feed_data['id'] . " Downloaded..." . PHP_EOL, 'green')
                    );

                    $feed_class_name =
                        FeedAggregator_CLIHelper::get_class_name_for_format($feed_data['format']);
                    try 
                    {
                        $feed = new $feed_class_name($xml_data);
                    }
                    catch (Exception $e)
                    {
                        throw new 
                            FeedAggregator_ClassInstanceCreationException('Error reading XML');
                    }

                    /**
                     * Insert the feed object into the DB
                     */
                    FeedAggregator_CLIHelper::add_feed_object_to_cache($feed);
                    print_r(
                        $this->colour_output(
                            "#" . $feed_data['id'] . " Added " . $feed->get_number_of_items() . " entries to DB..." . PHP_EOL, 'green'
                        )
                    );
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
