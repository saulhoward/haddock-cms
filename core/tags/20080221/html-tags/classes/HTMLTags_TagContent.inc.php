<?php
/**
 * HTMLTags_TagContent.inc.php
 *
 * RFI & SANH 2006-11-27
 */

require_once PROJECT_ROOT . '/haddock/html-tags/classes/HTMLTags_Tag.inc.php';

class HTMLTags_TagContent
{
    private $content_items;
    
    private $str;
    
    public function __construct()
    {
        $this->content_items = array();
    }
    
    public function append_tag(HTMLTags_Tag $tag)
    {
        $tmp['type'] = 'T';
        $tmp['item'] = $tag;
        
        $this->content_items[] = $tmp;
    }
    
    public function append_str($str)
    {
        if (is_string($str) or is_numeric($str)) {
            $tmp['type'] = 'S';
            
            if (is_string($str)) {
                $tmp['item'] = $str;
            } else {
                $tmp['item'] = '' . $str;
            }
            
            $this->content_items[] = $tmp;
        } else {
            $error_message = "Attempt to append non-string to tag content with HTMLTags_TagContent::append_str(...)!";
            
            throw new Exception($error_message);
        }
    }
    
    public function get_as_string()
    {
        if (!isset($this->str)) {
            $this->str;
            
            foreach ($this->content_items as $item) {
                if ($item['type'] == 'T') {
                    $this->str .= $item['item']->get_as_string();
                }

                if ($item['type'] == 'S') {
                    $this->str .= $item['item'];
                }
            }
        }
        
        return $this->str;
    }
}
?>
