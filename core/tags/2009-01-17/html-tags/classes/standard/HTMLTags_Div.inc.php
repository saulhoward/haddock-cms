<?php
/**
 * HTMLTags_Div
 *
 * RFI & SANH 2006-11-27
 */

require_once PROJECT_ROOT . '/haddock/html-tags/classes/HTMLTags_TagWithContent.inc.php';

class HTMLTags_Div extends HTMLTags_TagWithContent
{
    public function __construct()
    {
        parent::__construct('div', null);
    }
    
    public function
        get_pre_opening_tag_comment()
    {
        if ($this->has_attribute('id')) {
            $id_attribute = $this->get_attribute('id');
            
            return '<!-- Start of ' . $id_attribute->get_value() . " div. -->\n";
        }
        
        return '';
    }
    
    public function
        get_post_closing_tag_comment()
    {
        if ($this->has_attribute('id')) {
            $id_attribute = $this->get_attribute('id');
            
            return '<!-- End of ' . $id_attribute->get_value() . " div. -->\n";
        }
        
        return '';
    }
}
?>
