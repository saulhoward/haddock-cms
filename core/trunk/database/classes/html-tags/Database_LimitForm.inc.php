<?php

require_once PROJECT_ROOT . '/haddock/html-tags/classes/HTMLTags_URL.inc.php';

require_once PROJECT_ROOT . '/haddock/html-tags/classes/standard/HTMLTags_Form.inc.php';
require_once PROJECT_ROOT . '/haddock/html-tags/classes/standard/HTMLTags_Select.inc.php';
require_once PROJECT_ROOT . '/haddock/html-tags/classes/standard/HTMLTags_Option.inc.php';

class
    Database_LimitForm
extends
    HTMLTags_Form
{
    private $current_limit;
    private $limits;
    
    public function
        __construct(HTMLTags_URL $action, $current_limit, $limits_str)
    {
        parent::__construct();
        
        $this->current_limit = $current_limit;
	#echo "\$this->current_limit: $this->current_limit\n"; exit;
	
        if (preg_match('/^(?:\d+)(?: \d+)*$/', $limits_str)) {
            $this->limits = explode(' ', $limits_str);
        } else {
            throw new Exception('$limits_str must be like \'NUM[ NUM]*\'');
        }
        
        $this->set_attribute_str('name', 'limit_setting');
        $this->set_action($action);
        $this->set_attribute_str('method', 'GET');
        
        $select = new HTMLTags_Select();
        
        $select->set_attribute_str('name', 'limit');
        
        foreach ($this->limits as $limit) {
            $option = new HTMLTags_Option($limit);
            
            $option->set_attribute_str('value', $limit);
            
            $select->add_option($option);
        }
        
        $select->set_value($this->current_limit);
        
        $this->append_tag_to_content($select);
        
        foreach ($this->get_hidden_inputs() as $h_i) {
            $this->append_tag_to_content($h_i);
        }
        
        $submit = new HTMLTags_Input();
        $submit->set_attribute_str('type', 'submit');
        $submit->set_attribute_str('value', 'Go');
        
        $this->append_tag_to_content($submit);
        
        #$content->append_tag($p);
    }
    
    public function
        get_content()
    {
        $content = parent::get_content();
        
        foreach ($this->get_hidden_inputs() as $h_i) {
            $content->append_tag($h_i);
        }
        
        return $content;
    }
}
?>
