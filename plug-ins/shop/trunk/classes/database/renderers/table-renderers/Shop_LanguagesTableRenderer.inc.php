<?php
/**
 * Shop_languagesTableRenderer
 *
 * @copyright Clear Line Web Design, 2007-04-09
 */

require_once PROJECT_ROOT
    . '/haddock/database/classes/renderers/'
    . 'Database_TableRenderer.inc.php';
    
require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_UL.inc.php';

class
    Shop_languagesTableRenderer
extends
    Database_TableRenderer
{
   public function get_language_adding_form(
                                HTMLTags_URL $redirect_script_url,
                                HTMLTags_URL $cancel_url
                                )
    {
        $languages_table = $this->get_element();
        
        $language_adding_form = new HTMLTags_SimpleOLForm('language_adding');
        
        $language_adding_form->set_action($redirect_script_url);
        
        $language_adding_form->set_legend_text('Add a language');
       
        /*
         * The name
         */
        $name_field = $languages_table->get_field('name');
            
        $name_field_renderer = $name_field->get_renderer();
            
        $input_tag = $name_field_renderer->get_form_input();
        
        $input_tag->set_attribute_str('id', 'name');
        
        $language_adding_form->add_input_tag(
            'name',
            $input_tag
        );        
        
        /*
         * The iso_639_1_code
         */
        $iso_639_1_code_field = $languages_table->get_field('iso_639_1_code');
            
        $iso_639_1_code_field_renderer = $iso_639_1_code_field->get_renderer();
            
        $input_tag = $iso_639_1_code_field_renderer->get_form_input();
        
        $input_tag->set_attribute_str('id', 'iso_639_1_code');
        
        $language_adding_form->add_input_tag(
            'iso_639_1_code',
	    $input_tag,
	    'ISO 639-1 code'
        );

       /*
         * The add button.
         */
        $language_adding_form->set_submit_text('Add');
        
        $language_adding_form->set_cancel_location($cancel_url);
        
        return $language_adding_form;
    }
}
?>
