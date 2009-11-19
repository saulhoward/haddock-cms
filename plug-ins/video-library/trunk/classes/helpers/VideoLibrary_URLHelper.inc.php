<?php
/**
 * VideoLibrary_URLHelper
 *
 * @copyright 2009-01-10, SANH
 */

class
VideoLibrary_URLHelper
{
	public static function
		get_default_thumbnail_url()
	{
		$cmf = HaddockProjectOrganisation_ConfigManagerFactory::get_instance();
		$config_manager = 
			$cmf->get_config_manager('plug-ins', 'video-library');
		$default_url= $config_manager->get_default_thumbnail_url();

		$url = new HTMLTags_URL();
		$url->set_file($default_url);
		return $url;
	}

	public static function
		get_pretty_video_page_url(
			$id,
			$video_name
		)
	{
		$video_name = self::prepare_for_url($video_name);
		$url = new HTMLTags_URL();
		$url->set_file('/videos/' . $id . '/' . $video_name);
		return $url;
	}

	public static function
		get_video_page_url($video_id)
	{
		$cmf = HaddockProjectOrganisation_ConfigManagerFactory::get_instance();
		$config_manager = 
			$cmf->get_config_manager('plug-ins', 'video-library');
		$video_page_class_name= $config_manager->get_video_page_class_name();

		$get_variables = array(
			"video_id" => $video_id
		);
		return PublicHTML_URLHelper
			::get_oo_page_url(
				$video_page_class_name,
				$get_variables
			);
	}

	public static function
		get_search_page_url()
	{
		$cmf = HaddockProjectOrganisation_ConfigManagerFactory::get_instance();
		$config_manager = 
			$cmf->get_config_manager('plug-ins', 'video-library');
		$search_page_class_name= $config_manager->get_search_page_class_name();

		return PublicHTML_URLHelper
			::get_oo_page_url(
				$search_page_class_name
			);
	}

	public static function
		get_external_video_library_search_page_url(
			$library_id
		)
	{
		$search_page_url = self::get_search_page_url();
		$search_page_url->set_get_variable("external_video_library_id", $library_id);
		return $search_page_url;
	}

	public static function
		get_external_video_provider_search_page_url(
			$provider_id
		)
	{
		$search_page_url = self::get_search_page_url();
		$search_page_url->set_get_variable("external_video_provider_id", $provider_id);

		if (isset($_GET['external_video_library_id'])) {
			$search_page_url->set_get_variable(
				"external_video_library_id", 
				$_GET['external_video_library_id']
			);
		}
		return $search_page_url;
	}

	public static function
		get_tags_search_page_url_for_tag_id(
			$tag_id,
			$external_video_library_id
		)
	{
		$search_page_url = self
			::get_external_video_library_search_page_url($external_video_library_id);
		$search_page_url->set_get_variable("tag_ids", $tag_id);
		return $search_page_url;
	}

	public static function
		get_tags_search_page_url(
			$tag_ids,
			$external_video_library_id
		)
	{
		$search_page_url = self
			::get_external_video_library_search_page_url($external_video_library_id);
		if (is_array($tag_ids)) {
			$search_page_url->set_get_variable("tag_ids", implode(',', $tag_ids));
		} else {
			$search_page_url->set_get_variable("tag_ids", $tag_ids);
		}
		return $search_page_url;
	}

	public static function
		get_tags_and_external_video_provider_search_page_url(
			$tag_ids,
			$external_video_provider_id
		)
	{
		$search_page_url = self
			::get_search_page_url();
		if (is_array($tag_ids)) {
			$search_page_url->set_get_variable("tag_ids", implode(',', $tag_ids));
		} else {
			$search_page_url->set_get_variable("tag_ids", $tag_ids);
		}
		$search_page_url->set_get_variable(
			"external_video_provider_id", 
			$external_video_provider_id
		);
		if (isset($_GET['external_video_library_id'])) {
			$search_page_url->set_get_variable(
				"external_video_library_id", 
				$_GET['external_video_library_id']
			);
		}
		return $search_page_url;
	}

	public static function
		get_all_external_video_providers_url(
			$tag_ids = NULL
		)
	{
		$search_page_url = self
			::get_search_page_url();
		
		if ($tag_ids) {
			if (is_array($tag_ids)) {
				$search_page_url->set_get_variable("tag_ids", implode(',', $tag_ids));
			} else {
				$search_page_url->set_get_variable("tag_ids", $tag_ids);
			}
		}
		if (isset($_GET['external_video_library_id'])) {
			$search_page_url->set_get_variable(
				"external_video_library_id", 
				$_GET['external_video_library_id']
			);
		}
		return $search_page_url;
	}

	public static function
		get_all_tags_url(
			$external_video_provider_id = NULL
		)
	{
		$search_page_url = self
			::get_search_page_url();
		
		if ($external_video_provider_id) {
			$search_page_url->set_get_variable(
				"external_video_provider_id", 
				$external_video_provider_id
			);
		}
		if (isset($_GET['external_video_library_id'])) {
			$search_page_url->set_get_variable(
				"external_video_library_id", 
				$_GET['external_video_library_id']
			);
		}
		return $search_page_url;
	}

        public static function
                get_results_page_url(
                        $results_page_url,
                        $start,
                        $duration
                )
        {
                $results_page_url->set_get_variable(
                        'start',
                        $start
                );
                $results_page_url->set_get_variable(
                        'duration',
                        $duration
                );
                if (isset($_GET['tag_ids'])) {
                        $results_page_url->set_get_variable(
                                'tag_ids',
                                $_GET['tag_ids']
                        );
                }
                if (isset($_GET['external_video_library_id'])) {
                        $results_page_url->set_get_variable(
                                "external_video_library_id", 
                                $_GET['external_video_library_id']
                        );
                }
                if (isset($_GET['external_video_provider_id'])) {
                        $results_page_url->set_get_variable(
                                "external_video_provider_id", 
                                $_GET['external_video_provider_id']
                        );
                }



                return $results_page_url;
        }

	
}
?>
