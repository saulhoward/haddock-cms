<?php
/**
 * HTMLTags_Option
 *
 * @copyright Clear Line Web Design, 2006-11-27
 */

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/'
    . 'HTMLTags_TagWithContent.inc.php';

class
    HTMLTags_Option
extends
    HTMLTags_TagWithContent
{
    public function __construct($content)
    {
        parent::__construct('option', $content);
    }
}
?>
