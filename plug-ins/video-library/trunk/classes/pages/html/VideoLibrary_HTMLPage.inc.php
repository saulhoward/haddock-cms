<?php
/**
 * VideoLibrary_HTMLPage
 * 
 * @copyright SANH, 2008-15-18
 */

/**
 * Parent class of all the HTML pages of the VideoLibrary.com site
 */

abstract class
VideoLibrary_HTMLPage
extends
PublicHTML_HTMLPage
{
    private $page_builder;

    protected function
        get_page_builder()
    {
        if (!isset($this->page_builder)) {
            $this->set_page_builder();
        }
        return $this->page_builder;
    }

    protected function
        set_page_builder()
    {
        $this->page_builder 
            = VideoLibrary_PageBuildingHelper::get_page_builder();
        $this->page_builder->set_current_page_class($this);
    }

    public function
        render_body()
    {
    }
    
    protected function
        render_head_link_stylesheet()
    {
?>
<link
    rel="stylesheet"
    href="/styles/style.css"
    type="text/css"
    media="screen"
/>
<link
    rel="stylesheet"
    href="/styles/style2.css"
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
<?php
    }

    public function
        render_head_script_javascript()
    {
        echo $this->get_page_builder()->get_html_page_javascript_includes();
    }

    public function
        get_head_title()
    {   
        return $this->get_head_title_extension() 
            . ' - ' 
            . $this->get_head_title_base();
    }   

    public function
        get_head_title_extension()
    {
        return $this->get_page_builder()->get_head_title_default_extension();
    }

    public function
        get_head_title_base()
    {   
        return $this->get_page_builder()->get_head_title_base();
    }

    public function
        get_head_meta_keywords()
    {
        return $this->get_page_builder()->get_head_meta_keywords();
    }

    public function
        get_head_meta_description()
    {
        return $this->get_page_builder()->get_head_meta_description();
    }
}
?>
