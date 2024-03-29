<?php
/**
 * VideoLibrary_VideoXMLPage
 * 
 * @copyright SANH, 2010-04-08
 *
 * Video Page XML for the VideoLibrary.com site
 */
class
VideoLibrary_VideoXMLPage
extends
VideoLibrary_SearchXMLPage
{
    private $video_data;

    private $related_videos;

    protected function
        get_external_video_library_id()
    {
        $video_data = $this->get_video_data();
        return $video_data['external_video_library_id'];
    }

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
        get_total_related_videos_count()
    {
        if (!isset($this->total_related_videos_count)) {
            $this->set_total_related_videos_count();
        }
        return $this->total_related_videos_count;
    }

    protected function
        set_total_related_videos_count()
    {
        if (isset($_GET['external_video_provider_id'])) {
            $videos = VideoLibrary_RelatedVideosHelper
                ::get_related_videos_count_for_external_video_data(
                    $this->get_external_video_library_id(),
                    $this->get_video_data(),
                    $this->get_external_video_provider_id()
                );

        } else {
            $videos = VideoLibrary_RelatedVideosHelper
                ::get_related_videos_count_for_external_video_data(
                    $this->get_external_video_library_id(),
                    $this->get_video_data()
                );
        }

        $this->total_related_videos_count = $videos;
    }
    public function
        render_xml()
    {
        if (
            (isset($_GET['ajax']))
            &&
            (isset($_GET['related_videos']))
            &&
            (isset($_GET['rewrite_controls']))
        ) {
            $div = new HTMLTags_Div();
            $thumbnails_wrapper_div = new HTMLTags_Div();
            $thumbnails_wrapper_div->set_attribute_str('id', 'thumbnails-wrapper');
            $thumbnails_wrapper_div->append(
                VideoLibrary_DisplayHelper::
                get_thumbnails_div($this->get_related_videos())
            );
            $div->append($thumbnails_wrapper_div);

            $div->append(
                VideoLibrary_DisplayHelper::
                get_pager_div(
                    $this->get_start(),
                    $this->get_duration(),
                    $this->get_total_related_videos_count(),
                    $this->get_page_url()
                )
            );
            echo $div->get_as_string();

        }
        elseif (
            (isset($_GET['ajax']))
            &&
            (isset($_GET['related_videos']))
        ) {
            echo VideoLibrary_DisplayHelper::
                get_thumbnails_div($this->get_related_videos());
        }
 
    }

    protected function
        get_page_url()
    {
        $url = VideoLibrary_URLHelper
            ::get_oo_page_url(
                'VideoLibrary_VideoPage'
            );
        $video_data = $this->get_video_data();
        $url->set_get_variable('video_id', $video_data['id']);
        return $url;
    }
}
?>
