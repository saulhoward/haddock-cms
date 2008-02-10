<?php
/**
 * HTMLTags_MetaWithNameAndContent
 *
 * @copyright Clear Line Web Design, 2007-08-29
 */

class
	HTMLTags_MetaWithNameAndContent
extends
	HTMLTags_Meta
{
    public function
        __construct($name, $content)
    {
        parent::__construct();
        
        $this->set_attribute_str('name', $name);
        
        $this->set_attribute_str('content', $content);
    }
}
?>
