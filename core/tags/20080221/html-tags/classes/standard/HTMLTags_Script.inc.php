<?php
/**
 * HTMLTags_Script
 *
 * RFI & SANH 2006-11-29
 */

#require_once PROJECT_ROOT . '/haddock/html-tags/classes/HTMLTags_TagWithContent.inc.php';

class
    HTMLTags_Script
extends
    HTMLTags_TagWithContent
{
    public function __construct($content = null)
    {
        parent::__construct('script', $content);
    }
}
?>