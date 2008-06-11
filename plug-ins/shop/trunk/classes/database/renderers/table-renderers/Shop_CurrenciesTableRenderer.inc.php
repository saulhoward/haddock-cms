<?php
/**
 * Shop_CurrenciesTableRenderer
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
    Shop_CurrenciesTableRenderer
extends
    Database_TableRenderer
{
   public function get_currency_adding_form(
                                HTMLTags_URL $redirect_script_url,
                                HTMLTags_URL $cancel_url
                                )
    {
        $currencies_table = $this->get_element();
        
        $currency_adding_form = new HTMLTags_SimpleOLForm('currency_adding');
        
        $currency_adding_form->set_action($redirect_script_url);
        
        $currency_adding_form->set_legend_text('Add a currency');
        
        # The Fields:
            #             $name, $description,   $shipping_category_id, $photograph_id,    $price,    $status
        
        /*
         * The name
         */
        $name_field = $currencies_table->get_field('name');
            
        $name_field_renderer = $name_field->get_renderer();
            
        $input_tag = $name_field_renderer->get_form_input();
        
        $input_tag->set_attribute_str('id', 'name');
        
        $currency_adding_form->add_input_tag(
            'name',
            $input_tag
        );        
        
        /*
         * The iso_4217_code
         */
        $iso_4217_code_field = $currencies_table->get_field('iso_4217_code');
            
        $iso_4217_code_field_renderer = $iso_4217_code_field->get_renderer();
            
        $input_tag = $iso_4217_code_field_renderer->get_form_input();
        
        $input_tag->set_attribute_str('id', 'iso_4217_code');
        
        $currency_adding_form->add_input_tag(
            'iso_4217_code',
	    $input_tag,
	    'ISO 4217 code'
        );
        
        /*
         * The symbol
         */
        $symbol_field = $currencies_table->get_field('symbol');
            
        $symbol_field_renderer = $symbol_field->get_renderer();
            
        $input_tag = $symbol_field_renderer->get_form_input();
        
        $input_tag->set_attribute_str('id', 'symbol');
        
        $currency_adding_form->add_input_tag(
            'symbol',
            $input_tag
        );

        /*
         * The add button.
         */
        $currency_adding_form->set_submit_text('Add');
        
        $currency_adding_form->set_cancel_location($cancel_url);
        
        return $currency_adding_form;
    }
}
?>
