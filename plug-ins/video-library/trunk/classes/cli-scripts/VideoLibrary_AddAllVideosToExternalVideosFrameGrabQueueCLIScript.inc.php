<?php
/**
 * VideoLibrary_AddAllVideosToExternalVideosFrameGrabQueueCLIScript
 *
 * @copyright 2009-11-15, SANH
 */

class
VideoLibrary_AddAllVideosToExternalVideosFrameGrabQueueCLIScript
extends
CLIScripts_CLIScript
{

    public function
        do_actions()
    {
        try
        {
            VideoLibrary_DatabaseHelper::add_all_videos_to_external_videos_frame_grabbing_queue();
            $output = 'Succeeded' . PHP_EOL;
            print_r($this->colour_output($output, 'green'));
        }
        catch (Exception $e)
        {
            $output = 'Failed' 
                . ' (' . $e->getMessage() . ")" . PHP_EOL;

            print_r($this->colour_output($output, 'red'));
        }
        print_r('Exiting...' . PHP_EOL);
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
Add *all* videos to the Frame Grab Queue
for the Video Library Plugin
TXT;

        $msg .= PHP_EOL;
        return $msg;
    }
}
?>
