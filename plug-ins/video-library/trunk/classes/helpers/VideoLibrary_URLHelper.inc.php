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
			= VideoLibrary_PagesHelper::get_video_page_class_name();
		$get_variables = array(
                        "video_id" => $video_id
                );
                return PublicHTML_URLHelper
                        ::get_oo_page_url('DirtyDodo_VideoPage', $get_variables);
	}
}
?>
