<?php
/**
 * VideoLibrary_FullPage
 * 
 * @copyright SANH, 2008-15-18
 */

/**
 * Parent class of all the Dynamic Library pages of the VideoLibrary.com site
 */

abstract class
VideoLibrary_FullPage
extends
VideoLibrary_HTMLPage
{
    private $primary_tags;
    private $tags_navigation_div;
    private $libraries_navigation_div;
    private $provider_navigation_div;

    public function
        render_body()
    {
        $this->render_body_tag_open();

        $this->render_body_div_header();

        $first_navigation_div = $this->get_first_tier_navigation_div();
        $first_navigation_div->set_attribute_str('id', 'top-nav-1');
        echo $first_navigation_div->get_as_string();

        /*
         *Second Tier Nav - libraries and search
         */
        $second_nav_div = new HTMLTags_Div();
        $second_nav_div->set_attribute_str('id', 'top-nav-2');
        $second_nav_div->append($this->get_second_tier_navigation_div());
        $second_nav_div->append(
            $this->get_external_video_search_div()
        );
        echo $second_nav_div->get_as_string();

        $this->render_body_div_content();

        $this->render_body_div_footer_nav();

        $this->render_body_div_footer();

        echo "</body>\n";
    }

    public function
        get_external_video_search_div()
    {
        if (isset($_GET['q'])){
            $search_query =  $_GET['q'];
        } else {
            $search_query = NULL;
        }
        return VideoLibrary_DisplayHelper::get_external_video_search_div(
            $this->get_external_video_library_id(),
            $search_query
        );

    }

    public function
        get_first_tier_navigation_div()
    {
        return $this->get_page_builder()->get_first_tier_navigation_div($this->get_external_video_library_id());
    }

    public function
        get_second_tier_navigation_div()
    {
        return $this->get_libraries_navigation_div();
    }

    public function
        render_body_div_header()
    {
        $title = $this->get_head_title();
        echo <<<HTML
<div id="header">
    <h1><a href="/">$title</a></h1>
</div>
HTML;

    }

    public function
        render_body_div_footer_nav()
    {
        /*
         *Second Tier Nav - libraries and search
         */
        $footer_nav_div = new HTMLTags_Div();
        $footer_nav_div->set_attribute_str('id', 'footer-nav');
        $footer_nav_div->append($this->get_second_tier_navigation_div());
        $footer_nav_div->append($this->get_external_video_search_div());
        echo $footer_nav_div->get_as_string();
    }

    public function
        render_body_div_footer()
    {
        echo '<div id="footer">';
        echo $this->get_page_builder()->get_footer_content();
        echo '</div>';
    }

    protected function
        set_libraries_navigation_div()
    {
        $libraries = VideoLibrary_DatabaseHelper
            ::get_external_video_libraries();
        //print_r($libraries);exit;
        $this->libraries_navigation_div = VideoLibrary_DisplayHelper
            ::get_external_video_libraries_navigation_div(
                $libraries,
                $this->get_external_video_library_id(),
                $this->get_libraries_navigation_div_base_url()
            );
    }

    protected function
        get_libraries_navigation_div_base_url()
    {
        return  VideoLibrary_URLHelper
            ::get_search_page_url();
    }

    protected function
        get_libraries_navigation_div()
    {
        if (!isset($this->libraries_navigation_div)) {
            $this->set_libraries_navigation_div();
        }
        return $this->libraries_navigation_div;
    }

    protected function
        set_tags_navigation_div()
    {
        $this->tags_navigation_div = VideoLibrary_DisplayHelper
            ::get_tags_navigation_div(
                $this->get_primary_tags(),
                $this->get_external_video_library_id()
            );
    }

    protected function
        get_tags_navigation_div()
    {
        if (!isset($this->tags_navigation_div)) {
            $this->set_tags_navigation_div();
        }
        return $this->tags_navigation_div;
    }

    protected function
        set_primary_tags()
    {
        $this->primary_tags = VideoLibrary_DatabaseHelper::
            get_tags_for_external_library_id(
                $this->get_external_video_library_id(),
                TRUE
            );
    }

    protected function
        get_primary_tags()
    {
        if (!isset($this->primary_tags)) {
            $this->set_primary_tags();
        }
        return $this->primary_tags;
    }

    protected function
        set_provider_navigation_div()
    {
        $providers = VideoLibrary_DatabaseHelper::
            get_external_video_providers_for_external_video_library_id(
                $this->get_external_video_library_id()
            );
        $this->provider_navigation_div 
            = VideoLibrary_DisplayHelper
            ::get_external_video_provider_navigation_div(
                $providers,
                VideoLibrary_URLHelper::get_search_page_url()
            );

    }

    protected function
        get_provider_navigation_div()
    {
        if (!isset($this->provider_navigation_div)) {
            $this->set_provider_navigation_div();
        }
        return $this->provider_navigation_div;
    }
}
?>
