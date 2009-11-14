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
                        throw new VideoGallery_VideoNotSetException();
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
                                        $this->get_external_video_provider_id()
                                );
	
		} else {
                        $videos = VideoLibrary_DatabaseHelper
                                ::get_related_videos_for_external_video_data(
                                        $this->get_external_video_library_id(),
                                        $this->get_video_data()
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
                $providers = VideoLibrary_DatabaseHelper::
                        get_external_video_providers_for_videos(
                                VideoLibrary_DatabaseHelper
                                ::get_related_videos_for_external_video_data(
                                        $this->get_external_video_library_id(),
                                        $this->get_video_data()
                                )
                        );

                return VideoLibrary_DisplayHelper
                        ::get_related_videos_div(
                                $this->get_video_data(), $this->get_related_videos(), $providers
                        );
        }


}
?>
