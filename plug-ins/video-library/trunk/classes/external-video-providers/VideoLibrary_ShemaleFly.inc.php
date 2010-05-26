<?php
/**
 * VideoLibrary_ShemaleFly
 *
 * @copyright 2009-01-10, SANH
 */

class
VideoLibrary_ShemaleFly
extends
VideoLibrary_ExternalVideoProvider
{
    public function
        get_video_embed_code()
    {
        //$internal_id = $this->get_providers_internal_id();

        return <<<HTML
<embed src='http://shemalefly/player.swf' height='%video_height' width='%video_width' allowscriptaccess='always' allowfullscreen='true' flashvars='config=http%3A%2F%2Fshemalefly%2Fvid_config.php%3Fid%3D%video_id'/>
HTML;

    }

    public function
        get_video_dimensions_ratio()
    {
        return array(1.376443418,1);
    }


    public function
        get_video_page_url_schema()
    {
        return 'http://shemalefly.com/videos/-%this_is_a_different_video_id.html';
    }

    public function
        get_thumbnail_urls()
    {
        $urls = array();
        for ($i = 0; $i <= 8; $i++) {
            $urls[] = $this->extract_thumbnail_url_from_video_page_url($i);
        }
        return $urls;
    }

    public function
        extract_thumbnail_url_from_video_page_url($frame_no)
    {
        /* The thumbnail link works by formatting the id like this:
         * full_shemale_horny_shemale =>
         * http://media.shemalefly.com/thumbs/full_shemale_horny_shemale.flv-0.jpg
         */
        $thumb_schema = 'http://media.shemalefly.com/thumbs/%video_id.flv-' . $frame_no . '.jpg';
        $id = $this->get_providers_internal_id();
        $thumb_url = str_replace(
            '%video_id',
            $id,
            $thumb_schema
        );
        // print_r($thumb_url);exit;
        return $thumb_url;
    }

}
?>
