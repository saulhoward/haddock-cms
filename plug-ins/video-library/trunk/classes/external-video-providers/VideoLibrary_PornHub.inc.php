<?php
/**
 * VideoLibrary_PornHub
 *
 * @copyright 2009-01-10, SANH
 */

class
VideoLibrary_PornHub
extends
VideoLibrary_ExternalVideoProvider
{
	public function
		get_video_embed_code()
	{
		//$internal_id = $this->get_providers_internal_id();

		return <<<HTML

<object type="application/x-shockwave-flash" data="http://ph-static.phncdn.com/flash/embed_player_v1.3.swf" width="%video_width" height="%video_height"><param name="movie" value="http://ph-static.phncdn.com/flash/embed_player_v1.3.swf" /><param name="bgColor" value="#000000" /><param name="allowfullscreen" value="true" /><param name="allowScriptAccess" value="always" /><param name="FlashVars" value="options=http://www.pornhub.com/embed_player.php?id=160676"/></object><br /><a href="http://www.pornhub.com/view_video.php?viewkey=d1378e75ec5d326ddd3c">Hot asian slave Christina Aguchi ravaged hardcore!</a> brought to you by <a href="http://www.pornhub.com/">PornHub</a> %video_id

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
        return 'http://www.pornhub.com/view_video.php?viewkey=%video_id';
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

        $urls = array();
        // for ($i = 1; $i == 16; $i++) {
        // }

        $urls[] = $this->create_thumbnail_url_from_thumbnail_id(
            $this->extract_thumbnail_code_from_video_page(
                $video_page_html
            )
        );
        return $urls;
    }

    public function
        extract_thumbnail_code_from_video_page(
            $video_page_html
        )
    {
        // print_r($video_page_html);exit;

        $dom = new DOMDocument();
        $doc->validateOnParse = true;
        @$dom->loadHTML($video_page_html);

        /**
         * We're looking for the <div class=flag-box> element
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
        preg_match('/var flagger_video_([0-9]+);/', $player_div_str, $matches);
        // print_r($matches[1]);exit;

        return $matches[1];
    }

    public function
        create_thumbnail_url_from_thumbnail_id($id)
    {
        /* The thumbnail link works by formatting the id like this:
         * 404 => 000/000/404
         * 1699 => 000/001/699
         */
        $thumb_schema = 'http://ph-pics.phncdn.com/thumbs/%formatted_id/large.jpg';

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
