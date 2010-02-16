<?php
/**
 * VideoLibrary_SearchPage
 * 
 * @copyright Clear Line Web Design, 2007-12-10
 *
 * Search Page for the VideoLibrary.com site
 */
class
VideoLibrary_SearchPage
extends
VideoLibrary_ThumbnailsPage
{
    private $search_string;

    private $tag_ids;

    private $external_video_provider_id;

    protected function
        set_videos()
    {
        if (
            (isset($_GET['external_video_provider_id']))
            &&
            (isset($_GET['tag_ids']))
        ) {
            $videos = VideoLibrary_DatabaseHelper::
                get_external_videos_for_tag_ids_and_external_video_provider_id(
                    $this->get_external_video_library_id(),
                    $this->get_tag_ids(),
                    $this->get_external_video_provider_id(),
                    $this->get_start(),
                    $this->get_duration()
                );
        } elseif (isset($_GET['external_video_provider_id'])) {
            $videos = VideoLibrary_DatabaseHelper::
                get_external_videos_for_provider_id(
                    $this->get_external_video_library_id(),
                    $this->get_external_video_provider_id(),
                    $this->get_start(),
                    $this->get_duration()
                );
        } elseif (isset($_GET['tag_ids'])) {
            $videos = VideoLibrary_DatabaseHelper::get_external_videos_for_tag_ids(
                $this->get_external_video_library_id(),
                $this->get_tag_ids(),
                NULL,
                $this->get_start(),
                $this->get_duration()
            );
        } elseif (isset($_GET['q'])){
            $videos = VideoLibrary_SearchHelper::
                get_external_videos_for_search_string(
                    $this->get_external_video_library_id(),
                    $this->get_search_string(),
                    $this->get_start(),
                    $this->get_duration()
                );              
        } else {
            $videos = VideoLibrary_DatabaseHelper::get_external_videos(
                $this->get_external_video_library_id(),
                $this->get_start(),
                $this->get_duration()
            );
        }

        $this->videos = $videos;
    }

    protected function
        set_total_videos_count()
    {
        if (
            (isset($_GET['external_video_provider_id']))
            &&
            (isset($_GET['tag_ids']))
        ) {
            $count = VideoLibrary_DatabaseHelper::
                get_external_videos_count_for_tag_ids_and_external_video_provider_id(
                    $this->get_external_video_library_id(),
                    $this->get_tag_ids(),
                    $this->get_external_video_provider_id()
                );
        } elseif (isset($_GET['external_video_provider_id'])) {
            $count = VideoLibrary_DatabaseHelper::
                get_external_videos_count_for_provider_id(
                    $this->get_external_video_library_id(),
                    $this->get_external_video_provider_id()
                );
        } elseif (isset($_GET['tag_ids'])) {
            $count = VideoLibrary_DatabaseHelper::
                get_external_videos_count_for_tag_ids(
                    $this->get_external_video_library_id(),
                    $this->get_tag_ids(),
                    NULL
                );
        } elseif (isset($_GET['q'])){
            $count = VideoLibrary_SearchHelper::
                get_external_videos_count_for_search_string(
                    $this->get_external_video_library_id(),
                    $this->get_search_string()
                );              
        } else {
            $count = VideoLibrary_DatabaseHelper::
                get_external_videos_count(
                    $this->get_external_video_library_id()
                );
        }

        $this->total_videos_count = $count;
    }

    private function
        set_search_string($str)
    { 
        $this->search_string = $str;
    }

    private function
        set_search_string_from_get()
    { 
        if (isset($_GET['q'])) {
            $this->set_search_string(
                $_GET['q']
            );
        }
    }

    protected function
        get_search_string()
    {
        if (isset($this->search_string)) {
            return $this->search_string;
        }
        elseif (
            isset($_GET['q'])
        ) {
            $this->set_search_string_from_get();
            return $this->get_search_string();
        }
        else {
            throw new VideoGallery_SearchStringNotSetException();
        }
    }


    private function
        set_external_video_provider_id(
            $external_video_provider_id
        )
    {
        $this->external_video_provider_id 
            = $external_video_provider_id;
    }

    private function
        set_external_video_provider_id_from_get()
    { 
        if (isset($_GET['external_video_provider_id'])) {
            $this->set_external_video_provider_id(
                $_GET['external_video_provider_id']
            );
        }
    }

    protected function
        get_external_video_provider_id()
    {
        if (isset($this->external_video_provider_id)) {
            return $this->external_video_provider_id;
        }
        elseif (
            isset($_GET['external_video_provider_id'])
        ) {
            $this->set_external_video_provider_id_from_get();
            return $this->get_external_video_provider_id();
        }
        else {
            throw new VideoGallery_ExternalVideoProviderNotSetException();
        }
    }

    private function
        set_tag_ids(
            $tag_ids
        )
    {
        $this->tag_ids 
            = $tag_ids;
    }

    private function
        set_tag_ids_from_get()
    { 
        if (isset($_GET['tag_ids'])) {
            $this->set_tag_ids(
                explode(',', $_GET['tag_ids'])
            );
        }
    }

    protected function
        get_tag_ids()
    {
        if (isset($this->tag_ids)) {
            return $this->tag_ids;
        }
        elseif (
            isset($_GET['tag_ids'])
        ) {
            $this->set_tag_ids_from_get();
            return $this->get_tag_ids();
        }
        else {
            throw new VideoGallery_TagsNotSetException();
        }
    }

    protected function
        get_videos_description_div()
    {
        if (isset($_GET['external_video_provider_id'])) {
            $external_video_provider = VideoLibrary_DatabaseHelper
                ::get_external_video_provider_for_id(
                    $this->get_external_video_provider_id()
                );
        } else {
            $external_video_provider = NULL;
        }

        if (isset($_GET['tag_ids'])) {
            $tags =	VideoLibrary_DatabaseHelper
                ::get_tags_for_tag_ids(
                    $this->get_tag_ids()
                );
        } else {
            $tags = NULL;

        }
        if (isset($_GET['q'])) {
            $search_query =	$_GET['q'];
        } else {
            $search_query = NULL;

        }

        return	VideoLibrary_DisplayHelper
            ::get_search_page_videos_description_div(
                $tags, 
                $external_video_provider,
                $search_query
            );
    }

}
?>
