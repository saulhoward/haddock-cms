<?php
/**
 * VideoLibrary_YouTube
 *
 * @copyright 2009-01-10, SANH
 */

class
VideoLibrary_YouTube
extends
VideoLibrary_ExternalVideoProvider
{
	public function
		get_video_embed_code()
	{
		//$internal_id = $this->get_providers_internal_id();

		return <<<HTML
<object width="%video_width" height="%video_height"><param name="movie" value="http://www.youtube.com/v/%video_id&fs=1&color1=0x5d1719&color2=0xcd311b"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/%video_id&fs=1&color1=0x5d1719&color2=0xcd311b" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="%video_width" height="%video_height"></embed></object>

HTML;

	}

    public function
        get_video_dimensions_ratio()
    {
        return array(1.2,1);
    }

    public function
        get_thumbnail_urls()
    {
        // So far just getting one thumb from YouTube
        $urls = array();
        $urls[] = $this->create_thumbnail_url_from_provider_id();
        return $urls;
    }

    public function
        create_thumbnail_url_from_provider_id()
    {
        $thumb_schema = 'http://i4.ytimg.com/vi/%video_id/default.jpg';
        $thumb_url = str_replace(
            '%video_id',
            $this->get_providers_internal_id(),
            $thumb_schema
        );

        // print_r($thumb_url);exit;
        return $thumb_url;
    }
}
?>
