<?php
/**
 * VideoLibrary_PornRabbit
 *
 * @copyright 2009-01-10, SANH
 */

class
VideoLibrary_PornRabbit
extends
VideoLibrary_ExternalVideoProvider
{
	public function
		get_video_embed_code()
	{
		//$internal_id = $this->get_providers_internal_id();

		return <<<HTML
<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" height="%video_heightpx" width="%video_widthpx" id="embedpornrabbit"><param name="movie" value="http://embed.pornrabbit.com/player.swf"><param name="FlashVars" value="movie_id=%video_id"><param name="AllowScriptAccess" value="always"><embed src="http://embed.pornrabbit.com/player.swf?movie_id=%video_id" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" height="%video_heightpx" width="%video_widthpx" AllowScriptAccess="always"></object>

HTML;

	}

    public function
        get_video_dimensions_ratio()
    {
        return array(1.28,0.763387387);
    }

    public function
        get_video_page_url_schema()
    {
        return 'http://www.pornrabbit.com/%video_id/x.html';
    }

    public function
        get_thumbnail_urls()
    {
        // print_r($this->get_video_page_url());exit;
        $video_page_html =
            VideoLibrary_CLIScriptsHelper
            ::download_html_page(
                $this->get_video_page_url()
            );
        $thumbnail_loc_url = $this->extract_thumbnail_location_url_from_video_page(
                $video_page_html
            );

        $urls = array();
        for ($i = 1; $i <= 8; $i++) {
            $urls[] = $this->create_thumbnail_url_from_thumbnail_loc_url(
                $thumbnail_loc_url, $i
            );
        }
        return $urls;
    }

    public function
        extract_thumbnail_location_url_from_video_page(
            $video_page_html
        )
    {
        // print_r($video_page_html);exit;

        $dom = new DOMDocument();
        $doc->validateOnParse = true;
        @$dom->loadHTML($video_page_html);

        /**
         * We're looking for the <div class=videoinfomiddle> element
         * but its not an ID , so I'll try the whole goddam page and go 
         * for the js var declaration
         */
        $bodies = $dom->getElementsByTagName('body');
        if ($bodies){
            foreach ($bodies as $body) {
                $player_div_str = $body->ownerDocument->saveXML($body);
            }
        } else {
            throw new VideoLibrary_Exception("body element not found");
        }
        // print_r($player_div_str);exit;

        /**
         * And now we want the string between
         * var flagger_video_...;
         */
        preg_match('/&image=(.+)player.jpg/', $player_div_str, $matches);
        // print_r($matches[1]);exit;

        return $matches[1];
    }

    public function
        create_thumbnail_url_from_thumbnail_loc_url($thumbnail_loc_url, $frame_no)
    {
        /* The thumbnail link works by formatting the id like this:
         * 
         *  http://thumb1.pornrabbit.com/3/2/32681/2_medium.jpg
         */
        // print_r($id . "\n");
        // print_r($id_mod);exit;

        $thumb_url = $thumbnail_loc_url . $frame_no . '_medium.jpg';
        // print_r($thumb_url);exit;
        return $thumb_url;
    }



}
?>
