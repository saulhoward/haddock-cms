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
		$url = new VideoLibrary_URL();
		$url->set_file(self::get_default_thumbnail_url_string());
		return $url;
	}

	public static function
		get_default_thumbnail_url_string()
	{
		$cmf = HaddockProjectOrganisation_ConfigManagerFactory::get_instance();
		$config_manager = 
			$cmf->get_config_manager('plug-ins', 'video-library');
		return $config_manager->get_default_thumbnail_url();
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
		get_video_page_class_name()
	{
		$cmf = HaddockProjectOrganisation_ConfigManagerFactory::get_instance();
		$config_manager = 
			$cmf->get_config_manager('plug-ins', 'video-library');
                return $config_manager->get_video_page_class_name();
	}

	public static function
		get_edit_external_video_admin_page_url($id)
    {
        $url = self::get_manage_external_videos_admin_page_url();
        $url->set_get_variable('content', 'edit_something');
        $url->set_get_variable('id', $id);
        return $url;
    }

	public static function
		get_manage_external_videos_admin_page_url()
	{
		return self
			::get_oo_page_url(
                'VideoLibrary_ManageExternalVideosAdminPage'
			);
	}

	public static function
        get_tags_page_url_for_external_video_library_id(
            $external_video_library_id
        )
	{
        $url = self::get_tags_page_url();
        $url->set_get_variable('external_video_library_id', $external_video_library_id);
        return $url;
	}

	public static function
		get_home_page_url()
    {
        $url = new HTMLTags_URL();
		$url->set_file('/');
		return $url;
	
		// return self
			// ::get_oo_page_url(
                // '/'
			// );
	}

	public static function
		get_add_external_video_admin_page_url()
	{
		return self
			::get_oo_page_url(
                'VideoLibrary_AddExternalVideoAdminPage'
			);
	}

	public static function
		get_tags_page_url()
	{
		return self
			::get_oo_page_url(
                'VideoLibrary_TagsPage'
			);
	}

	public static function
        get_admin_video_view_url(
            $video_id
        )
	{
		$get_variables = array(
			"id" => $video_id,
			"content" => 'view_video'
		);
		return self
			::get_oo_page_url(
				'VideoLibrary_ManageExternalVideosAdminPage',
				$get_variables
			);
	}


	public static function
        get_video_page_url(
            $video_id,
            $video_name = NULL
        )
	{
		$get_variables = array(
			"video_id" => $video_id
		);
        if ($video_name) {
            $get_variables['video_name'] = self::format_string_for_url($video_name);
        }
		return self
			::get_oo_page_url(
				self::get_video_page_class_name(),
				$get_variables
			);
	}

    public static function
        format_string_for_url($str)
    {
        $str = strtolower($str);
        $str = preg_replace('([^a-zA-Z\s])', '', $str);
        $str = preg_replace('(\s+)', '-', $str);
        // $str = rawurlencode($str);
        return $str;
    }

	public static function
        get_search_page_class_name()
    {
        $cmf = HaddockProjectOrganisation_ConfigManagerFactory::get_instance();
		$config_manager = 
			$cmf->get_config_manager('plug-ins', 'video-library');
		return $config_manager->get_search_page_class_name();
    }

	public static function
		get_search_page_url()
	{
		return self
			::get_oo_page_url(
				self::get_search_page_class_name()
			);
	}

	public static function
        get_search_page_url_for_external_video_library_id(
            $external_video_library_id
        )
	{
        $url = self::get_search_page_url();
        $url->set_get_variable('external_video_library_id', $external_video_library_id);
        return $url;
	}


	public static function
		get_external_video_library_url(
            $base_url,
			$library_id
		)
	{
		$base_url->set_get_variable("external_video_library_id", $library_id);
		return $base_url;
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
                if (isset($_GET['external_video_provider_id'])) {
                    $results_page_url->set_get_variable(
                        'external_video_provider_id',
                        $_GET['external_video_provider_id']
                    );
                }

                return $results_page_url;
        }
        	
	public static function
		get_oo_page_url(
			$page_class,
			$get_variables = NULL
		)
        {
                /**
                 * Copied from PublicHTML_URLHelper so I can use 
                 * the VideoLibrary_URL class
                 */
                $url = new VideoLibrary_URL();
                if (
                        PublicHTML_ServerCapabilitiesHelper
				::has_mod_rewrite()
		) {
			$url->set_file('/');
		} else {
			$url->set_file('/haddock/public-html/public-html/index.php');
		}
			
		$url->set_get_variable('oo-page');
		$url->set_get_variable('page-class', $page_class);
		
		if (isset($get_variables)) {
			foreach ($get_variables as $k => $v) {
				$url->set_get_variable($k, urlencode($v));
			}
		}
		
		return $url;
        }
}
?>
