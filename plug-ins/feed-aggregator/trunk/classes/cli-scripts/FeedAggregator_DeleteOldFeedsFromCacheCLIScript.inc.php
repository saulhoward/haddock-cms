<?php
/**
 * FeedAggregator_DeleteOldFeedsFromCacheCLIScript
 *
 * @copyright 2010-03-23, SANH
 */

class
FeedAggregator_DeleteOldFeedsFromCacheCLIScript
extends
CLIScripts_CLIScript
{
    public function
        do_actions()
    {
        try
        {
            FeedAggregator_DatabaseHelper::delete_old_feeds_from_cache();
            print_r(
                $this->colour_output('Deleted Feeds from Cache' . PHP_EOL, 'green')
            );
            print_r('Exiting...' . PHP_EOL);
        }
        catch (Exception $e)
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
