<?php
/**
 * VideoLibrary_SearchXMLPage
 * 
 * @copyright Clear Line Web Design, 2007-12-10
 *
 * Search Page for the VideoLibrary.com site
 */
class
VideoLibrary_SearchXMLPage
extends
VideoLibrary_XMLPage
{
    private $search_string;

    private $tag_ids;

    private $external_video_provider_id;

    private $related_videos;

    private $external_video_library_id;

    private $video_data;

    protected $start;
    protected $duration;

    protected function
        set_start()
    {
        if (isset($_GET['start'])) {
            $this->start = $_GET['start'];
        } else {
            $this->start = '0';
        }
    }

    protected function
        set_duration()
    {
        if (isset($_GET['duration'])) {
            $this->duration = $_GET['duration'];
        } else {
            if (isset($_GET['related_videos'])) {
                $this->duration =
                    $this->get_related_videos_results_duration();
            } else {
                $this->duration =
                    $this->get_search_results_duration();
            }
        }
    }

    private function
        get_related_videos_results_duration()
    {
        $cmf = HaddockProjectOrganisation_ConfigManagerFactory::get_instance();
        $config_manager = 
            $cmf->get_config_manager('plug-ins', 'video-library');
        return $config_manager->get_related_videos_results_duration();
    }


    private function
        get_search_results_duration()
    {
        $cmf = HaddockProjectOrganisation_ConfigManagerFactory::get_instance();
        $config_manager = 
            $cmf->get_config_manager('plug-ins', 'video-library');
        return $config_manager->get_search_results_duration();
    }


    private function
        set_external_video_library_id(
            $external_video_library_id
        )
    {
        $this->external_video_library_id 
            = $external_video_library_id;
    }

    private function
        set_external_video_library_id_from_get()
    { 
        if (isset($_GET['external_video_library_id'])) {
            $this->set_external_video_library_id(
                $_GET['external_video_library_id']
            );
        }
    }

    public function
        get_external_video_library_id()
    {
        /*
         * Is this always a Video Page?
         */
        $video_data = $this->get_video_data();
        return $video_data['external_video_library_id'];
    }

    // protected function
        // get_external_video_library_id()
    // {
        // if (isset($this->external_video_library_id)) {
            // return $this->external_video_library_id;
        // }
        // elseif (
            // isset($_GET['external_video_library_id'])
        // ) {
            // $this->set_external_video_library_id_from_get();
            // return $this->get_external_video_library_id();
        // }
        // else {
            // $this->set_external_video_library_id(
                // VideoLibrary_ExternalLibraryHelper
                // ::get_default_external_library_id()
            // );
            // return $this->get_external_video_library_id();
            // //throw new VideoGallery_ExternalVideoLibraryNotSetException();
        // }
    // }

    private function
        set_video_data($video_data)
    {
        $this->video_data = $video_data;
    }

    private function
        set_video_data_from_get()
    { 
        if (isset($_GET['video_id'])) {
            $this->set_video_data(
                VideoLibrary_DatabaseHelper
                ::get_external_video_data(
                    $_GET['video_id']
                )
            );
        } else {
            throw new VideoGallery_VideoNotSetException();
        }
    }

    protected function
        get_video_data()
    {
        if (isset($this->video_data)) {
            return $this->video_data;
        }
        elseif (
            isset($_GET['video_id'])
        ) {
            $this->set_video_data_from_get();
            return $this->get_video_data();
        }
        else {
            throw new VideoLibrary_VideoNotSetException();
        }
    }

    public function
        get_start()
    {
        // print_r($_GET);exit;
        if (!isset($this->start)) {
            $this->set_start();
        }
        return $this->start;
    }

    public function
        get_duration()
    {
        if (!isset($this->duration)) {
            $this->set_duration();
        }
        return $this->duration;
    }



    protected function
        set_related_videos()
    {
        if (isset($_GET['external_video_provider_id'])) {
            $videos = VideoLibrary_RelatedVideosHelper
                ::get_related_videos_for_external_video_data(
                    $this->get_external_video_library_id(),
                    $this->get_video_data(),
                    $this->get_external_video_provider_id(),
                    $this->get_start(),
                    $this->get_duration()
                );

        } else {
            // print_r($this->get_start());exit;
            $videos = VideoLibrary_RelatedVideosHelper
                ::get_related_videos_for_external_video_data(
                    $this->get_external_video_library_id(),
                    $this->get_video_data(),
                    NULL,
                    $this->get_start(),
                    $this->get_duration()
                );
        }

        $this->related_videos = $videos;
    }

    protected function
        get_related_videos()
    {
        if (!isset($this->related_videos)) {
            $this->set_related_videos();
        }
        return $this->related_videos;
    }

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
                    NULL,
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
        // if (isset($_GET['external_video_library_id'])) {
        // $external_video_library_id =	$_GET['external_video_library_id'];
        // } else {
        // $external_video_library_id = $this->get_external_video_library_id();

        // }


        return	VideoLibrary_DisplayHelper
            ::get_search_page_videos_description_div(
                $tags, 
                $external_video_provider,
                $this->get_external_video_library_id(),
                $search_query
            );
    }

    public function
        render_xml()
    {
        if (
            (isset($_GET['ajax']))
            &&
            (isset($_GET['related_videos']))
        ) {
            echo VideoLibrary_DisplayHelper::
                get_thumbnails_div($this->get_related_videos());
        }
    }
}
?>
