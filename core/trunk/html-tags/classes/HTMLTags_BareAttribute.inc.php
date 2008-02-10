<?php
/**
 * HTMLTags_BareAttribute
 *
 * RFI & SANH 2006-11-27
 */

require_once PROJECT_ROOT . '/haddock/html-tags/classes/HTMLTags_Attribute.inc.php';

class HTMLTags_BareAttribute extends HTMLTags_Attribute
{
    public function get_as_string()
    {
        return $this->get_name();
    }
}
?>
