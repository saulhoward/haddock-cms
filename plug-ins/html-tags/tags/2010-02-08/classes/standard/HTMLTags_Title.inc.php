<?php
/**
 * HTMLTags_Title
 *
 * @copyright Clear Line Web Design, 2007-07-19
 */

#require_once PROJECT_ROOT
#    . '/haddock/html-tags/classes/'
#    . 'HTMLTags_TagWithContent.inc.php';

class
    HTMLTags_Title
extends
    HTMLTags_TagWithContent
{
    public function
        __construct($content = null)
    {
        parent::__construct('title', $content);
    }
}
?>
