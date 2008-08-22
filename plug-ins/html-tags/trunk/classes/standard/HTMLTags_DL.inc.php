<?php
/**
 * HTMLTags_DL
 *
 * RFI & SANH 2007-01-05
 */

require_once PROJECT_ROOT . '/haddock/html-tags/classes/HTMLTags_TagWithContent.inc.php';

class HTMLTags_DL extends HTMLTags_TagWithContent
{
    public function __construct()
    {
        parent::__construct('dl', null);
    }
}
?>
