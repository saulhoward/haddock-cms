<?php
/**
 * VideoLibrary_PageBuilder
 *
 * @copyright 2008-02-09, RFI
 */

class
VideoLibrary_PageBuilder
{
    private $current_page_class;

    public function
        get_current_page_class_string()
    {
        return get_class($this->get_current_page_class());
    }

    public function
        get_current_page_class()
    {
        if (!isset($this->current_page_class)) {
            throw new VideoLibrary_CurrentPageClassNotSetException();
        }
        return $this->current_page_class;
    }


    public function
        set_current_page_class($current_page_class)
    {
        $this->current_page_class = $current_page_class;
    }
    public function
        get_first_tier_navigation_ul()
    {
        $pages = $this->get_pages_for_first_tier_navigation();
        $ul = new HTMLTags_UL();

        foreach ($pages as $page) {
            $li = new HTMLTags_LI();
            if (
                (
                    (
                        ($this->get_current_page_class_string() == 'VideoLibrary_SearchPage')
                        ||
                        ($this->get_current_page_class_string() == 'VideoLibrary_HomePage')
                    )
                    &&
                    ($page['name'] == 'home')
                )
                ||
                (
                    ($this->get_current_page_class_string() == 'VideoLibrary_TagsPage')
                    &&
                    ($page['name'] == 'tags')

                )
            ) {
                $li->set_attribute_str('class', 'selected');
            }
            $a = new HTMLTags_A();
            $url = new HTMLTags_URL();
            $url->set_file($page['href']);
            $a->set_href($url);
            if ($page['open-in-new-window'] == 'yes') {
                $a->set_attribute_str('target', '_blank');
            }
            $span = new HTMLTags_Span($page['title']);
            $a->append($span);
            $li->append($a);
            $ul->append($li);
        }
        return $ul;
    }

    public function
        get_first_tier_navigation_div()
    {
        $div = new HTMLTags_Div();
        $div->append($this->get_first_tier_navigation_ul());
        return $div;
    }

    public function
        get_current_page_external_video_library_id()
    {
        /**
         * Check whether or not the page we are building is an inheritor 
         * of VideoLibrary_ExternalVideoLibraryPage
         */
        if (method_exists($this->get_current_page_class(), 'get_external_video_library_id')) {
            return $this->get_current_page_class()->get_external_video_library_id();
        } else {
            return FALSE; // Page has no library id
        }
    }

    public function
        get_pages_for_first_tier_navigation()
    {
        if ($library_id = $this->get_current_page_external_video_library_id()) {
            $tags_page_url = VideoLibrary_URLHelper::
                get_tags_page_url_for_external_video_library_id(
                    $library_id
                );
            $search_page_url = VideoLibrary_URLHelper::
                get_search_page_url_for_external_video_library_id(
                    $library_id
                );
        } else {
            $tags_page_url = VideoLibrary_URLHelper::
                get_tags_page_url();
            $search_page_url = VideoLibrary_URLHelper::
                get_search_page_url();
        }
        $pages = array();
        $pages[] = array(
            'name' => 'home',
            'title' => 'Home',
            'href' => $search_page_url->get_as_string()
        );
        $pages[] = array(
            'name' => 'tags',
            'title' => 'Categories',
            'href' => $tags_page_url->get_as_string()
        );
        return $pages;
    }

    public function
        get_head_title_base()
    {   
        return 'Haddockvision Video Library';
    }

    public function
        get_head_title_default_extension()
    {   
        return 'Moving Pictures';
    }

    public function
        get_head_meta_keywords()
    {
        return 'videos, online, flash';
    }

    public function
        get_head_meta_description()
    {
        return 'A fine collection of online videos';
    }

    public function
        get_head_meta_description_extra()
    {
        return $this->get_head_meta_description();
    }

    public function
        get_html_page_css_includes()
    {
        return <<<HTML
<link
    rel="stylesheet"
    href="/styles/style.css"
    type="text/css"
    media="screen"
/>
<!--[if IE 7]>
<link
        rel="stylesheet"
        href="/styles/ie7-hacks.css"
        type="text/css"
        media="screen"
    />
<![endif]-->
<!--[if lte IE 6]>
<link
        rel="stylesheet"
        href="/styles/ie6-hacks.css"
        type="text/css"
        media="screen"
    />
<![endif]-->
HTML;

    }

    public function
        get_html_page_javascript_includes()
    {
        return <<<HTML
<script 
    type="text/javascript" 
    src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"
>
</script> 
<script 
    type="text/javascript" 
    src="/plug-ins/video-library/public-html/scripts/pages/VideoLibrary_HTMLPage.js"
>
</script> 
<script 
    type="text/javascript" 
    src="/plug-ins/video-library/public-html/scripts/VideoLibrary_SearchForms.js"
>
</script> 
<script 
    type="text/javascript" 
    src="/plug-ins/video-library/public-html/scripts/pages/VideoLibrary_ThumbnailsPage.js"
>
</script> 
<script 
    type="text/javascript" 
    src="/plug-ins/video-library/public-html/scripts/VideoLibrary_Thumbnails.js"
>
</script> 

HTML;

    }

    public function
        get_video_page_javascript_includes()
    {
        return <<<HTML
<script 
    type="text/javascript" 
    src="/plug-ins/video-library/public-html/scripts/pages/VideoLibrary_VideoPage.js"
>
</script> 
<script 
    type="text/javascript" 
    src="/plug-ins/video-library/public-html/scripts/VideoLibrary_VideoPageURL.js"
>
</script> 
<script 
    type="text/javascript" 
    src="/plug-ins/video-library/public-html/scripts/VideoLibrary_VideoPageURLHelper.js"
>
</script>
<script 
    type="text/javascript" 
    src="/plug-ins/video-library/public-html/scripts/VideoLibrary_RelatedVideos.js"
>
</script> 
HTML;

    }

    public function
        get_video_page_body_header_extra_content()
    {
        return '';
    }

    public function
        get_video_page_side_content()
    {
        return '';
    }

    public function
        get_video_player_div_additional_content()
    {
        return '';
    }


    public function
        get_video_info_div_additional_content(
            $video_data
        )
    {
        return '';
    }

    public function
        get_thumbnails_page_extra_content()
    {
        return '';
    }

    public function
        get_simple_footer_content()
    {
        return '<p>' . $this->get_footer_copyright_notice() . '</p>';
    }

    public function
        get_footer_content()
    {
        return $this->get_simple_footer_content();
    }

    public function
        get_footer_copyright_notice()
    {
        return 'Copyright the authors ' . date('Y') . ', all rights reserved.';
    }
}
?>
