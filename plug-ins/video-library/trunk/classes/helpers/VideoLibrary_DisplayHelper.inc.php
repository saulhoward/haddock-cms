<?php
/**
 * VideoLibrary_DisplayHelper
 *
 * @copyright 2009-01-10, SANH
 */

class
VideoLibrary_DisplayHelper
{
    public static function
        get_thumbnails_div(
            $videos
        )
    {
        $div = new HTMLTags_Div();
        $div->set_attribute_str('id', 'thumbnails');

        if (count($videos) >= 1) {
            $div->append('<ul>');
            foreach ($videos as $video) {
                $div->append('<li>');
                $div->append(self::get_thumbnail_div_for_video($video));
                $div->append('</li>');
            }
            $div->append('</ul>');
        }

        return $div;
    }

    public static function
        get_admin_view_tag_div($videos)
    {
        return self::get_thumbnails_div($videos);
    }

    public static function
        get_admin_view_library_div($videos)
    {
        return self::get_thumbnails_div($videos);
    }

    public static function
        get_thumbnail_div_for_tag($tag, $external_video_library_id)
    {
        $div = new HTMLTags_Div();
        $div->set_attribute_str('class', 'tag');

        $url = VideoLibrary_URLHelper::
            get_tags_search_page_url_for_tag_id(
                $tag['id'], $external_video_library_id
            );

        $img_a = new HTMLTags_A();
        $img_a->set_href($url);
        $img_a->append(self::get_thumbnail_img_for_tag($tag['tag'], $external_video_library_id));

        $text_a = new HTMLTags_A();
        $text_a->set_attribute_str('class', 'text');
        $text_a->set_href($url);
        $text_a->append(ucwords($tag['tag']));

        $div->append($img_a);
        $div->append($text_a);
        return $div;
    }

    public static function 
        truncate_video_name(
            $string,
            $limit,
            $break=" ",
            $pad='&hellip;'
        ) 
    { 
        // This function
        // Original PHP code by Chirp Internet: www.chirp.com.au 
        // Please acknowledge use of this code by including this header. 

        // return with no change if string is shorter than $limit  
        if(strlen($string) <= $limit) return $string;

        $string = substr($string, 0, $limit);
        if(false !== ($breakpoint = strrpos($string, $break))) {
            $string = substr($string, 0, $breakpoint);
        } 
        return $string . $pad;
    }

    public static function
        get_thumbnail_div_for_video($video_data)
    {
        $div = new HTMLTags_Div();
        $div->set_attribute_str('class', 'video');

        $url = VideoLibrary_URLHelper::get_video_page_url($video_data['id'], $video_data['name']);

        $img_a = new HTMLTags_A();
        $img_a->set_href($url);
        $img_a->append(self::get_thumbnail_img($video_data['thumbnail_url']));;

        $details_ul = new HTMLTags_UL();
        $details_ul->set_attribute_str('class', 'details');

        $name_a = new HTMLTags_A();
        $name_a->set_attribute_str('class', 'text');
        $name_a->set_href($url);
        $name_a->set_attribute_str('title', stripslashes($video_data['name']));
        $name_a->append(self::truncate_video_name(stripslashes($video_data['name']), 50));
        $name_li = new HTMLTags_LI();
        $name_li->set_attribute_str('class', 'name');
        $name_li->append($name_a);

        $details_ul->append($name_li);

        $length_min = self::get_minutes_from_seconds($video_data['length_seconds']);
        $details_ul->append('<li class="length">' . $length_min . ' min</li>');

        $provider_li = new HTMLTags_LI();
        $provider_li->set_attribute_str('class', 'provider');
        $provider_li->append(
            self::get_img_for_external_provider_name($video_data['external_video_provider_name'], 16)
        );
        $details_ul->append($provider_li);

        $div->append($img_a);
        $div->append($details_ul);
        return $div;
    }

    public static function
        get_thumbnail_img_for_tag($tag, $external_video_library_id)
    {
        return self::get_img_for_tag_name($tag, 'thumbnails/' . $external_video_library_id);
    }

    public static function
        get_thumbnail_img($url)
    {
        $img = new HTMLTags_IMG();
        if ($url == NULL) {
            $src = VideoLibrary_URLHelper
                ::get_default_thumbnail_url();
        } else {
            $src = new HTMLTags_URL();
            $src->set_file($url);
        }
        $img->set_src($src);
        return $img;
    }


    public static function
        get_admin_view_video_div($video_data)
    {
        $div = new HTMLTags_Div();
        $div->set_attribute_str('id', 'admin-video');
        $div->append('<h2>External Video Preview</h2>');
        $div->append(self::get_video_div_for_external_video_data($video_data));
        $div->append('<br /><br /><br />');
        return $div;
    }

    public static function 
        get_minutes_from_seconds($seconds)
    {
        return sprintf( "%02.2d:%02.2d", floor( $seconds / 60 ), $seconds % 60 );
    }


    public static function
        get_video_div_for_external_video_data($video_data)
    {
        //print_r($video_data);exit;
        $div = new HTMLTags_Div();
        $div->set_attribute_str('id', 'video');

        $name_div = new HTMLTags_Div();
        $name_div->set_attribute_str('id', 'name');
        $name_div->append('<h2>' . stripslashes($video_data['name']) . '</h2>');	
        $div->append($name_div);

        /*
         *Embed Code
         */
        $embed_div = new HTMLTags_Div();
        $embed_div->set_attribute_str('id', 'embed');
        $embed_div->append(
            VideoLibrary_EmbedHelper
            ::get_video_embed_code_for_external_video($video_data)
        );
        $div->append($embed_div);
        return $div;
    }

    public static function
        get_video_info_div_for_external_video_data($video_data)
    {
        /*
         *Info
         */
        $info_div = new HTMLTags_Div();
        $info_div->set_attribute_str('id', 'info');

        $length_min = self::get_minutes_from_seconds($video_data['length_seconds']);
        $tags = self::get_tags_links_string(
            $video_data['tags'],
            $video_data['external_video_library_id']
        );
        $info_dl = <<<HTML
<dl>
        <dt>Length:</dt>
                <dd>$length_min min</dd>

        <dt>Tags:</dt>
                <dd class="tags">$tags</dd>
</dl>
HTML;

        $info_div->append($info_dl);

        return $info_div;
    }

    public static function
        get_tags_csv_string(
            $tags
        )
    {
        //print_r($tags);exit;
        $html = '';
        $i = 0;
        foreach ($tags as $tag) {
            if ($i != 0) {
                $html .= ', ';
            }
            $i++;
            $html .= $tag['tag'];
        }
        return $html;
    }

    public static function
        get_tags_links_string(
            $tags,
            $external_video_library_id
        )
    {
        $html = '';
        $i = 0;
        foreach ($tags as $tag) {
            if ($i != 0) {
                $html .= ', ';
            }
            $i++;
            $html .= '<a href="' 
                . VideoLibrary_URLHelper
                ::get_tags_search_page_url_for_tag_id(
                    $tag['id'],
                    $external_video_library_id
                )->get_as_string()
                . '">' . $tag['tag']
                . '</a>';
        }
        return $html;
    }

    public static function
        get_external_video_search_div(
            $external_video_library_id,
            $search_query = NULL
        )
    {
        if ($search_query == NULL) {
            $search_query = '';
        }
        $div = new HTMLTags_Div();
        $div->set_attribute_str('class', 'search');
        $html = <<<HTML
    <form action="/search/"
          method="get"
          class="search-form"
          >
        <fieldset class="search">
            <input class="search box" type="text" name="q" value="$search_query">
            <!--<input type="submit" value="Go">-->
            <button class="btn" type="submit" title="Submit Search">Go!</button>
HTML;

        $html .= '<input type="hidden" name="external_video_library_id" value="'
            . $external_video_library_id .'">' . "\n";
        $html .= <<<HTML
        </fieldset>
    </form>

HTML;

        $div->append($html);
        return $div;
    }

    public static function
        get_external_video_provider_navigation_div(
            $providers,
            $results_page_url
        )
    {
        $div = new HTMLTags_Div();
        $div->set_attribute_str('class', 'providers');
        $ul = new HTMLTags_UL();

        $all_li = new HTMLTags_LI();
        if ( !isset($_GET['external_video_provider_id'])) {
            $all_li->set_attribute_str('class', 'selected');
        }
        $all_a = new HTMLTags_A('All');

        $href = $results_page_url;
        if (isset($_GET['tag_ids'])) {
            $href->set_get_variable(
                'tag_ids',
                $_GET['tag_ids']
            );
        }
        if (isset($_GET['external_video_library_id'])) {
            $href->set_get_variable(
                "external_video_library_id", 
                $_GET['external_video_library_id']
            );
        }

        $all_a->set_href($href);
        $all_li->append($all_a);

        $ul->append($all_li);

        foreach ($providers as $provider) {
            $li = new HTMLTags_LI();
            if (
                (isset($_GET['external_video_provider_id']))
                &&
                ($_GET['external_video_provider_id'] == $provider['id'])
            ) {
                $li->set_attribute_str('class', 'selected');
            }
            $a = new HTMLTags_A();
            $href = $results_page_url;
            $href->set_get_variable(
                'external_video_provider_id',
                $provider['id']
            );

            if (isset($_GET['tag_ids'])) {
                $href->set_get_variable(
                    'tag_ids',
                    $_GET['tag_ids']
                );
            } 
            if (isset($_GET['external_video_library_id'])) {
                $href->set_get_variable(
                    "external_video_library_id", 
                    $_GET['external_video_library_id']
                );
            }

            $a->set_href($href);
            $a->append($provider['name']);
            $li->append($a);
            $ul->append($li);
        }
        $div->append($ul);
        return $div;
    }

    public static function
        get_external_video_libraries_navigation_div(
            $libraries,
            $current_library,
            $base_url
        )
    {
        $div = new HTMLTags_Div();
        $div->set_attribute_str('class', 'libraries');
        $ul = new HTMLTags_UL();
        foreach ($libraries as $library) {
            $li = new HTMLTags_LI();
            if (
                $current_library == $library['id']
            ) {
                $li->set_attribute_str('class', 'selected');
            }
            $a = new HTMLTags_A();
            $a->set_href(
                VideoLibrary_URLHelper
                ::get_external_video_library_url(
                    $base_url,
                    $library['id']
                )
            );
            $a->append($library['name']);
            $li->append($a);
            $ul->append($li);
        }
        $div->append($ul);
        return $div;
    }

    public static function
        get_tags_empty_links_list(
            $tags
        )
    {
        $ul = new HTMLTags_UL();
        $ul->set_attribute_str('class', 'tags-empty-links-list');
        foreach ($tags as $tag) {
            $li = new HTMLTags_LI();
            $li->set_attribute_str('tag', $tag['tag']);
            $li->append($tag['tag']);
            $ul->append($li);
        }
        return $ul;
    }

    public static function
        get_tags_page_tags_div(
            $tags,
            $external_video_library_id
        )
    {
        $wrapper_div = new HTMLTags_Div();
        $wrapper_div->set_attribute_str('id', 'thumbnails-wrapper');
        $div = new HTMLTags_Div();
        $div->set_attribute_str('id', 'thumbnails');
        $ul = new HTMLTags_UL();

        foreach ($tags as $tag) {
            $li = new HTMLTags_LI();
            $li->append(self::get_thumbnail_div_for_tag($tag, $external_video_library_id));
            $ul->append($li);
        }
        $div->append($ul);
        $wrapper_div->append($div);
        return $wrapper_div;
    }

    public static function
        get_tags_navigation_div(
            $tags,
            $external_video_library_id
        )
    {
        $div = new HTMLTags_Div();
        $div->set_attribute_str('class', 'tags');
        $ul = new HTMLTags_UL();

        $all_li = new HTMLTags_LI();
        if (
            (!isset($_GET['tag_ids']))
            &&
            (
                (isset($_GET['page-class']))
                &&
                ($_GET['page-class'] != 'DirtyDodo_TagsPage')
            )
        ) {
            $all_li->set_attribute_str('class', 'selected');
        }
        $all_a = new HTMLTags_A('All');
        $href = '';
        if (isset($_GET['external_video_provider_id'])) {
            $href = VideoLibrary_URLHelper::get_all_tags_url(
                $_GET['external_video_provider_id']
            );
        } else {
            $href = VideoLibrary_URLHelper::get_all_tags_url();
        }
        $all_a->set_href($href);
        $all_li->append($all_a);

        $ul->append($all_li);

        foreach ($tags as $tag) {
            $li = new HTMLTags_LI();
            if (
                (isset($_GET['tag_ids']))
                &&
                (in_array($tag['id'], explode(',', $_GET['tag_ids'])))
            ) {
                $li->set_attribute_str('class', 'selected');
            }
            $a = new HTMLTags_A();
            $tags_array = array();
            $tags_array[] = $tag['id'];
            $href='';
            if (isset($_GET['external_video_provider_id'])) {
                $href = VideoLibrary_URLHelper
                    ::get_tags_and_external_video_provider_search_page_url(
                        $tags_array,
                        $_GET['external_video_provider_id']
                    );
            } else {
                $href = VideoLibrary_URLHelper
                    ::get_tags_search_page_url(
                        $tags_array,
                        $external_video_library_id
                    );
            }
            $a->set_href($href);
            $a->append(ucwords($tag['tag']));
            $li->append($a);
            $ul->append($li);
        }
        $div->append($ul);
        return $div;
    }

    public static function
        get_search_page_videos_description_div(
            $tags = NULL,
            $external_video_provider = NULL,
            $external_video_library_id = NULL,
            $search_query = NULL
        )
    {
        $div = new HTMLTags_Div();

        $images_div = new HTMLTags_Div();
        $images_div->set_attribute_str('id', 'images');
        if ($tags) {
            foreach ($tags as $tag) {
                $images_div->append(
                    self::get_img_for_tag_name($tag['tag'], '50/' . $external_video_library_id)
                );
            }
        } 
        //else {
        //$images_div->append('<img src="/images/tags/50/all.png" />');
        //}
        if ($external_video_provider) {
            $images_div->append(
                self::get_img_for_external_provider_name($external_video_provider['name'])
            );
        }
        $div->append($images_div);

        $text_div = new HTMLTags_Div();
        $text_div->set_attribute_str('id', 'text');
        $text_str = '';
        if ($search_query) {
            $text_str .= 'Search for '
                . $search_query . ' ';
        } elseif ($tags) {
            $i = 0;
            foreach ($tags as $tag) {
                if ($i != 0) $text_str .= ', '; $i++;
                $text_str .= ucwords($tag['tag']);
            }
        } else {
            $text_str .= 'All ';
        }
        $text_str .= ' Videos ';
        if ($external_video_provider) {
            $text_str .= 'from ' . $external_video_provider['name'];
        } else {
            $text_str .= 'on Dirty Dodo';
        }
        $text_div->append('<p>' . $text_str . '</p>');
        $div->append($text_div);

        return $div;
    }

    public static function
        get_img_for_external_provider_name(
            $name,
            $size = '50'
        )
    {
        $name = preg_replace('([^a-zA-Z,\s])', '', $name);
        $name = strtolower($name);
        $name = preg_replace('/ /', '-', $name);

        $img = new HTMLTags_IMG();
        $url = new HTMLTags_URL();
        $file_name = '/images/external-video-providers/' . $size . '/' . $name . '.png';
        if (file_exists($_SERVER{'DOCUMENT_ROOT'} . '/project-specific/public-html' . $file_name)) {
            $url->set_file($file_name);
        } else {
            $url->set_file('/images/external-video-providers/' . $size . '/default.png');
        }
        $img->set_src($url);
        return $img;
    }

    public static function
        get_img_for_tag_name(
            $name,
            $size = '50',
            $filetype = NULL
        )
    {
        /*
         * A bodge TODO: rewrite this function
         */
        if (!($filetype)) {
            if (substr($size, 0, 2) == '50') {
                $filetype = 'png';
            } else {
                $filetype = 'jpg';
            }
        }

        $name = preg_replace('([^a-zA-Z,\s])', '', $name);
        $name = strtolower($name);
        $name = trim($name);
        $name = preg_replace('/ /', '-', $name);

        $img = new HTMLTags_IMG();
        $url = new HTMLTags_URL();
        $file_name = '/images/tags/' . $size . '/' . $name . '.' . $filetype;
        if (file_exists($_SERVER{'DOCUMENT_ROOT'} . '/project-specific/public-html' . $file_name)) {
            $url->set_file($file_name);
        } else {
            $url->set_file('/images/tags/' . $size . '/default.' . $filetype);
        }
        $img->set_src($url);
        return $img;
    }

    public static function
        get_pager_div(
            $start,
            $duration,
            $total_videos_count,
            $results_page_url
        )
    {
        $div = new HTMLTags_Div();
        $div->set_attribute_str('class', 'pager');
        //print_r($total_videos_count . ' || ' . $duration);exit;

        /*
         * Find how many pages, any remainder has to count as a new page
         */
        $pages = ceil($total_videos_count / $duration);

        if ($pages > 1) {

            /*
             * Find current page
             */
            if ($start > 0) {
                $current_page = ceil($start / $duration) + 1;
            } else {
                $current_page = 1;
            }

            //print_r($start . ' || ' . $duration . "\n");
            //print_r($pages . ' || ' . $current_page);exit;

            $ul = new HTMLTags_UL();


            $first = TRUE;

            /*
             * Previous Link
             */
            if ($current_page > 1 ){
                $prev_li= new HTMLTags_LI();
                $prev_li->set_attribute_str('class', 'prev');
                $prev_a = new HTMLTags_A('Previous');
                $prev_a->set_href(
                    VideoLibrary_URLHelper::
                    get_results_page_url(
                        $results_page_url,
                        (($current_page - 2) * $duration),
                        $duration
                    )
                );
                $prev_li->append($prev_a);
                $ul->append($prev_li);
            }

            /*
             * Middle Links:
             *
             * (if there are 7 pages)
             * << 1 2 3 4 5 6 7>>
             *
             * (if we're on page 5 of 8)
             * << 1 2 ... 4 5 6 7 8 >>
             *
             * (if we're on page 50 of 100)
             * << 1 2 ... 49 50 51 ... 99 100 >>
             *
             */
            $ellipsis = 0;
            $previous_line_was_ellipsis = FALSE;
            for ($page = 1; $page <= $pages; $page++) {
                if (
                    ($pages <= 9) 
                    OR
                    ($page == 1) OR ($page == 2)
                    OR
                    ($page == $current_page)
                    OR
                    ($page == ($pages -1)) OR ($page == $pages)
                    OR
                    ($page == ($current_page - 1)) OR ($page == ($current_page + 1))
                ) {
                    $li = new HTMLTags_LI();
                    $li_class = "";
                    if ($first) {
                        $li_class .= 'first ';
                        $first = FALSE;
                    } elseif ($page == $pages) {
                        $li_class .= 'last ';
                    }
                    if ($page == $current_page) {
                        $li_class .= 'selected ';
                        $span = new HTMLTags_Span($page);
                        $li->append($span);
                    } else {
                        $a = new HTMLTags_A($page);
                        $a->set_href(
                            VideoLibrary_URLHelper::
                            get_results_page_url(
                                $results_page_url,
                                ((($page - 1) * $duration) ),
                                $duration
                            )
                        );
                        $li->append($a);
                    }
                    $li->set_attribute_str('class', 
                        trim($li_class));
                    $ul->append($li);
                    $previous_line_was_ellipsis = FALSE;
                } elseif (!($previous_line_was_ellipsis) && ($ellipsis <= 1)){
                    $li = new HTMLTags_LI();
                    $li->set_attribute_str('class', 'ellipsis');
                    $li->append('<span>&hellip;</span>');
                    $ul->append($li);
                    $ellipsis++;
                    $previous_line_was_ellipsis = TRUE;
                }
            }

            /*
             * Next page link
             */
            if ($current_page < $pages ){
                $next_li= new HTMLTags_LI();
                $next_li->set_attribute_str('class', 'next');
                $next_a = new HTMLTags_A('Next');
                $next_a->set_href(
                    VideoLibrary_URLHelper::
                    get_results_page_url(
                        $results_page_url,
                        (($current_page) * $duration),
                        $duration
                    )
                );
                $next_li->append($next_a);
                $ul->append($next_li);
            }

            $div->append($ul);
            //print_r($div->get_as_string());exit;

        }

        return $div;
    }
}
?>
