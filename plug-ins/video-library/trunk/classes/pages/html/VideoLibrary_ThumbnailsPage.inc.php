<?php
/**
 * VideoLibrary_ThumbnailsPage
 * 
 * @copyright Clear Line Web Design, 2007-12-10
 *
 * Abstract class for pages that list videos,
 * like: Home, Search
 *
 */

abstract class
VideoLibrary_ThumbnailsPage
extends
VideoLibrary_ExternalVideoLibraryPage
{
        protected $videos;
        protected $total_videos_count;
        protected $start;
        protected $duration;

        abstract protected function
                set_videos();

        abstract protected function
                set_total_videos_count();

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
                                $this->get_search_results_duration();
                }
        }

        private function
                get_search_results_duration()
        {
                $cmf = HaddockProjectOrganisation_ConfigManagerFactory::get_instance();
                $config_manager = 
                        $cmf->get_config_manager('plug-ins', 'video-library');
                return $config_manager->get_search_results_duration();
        }

        protected function
                get_videos()
        {
                if (!isset($this->videos)) {
                        $this->set_videos();
                }
                return $this->videos;
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
                get_total_videos_count()
        {
                if (!isset($this->total_videos_count)) {
                        $this->set_total_videos_count();
                }
                return $this->total_videos_count;
        }

        public function
                content()
        {
        }

        public function
                render_body_div_content()
        {
                $content_div = new HTMLTags_Div();
                $content_div->set_attribute_str('id', 'content');

                $provider_wrapper = new HTMLTags_Div();
                $provider_wrapper->set_attribute_str('id','providers-wrapper');
                $provider_wrapper->append('<h3 id="channels">Channels</h3>');
                $provider_wrapper->append($this->get_provider_navigation_div());
                $provider_wrapper->append('<h3 id="categories">Categories</h3>');
                $tags_nav = $this->get_tags_navigation_div();
                $tags_nav->set_attribute_str('id', 'sidebar-tags');
                $provider_wrapper->append($tags_nav);
                $content_div->append($provider_wrapper);

                $videos_description = new HTMLTags_Div();
                $videos_description->set_attribute_str('id','videos-description');
                $videos_description->append($this->get_videos_description_div());
                $content_div->append($videos_description);

                $thumbnails_wrapper = new HTMLTags_Div();
                $thumbnails_wrapper->set_attribute_str('id','thumbnails-wrapper');
                $thumbnails_wrapper->append($this->get_thumbnails_advert_div());
                $thumbnails_wrapper->append($this->get_thumbnails_div());
                $thumbnails_wrapper->append($this->get_pager_div());
                $content_div->append($thumbnails_wrapper);

                echo $content_div->get_as_string();
        }

        private function
                get_thumbnails_advert_div()
        {
                return <<<HTML
<div id="medium-square" class="advert">
&nbsp;
</div>
HTML;

        }

        protected function
                get_videos_description_div()
        {
                return VideoLibrary_DisplayHelper::get_search_page_videos_description_div();
        }

        private function
                get_thumbnails_div()
        {
                //print_r($this->get_videos());exit;
                return	VideoLibrary_DisplayHelper
                        ::get_thumbnails_div($this->get_videos());
        }

        private function
                get_pager_div()
        {
                return	VideoLibrary_DisplayHelper
                        ::get_pager_div(
                                $this->get_start(),
                                $this->get_duration(),
                                $this->get_total_videos_count()
                        );
        }
}
?>
