<?php
/**
 * VideoLibrary_RedTube
 *
 * @copyright 2009-01-10, SANH
 */

class
VideoLibrary_RedTube
extends
VideoLibrary_ExternalVideoProvider
{
	public function
		get_video_embed_code()
	{
		return <<<HTML
<object height="%video_height" width="%video_width">
        <param name="movie" value="http://embed.redtube.com/player/">
        <param name="FlashVars" value="id=%video_id&style=redtube&autostart=false">
        <embed src="http://embed.redtube.com/player/?id=%video_id&style=redtube"
        flashvars="autostart=false"
        pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" 
        type="application/x-shockwave-flash" height="%video_height" width="%video_width" />
    </object>

HTML;

	}


    public function
        get_video_dimensions_ratio()
    {
        return array(1.261627907,1);
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
        /**
         * Simple Transform on the ID
         * 24783 -> http://thumbs.redtube.com/_thumbs/0000024/0024783/0024783_001.jpg
         * 8259  -> http://thumbs.redtube.com/_thumbs/0000008/0008259/0008259_001.jpg
         *
         */
        $frame_no = sprintf('%03d', $frame_no);

        $thumb_schema = 'http://thumbs.redtube.com/_thumbs/%formatted_id_' . $frame_no . '.jpg';
        $id = $this->get_providers_internal_id();

        $id_2 = sprintf("%07.7s", $id);                // 7 chars, padded with 0s

        $id_1 = substr($id_2, 0, 4);
        // print_r($id_1);exit;
        $id_1 = sprintf("%07.7s", $id_1);                // 7 chars, padded with 0s

        $id_mod = $id_1 . '/' . $id_2 . '/' . $id_2;

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
