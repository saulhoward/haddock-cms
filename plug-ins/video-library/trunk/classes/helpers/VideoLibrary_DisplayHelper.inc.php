<?php
/**
 * VideoLibrary_DisplayHelper
 *
 * @copyright 2009-01-10, SANH
 */

class
VideoLibrary_DisplayHelper
{
	public static function
		get_thumbnails_div(
			//$tag_ids
			)
	{
		$div = new HTMLTags_Div();
		$div->set_attribute_str('id', 'thumbnails');

		$limit = 16;
		$videos = VideoLibrary_DatabaseHelper::get_external_videos_data($limit);
		//print_r($videos);exit;

		if (count($videos) >= 1) {
			$div->append('<ul>');
			foreach ($videos as $video) {
				$div->append('<li>');
				$div->append(self::get_thumbnail_div_for_video($video));
				$div->append('</li>');
			}
			$div->append('</ul>');
		}

		return $div;
	}

	public static function
		get_thumbnail_div_for_video($video_data)
	{
		$div = new HTMLTags_Div();
		$div->set_attribute_str('id', 'video');

		$a = new HTMLTags_A();
		$a->set_href(self::get_video_page_url($video_data['id']));
		$a->append(self::get_thumbnail_img($video_data['thumbnail_url']));;
		$div->append($a);
		return $div;
	}

	public static function
		get_thumbnail_img($url)
	{
		$img = new HTMLTags_IMG();
		if ($url == NULL) {
			$src = self::get_default_thumbnail_url();
		} else {
			$src = new HTMLTags_URL();
			$src->set_file($url);
		}
		$img->set_src($src);
		return $img;
	}

	public static function
		get_video_div_for_external_video_id($id)
	{
		$video_data = VideoLibrary_DatabaseHelper::get_external_video_data($id);
		//print_r($video_data);exit;

		$html = '';
		$html .= '<div id="video">';
		$html .= self::get_video_embed_code_for_external_video($video_data);
		$html .= '</div>';

		return $html;
	}

	public static function
		get_video_embed_code_for_external_video($video_data)
	{
		/**
		 * Creates an instance of the provider class named in the video data,
		 * passes it the internal id and gets back the correct embed code
		 */
		$provider_class_str = trim($video_data['haddock_class_name']);
		$instance = new $provider_class_str();
		$instance->set_providers_internal_id($video_data['providers_internal_id']);
		return $instance->get_video_embed_code();
	}

	/*
	 * URLs
	 */
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
		$get_variables = array(
                        "video_id" => $video_id
                );
                return PublicHTML_URLHelper
                        ::get_oo_page_url('DirtyDodo_VideoPage', $get_variables);
	}
}
?>
