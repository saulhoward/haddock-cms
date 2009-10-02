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
		$a->set_href(VideoLibrary_URLHelper::get_video_page_url($video_data['id']));
		$a->append(self::get_thumbnail_img($video_data['thumbnail_url']));;
		$div->append($a);
		return $div;
	}

	public static function
		get_thumbnail_img($url)
	{
		$img = new HTMLTags_IMG();
		if ($url == NULL) {
			$src = VideoLibrary_URLHelper
				::get_default_thumbnail_url();
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
		$video_data = VideoLibrary_DatabaseHelper
			::get_external_video_data($id);
		//print_r($video_data);exit;

		$html = '';
		$html .= '<div id="video">';
		$html .= VideoLibrary_EmbedHelper
			::get_video_embed_code_for_external_video($video_data);
		$html .= '</div>';

		return $html;
	}

	public static function
		get_external_video_provider_navigation_div($providers)
	{
		$div = new HTMLTags_Div();
		$div->set_attribute_str('id', 'providers');
		$ul = new HTMLTags_UL();
		foreach ($providers as $provider) {
			$li = new HTMLTags_LI();
			$a = new HTMLTags_A();
			$a->set_href(
				VideoLibrary_URLHelper
				::get_external_video_provider_search_page_url(
					$provider['id']
				)
			);
			$a->append($provider['name']);
			$li->append($a);
			$ul->append($li);
		}
		$div->append($ul);
		return $div;
	}

}
?>
