<?php
/**
 * HTMLTags_ColGroup
 *
 * RFI & SANH 2008-04-05
 */

#require_once PROJECT_ROOT . '/haddock/html-tags/classes/HTMLTags_TagWithoutContent.inc.php';

class
    HTMLTags_ColGroup
extends
    HTMLTags_TagWithoutContent
{
    public function __construct()
    {
        parent::__construct('colgroup');
    }
}
?>
