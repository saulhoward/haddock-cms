<?php
/**
 * VideoLibrary_ExceptionPage
 * 
 * @copyright SANH, 2010-04-20
 */

class
VideoLibrary_ExceptionPage
extends
VideoLibrary_SimplePage
{
    public function
        get_head_title_extension()
    {   
        return 'Exception';
    }

    public function
        render_body_div_content()
    {
        echo $this->content();
    }

    public function
        content()
    {   
        #echo __METHOD__; exit;
        echo '<div id="exception-content"><h2>' . $this->get_project_title() . ' Exception</h2>';
        PublicHTML_ExceptionRenderer::render_exception_div_from_session();
        echo '</div>';
        #echo __METHOD__; exit;
    }   
}
?>
