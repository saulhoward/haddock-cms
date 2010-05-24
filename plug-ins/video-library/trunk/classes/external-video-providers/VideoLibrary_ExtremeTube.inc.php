<?php
/**
 * VideoLibrary_XVideos
 *
 * @copyright 2009-01-10, SANH
 */

class
VideoLibrary_ExtremeTube
extends
VideoLibrary_ExternalVideoProvider
{
    public function
        get_video_embed_code()
    {
        //$internal_id = $this->get_providers_internal_id();

        return <<<HTML
<object type="application/x-shockwave-flash" data="http://cdn-www.extremetube.com/flash/player_embed.swf" width="%video_width" height="%video_height"><param name="movie" value="http://cdn-www.extremetube.com/flash/player_embed.swf" /><param name="bgColor" value="#000000" /><param name="allowfullscreen" value="true" /><param name="allowScriptAccess" value="always" /><param name="FlashVars" value="options=http://www.extremetube.com/embed_player.php?id=%video_id"/></object>
HTML;

    }

    public function
        get_video_dimensions_ratio()
    {
        return array(1.277310924,1);
    }


    public function
        get_video_page_url_schema()
    {
        return 'http://www.extremetube.com/video/%video_id';
    }

    public function
        get_thumbnail_urls()
    {
        $urls = array();
        for ($i = 1; $i <= 16; $i++) {
            $urls[] = $this->extract_thumbnail_url_from_video_page_url($i);
        }
        return $urls;
    }

    public function
        extract_thumbnail_url_from_video_page_url($frame_no)
    {
        /* The thumbnail link works by formatting the id like this:
         * 404 => 000/000/404
         * 1699 => 000/001/699
         */
        $thumb_schema = 'http://pics1.extremetube.com/thumbs/%formatted_id/240x180/' . $frame_no . '.jpg';
        $id = $this->get_providers_internal_id();

        $id = sprintf("%09.9s", $id);                // 9 chars, padded with 0s

        $id_mod = '';
        $l = strlen($id);
        for ($i = 0; $i < $l; $i++) { 
            $id_mod = substr($id, $i, 1) . $id_mod;
            if (($i + 1) % 3 == 0) {
                $id_mod = '/' . $id_mod;
            }
        }
        $id_mod = substr($id_mod, 1);
        $id_mod = strrev($id_mod);

        // print_r($id . "\n");
        // print_r($id_mod);exit;

        $thumb_url = str_replace(
            '%formatted_id',
            $id_mod,
            $thumb_schema
        );
        // print_r($thumb_url);exit;
        return $thumb_url;
    }

}
?>
