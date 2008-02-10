<?php
/**
 * HTMLTags_List
 *
 * RFI & SANH 2006-11-27
 */

require_once PROJECT_ROOT . '/haddock/html-tags/classes/HTMLTags_TagWithContent.inc.php';
require_once PROJECT_ROOT . '/haddock/html-tags/classes/standard/HTMLTags_LI.inc.php';

abstract class HTMLTags_List extends HTMLTags_TagWithContent
{
    #private $items;
    
    protected function __construct($name)
    {
        parent::__construct($name, null);
        #$this->items = array();
    }
    
    #public function get_items()
    #{
    #    return $this->items;
    #}
    
    public function add_li(HTMLTags_LI $li)
    {
        #$this->items[] = $li;
        
        $content = $this->get_content();
        
        $content->append_tag($li);
    }
    
    #public function get_content()
    #{
    #    $content = "\n";
    #    
    #    foreach ($this->get_items() as $item) {
    #        $content .= $item->get_as_string();
    #        $content .= "\n";
    #    }
    #    
    #    return $content;
    #}
    
    public function
        add_tag_in_new_li(
            HTMLTags_Tag $tag
        )
    {
        $li = new HTMLTags_LI();
        
        $li->append_tag_to_content($tag);
        
        $this->add_li($li);
    }
}
?>
