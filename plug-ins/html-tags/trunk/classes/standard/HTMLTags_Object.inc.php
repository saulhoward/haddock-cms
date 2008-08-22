<?php
/**
 * HTMLTags_Object
 *
 * RFI & SANH 2007-03-08
 */

require_once PROJECT_ROOT . '/haddock/html-tags/classes/HTMLTags_TagWithContent.inc.php';

class HTMLTags_Object extends HTMLTags_TagWithContent
{
    public function __construct($content = null)
    {
        parent::__construct('object', $content);
    }
}
?>
