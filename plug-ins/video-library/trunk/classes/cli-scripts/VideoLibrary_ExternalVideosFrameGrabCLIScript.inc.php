<?php
/**
 * VideoLibrary_ExternalVideosFrameGrabCLIScript
 *
 * @copyright 2009-11-15, SANH
 */

class
VideoLibrary_ExternalVideosFrameGrabCLIScript
extends
CLIScripts_CLIScript
{

    public function
        do_actions()
    {
        try
        {
            /*
             * Get videos which haven't been processed
             */
            $queued_videos = VideoLibrary_DatabaseHelper::
                get_external_videos_frame_grabbing_queue(
                    'last_processed IS NULL'
                );
            //print_r($queued_videos);exit;

            foreach ($queued_videos as $queued_video) {

                /**
                 * get the thumbnail urls
                 */
                $video = VideoLibrary_DatabaseHelper
                    ::get_external_video_data(
                        $queued_video['external_video_id']
                    );

                $thumbnail_urls = VideoLibrary_CLIScriptsHelper
                    ::get_thumbnail_urls_for_external_video($video);

                $i = 1;
                foreach ($thumbnail_urls as $thumbnail_url) {

                    try
                    {
                        /*
                         *Download the thumbnail
                         */
                        $thumbnail_filename = $video['id'] . '_' . $i . '.jpg';
                        $thumbnails_original_dir = VideoLibrary_CLIScriptsHelper::
                            get_thumbnails_original_directory();
                        $original_filename = VideoLibrary_CLIScriptsHelper::
                            download_file(
                                $thumbnail_url,
                                $thumbnails_original_dir,
                                $thumbnail_filename
                            );

                        /*
                         *Resize the thumbnail and copy the resized versions 
                         *to the other directories
                         */
                        $thumbnails_medium_dir = VideoLibrary_CLIScriptsHelper::
                            get_thumbnails_medium_directory();
                        $medium_width = VideoLibrary_CLIScriptsHelper::
                            get_thumbnails_medium_width();
                        $medium_height = VideoLibrary_CLIScriptsHelper::
                            get_thumbnails_medium_height();

                        $medium_filename = VideoLibrary_CLIScriptsHelper::
                            resize_image(
                                $original_filename,
                                $medium_width,
                                $medium_height,
                                $thumbnails_medium_dir,
                                $thumbnail_filename
                            );

                        /**
                         * Update the video's status and thumbnail details
                         * but for the first thumb
                         */
                        if ($i == 1) {
                            $thumbnails_medium_web_dir = VideoLibrary_CLIScriptsHelper::
                                get_thumbnails_medium_web_directory();
                            $thumbnails_medium_web_dir 
                                .= ( substr($thumbnails_medium_web_dir,-1) 
                                != DIRECTORY_SEPARATOR
                            ) ? DIRECTORY_SEPARATOR : "";

                            VideoLibrary_DatabaseHelper::
                                set_external_video_thumbnail_url(
                                    $video['id'],
                                    $thumbnails_medium_web_dir . $thumbnail_filename
                                );
                            VideoLibrary_DatabaseHelper::
                                update_external_video_frame_grabbing_queue_for_video(
                                    $queued_video['id']
                                );
                        }

                        $output = '#' . $video['id'] . ' Set thumbnail ' . $i . ' for video "' . $video['name'] . '"' . PHP_EOL;
                        print_r($this->colour_output($output, 'green'));
                    }
                    catch (Exception $e)
                    {
                        $output = "#" . $video['id'] 
                            . ' Failed to set thumbnail for video "' 
                            . $video['name'] . '" (' . $e->getMessage() . ")" . PHP_EOL;

                        print_r($this->colour_output($output, 'red'));
                    }
                    $i++
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
Frame Grab from External Videos Script
for the Video Library Plugin
TXT;

        $msg .= PHP_EOL;
        return $msg;
    }
}
?>
