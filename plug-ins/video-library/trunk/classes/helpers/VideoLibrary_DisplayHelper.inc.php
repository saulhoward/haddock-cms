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
			$videos
			)
	{
		$div = new HTMLTags_Div();
		$div->set_attribute_str('id', 'thumbnails');

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

		$url = VideoLibrary_URLHelper::get_video_page_url($video_data['id']);

		$img_a = new HTMLTags_A();
		$img_a->set_href($url);
		$img_a->append(self::get_thumbnail_img($video_data['thumbnail_url']));;

		$text_a = new HTMLTags_A();
$text_a->set_attribute_str('class', 'text');
		$text_a->set_href($url);
		$text_a->append($video_data['name']);

		$div->append($img_a);
		$div->append($text_a);
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
		get_external_video_search_div()
	{
		$div = new HTMLTags_Div();
		$div->set_attribute_str('class', 'search');
$html = <<<HTML
<form>
<input text="text" value="search..."  name="qt" > 
</form>

HTML;

$div->append($html);
		return $div;
	}

	public static function
		get_external_video_provider_navigation_div($providers)
	{
		$div = new HTMLTags_Div();
		$div->set_attribute_str('class', 'providers');
		$ul = new HTMLTags_UL();
		foreach ($providers as $provider) {
			$li = new HTMLTags_LI();
			if (
				(isset($_GET['external_video_provider_id']))
				&&
				($_GET['external_video_provider_id'] == $provider['id'])
			) {
				$li->set_attribute_str('class', 'selected');
			}
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

	public static function
		get_external_video_libraries_navigation_div($libraries)
	{
		$div = new HTMLTags_Div();
		$div->set_attribute_str('class', 'libraries');
		$ul = new HTMLTags_UL();
		foreach ($libraries as $library) {
			$li = new HTMLTags_LI();
			if (
				(isset($_GET['external_video_library_id']))
				&&
				($_GET['external_video_library_id'] == $library['id'])
			) {
				$li->set_attribute_str('class', 'selected');
			}
			$a = new HTMLTags_A();
			$a->set_href(
				VideoLibrary_URLHelper
				::get_external_video_library_search_page_url(
					$library['id']
				)
			);
			$a->append($library['name']);
			$li->append($a);
			$ul->append($li);
		}
		$div->append($ul);
		return $div;
	}

	public static function
		get_tags_navigation_div($tags)
	{
		$div = new HTMLTags_Div();
		$div->set_attribute_str('class', 'tags');
		$ul = new HTMLTags_UL();
		foreach ($tags as $tag) {
			$li = new HTMLTags_LI();
			if (
				(isset($_GET['tag_ids']))
				&&
				(in_array($tag['id'], explode(',', $_GET['tag_ids'])))
			) {
				$li->set_attribute_str('class', 'selected');
			}
			$a = new HTMLTags_A();
			$tags_array = array();
			$tags_array[] = $tag['id'];
			$a->set_href(
				VideoLibrary_URLHelper
				::get_tags_search_page_url(
					$tags_array
				)
			);
			$a->append($tag['tag']);
			$li->append($a);
			$ul->append($li);
		}
		$div->append($ul);
		return $div;
	}
}
?>
