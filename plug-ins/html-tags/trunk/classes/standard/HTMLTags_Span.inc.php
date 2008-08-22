<?php
/**
 * HTMLTags_Span
 *
 * RFI & SANH 2007-01-08
 */

require_once PROJECT_ROOT . '/haddock/html-tags/classes/HTMLTags_TagWithContent.inc.php';

class HTMLTags_Span extends HTMLTags_TagWithContent
{
    public function __construct($content = null)
    {
        parent::__construct('span', $content);
    }
}
?>
