<?php
/**
 * VideoLibrary_TrannyTube
 *
 * @copyright 2009-01-10, SANH
 */

class
VideoLibrary_TrannyTube
extends
VideoLibrary_ExternalVideoProvider
{
    public function
        get_video_embed_code()
    {
        //$internal_id = $this->get_providers_internal_id();

        return <<<HTML
<script type="text/javascript" src="http://www.trannytube.net/stp/embed.php?video=%video_id.default.mp4&url=http://www.trannytube.net/video/teen-asian-shemale-s0uP93ad83z.html&wm=0"></script>

HTML;


    }

    public function
        get_video_dimensions_ratio()
    {
        return array(1,1);
    }


    public function
        get_video_page_url_schema()
    {
        return 'http://www.trannytube.net/video/x-%only_thelast_part_of_the_id.html';
    }

    public function
        get_thumbnail_urls()
    {
        $video_codes = $this->extract_codes_from_video_id(
            $this->get_providers_internal_id()
        );
        $urls = array();
        for ($i = 1; $i <= 20; $i++) {
            $urls[] = $this->create_thumbnail_url($i, $video_codes);
        }
        return $urls;
    }

    public function
        extract_codes_from_video_id($id)
    {
        /*
         * ID looks like:
         * 0936.8645.s0uP93ad83
         * we need to return
         * array(0936,8645)
         */
        preg_match('/([^\.]+)\.([^\.]+)\.[^\.]/', $id, $matches);
        // print_r($id);
        // print_r($matches);exit;

        return array($matches[1], $matches[2]);
    }
        
    public function
        create_thumbnail_url(
            $frame_no,
            $video_codes  // array()
        )
    {
        /* The thumbnail link works by formatting the codes like this:
         * 0936,8645 =>
         * http://www.trannytube.net/images/videos/0936/8645/2.jpg
         * BUT DO THEY NEED LEADING SPACES?? -- dunno yet
         */
        $thumb_url = 'http://www.trannytube.net/images/videos/' 
            . $video_codes[0] . '/' 
            . $video_codes[1] . '/' . $frame_no . '.jpg';
        // print_r($thumb_url);exit;
        return $thumb_url;
    }
}
?>
