<?php
/**
 * HTMLTags_TextArea
 *
 * RFI & SANH 2006-11-27
 */

require_once PROJECT_ROOT . '/haddock/html-tags/classes/HTMLTags_TagWithContent.inc.php';
require_once PROJECT_ROOT . '/haddock/html-tags/classes/HTMLTags_InputTag.inc.php';

class HTMLTags_TextArea extends HTMLTags_TagWithContent implements HTMLTags_InputTag
{
    public function __construct($content = null)
    {
        parent::__construct('textarea', $content);
    }
    
    public function set_value($value)
    {
        $this->append_str_to_content($value);
    }
}
?>
