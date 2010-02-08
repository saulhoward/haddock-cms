<?php
/**
 * HTMLTags_SelectFactory
 *
 * @copyright Clear Line Web Design, 2007-09-21
 */

class
	HTMLTags_SelectFactory
{
    public static function
        make_select_for_str_array($strings)
    {
        $select = new HTMLTags_Select();
        
        foreach ($strings as $str) {
            $option = new HTMLTags_Option($str);
            
            $option->set_attribute_str('value', $str);
            
            $select->add_option($option);
        }
        
        return $select;
    }
    
    public static function
        make_select_for_str($str, $separator = ' ')
    {
        return self::make_select_for_str_array(explode($separator, $str));
    }
}
?>
