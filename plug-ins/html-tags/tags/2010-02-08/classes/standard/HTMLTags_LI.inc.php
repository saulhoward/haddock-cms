<?php
/**
 * HTMLTags_LI
 *
 * RFI & SANH 2006-11-27
 */

#require_once PROJECT_ROOT . '/haddock/html-tags/classes/HTMLTags_TagWithContent.inc.php';

class HTMLTags_LI extends HTMLTags_TagWithContent
{
    public function __construct($content = '')
    {
        parent::__construct('li', $content);
    }
}
?>
