<?php
/**
 * Shop_ProductsTableRenderer
 *
 * @copyright Clear Line Web Design, 2007-04-09
 */

class
	Shop_ProductsTableRenderer
extends
	Database_TableRenderer
{
	public function
        get_all_products_ul_in_public()
	{
		$products_table = $this->get_element();
		$database = $products_table->get_database();
		$customer_regions_table = $database->get_table('hpi_shop_customer_regions');

		/*
		 * What happens if this isn't set?
		 */
		$customer_region
			= $customer_regions_table
			->get_row_by_id($_SESSION['customer_region_id']);

		$products_ul = new HTMLTags_UL();

		$rows = $customer_region->get_active_products();

		#print_r($rows);

		foreach ($rows as $row) {
			$row_renderer = $row->get_renderer();

			$product_description_li = $row_renderer->get_product_description_li();
			$products_ul->append_tag_to_content($product_description_li);
		}

		return $products_ul;
	}

	public function
        get_products_for_product_category_ul_in_public($product_category_id)
	{
		$products_table = $this->get_element();
		$database = $products_table->get_database();
		$customer_regions_table = $database->get_table('hpi_shop_customer_regions');
		$customer_region = $customer_regions_table->get_row_by_id($_SESSION['customer_region_id']);

		$products_ul = new HTMLTags_UL();

		$rows = $customer_region->get_active_products_for_product_category($product_category_id);
		#print_r($rows);
		foreach ($rows as $row) {
			$row_renderer = $row->get_renderer();

			$product_description_li = $row_renderer->get_product_description_li();
			$products_ul->append_tag_to_content($product_description_li);
		}

		return $products_ul;
	}

	public function
        get_products_for_product_category_and_tag_ul_in_public($product_category_id, $tag)
	{
		$products_table = $this->get_element();
		$database = $products_table->get_database();
		$customer_regions_table = $database->get_table('hpi_shop_customer_regions');
		$customer_region = $customer_regions_table->get_row_by_id($_SESSION['customer_region_id']);

		$products_ul = new HTMLTags_UL();

		$rows = $customer_region->get_active_products_for_product_category_and_tag($product_category_id, $tag);
		#print_r($rows);
		foreach ($rows as $row) {
			$row_renderer = $row->get_renderer();

			$product_description_li = $row_renderer->get_product_description_li();
			$products_ul->append_tag_to_content($product_description_li);
		}

		return $products_ul;
	}
	
	/**
	 * This takes a space separated list of tags and returns
	 * a UL containing the products that have been tagged that way.
	 *
	 * For example, products that should be displayed on the front page
	 * might get tagged 'front_page'.
	 */
	public function
        get_products_for_product_tags_ul_in_public($product_tags_space_separated_str)
	{
		$products_table = $this->get_element();
		
		$database = $products_table->get_database();
		$product_tags_table = $database->get_table('hpi_shop_product_tags');
		
		$already_displayed_products = array();

		$products_ul = new HTMLTags_UL();
		$products_ul->set_attribute_str('id', 'products');

		$product_tags_strs = $products_table->explode_tags($product_tags_space_separated_str);
		
		#print_r($product_tags_strs); exit;
		
		foreach ($product_tags_strs as $product_tag_str)
		{
			$conditions['tag'] = $product_tag_str;
			$product_tags = array();
			$product_tags = $product_tags_table->get_rows_where($conditions);
			
			#print_r($product_tags); exit;
			
			if (count($product_tags) > 0) {
				$products = $product_tags[0]->get_product_rows();
				
				#print_r($products); exit;
				
				foreach ($products as $product)
				{
					if ($product->is_active())
					{
						$already_displayed = FALSE;

						foreach ($already_displayed_products as $already_displayed_product)
						{
							if (
								($product->get_id() 
								== $already_displayed_product->get_id())
								||
								($product->get_style_id() 
								== $already_displayed_product->get_style_id())
							)
							{
								$already_displayed = TRUE;
							}
						}

						if ($already_displayed == FALSE)
						{
							$product_renderer = $product->get_renderer();

							$product_description_li = 
								$product_renderer->get_product_description_li();

							$product_description_li->set_attribute_str('id', 'product');
							$products_ul->append_tag_to_content($product_description_li);
							$already_displayed_products[] = $product;
						}
					} else {
						#echo "Inactive\n";
					}
				}
				
				#exit;
			}
		}
		
		return $products_ul;
	}

	public function
        get_product_adding_form(
            HTMLTags_URL $redirect_script_url,
            HTMLTags_URL $cancel_url
        )
	{
		$products_table = $this->get_element();

		$product_adding_form = new HTMLTags_SimpleOLForm('product_adding');

		$product_adding_form->set_action($redirect_script_url);

		$product_adding_form->set_legend_text('Add a product');

		# The Fields:
		#             $name, $description,   $shipping_category_id, $photograph_id,    $price,    $status

		/*
		 * The name
		 */
		$name_field = $products_table->get_field('name');

		$name_field_renderer = $name_field->get_renderer();

		$input_tag = $name_field_renderer->get_form_input();

		$input_tag->set_attribute_str('id', 'name');

		$product_adding_form->add_input_tag(
			'name',
			$input_tag
		);        

		/*
		 * The description
		 */
		$description_field = $products_table->get_field('description');

		$description_field_renderer = $description_field->get_renderer();

		$input_tag = $description_field_renderer->get_form_input();

		$input_tag->set_attribute_str('id', 'description');

		$product_adding_form->add_input_tag(
			'description',
			$input_tag
		);

		/*
		 * The main_photograph_id
		 */
		$main_photograph_li = $this->get_main_photograph_form_radio_li();
		$product_adding_form->add_input_li($main_photograph_li);       

		/*
		 * The design_photograph_id
		 */
		$design_photograph_li = $this->get_design_photograph_form_radio_li();
		$product_adding_form->add_input_li($design_photograph_li);       

		/*
		 * The extra_photograph_id
		 */
		$extra_photograph_li = $this->get_extra_photograph_form_checkbox_li();
		$product_adding_form->add_input_li($extra_photograph_li);       

		/*
		 * The product_category_id
		 */
		$product_category_li = $this->get_product_category_form_select_li();
		$product_adding_form->add_input_li($product_category_li);       

		/*
		 * The product_brand_id
		 */
		$product_brand_li = $this->get_product_brand_form_select_li();
		$product_adding_form->add_input_li($product_brand_li);       


		/*
		 * The supplier_id
		 */
		$supplier_li = $this->get_supplier_form_select_li();
		$product_adding_form->add_input_li($supplier_li);       

//                /*
//                 * The status
//                 */
//                $status_field = $products_table->get_field('status');
//                $status_field_renderer = $status_field->get_renderer();
//                $input_tag = $status_field_renderer->get_form_input();
//                $input_tag->set_attribute_str('id', 'status');
//                $product_adding_form->add_input_tag(
//                        'status',
//                        $input_tag
//                );

		/*
		 * The Principal Tags
		 */
		$input_li = $this->get_principal_tag_form_checkbox_li();
		$product_adding_form->add_input_li($input_li);

		/* 
		 * The Price Lis
		 */
		$input_lis = $this->get_price_form_input_lis();
		foreach ($input_lis as $input_li)
		{
			$product_adding_form->add_input_li($input_li);
		}


		/*
		 * The use_stock_level
		 */
		$use_stock_level_field = $products_table->get_field('use_stock_level');
		$use_stock_level_field_renderer = $use_stock_level_field->get_renderer();
		$input_tag = $use_stock_level_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'use_stock_level');
		$product_adding_form->add_input_tag(
			'use_stock_level',
			$input_tag
		);

		/*
		 * The sort_order
		 */
		$sort_order_field = $products_table->get_field('sort_order');
		$sort_order_field_renderer = $sort_order_field->get_renderer();
		$input_tag = $sort_order_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'sort_order');
		$product_adding_form->add_input_tag(
			'sort_order',
			$input_tag
		);

		/*
		 * The add button.
		 */
		$product_adding_form->set_submit_text('Add');

		$product_adding_form->set_cancel_location($cancel_url);

		return $product_adding_form;
	}

	public function
		get_price_form_input_lis()
	{
		$products_table = $this->get_element();
		$database = $products_table->get_database();
		$currencies_table = $database->get_table('hpi_shop_currencies');
		$product_currency_prices_table = $database->get_table('hpi_shop_product_currency_prices');

		$currencies = $currencies_table->get_all_rows();

		$input_lis = array();

		foreach ($currencies as $currency)
		{
			/*
			 * The price
			 */
//                        $conditions = array();
//                        $conditions['product_id'] = $product->get_id();
//                        $conditions['currency_id'] = $currency->get_id();

//                        $product_currency_price = $product_currency_prices_table->get_rows_where($conditions);
//                        if (count($product_currency_price) > 0)
//                        {
//                                $current_price = $product_currency_price[0]->get_price();
//                        }
//                        else
//                        {
//                                $current_price = 0;
//                        }

			$current_price = 0;
			$input_li = new HTMLTags_LI();
			$input_label_text = '';
			$input_label_text .= 'Price in&nbsp;';
			$input_label_text .= $currency->get_name();
			$input_label_text .= '&nbsp;(';
			$input_label_text .= $currency->get_symbol();
			$input_label_text .= ')';

			$input_label_title = 'price_';
			$input_label_title .= $currency->get_id();
				
			$input_label = new HTMLTags_Label($input_label_text);
			$input_label->set_attribute_str('for', $input_label_title);

			$input_li->append_tag_to_content($input_label);

			$input = new HTMLTags_Input();
			$input->set_attribute_str('type', 'text');
			$input->set_attribute_str('name', $input_label_title);
			$input->set_value($current_price);

			$input_li->append_tag_to_content($input);

			$input_lis[] = $input_li;
		}


		return $input_lis;
	}

	public function
		get_principal_tag_form_checkbox_li()
	{
		$products_table = $this->get_element();

		$database = $products_table->get_database();
		$product_tags_table = $database->get_table('hpi_shop_product_tags');

		$input_li = new HTMLTags_LI();

		$input_label = new HTMLTags_Label('Tags');
		$input_label->set_attribute_str('for', 'principal_tag_id');

		$input_li->append_tag_to_content($input_label);

		$principal_tags = $product_tags_table->get_principal_tags();

		foreach ($principal_tags as $principal_tag) 
		{

			$input = new HTMLTags_Input();
			$input->set_attribute_str('type', 'checkbox');
			$input->set_attribute_str('name', 'tag_' . $principal_tag->get_id());
			$input->set_value($principal_tag->get_id());

			$input_li->append_tag_to_content($input);
			$input_li->append_str_to_content($principal_tag->get_tag());

//                        $input_li->append_tag_to_content(new HTMLTags_BR());
		}

		$input_msg_box = new HTMLTags_Span();
		$input_msg_box->set_attribute_str('id', 'principal_tag_id' . 'msg');
		$input_msg_box->set_attribute_str('class', 'rules');

		$input_li->append_tag_to_content($input_msg_box);

		return $input_li;
	}	


	public function
		get_product_category_form_select_li()
	{
		$input_li = new HTMLTags_LI();

		$input_label = new HTMLTags_Label('Product Category');
		$input_label->set_attribute_str('for', 'product_category_id');

		$input_li->append_tag_to_content($input_label);

		$input_li->append_tag_to_content($this->get_product_category_form_select());

		$input_msg_box = new HTMLTags_Span();
		$input_msg_box->set_attribute_str('id', 'product_category_id' . 'msg');
		$input_msg_box->set_attribute_str('class', 'rules');

		$input_li->append_tag_to_content($input_msg_box);

		return $input_li;
	}	

	public function
		get_product_category_form_select($selected_value = NULL)
	{
		$products_table = $this->get_element();
		$database = $products_table->get_database();
		$product_categories_table = $database->get_table('hpi_shop_product_categories');
		$product_categories = $product_categories_table->get_all_rows();

		$select = new HTMLTags_Select();
		$select->set_attribute_str('name', 'product_category_id');

		foreach ($product_categories as $product_category) 
		{
			$option = new HTMLTags_Option($product_category->get_name());
			$option->set_attribute_str('value', $product_category->get_id());
			$select->add_option($option);
			if (isset($selected_value) && $selected_value == $product_category->get_id())
			{
				$option->set_attribute_str('selected');
			}
		}

		return $select;
	}

	public function
		get_supplier_form_select_li()
	{
		$input_li = new HTMLTags_LI();

		$input_label = new HTMLTags_Label('Supplier');
		$input_label->set_attribute_str('for', 'supplier_id');

		$input_li->append_tag_to_content($input_label);

		$input_li->append_tag_to_content($this->get_supplier_form_select());

		$input_msg_box = new HTMLTags_Span();
		$input_msg_box->set_attribute_str('id', 'supplier_id' . 'msg');
		$input_msg_box->set_attribute_str('class', 'rules');

		$input_li->append_tag_to_content($input_msg_box);

		return $input_li;
	}	

	public function
		get_supplier_form_select()
	{
		$products_table = $this->get_element();
		$database = $products_table->get_database();
		$suppliers_table = $database->get_table('hpi_shop_suppliers');
		$suppliers = $suppliers_table->get_all_rows();

		$select = new HTMLTags_Select();
		$select->set_attribute_str('name', 'supplier_id');

		foreach ($suppliers as $supplier) 
		{
			$address = $supplier->get_address();
			$supplier_text = '';
			$supplier_text .= $supplier->get_name();
			$supplier_text .= '&nbsp;(';
			$supplier_text .= $address->get_country_name();
			$supplier_text .= ')';

			$option = new HTMLTags_Option($supplier_text);
			$option->set_attribute_str('value', $supplier->get_id());
			$select->add_option($option);
		}

		return $select;
	}

	public function
		get_product_brand_form_select_li()
	{
		$input_li = new HTMLTags_LI();

		$input_label = new HTMLTags_Label('Product Brand');
		$input_label->set_attribute_str('for', 'product_brand_id');

		$input_li->append_tag_to_content($input_label);

		$input_li->append_tag_to_content($this->get_product_brand_form_select());

		$input_msg_box = new HTMLTags_Span();
		$input_msg_box->set_attribute_str('id', 'product_brand_id' . 'msg');
		$input_msg_box->set_attribute_str('class', 'rules');

		$input_li->append_tag_to_content($input_msg_box);

		return $input_li;
	}

	public function
		get_product_brand_form_select()
	{
		$products_table = $this->get_element();
		$database = $products_table->get_database();
		$product_brands_table = $database->get_table('hpi_shop_product_brands');
		$product_brands = $product_brands_table->get_all_rows();

		$select = new HTMLTags_Select();
		$select->set_attribute_str('name', 'product_brand_id');

		foreach ($product_brands as $product_brand) 
		{
			$option = new HTMLTags_Option($product_brand->get_name());
			$option->set_attribute_str('value', $product_brand->get_id());
			$select->add_option($option);
		}

		return $select;
	}


	public function
		get_main_photograph_form_radio_li()
	{
		$input_li = new HTMLTags_LI();

		$input_label = new HTMLTags_Label('Main Photograph');
		$input_label->set_attribute_str('for', 'main_photograph_id');

		$input_li->append_tag_to_content($input_label);

		$products_table = $this->get_element();
		$database = $products_table->get_database();
		$photographs_table = $database->get_table('hpi_shop_photographs');
		$photographs = $photographs_table->get_all_rows();

		foreach ($photographs as $photograph) 
		{
			$photograph_renderer = $photograph->get_renderer();
			$input = new HTMLTags_Input();
			$input->set_attribute_str('type', 'radio');
			$input->set_attribute_str('name', 'main_photograph_id');
			$input->set_value($photograph->get_id());
			$input_li->append_tag_to_content($input);
			$input_li->append_tag_to_content($photograph_renderer->get_thumbnail_img());
		}

		$input_msg_box = new HTMLTags_Span();
		$input_msg_box->set_attribute_str('id', 'main_photograph_id' . 'msg');
		$input_msg_box->set_attribute_str('class', 'rules');

		$input_li->append_tag_to_content($input_msg_box);

		return $input_li;
	}	

	public function
		get_design_photograph_form_radio_li()
	{
		$input_li = new HTMLTags_LI();

		$input_label = new HTMLTags_Label('Design Photograph');
		$input_label->set_attribute_str('for', 'design_photograph_id');

		$input_li->append_tag_to_content($input_label);

		$products_table = $this->get_element();
		$database = $products_table->get_database();
		$photographs_table = $database->get_table('hpi_shop_photographs');
		$photographs = $photographs_table->get_all_rows();

		foreach ($photographs as $photograph) 
		{
			$photograph_renderer = $photograph->get_renderer();
			$input = new HTMLTags_Input();
			$input->set_attribute_str('type', 'radio');
			$input->set_attribute_str('name', 'design_photograph_id');
			$input->set_value($photograph->get_id());
			$input_li->append_tag_to_content($input);
			$input_li->append_tag_to_content($photograph_renderer->get_thumbnail_img());
		}

		$input_msg_box = new HTMLTags_Span();
		$input_msg_box->set_attribute_str('id', 'design_photograph_id' . 'msg');
		$input_msg_box->set_attribute_str('class', 'rules');

		$input_li->append_tag_to_content($input_msg_box);

		return $input_li;
	}	

	public function
		get_extra_photograph_form_checkbox_li()
	{
		$input_li = new HTMLTags_LI();

		$input_label = new HTMLTags_Label('Extra Photographs');
		$input_label->set_attribute_str('for', 'extra_photograph_id');

		$input_li->append_tag_to_content($input_label);

		$products_table = $this->get_element();
		$database = $products_table->get_database();
		$photographs_table = $database->get_table('hpi_shop_photographs');
		$photographs = $photographs_table->get_all_rows();

		foreach ($photographs as $photograph) 
		{
			$photograph_renderer = $photograph->get_renderer();
			$input = new HTMLTags_Input();
			$input->set_attribute_str('type', 'checkbox');
			$input->set_attribute_str('name', 'extra_photograph_id_' . $photograph->get_id());
			$input->set_value($photograph->get_id());
			$input_li->append_tag_to_content($input);
			$input_li->append_tag_to_content($photograph_renderer->get_thumbnail_img());
		}

		$input_msg_box = new HTMLTags_Span();
		$input_msg_box->set_attribute_str('id', 'extra_photograph_id' . 'msg');
		$input_msg_box->set_attribute_str('class', 'rules');

		$input_li->append_tag_to_content($input_msg_box);

		return $input_li;
	}
	
	/**
	 * Shows the details of a product:
	 *
	 * 	- Price
	 * 	- Date added
	 * 	- Available stock.
	 */
	public static function
		render_product_details_ul(
			$price,
			$added,
			$quantity
		)
	{
?>
<ul>
	<li>
		<span class="price">
			&pound;<?php printf("%.2f\n", $price / 100); ?>
		</span>
	</li>
<?php
$added_ts = strtotime($added);
?>
<!--	<li>
		Listed:&nbsp;
		<abbr
			class="dtlisted"
			title="<?php echo date("Ymd", $added_ts); ?>"
		><?php echo date("j M, Y", $added_ts); ?></abbr>
	</li> -->
	<li><span class="availability" ><?php
if ($quantity > 0) {
	echo (int)$quantity . " in stock";
} else {
	echo "Out of Stock\n";
}
?></span></li>
</ul>
<?php
	}
	
	/**
	 * Shows a lot of data for a product.
	 *
	 * Used:
	 * 	- In the search results page.
	 */
	public static function
		render_full_product_div(
			$name,
			$product_page_href,
			$medium_size_image_id,
			$medium_size_image_file_type,
			$price,
			$added,
			$quantity
		)
	{
?>
<div
  class="hlisting offer-sale list-item"
>
	<div
	  class="summary"
	>
		<a
		  class="summary-link"
		  href="<?php echo $product_page_href; ?>"
		><?php echo $name; ?></a>
	</div>
	<div
	  class="description"
	>
		<a
			class="img-link"
			href="<?php echo $product_page_href; ?>"
		>
<?php
if (isset($medium_size_image_id)) {
	Database_ImagesTableRenderer::render_hc_database_img(
		$medium_size_image_id,
		$medium_size_image_file_type
	);
} else {
?>
		<img src="/plug-ins/shop/public-html/images/no-image-available-medium.png" />
<?php
}
?>
		</a>
	</div>
	<div class="details">
	<?php self::render_product_details_ul($price, $added, $quantity); ?>
	</div>
</div>
<?php
	}
	public static function
		get_full_product_div(
			$name,
			$product_page_href,
			$medium_size_image_id,
			$medium_size_image_file_type,
			$price,
			$added,
			$quantity
		)
	{
		$html = '';
		$html .= <<<HTML
<div
  class="hlisting offer-sale list-item"
>
	<div
	  class="summary"
	>
		<a
		  class="summary-link"
		  href="$product_page_href"
		>$name</a>
	</div>
	<div
	  class="description"
	>
		<a
			class="img-link"
			href="$product_page_href"
		>
HTML;

if (isset($medium_size_image_id)) {
	$html .= Database_ImagesHelper::get_img($medium_size_image_id)->get_as_string();
} else {
		$html .= <<<HTML
		<img src="/plug-ins/shop/public-html/images/no-image-available-medium.png" />
HTML;

}

		$html .= <<<HTML
		</a>
	</div>
	<div class="details">
HTML;

		$html .= self::get_product_details_ul($price, $added, $quantity);
		$html .= <<<HTML
	</div>
</div>
HTML;

		return $html;
	}
	/**
	 * Shows the details of a product:
	 *
	 * 	- Price
	 * 	- Date added
	 * 	- Available stock.
	 */
	public static function
		get_product_details_ul(
			$price,
			$added,
			$quantity
		)
	{
		$html = '';
		$html .= <<<HTML
<ul>
	<li>
		<span class="price">
			&pound;
HTML;

		$html .= sprintf("%.2f\n", $price / 100);
		$html .= <<<HTML
		</span>
	</li>
	<li><span class="availability" >
HTML;

		if ($quantity > 0) {
			$html .= (int)$quantity . " in stock";
		} else {
			$html .= "Out of Stock\n";
		}
		$html .= <<<HTML
</span></li>
</ul>
HTML;

		return $html;
	}
}
?>
