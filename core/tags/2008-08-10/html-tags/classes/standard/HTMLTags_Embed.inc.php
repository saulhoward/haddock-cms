<?php
/**
 * HTMLTags_Div
 *
 * RFI & SANH 2006-11-27
 */

require_once PROJECT_ROOT . '/haddock/html-tags/classes/HTMLTags_TagWithContent.inc.php';

class HTMLTags_Embed extends HTMLTags_TagWithContent
{
    public function __construct()
    {
        parent::__construct('embed', null);
    }
}
?>
