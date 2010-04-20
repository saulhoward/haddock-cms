<?php
/**
 * VideoLibrary_SimplePage
 * 
 * @copyright SANH, 2008-15-18
 */

/**
 * Simple page for the Video Library, no frills at all
 * Used for ExceptionPage, for example
 */

abstract class
VideoLibrary_SimplePage
extends
VideoLibrary_HTMLPage
{
    public function
        render_body()
    {
        $this->render_body_tag_open();

        $this->render_body_div_header();
        $this->render_body_div_content();

        $this->render_body_div_footer();

        echo "</body>\n";
    }

    public function
        render_body_div_header()
    {
        $title = $this->get_head_title();
        echo <<<HTML
<div id="header" class="SimplePage">
    <h1><a href="/">$title</a></h1>
</div>
HTML;

    }

    public function
        render_body_div_footer()
    {
        echo '<div id="footer">';
        echo $this->get_page_builder()->get_simple_footer_content();
        echo '</div>';
    }
}
?>
