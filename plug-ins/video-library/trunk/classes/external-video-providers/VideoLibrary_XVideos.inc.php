<?php
/**
 * VideoLibrary_XVideos
 *
 * @copyright 2009-01-10, SANH
 */

class
VideoLibrary_XVideos
extends
VideoLibrary_ExternalVideoProvider
{
    public function
        get_video_embed_code()
    {
        //$internal_id = $this->get_providers_internal_id();

        return <<<HTML
<object width="%video_width" height="%video_height" classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" ><param name="quality" value="high" /><param name="bgcolor" value="#000000" /><param name="allowScriptAccess" value="always" /><param name="movie" value="http://static.xvideos.com/swf/flv_player_site_v4.swf" /><param name="allowFullScreen" value="true" />
<param name="flashvars" value="id_video=%video_id" />
<embed src="http://static.xvideos.com/swf/flv_player_site_v4.swf" allowscriptaccess="always" width="%video_width" height="%video_height" menu="false" quality="high" bgcolor="#000000" allowfullscreen="true" 
flashvars="id_video=%video_id" 
type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object>

HTML;

    }

    public function
        get_video_dimensions_ratio()
    {
        return array(1.275,1);
    }

    public function
        get_video_page_url_schema()
    {
        return 'http://www.xvideos.com/video%video_id/';
    }

    public function
        get_thumbnail_urls()
    {
        $video_page_html =
            VideoLibrary_CLIScriptsHelper
            ::download_html_page(
                $this->get_video_page_url()
            );
        // print_r($this->get_video_page_url());exit;
        // print_r($video_page_html);exit;

        $url = $this->extract_thumbnail_url_from_video_page(
            $video_page_html
        );

        $urls = array();
        for ($i = 1; $i == 30; $i++) {
            $urls[] = $this->convert_url_to_frame_specific_url($url, $i);
        }
        return $urls;
    }

    public function
        convert_url_to_frame_specific_url(
            $url,
            $frame_no
        )
    {
        /**
         * The url will be in the form
         * http://img100.xvideos.com/videos/thumbslll/7/1/e/71e1bd885d0fe4a98e8fd32ba74013a6.30.jpg
         * The last number (30) is the frame no.
         */

        preg_replace('/\.([0-9]+)\.jpg$/', $frame_no, $url);
        return $url;
    }

    public function
        extract_thumbnail_url_from_video_page(
            $video_page_html
        )
    {
        // print_r($video_page_html);exit;

        $dom = new DOMDocument();
        $doc->validateOnParse = true;
        @$dom->loadHTML($video_page_html);

        /**
         * We're looking for the <div id=player> element
         */
        $player_div = $dom->getElementById('player');
        // print_r($player_div);exit;
        if ($player_div) {
            $player_div_str = $player_div->ownerDocument->saveXML($player_div);
        } else {
            throw new VideoLibrary_Exception("div with id 'player' not found");
        }
        //print_r($player_div_str);exit;

        /**
         * And now we want the string between
         * url_bigthumb=http://thumbs .... .jpg&amp;
         */
        preg_match('/url_bigthumb=([^&]*)&amp;/', $player_div_str, $matches);
        //print_r($matches[1]);exit;

        return $matches[1];
    }

}
?>
