<?php
/**
 * HTMLTags_Heading
 *
 * RFI & SANH 2006-11-27
 */

#require_once PROJECT_ROOT . '/haddock/html-tags/classes/HTMLTags_TagWithContent.inc.php';

class HTMLTags_Heading extends HTMLTags_TagWithContent
{
    public function __construct($level, $content = null)
    {
        if (is_int($level) && ($level >= 1) && ($level <= 6)) {
            parent::__construct(('h' . $level), $content);
        } else {
            $error_message = "The heading level must be an integer between 1 and 6!";
            throw new Exception($error_message);
        }
    }
}
?>
