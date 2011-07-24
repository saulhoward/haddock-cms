<?php
/**
 * Shop_CurrencyRowRenderer.inc.php
 *
 * @copyright Clear Line Web Design, 2007-03-03
 */
    
class
    Shop_CurrencyRowRenderer
extends
    Database_RowRenderer
{
    public function
        get_admin_currencies_html_table_tr($current_page_url)
    {
        $html_row =  new HTMLTags_TR();
        
        $row = $this->get_element();
        
        $table = $row->get_table();
        
        /*
         * The data.
         */ 
	$name_field = $table->get_field('name');
        $name_td = $this->get_data_html_table_td($name_field);
        $html_row->append_tag_to_content($name_td);

         $iso_4217_code_field = $table->get_field('iso_4217_code');
        $iso_4217_code_td = $this->get_data_html_table_td($iso_4217_code_field);
        $html_row->append_tag_to_content($iso_4217_code_td);
        
       $symbol_field = $table->get_field('symbol');
        $symbol_td = $this->get_data_html_table_td($symbol_field);
        $html_row->append_tag_to_content($symbol_td);

            /*
             * The edit td.
             */
            $edit_td = new HTMLTags_TD();
            
            $edit_link = new HTMLTags_A('Edit');
            $edit_link->set_attribute_str('class', 'cool_button');
            $edit_link->set_attribute_str('id', 'edit_table_button');
           
	    $edit_location = clone $current_page_url;
            $edit_location->set_get_variable('edit_id', $row->get_id());
            
            $edit_link->set_href($edit_location);
            
            $edit_td->append_tag_to_content($edit_link);
            
            $html_row->append_tag_to_content($edit_td);
            
            /*
             * The delete td.
             */
            $delete_td = new HTMLTags_TD();
    
            $delete_link = new HTMLTags_A('Delete');
            $delete_link->set_attribute_str('class', 'cool_button');
            $delete_link->set_attribute_str('id', 'delete_table_button');
       
	    $delete_location = clone $current_page_url;
            $delete_location->set_get_variable('delete_id', $row->get_id());
    
            $delete_link->set_href($delete_location);
    
            $delete_td->append_tag_to_content($delete_link);
    
            $html_row->append_tag_to_content($delete_td);
            
        return $html_row;
    }
   
}
?>
