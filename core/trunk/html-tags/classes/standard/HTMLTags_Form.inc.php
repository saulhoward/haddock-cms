<?php
/**
 * HTMLTags_Form
 *
 * @copyright Clear Line Web Design, 2006-11-27
 */

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/'
    . 'HTMLTags_TagWithContent.inc.php';

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/'
    . 'HTMLTags_URL.inc.php';

class
    HTMLTags_Form
extends
    HTMLTags_TagWithContent
{
    private $hidden_inputs;
    
    public function
        __construct()
    {
        parent::__construct('form', null);
        
        $this->hidden_inputs = array();
    }
    
    public function
        set_action(HTMLTags_URL $href)
    {
        $this->set_attribute_str('action', $href->get_as_string());
    }
    
    # No! No! No!
    # Use the delegate pattern?
    public function
        get_hidden_inputs()
    {
        return $this->hidden_inputs;
    }
    
    public function
        add_hidden_input($name, $value)
    {
        $this->hidden_inputs[$name] = new HTMLTags_Input();
        
        $this->hidden_inputs[$name]->set_attribute_str('type', 'hidden');
        $this->hidden_inputs[$name]->set_attribute_str('name', $name);
        $this->hidden_inputs[$name]->set_attribute_str('value', $value);
    }
}
?>
