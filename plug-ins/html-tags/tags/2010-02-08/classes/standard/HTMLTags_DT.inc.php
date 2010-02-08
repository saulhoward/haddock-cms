<?php
/**
 * HTMLTags_DT
 *
 * RFI & SANH 2007-01-05
 */

#require_once PROJECT_ROOT . '/haddock/html-tags/classes/HTMLTags_TagWithContent.inc.php';

class HTMLTags_DT extends HTMLTags_TagWithContent
{
    public function __construct($content = NULL)
    {
        parent::__construct('dt', $content);
    }
}
?>
