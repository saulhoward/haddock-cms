<?php
/**
 * HTMLTags_Pre
 *
 * @copyright Clear Line Web Design, 2006-12-02
 */

require_once PROJECT_ROOT . '/haddock/html-tags/classes/HTMLTags_TagWithContent.inc.php';

class HTMLTags_Code extends HTMLTags_TagWithContent
{
    public function __construct($content = null)
    {
        parent::__construct('code', $content);
    }
}
?>