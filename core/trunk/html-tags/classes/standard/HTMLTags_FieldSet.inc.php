<?php
/**
 * HTMLTags_FieldSet
 *
 * RFI & SANH 2006-11-27
 */

require_once PROJECT_ROOT . '/haddock/html-tags/classes/HTMLTags_TagWithContent.inc.php';

class HTMLTags_FieldSet extends HTMLTags_TagWithContent
{
    #private $items;
    
    public function __construct()
    {
        parent::__construct('fieldset', null);
        #$this->items = array();
    }
    
    #public function get_items()
    #{
    #    return $this->items;
    #}
    
    #public function add_li(HTMLTags_LI $li)
    #{
    #    #$this->items[] = $li;
    #    
    #    $content = $this->get_content();
    #    
    #    $content->append_tag($li);
    #}
    
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
}
?>
