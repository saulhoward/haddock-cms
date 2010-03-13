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
        get_first_tier_navigation_div()
    {
        $div = new HTMLTags_Div();
        $pages = $this->get_pages_for_first_tier_navigation();
        $ul = new HTMLTags_UL();

        foreach ($pages as $page) {
            $li = new HTMLTags_LI();
            if (
                (
                    (
                        ($this->get_current_page_class() == 'VideoLibrary_SearchPage')
                        ||
                        ($this->get_current_page_class() == 'VideoLibrary_HomePage')
                    )
                    &&
                    ($page['name'] == 'home')
                )
                ||
                (
                    ($this->get_current_page_class() == 'VideoLibrary_TagsPage')
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
            $span = new HTMLTags_Span($page['title']);
            $a->append($span);
            $li->append($a);
            $ul->append($li);
        }
        $div->append($ul);

        return $div;
    }

    public function
        get_pages_for_first_tier_navigation()
    {
        $pages = array();
        $pages[] = array(
            'name' => 'home',
            'title' => 'Home',
            'href' => '/'
        );
        $pages[] = array(
            'name' => 'tags',
            'title' => 'Categories',
            'href' => '/VideoLibrary_TagsPage'
        );
        return $pages;
    }

    public function
        get_html_page_javascript_includes()
    {
        return <<<HTML
<script 
    type="text/javascript" 
    src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"
>
</script> 
<!--
<script 
    type="text/javascript" 
    src="/plug-ins/video-library/public-html/scripts/jquery.glow.js"
>
</script> 
-->
<script 
    type="text/javascript" 
    src="/plug-ins/video-library/public-html/scripts/VideoLibrary_HTMLPage.js"
>
</script> 
HTML;

    }
}
?>
