<?php
/**

 * VideoLibrary_HomePage
 * 
 * @copyright Clear Line Web Design, 2007-12-10
 */

/**
 * Home Page for the VideoLibrary.com site
 */
class
VideoLibrary_HomePage
extends
VideoLibrary_ThumbnailsPage
{
    protected function
        set_videos()
    {
        $videos = VideoLibrary_DatabaseHelper::get_external_videos(
            $this->get_external_video_library_id(),
            $this->get_start(),
            $this->get_duration()
        );

        $this->videos = $videos;
    }

    protected function
        set_total_videos_count()
    {
        $count = VideoLibrary_DatabaseHelper::
            get_external_videos_count(
                $this->get_external_video_library_id()
            );
        $this->total_videos_count = $count;
    }

    protected function
        get_page_url()
    {
        /* Pretend to be the search page for links to work */
        return VideoLibrary_URLHelper::
            get_search_page_url();
    }
}
?>
