<?php
/**
 * HTMLTags_P
 *
 * RFI & SANH 2006-11-27
 */

#require_once PROJECT_ROOT . '/haddock/html-tags/classes/HTMLTags_TagWithContent.inc.php';

class HTMLTags_P extends HTMLTags_TagWithContent
{
    public function __construct($content = null)
    {
        parent::__construct('p', $content);
    }
}
?>
