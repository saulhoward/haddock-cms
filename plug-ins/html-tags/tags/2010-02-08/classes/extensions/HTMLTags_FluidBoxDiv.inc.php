<?php
/**
 * HTMLTags_FluidBoxDiv
 *
 * @copyright Clear Line Web Design, 2006-11-29
 */

#require_once PROJECT_ROOT
#    . '/haddock/html-tags/classes/standard/'
#    . 'HTMLTags_Div.inc.php';

class
    HTMLTags_FluidBoxDiv
extends
    HTMLTags_Div
{
    public function
        __construct(HTMLTags_Tag $fluid_box_content, $style = 'text_box')
    {
        parent::__construct();
            
            $this->set_attribute_str('class', 'dialog_black');
            $this->set_attribute_str('id', $style);

            $fluid_box_hd = new HTMLTags_Div();
                $fluid_box_hd->set_attribute_str('class', 'hd');
                
            $fluid_box_hd_c = new HTMLTags_Div();
                $fluid_box_hd_c->set_attribute_str('class', 'c');
                
            $fluid_box_hd->append_tag_to_content($fluid_box_hd_c);
            
            $this->append_tag_to_content($fluid_box_hd);
            
            $fluid_box_bd = new HTMLTags_Div();
                $fluid_box_bd->set_attribute_str('class', 'bd');
                
            $fluid_box_c = new HTMLTags_Div();
                $fluid_box_c->set_attribute_str('class', 'c');
                
            $fluid_box_s = new HTMLTags_Div();
                $fluid_box_s->set_attribute_str('class', 's');
                
            $fluid_box_s->append_tag_to_content($fluid_box_content);
            
            $fluid_box_c->append_tag_to_content($fluid_box_s);
            
            $fluid_box_bd->append_tag_to_content($fluid_box_c);
            
            $this->append_tag_to_content($fluid_box_bd);
            
            $fluid_box_ft = new HTMLTags_Div();
                $fluid_box_ft->set_attribute_str('class', 'ft');
                
            $fluid_box_ft_c = new HTMLTags_Div();
                $fluid_box_ft_c->set_attribute_str('class', 'c');
                
            $fluid_box_ft->append_tag_to_content($fluid_box_ft_c);
            
            $this->append_tag_to_content($fluid_box_ft);

            return $this;

    }
}
?>
