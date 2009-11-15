<?php
/**
 * VideoLibrary_ConfigManager
 *
 * @copyright 2008-02-09, RFI
 */

class
	VideoLibrary_ConfigManager
extends
	HaddockProjectOrganisation_ConfigManager
{
	protected function
		get_module_prefix_string()
	{
		return '/plug-ins/video-library/';
	}
	
	public function
		get_page_builder_class_name()
	{
		return trim($this->get_config_value('page-building/page-builder-class'));
	}

	public function
		get_video_page_class_name()
	{
		return trim($this->get_config_value('page-classes/video-page-class'));
	}

	public function
		get_search_page_class_name()
	{
		return trim($this->get_config_value('page-classes/search-page-class'));
	}

	public function
		get_default_thumbnail_url()
	{
		return trim($this->get_config_value('thumbnails/default-thumbnail-url'));
	}

	public function
		get_thumbnails_original_directory()
        {
                return trim(
                        $this->get_config_value(
                                'thumbnails/original-directory'
                        )
                );
        }

	public function
		get_thumbnails_medium_directory()
        {
                return trim(
                        $this->get_config_value(
                                'thumbnails/medium/directory'
                        )
                );
        }

	public function
		get_thumbnails_medium_web_directory()
        {
                return trim(
                        $this->get_config_value(
                                'thumbnails/medium/web-directory'
                        )
                );
        }

	public function
		get_thumbnails_medium_width()
        {
                return trim(
                        $this->get_config_value(
                                'thumbnails/medium/width'
                        )
                );
        }

        public function
		get_thumbnails_medium_height()
        {
                return trim(
                        $this->get_config_value(
                                'thumbnails/medium/height'
                        )
                );
        }
}
?>
