<?php
/**
 * HTMLTags_OL
 *
 * RFI & SANH 2006-11-27
 */

require_once PROJECT_ROOT . '/haddock/html-tags/classes/HTMLTags_List.inc.php';

class HTMLTags_OL extends HTMLTags_List
{
    public function __construct()
    {
        parent::__construct('ol');
    }
}
?>
