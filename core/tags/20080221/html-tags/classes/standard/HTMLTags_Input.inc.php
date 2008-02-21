<?php
/**
 * HTMLTags_Input
 *
 * RFI & SANH 2006-11-27
 */

require_once PROJECT_ROOT . '/haddock/html-tags/classes/HTMLTags_TagWithoutContent.inc.php';
require_once PROJECT_ROOT . '/haddock/html-tags/classes/HTMLTags_InputTag.inc.php';

class HTMLTags_Input extends HTMLTags_TagWithoutContent implements HTMLTags_InputTag
{
    public function __construct()
    {
        parent::__construct('input');
    }
    
    public function set_value($value)
    {
        $this->set_attribute_str('value', $value);
    }
}
?>
