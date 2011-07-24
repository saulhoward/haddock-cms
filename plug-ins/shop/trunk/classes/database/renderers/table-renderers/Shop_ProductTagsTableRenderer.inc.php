<?php
/**
 * Shop_ProductTagsTableRenderer
 *
 * @copyright Clear Line Web Design, 2007-03-05
 */
    
class
    Shop_ProductTagsTableRenderer
extends
    Database_TableRenderer
{
    public function
        get_tag_cloud_div($current_url, $javascript = FALSE)
    {
        $tags_table = $this->get_element();
        #$database = $productgraph_row->get_database();
        #$tags_table = $database->get_table('hpi_shop_product_tags');
                                
        #$productgraph_row = $productgraphs_table->get_row_by_id($_GET['productgraph_id']);
        #$database = $productgraph_row->get_database();
        
        $tag_cloud_div = new HTMLTags_Div();
        $tag_cloud_div->set_attribute_str('id', 'tag_cloud_div');
        
        $tag_cloud_heading = new HTMLTags_Heading(3);
        $tag_cloud_heading->append_str_to_content('All Tags');
        
        $tag_cloud_div->append_tag_to_content($tag_cloud_heading);
        
        $tag_cloud_list = new HTMLTags_OL();
        
        $tags = $tags_table->get_tags_with_counts(
            'hpi_shop_product_tags.tag',
            'ASC'
        );
        
        foreach ($tags as $tag) {
            $tag_cloud_line = new HTMLTags_LI();
            
	    $tag_cloud_href = clone $current_url;
	    $tag_cloud_href->set_get_variable('tag_id', $tag->get_id());
            
            $tag_cloud_link = new HTMLTags_A();
            $tag_cloud_link->set_href($tag_cloud_href);
            $tag_cloud_link->set_attribute_str('id', $tag->get_id());
            
            if ($javascript) {
                $onclick = 'javascript:return tagsOnClick(this);';
                $tag_cloud_link->set_attribute_str('onclick', $onclick);
            }
            
            #tag_cloud_link->set_attribute_str('id', 'productgraph_page_link');
            
            #echo $tag->get_product_count();
            
            /*
             * RFI 2007-03-27
             * 
             * Is this the right way around?
             *
             * Aren't tags with a lower product count less popular?
             */
            #if ($tag->get_product_count() > 3) {
            #    $tag_cloud_link->set_attribute_str('class', 'not-very-popular');
            #}
            $popularity_css_class = $tag->get_popularity_css_class();
            
            #echo "\$popularity_css_class: $popularity_css_class\n\n";
            
            $tag_cloud_link->set_attribute_str(
                'class',
                $popularity_css_class
            );
            
            $tag_cloud_link->set_attribute_str('rel', 'tag');
                
                $tag_product_count = $tag->get_product_count();
                if ($tag_product_count == 1) {
                        $tag_product_count_span_text =  $tag_product_count . ' product is tagged with ';
                } else {
                        $tag_product_count_span_text =  $tag_product_count . ' products are tagged with ';
                }
            $tag_cloud_link_span = new HTMLTags_Span($tag_product_count_span_text);
        
            $tag_cloud_link->append_tag_to_content($tag_cloud_link_span);
            $tag_cloud_link->append_str_to_content($tag->get_tag());
            
            $tag_cloud_line->append_tag_to_content($tag_cloud_link);

            $tag_cloud_list->append_tag_to_content($tag_cloud_line);
        }

        $tag_cloud_div->append_tag_to_content($tag_cloud_list);  
        return $tag_cloud_div;
    }

	public function
        get_product_tag_adding_form(
            HTMLTags_URL $redirect_script_url,
            HTMLTags_URL $cancel_url
        )
	{
		$product_tags_table = $this->get_element();

		$product_tag_adding_form = new HTMLTags_SimpleOLForm('product_tag_adding');

		$product_tag_adding_form->set_action($redirect_script_url);

		$product_tag_adding_form->set_legend_text('Add a product tag');

		/*
		 * The tag
		 */
		$tag_field = $product_tags_table->get_field('tag');

		$tag_field_renderer = $tag_field->get_renderer();

		$input_tag = $tag_field_renderer->get_form_input();

		$input_tag->set_attribute_str('id', 'tag');

		$product_tag_adding_form->add_input_tag(
			'tag',
			$input_tag
		);        

		/*
		 * The principal
		 */
		$principal_field = $product_tags_table->get_field('principal');

		$principal_field_renderer = $principal_field->get_renderer();

		$input_tag = $principal_field_renderer->get_form_input();

		$input_tag->set_attribute_str('id', 'principal');

		$product_tag_adding_form->add_input_tag(
			'principal',
			$input_tag
		);
		/*
		 * The add button.
		 */
		$product_tag_adding_form->set_submit_text('Add');

		$product_tag_adding_form->set_cancel_location($cancel_url);

		return $product_tag_adding_form;
	}

	public function
		get_public_tag_selection_div($tag_str)
	{
		$product_tags_table = $this->get_element();
		
		#$product_tag_row = $product_tags_table->get_tag($tag_str);
		#$product_tag_row_renderer = $product_tag_row[0]->get_renderer();
		
		$product_tag_row = $product_tags_table->get_single_tag($tag_str);
		$product_tag_row_renderer = $product_tag_row->get_renderer();
		
		return $product_tag_row_renderer->get_public_tag_selection_div();
	}
}
?>