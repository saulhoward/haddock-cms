<?php
/**
 * HTMLTags_A
 *
 * RFI & SANH 2006-11-29
 */

require_once PROJECT_ROOT . '/haddock/html-tags/classes/HTMLTags_TagWithContent.inc.php';
require_once PROJECT_ROOT . '/haddock/html-tags/classes/HTMLTags_URL.inc.php';

class
	HTMLTags_A
extends
	HTMLTags_TagWithContent
{
    public function
        __construct($content = null)
    {
        parent::__construct('a', $content);
    }
    
    public function set_href(HTMLTags_URL $href)
    {
	    #print_r($href);

        $this->set_attribute_str('href', $href->get_as_string());
    }
}
?>