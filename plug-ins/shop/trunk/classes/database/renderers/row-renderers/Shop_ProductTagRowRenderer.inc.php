<?php
/**
 * Shop_ProductTagRowRenderer
 *
 * @copyright Clear Line Web Design, 2007-03-05
 */

class
	Shop_ProductTagRowRenderer
extends
	Database_RowRenderer
{
	//        public function
	//        get_thumbnails_tag_div($javascript = FALSE)
	//    {
	//                $tag_row = $this->get_element();
	//                #$database = $product_row->get_database();
	//                #$tags_table = $database->get_table('hpi_shop_product_tags');
	//                
	//                $thumbnails_tags_div = new HTMLTags_Div();
	//                $thumbnails_tags_div->set_attribute_str('id', 'thumbnail_tags_div');
	//                
	//                        $tagged_products = $tag_row->get_product_rows();

	//                        $thumbnails_div = new HTMLTags_Div();
	//                        $thumbnails_div->set_attribute_str('id', 'thumbnails_div');
	//                        
	//                        $tag_heading = new HTMLTags_Heading(3);
	//                        $tag_heading->set_attribute_str('class', 'main_tag_header');
	//                        $tag_heading->append_str_to_content($tag_row->get_tag());
	//                        $thumbnails_tags_div->append_tag_to_content($tag_heading);
	//                        
	//                        foreach ($tagged_products as $tagged_product) {
	//                                
	//                                $tagged_product_row_renderer = $tagged_product->get_renderer();
	//                                $thumbnail_img = $tagged_product_row_renderer
	//                                        ->get_thumbnail_img_with_drop_shadow_with_a_div($javascript);  
	//                                $thumbnails_div->append_tag_to_content($thumbnail_img);
	//                        }
	//                        
	//                        $thumbnails_tags_div->append_tag_to_content($thumbnails_div);
	//                
	//                return $thumbnails_tags_div;
	//    }

	public function
		get_tag_cloud_div($current_url, $javascript = FALSE)
	{
		$tag_row = $this->get_element();
		$database = $tag_row->get_database();
		$tags_table = $database->get_table('hpi_shop_product_tags');

		#$product_row = $products_table->get_row_by_id($_GET['product_id']);
		#$database = $product_row->get_database();

		$tag_cloud_div = new HTMLTags_Div();
		$tag_cloud_div->set_attribute_str('id', 'tag_cloud_div');

		$tag_cloud_list = new HTMLTags_OL();

		$tags = $tags_table->get_tags_with_counts();

		foreach ($tags as $tag) {

			$tag_cloud_line = new HTMLTags_LI();

			$tag_cloud_href = clone $current_url;
			$tag_cloud_href->set_get_variable('tag_id', $tag->get_id());

			$tag_cloud_link = new HTMLTags_A();
			$tag_cloud_link->set_href($tag_cloud_href);

			if ($javascript) {
				$onclick = 'javascript:return tagsOnClick(this);';
				$tag_cloud_link->set_attribute_str('onclick', $onclick);
			}

			#tag_cloud_link->set_attribute_str('id', 'product_page_link');

			#echo $tag->get_photo_count();

			if ($tag->get_photo_count() > 3) {
				$tag_cloud_link->set_attribute_str('class', 'ultra-popular');
			}

			$tag_cloud_link->set_attribute_str('rel', 'tag');

			$tag_cloud_link_span = new HTMLTags_Span();

			$tag_cloud_link->append_tag_to_content($tag_cloud_link_span);
			$tag_cloud_link->append_str_to_content($tag->get_tag());

			$tag_cloud_line->append_tag_to_content($tag_cloud_link);

			$tag_cloud_list->append_tag_to_content($tag_cloud_line);
		}

		$tag_cloud_div->append_tag_to_content($tag_cloud_list);  
		return $tag_cloud_div;
	}

	public function
		get_admin_product_tags_html_table_tr($redirect_script_url)
	{
		$html_row =  new HTMLTags_TR();

		$row = $this->get_element();

		$table = $row->get_table();

		/*
		 * The data.
		 */ 
		$tag_field = $table->get_field('tag');
		$tag_td = $this->get_data_html_table_td($tag_field);
		$html_row->append_tag_to_content($tag_td);

		$principal_field = $table->get_field('principal');
		$principal_td = $this->get_data_html_table_td($principal_field);
		$html_row->append_tag_to_content($principal_td);

		$no_of_products_td = $this->get_no_of_products_td();
		$html_row->append_tag_to_content($no_of_products_td);

		/*
		 * The toggle_principal_status td.
		 */

		$product_tag = $this->get_element();

		if ($product_tag->is_principal())
		{
			$toggle_principal_status_link = new HTMLTags_A('Make Normal');
		}
		else
		{
			$toggle_principal_status_link = new HTMLTags_A('Make Principal');
		}
		$toggle_principal_status_td = new HTMLTags_TD();

		$toggle_principal_status_link->set_attribute_str('class', 'cool_button');
		$toggle_principal_status_link->set_attribute_str('id', 'toggle_principal_status_table_button');

		$toggle_principal_status_location = clone $redirect_script_url;

		$toggle_principal_status_location->set_get_variable('toggle_principal_status');
		$toggle_principal_status_location->set_get_variable('product_tag_id', $row->get_id());

		$toggle_principal_status_link->set_href($toggle_principal_status_location);

		$toggle_principal_status_td->append_tag_to_content($toggle_principal_status_link);

		$html_row->append_tag_to_content($toggle_principal_status_td);

		return $html_row;
	}
	
	/**
	 * TO DO:
	 *
	 * Move functionality to the element class.
	 * Rewrite SQL to use '... COUNT(id) ...'
	 */
	public function
		get_no_of_products_td()
	{
		$product_tag = $this->get_element();
		$no_of_products = count($product_tag->get_product_rows());

		return new HTMLTags_TD($no_of_products);
	}

	/*
	 * ----------------------------------------
	 * Functions to do with the product selection drop down boxes.
	 * ----------------------------------------
	 */
	
	public function
		get_brand_select()
	{
		$product_tag = $this->get_element();
		$database = $product_tag->get_database();

		$product_brands_table = $database->get_table('hpi_shop_product_brands');
		$product_brands_table_renderer = $product_brands_table->get_renderer();
		
		$active_product_brands = $product_brands_table->get_active_product_brands_for_tag($product_tag);
		
		$select = new HTMLTags_Select();
		$select->set_attribute_str('name', 'product_brand_id');

		$description_option = new HTMLTags_Option('Browse Brands');
		$description_option->set_attribute_str('value', '');
		$select->add_option($description_option);

		foreach ($active_product_brands as $active_product_brand) 
		{
			$option = new HTMLTags_Option($active_product_brand->get_name());
			$option->set_attribute_str('value', $active_product_brand->get_id());
//                        if ($product->get_use_stock_level() == $active_product_brand->get_name())
//                        {
//                                $option->set_attribute_str('selected', 'selected');
//                        }
			$select->add_option($option);
		}

		return $select;
	}
	
	public function
		get_category_select()
	{
		$product_tag = $this->get_element();
		$database = $product_tag->get_database();

		$product_categories_table = $database->get_table('hpi_shop_product_categories');
		$product_categories_table_renderer = $product_categories_table->get_renderer();
		$active_product_categories = 
			$product_categories_table->get_active_product_categories_for_tag($product_tag);

		$select = new HTMLTags_Select();
		$select->set_attribute_str('name', 'product_category_id');

		$description_option = new HTMLTags_Option('Browse Products');
		$description_option->set_attribute_str('value', '');
		$select->add_option($description_option);

		foreach ($active_product_categories as $active_product_category) 
		{
			$option = new HTMLTags_Option($active_product_category->get_name());
			$option->set_attribute_str('value', $active_product_category->get_id());
//                        if ($product->get_use_stock_level() == $active_product_category->get_name())
//                        {
//                                $option->set_attribute_str('selected', 'selected');
//                        }
			$select->add_option($option);
		}

		return $select;
	}

	/**
	 * Little helper function that sets the GET vars for the results
	 * page of the selection criteria.
	 *
	 * The results page is the products page.
	 */
	private static function
		add_hidden_inputs_for_results_page_get_vars_to_tag_selection_form(HTMLTags_Form $form)
	{
		$form->add_hidden_input('section', 'plug-ins');
		$form->add_hidden_input('module', 'shop');
		$form->add_hidden_input('page', 'products');
		$form->add_hidden_input('type', 'html');
		
		/*
		 * Not really necessary because of the way references work
		 * but still...
		 */
		return $form;
	}
	
	/**
	 * Allows the customer to search for products by reducing the search
	 * criteria using select drop-downs.
	 *
	 * Used in:
	 * 	- The secondary navigation div.
	 *
	 * Changes:
	 * 	- RFI 2007-12-13
	 * 		Instead of going to separate pages for product categories and tags,
	 * 		the customer is taken to the products page where the selection criteria
	 * 		for products is constrained appropriately.
	 */
	public function
		get_public_tag_selection_div()
	{
		$product_tag = $this->get_element();
		$tag = $product_tag->get_tag();
		$div = new HTMLTags_Div();
		$div->set_attribute_str('id', $tag);
		$div->set_attribute_str('class', 'tag-selection');

		$heading = new HTMLTags_Heading(3, ucfirst($tag));

		$tag_link_href = new HTMLTags_URL();
		$tag_link_file = '/?section=plug-ins&module=shop&page=products&type=html&tag=' . $tag;
		$tag_link_href->set_file($tag_link_file);
		$tag_link = new HTMLTags_A();
		$tag_link->set_href($tag_link_href);

		$tag_link->append_tag_to_content($heading);
		$div->append_tag_to_content($tag_link);

		/*
		 * Brand Select Form
		 */
		$brand_form = new MashShop_TagSelectionForm();
		$brand_form->set_attribute_str('id', 'brand');

		#$brand_form->add_hidden_input('section', 'plug-ins');
		#$brand_form->add_hidden_input('module', 'shop');
		#$brand_form->add_hidden_input('page', 'product-brand');
		#$brand_form->add_hidden_input('type', 'html');
		
		$brand_form
			= self::add_hidden_inputs_for_results_page_get_vars_to_tag_selection_form(
				$brand_form
			);
		
		$brand_form->add_hidden_input('tag', $tag);

		$brand_action = new HTMLTags_URL();
		$brand_action->set_file('/');
		$brand_form->set_action($brand_action);
		$brand_form->set_attribute_str('name', 'brand');
		$brand_form->set_attribute_str('method', 'GET');

		$form_ul = new HTMLTags_UL();
		
		$brand_li = new HTMLTags_LI();
		
		$brand_label = new HTMLTags_Label('Brands:');
		$brand_label->set_attribute_str('for', 'product_brand_id');
		
		$brand_li->append_tag_to_content($brand_label);
		$brand_select_box = $this->get_brand_select();
		$brand_li->append_tag_to_content($brand_select_box);
		
		$form_ul->append_tag_to_content($brand_li);

		$submit_button = new HTMLTags_Input();
		$submit_button->set_attribute_str('type', 'submit');
		$submit_button->set_attribute_str('value', 'Go');
		$submit_button->set_attribute_str('class', 'submit');
		$submit_li = new HTMLTags_LI();
		$submit_li->append_tag_to_content($submit_button);
		$form_ul->append_tag_to_content($submit_li);

		$brand_form->append_tag_to_content($form_ul);
		$div->append_tag_to_content($brand_form);

		$clear_div = new HTMLTags_Div();
		$clear_div->set_attribute_str('style', 'clear:both;');
		$div->append_tag_to_content($clear_div);

		/*
		 * category Select Form
		 */
		$category_form = new MashShop_TagSelectionForm();
		$category_form->set_attribute_str('id', 'category');

		#$category_form->add_hidden_input('section', 'plug-ins');
		#$category_form->add_hidden_input('module', 'shop');
		#$category_form->add_hidden_input('page', 'product-category');
		#$category_form->add_hidden_input('type', 'html');
		
		$category_form
			= self::add_hidden_inputs_for_results_page_get_vars_to_tag_selection_form(
				$category_form
			);
		
		$category_form->add_hidden_input('tag', $tag);

		$category_action = new HTMLTags_URL();
		$category_action->set_file('/');
		$category_form->set_action($category_action);
		$category_form->set_attribute_str('name', 'category');
		$category_form->set_attribute_str('method', 'GET');

		$form_ul = new HTMLTags_UL();
		
		$category_li = new HTMLTags_LI();
		
		$category_label = new HTMLTags_Label('Products:');
		$category_label->set_attribute_str('for', 'product_category_id');
		
		$category_li->append_tag_to_content($category_label);
		
		$category_select_box = $this->get_category_select();
		$category_li->append_tag_to_content($category_select_box);
		
		$form_ul->append_tag_to_content($category_li);

		$submit_button = new HTMLTags_Input();
		$submit_button->set_attribute_str('type', 'submit');
		$submit_button->set_attribute_str('value', 'Go');
		$submit_button->set_attribute_str('class', 'submit');
		$submit_li = new HTMLTags_LI();
		$submit_li->append_tag_to_content($submit_button);
		$form_ul->append_tag_to_content($submit_li);

		$category_form->append_tag_to_content($form_ul);
		$div->append_tag_to_content($category_form);
		
		$div->append_tag_to_content($clear_div);

		return $div;
	}
}
?>
