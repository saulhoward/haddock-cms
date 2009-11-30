<?php
/**
 * VideoLibrary_VideoPage
 * 
 * @copyright Clear Line Web Design, 2007-12-10
 *
 * Video Page for the VideoLibrary.com site
 */

class
VideoLibrary_VideoPage
extends
VideoLibrary_ExternalVideoLibraryPage
{
        private $video_data;
        private $external_video_provider_id;
        private $related_videos;
        protected $total_related_videos_count;
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
                        $this->duration =
                                $this->get_related_videos_results_duration();
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

        protected function
                get_start()
        {
                if (!isset($this->start)) {
                        $this->set_start();
                }
                return $this->start;
        }

        protected function
                get_duration()
        {
                if (!isset($this->duration)) {
                        $this->set_duration();
                }
                return $this->duration;
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
                        $videos = VideoLibrary_DatabaseHelper
                                ::get_related_videos_count_for_external_video_data(
                                        $this->get_external_video_library_id(),
                                        $this->get_video_data(),
                                        $this->get_external_video_provider_id()
                                );

                } else {
                        $videos = VideoLibrary_DatabaseHelper
                                ::get_related_videos_count_for_external_video_data(
                                        $this->get_external_video_library_id(),
                                        $this->get_video_data()
                                );
                }

                $this->total_related_videos_count = $videos;
        }

        protected function
                get_external_video_library_id()
        {
                $video_data = $this->get_video_data();
                return $video_data['external_video_library_id'];
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
                        $videos = VideoLibrary_DatabaseHelper
                                ::get_related_videos_for_external_video_data(
                                        $this->get_external_video_library_id(),
                                        $this->get_video_data(),
                                        $this->get_external_video_provider_id(),
                                        $this->get_start(),
                                        $this->get_duration()
                                );

                } else {
                        $videos = VideoLibrary_DatabaseHelper
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

        public function
                content()
        {
                $content_div = $this->get_content_div();
                echo $content_div->get_as_string();
        }

        private function
                get_content_div()
        {
                $content_div = new HTMLTags_Div();
                $content_div->set_attribute_str('class', 'content');
                $content_div->set_attribute_str('id', 'VideoPage');

                $content_div->append($this->get_advert_div());
                $content_div->append($this->get_video_div());
                $content_div->append($this->get_related_videos_div());

                return $content_div;
        }

        private function
                get_advert_div()
        {
                $html = <<<HTML

<div class="advert" id="ad-side">
<p>
More Ads here
</p>
</div>
HTML;

                return $html;
        }

        private function
                get_video_div()
        {
                return VideoLibrary_DisplayHelper
                        ::get_video_div_for_external_video_data(
                                $this->get_video_data()
                        );
        }

        private function
                get_related_videos_div()
        {
                /**
                 * TODO:
                 *            Get these providers from the SQL
                 *            As a possible optimisation
                 */
                $related_video_providers = VideoLibrary_DatabaseHelper::
                        get_external_video_providers_for_videos(
                                VideoLibrary_DatabaseHelper
                                ::get_related_videos_for_external_video_data(
                                        $this->get_external_video_library_id(),
                                        $this->get_video_data()
                                )
                        );
                //print_r($video_data);exit;
                $div = new HTMLTags_Div();
                $div->set_attribute_str('id', 'related-videos');
                $video_data = $this->get_video_data();
                $video_page_url = VideoLibrary_URLHelper::
                        get_video_page_url($video_data['id']);
                $providers_wrapper_div = new HTMLTags_Div();
                $providers_wrapper_div->set_attribute_str('id', 'providers-wrapper');
                $providers_wrapper_div->append('<h3 id="channels">Channels</h3>');
                $providers_wrapper_div->append(
                        VideoLibrary_DisplayHelper::
                        get_external_video_provider_navigation_div(
                                $related_video_providers, $video_page_url
                        )
                );
                $div->append($providers_wrapper_div);

                $thumbnails_wrapper_div = new HTMLTags_Div();
                $thumbnails_wrapper_div->set_attribute_str('id', 'thumbnails-wrapper');
                $thumbnails_wrapper_div->append(
                        VideoLibrary_DisplayHelper::
                        get_thumbnails_div($this->get_related_videos())
                );

                $thumbnails_wrapper_div->append(
                        VideoLibrary_DisplayHelper::
                        get_pager_div(
                                $this->get_start(),
                                $this->get_duration(),
                                $this->get_total_related_videos_count(),
                                $this->get_page_url()
                        )
                );

                $div->append($thumbnails_wrapper_div);

                return $div;
        }

        protected function
                get_page_url()
        {
                $url = VideoLibrary_URLHelper
                        ::get_oo_page_url(
                                get_class($this)
                        );
                $video_data = $this->get_video_data();
                $url->set_get_variable('video_id', $video_data['id']);
                return $url;
        }
}
?>
