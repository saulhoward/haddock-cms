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
		render_head()
	{
?>
<head>
	<title><?php echo $this->get_head_title(); ?></title>
	<meta
		name="author"
		content="<?php echo $this->get_head_meta_author(); ?>"
	/>
	<meta
		name="keywords"
		content="<?php echo $this->get_head_meta_keywords(); ?>"
	/>
	<meta
		name="description"
		content="<?php echo $this->get_head_meta_description(); ?>"
	/>
<?php 
        if ($image_link = $this->get_head_link_image()) {
            echo $image_link;
        } 
        $this->render_head_link_stylesheet(); 
?>
	<link
		rel="Shortcut Icon"
		type="image/ico"
		href="/favicon.ico"
	/>
<?php $this->render_head_script_javascript(); ?>
</head>
<?	
	}
	
    public function
        render_body()
    {
    }

    protected function
        get_head_link_image()
    {
        return NULL;
    }

    protected function
        render_head_link_stylesheet()
    {
        echo $this->get_page_builder()->get_html_page_css_includes();
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
        return $this->get_page_builder()->get_head_meta_keywords(
            $this->get_head_meta_extra_keywords()
        );
    }

    public function
        get_head_meta_extra_keywords()
    {
        return NULL;
    }

    public function
        get_head_meta_description()
    {
        return $this->get_page_builder()->get_head_meta_description();
    }
}
?>
