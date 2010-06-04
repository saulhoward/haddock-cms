<?php
/**
 * VideoLibrary_PornOxo
 *
 * @copyright 2009-01-10, SANH
 */

class
VideoLibrary_PornOxo
extends
VideoLibrary_ExternalVideoProvider
{
    public function
        get_video_embed_code()
    {
        //$internal_id = $this->get_providers_internal_id();

        return <<<HTML

 <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" id="player" name="player" width="%video_width" height="%video_height"><param name="movie" value="http://213.174.142.210/xplayer-v3.0.swf" /><param name="allowfullscreen" value="true" /><param name="allowscriptaccess" value="always" /><param name="quality" value="high" /><param name="wmode" value="transparent" /><param name="flashvars" value="config=http://www.pornoxo.com/embed/embed-flashvars-v2.php?m=%video_id" /><embed type="application/x-shockwave-flash" id="player" name="player" src="http://213.174.142.210/xplayer-v3.0.swf" width="%video_width" height="%video_height" allowscriptaccess="always" allowfullscreen="true" wmode="transparent" flashvars="config=http://www.pornoxo.com/embed/embed-flashvars-v2.php?m=%video_id" /></object>

HTML;


    }

    public function
        get_video_dimensions_ratio()
    {
        return array(1.28,1.02);
    }


    public function
        get_video_page_url_schema()
    {
        return 'http://www.pornoxo.com/videos/%video_id/x.html';
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
        $first_part_id = $this->extract_first_part_of_id($this->get_providers_internal_id());
        $thumbnail_loc_url = $this->extract_thumbnail_location_url_from_video_page(
                $video_page_html,
                $first_part_id
            );

        $urls = array();
        for ($i = 1; $i <= 15; $i++) {
            $urls[] = $this->create_thumbnail_url_from_thumbnail_loc_url(
                $thumbnail_loc_url, $i
            );
        }
        return $urls;
    }

    public function
        extract_first_part_of_id(
            $id
        )
    {
        /*
         * Given an id like:
         * 19077-50292
         * We just want:
         * 19077
         */
        preg_match('/^([0-9]+)-[0-9]+/', $id, $matches);
        // print_r($matches[1]);exit;

        return $matches[1];
    }

    public function
        extract_thumbnail_location_url_from_video_page(
            $video_page_html,
            $video_id_first_part
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
         * <div class="thumb"><a href="/videos/3283/busty-chick-fucking-in-the-car.html" style="margin:0px; padding:0px;" target="_self"> <img src="
         */
        preg_match('/<div class="thumb"><a href="\/videos\/' . $video_id_first_part .  '\/.+<img src="([^"]+)"/', $player_div_str, $matches);
        // print_r($matches[1]);exit;

        /* Now we have:
         * 
         * http://213.174.142.210/thumbs/2010-01/4b42643fb6f96b845b23e2bbe6320509551d266b425c3.flv/a4b42643fb6f96b845b23e2bbe6320509551d266b425c3.flv-160x120-15.jpg
         * So take off the -frameno.jpg
         */
 
        preg_match('/^(.+)-[0-9]+\.jpg/', $matches[1], $matches_2);
        // print_r($matches[1]);exit;

        return $matches_2[1];
    }

    public function
        create_thumbnail_url_from_thumbnail_loc_url($thumbnail_loc_url, $frame_no)
    {
        /* The thumbnail loc url looks like:
         * 
         * http://213.174.142.210/thumbs/2010-01/4b42643fb6f96b845b23e2bbe6320509551d266b425c3.flv/a4b42643fb6f96b845b23e2bbe6320509551d266b425c3.flv-160x120 
         * We need to add the:
         * -15.jpg
         */
        // print_r($id . "\n");
        // print_r($id_mod);exit;
        $thumb_url = $thumbnail_loc_url . '-' . $frame_no . '.jpg';
        // print_r($thumb_url);exit;
        return $thumb_url;
    }

}
?>
