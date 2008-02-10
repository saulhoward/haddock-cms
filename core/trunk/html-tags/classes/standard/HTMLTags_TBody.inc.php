<?php
/**
 * HTMLTags_TBody
 *
 * RFI & SANH 2006-11-29
 */

require_once PROJECT_ROOT . '/haddock/html-tags/classes/HTMLTags_TagWithContent.inc.php';

class HTMLTags_TBody extends HTMLTags_TagWithContent
{
    public function __construct($content = null)
    {
        parent::__construct('tbody', $content);
    }
}
?>
