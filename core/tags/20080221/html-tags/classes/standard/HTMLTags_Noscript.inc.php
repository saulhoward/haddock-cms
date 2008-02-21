<?php
/**
 * HTMLTags_Noscript
 *
 * @copyright Clear Line Web Design, 2007-03-08
 */

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/'
    . 'HTMLTags_TagWithContent.inc.php';

class
    HTMLTags_Noscript
extends
    HTMLTags_TagWithContent
{
    public function __construct($content = null)
    {
        parent::__construct('noscript', $content);
    }
}
?>
