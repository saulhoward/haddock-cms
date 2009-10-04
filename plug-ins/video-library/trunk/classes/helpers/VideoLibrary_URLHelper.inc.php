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
		$url = new HTMLTags_URL();
		$url->set_file('/images/video-library/default-thumbnail.png');
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
		$video_page_class_name 
			= VideoLibrary_PagesHelper
			::get_video_page_class_name();
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
		get_external_video_library_search_page_url(
			$library_id
		)
	{
		$search_page_class_name 
			= VideoLibrary_PagesHelper
			::get_search_page_class_name();
		$get_variables = array(
			"external_video_library_id" => $library_id
		);
		return PublicHTML_URLHelper
			::get_oo_page_url(
				$search_page_class_name,
				$get_variables
			);
	}
	public static function
		get_external_video_provider_search_page_url(
			$provider_id
		)
	{
		$search_page_class_name 
			= VideoLibrary_PagesHelper
			::get_search_page_class_name();
		$get_variables = array(
			"external_video_provider_id" => $provider_id
		);
		if (isset($_GET['external_video_library_id'])) {
			$get_variables['external_video_library_id'] 
				= $_GET['external_video_library_id'];
		}
		return PublicHTML_URLHelper
			::get_oo_page_url(
				$search_page_class_name,
				$get_variables
			);
	}

	public static function
		get_tags_search_page_url_for_tag_id(
			$tag_id,
			$external_video_library_id
		)
	{
		$search_page_class_name 
			= VideoLibrary_PagesHelper
			::get_search_page_class_name();
		$get_variables = array(
			"tag_ids" => $tag_id,
			"external_video_library_id" => $external_video_library_id
		);
	
		return PublicHTML_URLHelper
			::get_oo_page_url(
				$search_page_class_name,
				$get_variables
			);
	}

	public static function
		get_tags_search_page_url(
			$tag_ids,
			$external_video_library_id
		)
	{
		$search_page_class_name 
			= VideoLibrary_PagesHelper
			::get_search_page_class_name();
		$get_variables = array(
			"tag_ids" => implode(',', $tag_ids),
			"external_video_library_id" => $external_video_library_id
		);
	
		return PublicHTML_URLHelper
			::get_oo_page_url(
				$search_page_class_name,
				$get_variables
			);
	}
}
?>
