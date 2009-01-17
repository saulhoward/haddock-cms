<?php
/**
 * HTMLTags_BR
 *
 * RFI & SANH 2006-11-30
 */

#require_once PROJECT_ROOT . '/haddock/html-tags/classes/HTMLTags_TagWithoutContent.inc.php';

class
    HTMLTags_BR
extends
    HTMLTags_TagWithoutContent
{
    public function __construct()
    {
        parent::__construct('br');
    }
}
?>