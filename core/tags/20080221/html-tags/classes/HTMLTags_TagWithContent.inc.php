<?php
/**
 * HTMLTags_TagWithContent
 *
 * RFI & SANH 2006-11-27
 */

require_once PROJECT_ROOT . '/haddock/html-tags/classes/HTMLTags_Tag.inc.php';
#require_once PROJECT_ROOT . '/haddock/html-tags/classes/HTMLTags_TagContent.inc.php';

class
    HTMLTags_TagWithContent
extends
    HTMLTags_Tag
{
    private $content;
    
    protected function __construct($name, $content)
    {
        parent::__construct($name);
        
        $this->content = new HTMLTags_TagContent();
        
        if (isset($content)) {
            $this->content->append_str($content);
        }
    }
    
    protected function get_content()
    {
        return $this->content;
    }
    
    public function append_str_to_content($str)
    {
        $this->content->append_str($str);
    }

    public function append_tag_to_content(HTMLTags_Tag $tag)
    {
        $this->content->append_tag($tag);
    }
    
    protected function get_opening_tag()
    {
        $opening_tag = '<' . $this->get_name();
        
        $opening_tag .= $this->get_attribute_string();
        
        $opening_tag .= '>';
        
        return $opening_tag;
    }
    
    protected function get_closing_tag()
    {
        return '</' . $this->get_name() . ">\n";
    }
    
    public function get_as_string()
    {
        $string = '';
        
        $string .= $this->get_pre_opening_tag_comment();
        
        # Open the tag.
        $string .= $this->get_opening_tag();
        
        # The content
        $content = $this->get_content();
        $string .= $content->get_as_string();
        
        # Close the tag.
        $string .= $this->get_closing_tag();

        $string .= $this->get_post_closing_tag_comment();
        
        return $string;
    }
}
?>