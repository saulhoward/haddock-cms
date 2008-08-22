<?php
/**
 * HTMLTags_Param
 *
 * RFI & SANH 2006-11-29
 */

require_once PROJECT_ROOT . '/haddock/html-tags/classes/HTMLTags_TagWithoutContent.inc.php';
require_once PROJECT_ROOT . '/haddock/html-tags/classes/HTMLTags_URL.inc.php';

class HTMLTags_Param extends HTMLTags_TagWithoutContent
{
    public function __construct()
    {
        parent::__construct('param');
    }
}
?>
