<?php
/**
 * HTMLTags_Legend
 *
 * RFI & SANH 2006-11-27
 */

require_once PROJECT_ROOT . '/haddock/html-tags/classes/HTMLTags_TagWithContent.inc.php';

class HTMLTags_Legend extends HTMLTags_TagWithContent
{
    public function __construct($content)
    {
        parent::__construct('legend', $content);
    }
}
?>
