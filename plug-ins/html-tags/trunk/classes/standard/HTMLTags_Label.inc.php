<?php
/**
 * HTMLTags_Label
 *
 * RFI & SANH 2006-11-27
 */

require_once PROJECT_ROOT . '/haddock/html-tags/classes/HTMLTags_TagWithContent.inc.php';

class HTMLTags_Label extends HTMLTags_TagWithContent
{
    public function __construct($content)
    {
        parent::__construct('label', $content);
    }
}
?>
