<?php
/**
 * HTMLTags_Em
 *
 * RFI & SANH 2006-11-27
 */

require_once PROJECT_ROOT . '/haddock/html-tags/classes/HTMLTags_TagWithContent.inc.php';

class HTMLTags_Em extends HTMLTags_TagWithContent
{
    public function __construct($content = null)
    {
        parent::__construct('em', $content);
    }
}
?>
