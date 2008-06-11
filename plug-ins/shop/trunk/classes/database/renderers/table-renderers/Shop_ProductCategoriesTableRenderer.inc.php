<?php
/**
 * Shop_ProductCategoriesTableRenderer
 *
 * @copyright Clear Line Web Design, 2007-04-09
 */

require_once PROJECT_ROOT
    . '/haddock/database/classes/renderers/'
    . 'Database_TableRenderer.inc.php';

class
    Shop_ProductCategoriesTableRenderer
extends
    Database_TableRenderer
{
   public function
      get_product_category_adding_form(
         HTMLTags_URL $redirect_script_url,
         HTMLTags_URL $cancel_url
      )
    {
        $product_categories_table = $this->get_element();
        
        $product_category_adding_form = new HTMLTags_SimpleOLForm('product_category_adding');
        
        $product_category_adding_form->set_action($redirect_script_url);
        
        $product_category_adding_form->set_legend_text('Add a product_category');
       
        /*
         * The name
         */
        $name_field = $product_categories_table->get_field('name');
            
        $name_field_renderer = $name_field->get_renderer();
            
        $input_tag = $name_field_renderer->get_form_input();
        
        $input_tag->set_attribute_str('id', 'name');
        
        $product_category_adding_form->add_input_tag(
            'name',
            $input_tag
        );        
        
        /*
         * The description
         */
        $description_field = $product_categories_table->get_field('description');
            
        $description_field_renderer = $description_field->get_renderer();
            
        $input_tag = $description_field_renderer->get_form_input();
        
        $input_tag->set_attribute_str('id', 'description');
        
        $product_category_adding_form->add_input_tag(
            'description',
	    $input_tag
        );
 
        /*
         * The sort_order
         */
        $sort_order_field = $product_categories_table->get_field('sort_order');
            
        $sort_order_field_renderer = $sort_order_field->get_renderer();
            
        $input_tag = $sort_order_field_renderer->get_form_input();
        
        $input_tag->set_attribute_str('id', 'sort_order');
        
        $product_category_adding_form->add_input_tag(
            'sort_order',
            $input_tag
        );        

        /*
         * The add button.
         */
        $product_category_adding_form->set_submit_text('Add');
        
        $product_category_adding_form->set_cancel_location($cancel_url);
        
        return $product_category_adding_form;
    }

   public function
	   get_active_product_categories_ul_in_public()
   {
        $product_categories_table = $this->get_element();
        $product_categories
            = $product_categories_table->get_active_product_categories();

        $product_categories_ul = new HTMLTags_UL();
        
        foreach ($product_categories as $product_category) {
            $product_category_renderer = $product_category->get_renderer();
            $product_categories_ul
                ->append_tag_to_content(
                    $product_category_renderer
                        ->get_product_category_li_in_public()
                );
        }
        
        return $product_categories_ul;
    }
   
   //public function
   //   get_admin_product_categories_selection_html_table(
   //         $url,
   //         $direction,
   //         $order_by,
   //         $limit,
   //         $offset
   //     )
   // {
   //     $table = $this->get_element();
   //     
   //     $field_objs = array();
   //     foreach (explode(' ', 'name description sort_order') as $field_str) {
   //         $field_objs[] = $table->get_field($field_str);
   //     }
   //     
   //     $fields = array();
   //     foreach ($field_objs as $field_obj) {
   //         $field['sortable'] = TRUE;
   //         
   //         $field['name'] = $field_obj->get_name();
   //         
   //         $field['method'] = 'get_data_html_table_td';
   //         
   //         $method_args = array();
   //         $method_args[] = $field_obj;
   //         $field['method_args'] = $method_args;
   //         
   //         $fields[] = $field;
   //     }
   //     
   //     $actions = array();
   //
   //     $edit_action['th'] = new HTMLTags_TH('Edit');
   //     $edit_action['method'] = 'get_admin_database_tr_action_edit_td';
   //
   //     $actions[] = $edit_action;
   //
   //     $delete_action['th'] = new HTMLTags_TH('Delete');
   //     $delete_action['method'] = 'get_admin_database_tr_action_delete_td';
   //
   //     $actions[] = $delete_action;
   //     
   //     #print_r($actions);
   //     
   //     if (!isset($caption)) {
   //         $caption = 'Data in the ' . $table->get_name() . ' table';
   //     }
   //     
   //     return new Database_SelectionHTMLDiv(
   //         $url,
   //         $table,
   //         $direction,
   //         $order_by,
   //         $limit,
   //         $offset,
   //         $limit_str = '10 20 50',
   //         $caption,
   //         'table_pages_div',
   //         'table_pages',
   //         $fields,
   //         $actions
   //     );
   // }
   
    public function
        get_shop_plug_in_admin_actions($location)
    {
        $actions = array();
    
        $edit_action['th'] = new HTMLTags_TH('Edit');
        $edit_action['method'] = 'get_shop_plug_in_edit_td';
        
        $method_args = array();
        $method_args[] = $location;
        #$method_args = array('foo' => 'bar');
        #$method_args0 = array('foo' => 'bar');
        
        //echo 'print_r($method_args): ' . "\n";
        //print_r($method_args);
        
        #$edit_action['method_args'] = clone $method_args;
        #$edit_action['method_args'] = clone $method_args0;
        $edit_action['method_args'] = $method_args;
        
        $actions[] = $edit_action;
        
        $delete_action['th'] = new HTMLTags_TH('Delete');
        $delete_action['method'] = 'get_shop_plug_in_delete_td';
        
        #$delete_action['method_args'] = clone $method_args;
        $delete_action['method_args'] = $method_args;
        
        $actions[] = $delete_action;
        
        return $actions;
    }
}
?>
