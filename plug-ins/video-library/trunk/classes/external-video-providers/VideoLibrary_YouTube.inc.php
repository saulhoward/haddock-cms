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
<object width="425" height="344"><param name="movie" value="http://www.youtube.com/v/%video_id"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/%video_id" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="425" height="344"></embed></object>

HTML;

	}

    public function
        get_thumbnail_urls()
    {
    }
}
?>
