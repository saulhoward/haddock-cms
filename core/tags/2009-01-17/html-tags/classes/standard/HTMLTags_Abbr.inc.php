<?php
/**
 * HTMLTags_Abbr
 *
 * RFI & SANH 2006-11-27
 */

require_once PROJECT_ROOT . '/haddock/html-tags/classes/HTMLTags_TagWithContent.inc.php';

class HTMLTags_Abbr extends HTMLTags_TagWithContent
{
    public function __construct()
    {
        parent::__construct('abbr', null);
    }
}
?>
