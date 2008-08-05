<?php
/**
 * Shop_ProductRowRenderer
 *
 * @copyright Clear Line Web Design, 2007-03-03
 */

class
	Shop_ProductRowRenderer
extends
	Database_RowRenderer
{
	public function
		get_product_editing_form(
			HTMLTags_URL $redirect_script_url,
			HTMLTags_URL $cancel_url
		)
	{
		$product = $this->get_element();
		$database = $product->get_database();
		$products_table = $database->get_table('hpi_shop_products');

		$product_editing_form = new HTMLTags_SimpleOLForm('product_editing');
		$product_editing_form->set_action($redirect_script_url);
		$product_editing_form->set_legend_text('Edit this product');

		# The Fields:

		/*
		 * The name
		 */
		$name_field = $products_table->get_field('name');
		$name_field_renderer = $name_field->get_renderer();
		$input_tag = $name_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'name');
		$input_tag->set_attribute_str('value', $product->get_name());
		$product_editing_form->add_input_tag(
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
		$input_tag->append_str_to_content($product->get_description());
		$product_editing_form->add_input_tag(
			'description',
			$input_tag
		);

		/*
		 * The main_photograph_id
		 */
		$main_photograph_li = $this->get_main_photograph_form_radio_li();
		$product_editing_form->add_input_li($main_photograph_li);

		///*
		// * The design_photograph_id
		// */
		//$design_photograph_li = $this->get_design_photograph_form_radio_li();
		//$product_editing_form->add_input_li($design_photograph_li);

		/*
		 * The extra_photograph_id
		 */
//                $extra_photograph_li = $this->get_extra_photograph_form_checkbox_li();
//                $product_editing_form->add_input_li($extra_photograph_li);

		/*
		 * The product_category_id
		 */
		$product_category_li = $this->get_product_category_form_select_li();
		$product_editing_form->add_input_li($product_category_li);

		/*
		 * The product_brand_id
		 */
		$product_brand_li = $this->get_product_brand_form_select_li();
		$product_editing_form->add_input_li($product_brand_li);

		/*
		 * The supplier_id
		 */
//                $supplier_li = $this->get_supplier_form_select_li();
//                $product_editing_form->add_input_li($supplier_li);

//                /*
//                 * The status
//                 */
//                $status_li = $this->get_status_form_select_li();
//                $product_editing_form->add_input_li($status_li);

		/*
		 * The Principal Tags
		 */
		$input_li = $this->get_principal_tag_form_checkbox_li();
		$product_editing_form->add_input_li($input_li);

		/*
		 * The Price Lis
		 */
//                $input_lis = $this->get_price_form_input_lis();
//                foreach ($input_lis as $input_li)
//                {
//                        $product_editing_form->add_input_li($input_li);
//                }

		/*
		 * The use_stock_level
		 */
//                $use_stock_level_li = $this->get_use_stock_level_form_select_li();
//                $product_editing_form->add_input_li($use_stock_level_li);
		
		/*
		 * The sort_order
		 */
		$sort_order_field = $products_table->get_field('sort_order');
		$sort_order_field_renderer = $sort_order_field->get_renderer();
		$input_tag = $sort_order_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'sort_order');
		$input_tag->set_attribute_str('value', $product->get_sort_order());
		$product_editing_form->add_input_tag(
			'sort_order',
			$input_tag
		);

		/*
		 * The edit button.
		 */
		$product_editing_form->set_submit_text('Edit');

		$product_editing_form->set_cancel_location($cancel_url);

		return $product_editing_form;
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
		get_product_category_form_select()
	{
		$product = $this->get_element();
		$database = $product->get_database();
		$product_categories_table = $database->get_table('hpi_shop_product_categories');
		$product_categories = $product_categories_table->get_all_rows();

		$select = new HTMLTags_Select();
		$select->set_attribute_str('name', 'product_category_id');

		foreach ($product_categories as $product_category)
		{
			$option = new HTMLTags_Option($product_category->get_name());
			$option->set_attribute_str('value', $product_category->get_id());
			if ($product->get_product_category_id() == $product_category->get_id())
			{
				$option->set_attribute_str('selected', 'selected');
			}
			$select->add_option($option);
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
		$product = $this->get_element();
		$database = $product->get_database();
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
			if ($product->get_supplier_id() == $supplier->get_id())
			{
				$option->set_attribute_str('selected', 'selected');
			}
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
		$product = $this->get_element();
		$database = $product->get_database();
		$product_brands_table = $database->get_table('hpi_shop_product_brands');
		$product_brands = $product_brands_table->get_all_rows();

		$select = new HTMLTags_Select();
		$select->set_attribute_str('name', 'product_brand_id');

		foreach ($product_brands as $product_brand)
		{
			$option = new HTMLTags_Option($product_brand->get_name());
			$option->set_attribute_str('value', $product_brand->get_id());
			if ($product->get_product_brand_id() == $product_brand->get_id())
			{
				$option->set_attribute_str('selected', 'selected');
			}
			$select->add_option($option);
		}

		return $select;
	}

	public function
		get_status_form_select_li()
	{
		$input_li = new HTMLTags_LI();

		$input_label = new HTMLTags_Label('Status');
		$input_label->set_attribute_str('for', 'status_id');

		$input_li->append_tag_to_content($input_label);

		$input_li->append_tag_to_content($this->get_status_form_select());

		$input_msg_box = new HTMLTags_Span();
		$input_msg_box->set_attribute_str('id', 'status_id' . 'msg');
		$input_msg_box->set_attribute_str('class', 'rules');

		$input_li->append_tag_to_content($input_msg_box);

		return $input_li;
	}

	public function
		get_status_form_select()
	{
		$product = $this->get_element();
		$database = $product->get_database();
		$products_table = $database->get_table('hpi_shop_products');
		$status_field = $products_table->get_field('status');
		$statuses = $status_field->get_options();

		$select = new HTMLTags_Select();
		$select->set_attribute_str('name', 'status_id');

		foreach ($statuses as $status)
		{
			$option = new HTMLTags_Option($status);
			$option->set_attribute_str('value', $status);
			if ($product->get_status() == $status)
			{
				$option->set_attribute_str('selected', 'selected');
			}
			$select->add_option($option);
		}

		return $select;
	}

	public function
		get_use_stock_level_form_select_li()
	{
		$input_li = new HTMLTags_LI();

		$input_label = new HTMLTags_Label('Use Stock Level');
		$input_label->set_attribute_str('for', 'use_stock_level_id');

		$input_li->append_tag_to_content($input_label);

		$input_li->append_tag_to_content($this->get_use_stock_level_form_select());

		$input_msg_box = new HTMLTags_Span();
		$input_msg_box->set_attribute_str('id', 'use_stock_level_id' . 'msg');
		$input_msg_box->set_attribute_str('class', 'rules');

		$input_li->append_tag_to_content($input_msg_box);

		return $input_li;
	}

	public function
		get_use_stock_level_form_select()
	{
		$product = $this->get_element();
		$database = $product->get_database();
		$products_table = $database->get_table('hpi_shop_products');
		$use_stock_level_field = $products_table->get_field('use_stock_level');
		$use_stock_levels = $use_stock_level_field->get_options();

		$select = new HTMLTags_Select();
		$select->set_attribute_str('name', 'use_stock_level');

		foreach ($use_stock_levels as $use_stock_level)
		{
			$option = new HTMLTags_Option($use_stock_level);
			$option->set_attribute_str('value', $use_stock_level);
			if ($product->get_use_stock_level() == $use_stock_level)
			{
				$option->set_attribute_str('selected', 'selected');
			}
			$select->add_option($option);
		}

		return $select;
	}

	/*
	 * ----------------------------------------
	 * Functions to do with the various photographs associated
	 * with this project.
	 * ----------------------------------------
	 */

	public function
		get_main_photograph_form_radio_li()
	{
		$input_li = new HTMLTags_LI();

		$input_label = new HTMLTags_Label('Main Photograph');
		$input_label->set_attribute_str('for', 'main_photograph_id');

		$input_li->append_tag_to_content($input_label);

		$product = $this->get_element();
		
		if ($product->has_main_photograph()) {
			$main_photograph = $product->get_main_photograph();
			
			#$database = $product->get_database();
			#$photographs_table = $database->get_table('hpi_shop_photographs');
			#$photographs = $photographs_table->get_all_rows();
			#
			#foreach ($photographs as $photograph)
			#{
			#	$photograph_renderer = $photograph->get_renderer();
			#	$input = new HTMLTags_Input();
			#	$input->set_attribute_str('type', 'radio');
			#	$input->set_attribute_str('name', 'main_photograph_id');
			#	$input->set_value($photograph->get_id());
			#
			#	if ($main_photograph->get_id() == $photograph->get_id())
			#	{
			#		$input->set_attribute_str('checked', 'checked');
			#	}
			#	$input_li->append_tag_to_content($input);
			#	$input_li->append_tag_to_content($photograph_renderer->get_thumbnail_img());
			#}
			
			$main_photograph_renderer = $main_photograph->get_renderer();
			
			$main_photograph_a = $main_photograph_renderer->get_thumbnail_image_a();
			
			$input_li->append_tag_to_content($main_photograph_a);
		}
		
		/*
		 * Link to set the main photograph.
		 */
		
		$set_main_photograph_a = new HTMLTags_A('Set Main Photograph');
		
		$set_main_photograph_a->set_attribute_str('class', 'cool_button set_image_button');
		
		#$set_main_photograph_url = Admin_AdminIncluderURLFactory::get_url(
		#	'plug-ins',
		#	'shop',
		#	'products',
		#	'html'
		#);
		
		$set_main_photograph_url = new HTMLTags_URL();
		
		$set_main_photograph_url->set_file('/haddock/public-html/public-html/index.php');
		
		$set_main_photograph_url->set_get_variable('oo-page');
		$set_main_photograph_url->set_get_variable('page-class', 'Shop_AdminProductsPage');
		
		$set_main_photograph_url->set_get_variable('set_main_photograph');
		$set_main_photograph_url->set_get_variable('product_id', $product->get_id());
		
		$set_main_photograph_a->set_href($set_main_photograph_url);
		
		$input_li->append_tag_to_content($set_main_photograph_a);

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

		$product = $this->get_element();
		
		if ($product->has_design_photograph()) {
			$design_photograph = $product->get_design_photograph();
			
			#$database = $product->get_database();
			#$photographs_table = $database->get_table('hpi_shop_photographs');
			#$photographs = $photographs_table->get_all_rows();
			#
			#foreach ($photographs as $photograph)
			#{
			#	$photograph_renderer = $photograph->get_renderer();
			#	$input = new HTMLTags_Input();
			#	$input->set_attribute_str('type', 'radio');
			#	$input->set_attribute_str('name', 'design_photograph_id');
			#	$input->set_value($photograph->get_id());
			#
			#	if ($design_photograph->get_id() == $photograph->get_id())
			#	{
			#		$input->set_attribute_str('checked', 'checked');
			#	}
			#	$input_li->append_tag_to_content($input);
			#	$input_li->append_tag_to_content($photograph_renderer->get_thumbnail_img());
			#}
			
			$design_photograph_renderer = $design_photograph->get_renderer();
						
			$design_photograph_a = $design_photograph_renderer->get_thumbnail_image_a();
			
			$input_li->append_tag_to_content($design_photograph_a);			
		}

		/*
		 * Link to set the design photograph.
		 */
		
		$set_design_photograph_a = new HTMLTags_A('Set Design Photograph');
		
		$set_design_photograph_a->set_attribute_str('class', 'cool_button set_image_button');
		
		#$set_design_photograph_url = Admin_AdminIncluderURLFactory::get_url(
		#	'plug-ins',
		#	'shop',
		#	'products',
		#	'html'
		#);
		
		$set_design_photograph_url = new HTMLTags_URL();
		
		$set_design_photograph_url->set_file('/haddock/public-html/public-html/index.php');
		
		$set_design_photograph_url->set_get_variable('oo-page');
		$set_design_photograph_url->set_get_variable('page-class', 'Shop_AdminProductsPage');
		
		$set_design_photograph_url->set_get_variable('set_design_photograph');
		$set_design_photograph_url->set_get_variable('product_id', $product->get_id());
		
		$set_design_photograph_a->set_href($set_design_photograph_url);
		
		$input_li->append_tag_to_content($set_design_photograph_a);

		$input_msg_box = new HTMLTags_Span();
		$input_msg_box->set_attribute_str('id', 'design_photograph_id' . 'msg');
		$input_msg_box->set_attribute_str('class', 'rules');

		$input_li->append_tag_to_content($input_msg_box);

		return $input_li;
	}

	public function
		get_extra_photograph_form_checkbox_li()
	{
		$product = $this->get_element();

		$input_li = new HTMLTags_LI();

		$input_label = new HTMLTags_Label('Extra Photographs');
		$input_label->set_attribute_str('for', 'extra_photograph_id');

		$input_li->append_tag_to_content($input_label);

		/*
		 * Link to add an extra photograph.
		 */
		
		$add_extra_photograph_a = new HTMLTags_A('Add an extra Photograph');
		
		$add_extra_photograph_a->set_attribute_str('class', 'cool_button set_image_button');
		
		$add_extra_photograph_url = new HTMLTags_URL();
		
		$add_extra_photograph_url->set_file('/haddock/public-html/public-html/index.php');
		
		$add_extra_photograph_url->set_get_variable('oo-page');
		$add_extra_photograph_url->set_get_variable('page-class', 'Shop_AdminProductsPage');
		
		$add_extra_photograph_url->set_get_variable('add_extra_photograph');
		$add_extra_photograph_url->set_get_variable('product_id', $product->get_id());
		
		$add_extra_photograph_a->set_href($add_extra_photograph_url);
		
		$input_li->append_tag_to_content($add_extra_photograph_a);
		
		$epul = new HTMLTags_UL();
		
		$extra_photographs = $product->get_extra_photographs();

		#$database = $product->get_database();
		#$photographs_table = $database->get_table('hpi_shop_photographs');
		#$photographs = $photographs_table->get_all_rows();
		#
		#foreach ($photographs as $photograph)
		#{
		#	$photograph_renderer = $photograph->get_renderer();
		#	$input = new HTMLTags_Input();
		#	$input->set_attribute_str('type', 'checkbox');
		#	$input->set_attribute_str('name', 'extra_photograph_id_' . $photograph->get_id());
		#	$input->set_value($photograph->get_id());
		#
		#	foreach ($extra_photographs as $extra_photograph)
		#	{
		#		if ($extra_photograph->get_id() == $photograph->get_id())
		#		{
		#			$input->set_attribute_str('checked', 'checked');
		#		}
		#	}
		#
		#	$input_li->append_tag_to_content($input);
		#	$input_li->append_tag_to_content($photograph_renderer->get_thumbnail_img());
		#}
		
		foreach ($extra_photographs as $ep) {
			$epli = new HTMLTags_LI();
			
			$epr = $ep->get_renderer();
			
			$tbia = $epr->get_thumbnail_image_a();
			
			$epli->append_tag_to_content($tbia);
			
			$delete_extra_photo_url
				= Shop_ProductsHelper
					::get_admin_disassociate_product_photo_redirect_script_url(
						$product->get_id(),
						$ep->get_id()
					);
			
			$delete_extra_photo_a = new HTMLTags_A('Delete');
			$delete_extra_photo_a->set_href($delete_extra_photo_url);
			
			$epli->append_tag_to_content($delete_extra_photo_a);
			
			$epul->add_li($epli);
		}
		
		$input_li->append_tag_to_content($epul);
		
		$input_msg_box = new HTMLTags_Span();
		$input_msg_box->set_attribute_str('id', 'extra_photograph_id' . 'msg');
		$input_msg_box->set_attribute_str('class', 'rules');

		$input_li->append_tag_to_content($input_msg_box);

		return $input_li;
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with setting the price of the product.
	 * ----------------------------------------
	 */

	public function
		get_price_form_input_lis()
	{
		$product = $this->get_element();
		$database = $product->get_database();
		$currencies_table = $database->get_table('hpi_shop_currencies');
		$product_currency_prices_table = $database->get_table('hpi_shop_product_currency_prices');

		$currencies = $currencies_table->get_all_rows();

		$input_lis = array();

		foreach ($currencies as $currency)
		{
			/*
			 * The price
			 */
			$conditions = array();
			$conditions['product_id'] = $product->get_id();
			$conditions['currency_id'] = $currency->get_id();

			$product_currency_price = $product_currency_prices_table->get_rows_where($conditions);
			if (count($product_currency_price) > 0)
			{
				$current_price = $product_currency_price[0]->get_price();
			}
			else
			{
				$current_price = 0;
			}
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
	
	/*
	 * ----------------------------------------
	 * Functions to do with the table that displays products on
	 * the admin page for products.
	 * ----------------------------------------
	 */

	public function
		get_admin_products_html_table_tr(
			$current_page_url,
			$redirect_script_url
		)
	{
		$html_row =  new HTMLTags_TR();

		$row = $this->get_element();

		$table = $row->get_table();

		/*
		 * The data.
		 */
		$plu_code_field = $table->get_field('plu_code');
		$plu_code_td = $this->get_data_html_table_td($plu_code_field);
		$html_row->append_tag_to_content($plu_code_td);

		$style_id_field = $table->get_field('style_id');
		$style_id_td = $this->get_data_html_table_td($style_id_field);
		$html_row->append_tag_to_content($style_id_td);

		$added_field = $table->get_field('added');
		$added_td = $this->get_data_html_table_td($added_field);
		$html_row->append_tag_to_content($added_td);

		$name_field = $table->get_field('name');
		$name_td = $this->get_data_html_table_td($name_field);
		$html_row->append_tag_to_content($name_td);
		
		$image_td = $this->get_image_td();
		$html_row->append_tag_to_content($image_td);
		
		$brand_td = $this->get_brand_td();
		$html_row->append_tag_to_content($brand_td);

		$product_category_td = $this->get_product_category_td();
		$html_row->append_tag_to_content($product_category_td);


//                $description_td = $this->get_description_td();
//                $html_row->append_tag_to_content($description_td);
		$price_td = $this->get_price_td();
		$html_row->append_tag_to_content($price_td);

		#$supplier_td = $this->get_supplier_td();
		#$html_row->append_tag_to_content($supplier_td);

//                $comments_td = $this->get_comments_td();
//                $html_row->append_tag_to_content($comments_td);

		$tags_td = $this->get_tags_td();
		$html_row->append_tag_to_content($tags_td);

//                $use_stock_level_field = $table->get_field('use_stock_level');
//                $use_stock_level_td = $this->get_data_html_table_td($use_stock_level_field);
//                $html_row->append_tag_to_content($use_stock_level_td);

//                $stock_level_td = $this->get_stock_level_td();
//                $html_row->append_tag_to_content($stock_level_td);

//                $stock_buffer_level_td = $this->get_stock_buffer_level_td();
//                $html_row->append_tag_to_content($stock_buffer_level_td);
		
		#$stock_td = $this->get_stock_td();
		#$html_row->append_tag_to_content($stock_td);
		
		#$sort_order_field = $table->get_field('sort_order');
		#$sort_order_td = $this->get_data_html_table_td($sort_order_field);
		#$html_row->append_tag_to_content($sort_order_td);

//                /*
//                 * The set_principal_tags td.
//                 */
//                $set_principal_tags_td = new HTMLTags_TD();

//                $set_principal_tags_link = new HTMLTags_A('Set Principal Tags');
//                $set_principal_tags_link->set_attribute_str('class', 'cool_button');
//                $set_principal_tags_link->set_attribute_str('id', 'set_principal_tags_table_button');

//                $set_principal_tags_location = clone $current_page_url;

//                $set_principal_tags_location->set_get_variable('set_principal_tags');
//                $set_principal_tags_location->set_get_variable('product_id', $row->get_id());

//                $set_principal_tags_link->set_href($set_principal_tags_location);

//                $set_principal_tags_td->append_tag_to_content($set_principal_tags_link);

//                $html_row->append_tag_to_content($set_principal_tags_td);

//                /*
//                 * The edit_tags td.
//                 */
//                $edit_tags_td = new HTMLTags_TD();

//                $edit_tags_link = new HTMLTags_A('Edit All Tags');
//                $edit_tags_link->set_attribute_str('class', 'cool_button');
//                $edit_tags_link->set_attribute_str('id', 'edit_tags_table_button');

//                $edit_tags_location = clone $current_page_url;

//                $edit_tags_location->set_get_variable('edit_tags');
//                $edit_tags_location->set_get_variable('product_id', $row->get_id());

//                $edit_tags_link->set_href($edit_tags_location);

//                $edit_tags_td->append_tag_to_content($edit_tags_link);

//                $html_row->append_tag_to_content($edit_tags_td);

//                /*
//                 * The set_price td.
//                 */
//                $set_price_td = new HTMLTags_TD();

//                $set_price_link = new HTMLTags_A('Set Price');
//                $set_price_link->set_attribute_str('class', 'cool_button');
//                $set_price_link->set_attribute_str('id', 'set_price_table_button');

//                $set_price_location = clone $current_page_url;

//                $set_price_location->set_get_variable('set_price');
//                $set_price_location->set_get_variable('product_id', $row->get_id());

//                $set_price_link->set_href($set_price_location);

//                $set_price_td->append_tag_to_content($set_price_link);

//                $html_row->append_tag_to_content($set_price_td);

		/*
		 * The toggle_status td
		 */
		$status_td = new HTMLTags_TD();
		$status_td->append_str_to_content($row->get_status());

//                $status_field = $table->get_field('status');
//                $status_td = $this->get_data_html_table_td($status_field);
//                $html_row->append_tag_to_content($status_td);

		if ($row->is_displayable())
		{
			$status_td->append_tag_to_content(new HTMLTags_BR);
			$status_td->append_tag_to_content(new HTMLTags_BR);
			if ($row->get_status() == 'hide')
			{
				$toggle_status_link = new HTMLTags_A('Display');
			}
			elseif ($row->get_status() == 'display')
			{
				$toggle_status_link = new HTMLTags_A('Hide');
			}
			$toggle_status_link->set_attribute_str('class', 'cool_button');
			$toggle_status_link->set_attribute_str('id', 'toggle_status_table_button');
			$toggle_status_location = clone $redirect_script_url;
			$toggle_status_location->set_get_variable('toggle_status');
			$toggle_status_location->set_get_variable('product_id', $row->get_id());
			$toggle_status_link->set_href($toggle_status_location);
			$status_td->append_tag_to_content($toggle_status_link);
		}
		$html_row->append_tag_to_content($status_td);

		/*
		 * The set_stock_level td.
		 */
		$set_stock_level_td = new HTMLTags_TD();

		if ($row->uses_stock_level()) {
#			$set_stock_level_link = new HTMLTags_A('Set Stock Level');
			$link_text = 'Stock Level (' . $row->get_trackit_stock_quanities_sum() . ')';
			
			$set_stock_level_link = new HTMLTags_A($link_text);
			#$set_stock_level_link->set_attribute_str('class', 'cool_button');
			#$set_stock_level_link->set_attribute_str('id', 'set_stock_level_table_button');
			$set_stock_level_location = clone $current_page_url;
			$set_stock_level_location->set_get_variable('stock_level');
			$set_stock_level_location->set_get_variable('product_id', $row->get_id());
			$set_stock_level_link->set_href($set_stock_level_location);
			$set_stock_level_td->append_tag_to_content($set_stock_level_link);
		}
		
		$html_row->append_tag_to_content($set_stock_level_td);

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
//                $delete_td = new HTMLTags_TD();
//                $delete_link = new HTMLTags_A('Delete');
//                $delete_link->set_attribute_str('class', 'cool_button');
//                $delete_link->set_attribute_str('id', 'delete_table_button');
//                $delete_location = clone $current_page_url;
//                $delete_location->set_get_variable('delete_id', $row->get_id());
//                $delete_link->set_href($delete_location);
//                $delete_td->append_tag_to_content($delete_link);
//                $html_row->append_tag_to_content($delete_td);

		return $html_row;
	}

	public function
		get_description_td()
	{
		$product = $this->get_element();
		$description = $product->get_description();
		if (strlen($description) > 40)
		{
			return new HTMLTags_TD(substr($description, 0, 40) . ' ...');
		}
		return new HTMLTags_TD($description);
	}

	public function
		get_stock_td()
	{
		$product = $this->get_element();
		if ($product->uses_stock_level())
		{
			$stock_level = $product->get_stock_level();
			$stock_buffer_level = $product->get_stock_buffer_level();
			if ($product->is_out_of_stock())
			{
				return new HTMLTags_TD(
					$stock_level . ' (' . $stock_buffer_level . ') <br />Out of Stock!'
				);
			}
			return new HTMLTags_TD($stock_level . ' (' . $stock_buffer_level . ')');
		}
		else
		{
			return new HTMLTags_TD('N/A');
		}
	}

	public function
		get_stock_level_td()
	{
		$product = $this->get_element();
		if ($product->uses_stock_level())
		{
			$stock_level = $product->get_stock_level();
			if ($product->is_out_of_stock())
			{
				return new HTMLTags_TD($stock_level . ' - Out of Stock!');
			}
			return new HTMLTags_TD($stock_level);
		}
		else
		{
			return new HTMLTags_TD('N/A');
		}
	}

	public function
		get_stock_buffer_level_td()
	{
		$product = $this->get_element();
		if ($product->uses_stock_level())
		{
			return new HTMLTags_TD($product->get_stock_buffer_level());
		}
		else
		{
			return new HTMLTags_TD('N/A');
		}
	}

	public function
		get_product_category_td()
	{
		$product = $this->get_element();
		$product_category = $product->get_product_category();

		if (isset($product_category)) {
			return new HTMLTags_TD($product_category->get_name());
		} else {
			return new HTMLTags_TD();
		}
	}

	public function
		get_supplier_td()
	{
		$product = $this->get_element();
		
		if ($product->has_supplier()) {
			$supplier = $product->get_supplier();
			
			return new HTMLTags_TD($supplier->get_name());
		} else {
			return new HTMLTags_TD('Supplier not set');
		}
	}

	public function
		get_comments_td()
	{
		$product = $this->get_element();

		return new HTMLTags_TD($product->count_comments());
	}

	public function
		get_image_td()
	{
		$product = $this->get_element();
		$photograph = $product->get_main_photograph();
		#print_r($photograph);exit;
		if (isset($photograph)) {
			$photograph_renderer = $photograph->get_renderer();

			return $photograph_renderer->get_thumbnail_image_td();
		} else {
			return new HTMLTags_TD();
		}
	}

	public function
		get_brand_td()
	{
		$product = $this->get_element();
		$product_brand = $product->get_product_brand();

		if (isset($product_brand)) {
			$product_brand_renderer = $product_brand->get_renderer();

			return $product_brand_renderer->get_thumbnail_image_td();
		} else {
			return new HTMLTags_TD();
		}
	}

	public function
		get_price_td()
	{
		$product = $this->get_element();
		$database = $product->get_database();
		$currencies_table = $database->get_table('hpi_shop_currencies');
		$price_td = new HTMLTags_TD();
		$currencies = $currencies_table->get_all_rows();
		foreach ($currencies as $currency) {
//			$product_currency_price
//                = $product->get_product_currency_price($currency->get_id());
//
//            if (count($product_currency_price) > 0) {
//				$sum_of_money
//                    = new Shop_SumOfMoney($product_currency_price->get_price(), $currency);
//
//				$price_text = $sum_of_money->get_as_string();
//			} else {
//				$price_text = 'not_set';
//			}
            if ($product->has_product_currency_price($currency->get_id())) {
                $product_currency_price
                    = $product
                        ->get_product_currency_price($currency->get_id());

                $sum_of_money
                    = new Shop_SumOfMoney(
                        $product_currency_price->get_price(),
                        $currency
                    );

				$price_text = $sum_of_money->get_as_string();
            } else {
                $price_text = 'not_set';
            }

			$price_td->append_str_to_content($price_text);
			$price_td->append_tag_to_content(new HTMLTags_BR());
		}
		return $price_td;
	}

	public function
		get_product_description_li()
	{
//                $product = $this->get_element();
//                $photograph = $product->get_photograph();
//                $photograph_renderer = $photograph->get_renderer();

//                $database = $product->get_database();
//                $customer_regions_table = $database->get_table('hpi_shop_customer_regions');
//                $customer_region = $customer_regions_table->get_row_by_id($_SESSION['customer_region_id']);
//                $currency = $customer_region->get_currency();

//                $product_currency_price = $product->get_product_currency_price($currency->get_id());

//                $product_description_txt = '';
//                $product_description_txt .= $product->get_name();
//                $product_description_txt .= '&nbsp;-&nbsp;';
//                $product_description_txt .= $product->get_description();
//                $product_description_txt .= '&nbsp;-&nbsp;';
//                $product_description_txt .= $product_currency_price->get_price();

		$product_description_li = new HTMLTags_LI();
		#$product_description_li->append_str_to_content($product_description_txt);
		#$product_description_li->append_tag_to_content($photograph_renderer->get_thumbnail_img());
		$product_description_li->append_tag_to_content($this->get_product_hlisting_div());

		return $product_description_li;
	}
	
	/**
	 * Returns a div that describes a product.
	 *
	 * Used on:
	 * 	- The home page.
	 */
	public function
        get_product_hlisting_div()
	{
		$product = $this->get_element();
		
		if ($product->has_main_photograph()) {
			$main_photograph = $product->get_main_photograph();
			$main_photograph_renderer = $main_photograph->get_renderer();
		}
		
		$database = $product->get_database();
		$shopping_baskets_table = $database->get_table('hpi_shop_shopping_baskets');

		$hlisting_div = new HTMLTags_Div();
		$hlisting_div->set_attribute_str('class', 'hlisting offer-sale list-item');

		//Summary div with product name
		$hlisting_summary_div = new HTMLTags_Div();
		$hlisting_summary_div->set_attribute_str('class', 'summary');

		$hlisting_div->append_tag_to_content($hlisting_summary_div);

		/*
         * Link to Product Page for summary.
         */
        $product_page_link = new HTMLTags_A();
		$product_page_link->set_attribute_str('class', 'summary-link');

		$product_page_location = $this->get_product_page_url();

		$product_page_link->set_href($product_page_location);
		$product_page_link->append_str_to_content($product->get_name());

        $hlisting_summary_div->append_tag_to_content($product_page_link);

		$hlisting_description_div = new HTMLTags_Div();
		$hlisting_description_div->set_attribute_str('class', 'description');

		//Link to Product Page for summary
		$single_product_link = new HTMLTags_A();
		$single_product_link->set_attribute_str('class', 'img-link');
		$single_product_link->set_href($this->get_product_page_url());
		
		if (isset($main_photograph)) {
			$medium_img = $main_photograph_renderer->get_medium_size_img();
			$single_product_link->append_tag_to_content($medium_img);
		} else {
			$single_product_link->append_str_to_content('No image available');
		}
		
		$hlisting_description_div->append_tag_to_content($single_product_link);

//                $hlisting_description_p = new HTMLTags_P($product->get_description());
//                $hlisting_description_div->append_tag_to_content($hlisting_description_p);
		$hlisting_div->append_tag_to_content($hlisting_description_div);

		$product_details_ul = $this->get_product_details_ul();
		$product_details_div = new HTMLTags_Div();
		$product_details_div->set_attribute_str('class', 'details');
		$product_details_div->append_tag_to_content($product_details_ul);

		// CHECK TO SEE IF PRODUCT IS IN SHOPPING BASKET
//                $shopping_basket_already_exists =
//                        $shopping_baskets_table
//                                ->check_for_product_in_current_session($product->get_id(), session_id());

//                if ($shopping_basket_already_exists) {
//                        $conditions['product_id'] = $product->get_id();
//                        $conditions['session_id'] = "'" . session_id() . "'";
//                        $conditions['deleted'] = 'no';
//                        $conditions['moved_to_orders'] = 'no';
//                        $shopping_basket_row = $shopping_baskets_table->get_rows_where($conditions);

//                        #/print_r($shopping_basket_row);
//                        $previous_quantity = $shopping_basket_row[0]->get_quantity();

//                        $previous_purchase_p = new HTMLTags_P();
//                        $previous_purchase_p->set_attribute_str('class', 'previous-purchase');

//                        $previous_purchase_text = <<<TXT
//You already have&nbsp;
//TXT;
//                        $previous_purchase_text .= $shopping_basket_row[0]->get_quantity();
//                        $previous_purchase_text .= <<<TXT
//&nbsp;of these in your Shopping Basket.
//TXT;
//                        $previous_purchase_p->append_str_to_content($previous_purchase_text);
//                        $product_details_div->append_tag_to_content($previous_purchase_p);
//                } else {

//                }
//                
		 ##CHECK for comments
//                if ($product->has_comments()) {
//                        $has_comments_a = new HTMLTags_A();
//                        $has_comments_a->set_attribute_str('class', 'has-comments');

//            $has_comments_url = $this->get_product_page_comments_url();

//                        $has_comments_a->set_href($has_comments_url);

//                        $has_comments_text = $product->count_comments();
//                        $has_comments_text .= <<<TXT
//&nbsp;comment
//TXT;
//                        if ($product->count_comments() > 1)
//                        {
//                                $has_comments_text .= "s";
//                        }
//                        $has_comments_a->append_str_to_content($has_comments_text);
//                        $product_details_div->append_tag_to_content($has_comments_a);
//                } else {

//                }
		
		// Check for active and display add to basket link
//                if ($product->is_active() && !$product->is_out_of_stock()) {
			##Link to ADD TO BASKET
//                        $add_to_basket_link = $this->get_add_to_shopping_basket_link();
//                        $add_to_basket_link_p = new HTMLTags_P();
//                        $add_to_basket_link_p->set_attribute_str('class', 'options');
//                        $add_to_basket_link_p->append_tag_to_content($add_to_basket_link);

//                        $product_details_div->append_tag_to_content($add_to_basket_link_p);
//                } else {
//                        if ($product->is_out_of_stock()) {
//                                $product_not_available_p = new HTMLTags_P();
//                                $product_not_available_p->set_attribute_str('class', 'unavailable');
//                                $product_not_available_p
//                                        ->append_str_to_content('This product is not available at the moment.');
//                                $product_details_div->append_tag_to_content($product_not_available_p);
//                        } else {
//                                $customer_regions_table = $database->get_table('hpi_shop_customer_regions');
//                                $customer_region =
//                                               $customer_regions_table->get_row_by_id($_SESSION['customer_region_id']);

//                                $product_not_available_p = new HTMLTags_P();

//                                $product_not_available_p->set_attribute_str('class', 'unavailable');
//                                $product_not_available_p
//                                        ->append_str_to_content('This product is not available in&nbsp;');
//                                $product_not_available_p->append_str_to_content($customer_region->get_name_with_the());
//                                $product_not_available_p->append_str_to_content('.');

//                                $product_details_div->append_tag_to_content($product_not_available_p);
//                        }
//                }

		$hlisting_div->append_tag_to_content($product_details_div);

		return $hlisting_div;
	}

    public function
        get_product_page_link()
    {
        $product = $this->get_element();

		$product_page_link = new HTMLTags_A();
		$product_page_link->set_attribute_str('class', 'add-to-basket-link');
		$product_page_link->set_attribute_str('id', 'summary-link');

		$product_page_location = $this->get_product_page_url();

		$product_page_link->set_href($product_page_location);
		$product_page_link->append_str_to_content($product->get_name());

		return $product_page_link;
    }

    public function
        get_absolute_product_page_url()
    {
        $product_page_location = new HTMLTags_URL();

        $product = $this->get_element();

	if (isset($_SERVER['HTTPS']))
	{
		$http_or_https = 'https';
	}
	else
	{
		$http_or_https = 'http';
	}


	$product_page_location->set_file($http_or_https . '://' . $_SERVER['SERVER_NAME'] . '/');
	$product_page_location->set_get_variable('section', 'plug-ins');
	$product_page_location->set_get_variable('module', 'shop');
	$product_page_location->set_get_variable('page', 'product');
	$product_page_location->set_get_variable('type', 'html');

	$product_page_location
		->set_get_variable('product_id', $product->get_id());

        return $product_page_location;
    }
	
    public function
        get_product_page_comments_url()
    {
        $product_page_url = $this->get_product_page_url();
        $comments_file = $product_page_url->get_as_string() . '#comments';
	$comments_url = new HTMLTags_URL();
	$comments_url->set_file($comments_file);
	return $comments_url;
    }

    public function
        get_product_page_url()
    {
        $product_page_location = new HTMLTags_URL();

        $product = $this->get_element();

		$product_page_location->set_file('/');
		$product_page_location->set_get_variable('section', 'plug-ins');
		$product_page_location->set_get_variable('module', 'shop');
		$product_page_location->set_get_variable('page', 'product');
		$product_page_location->set_get_variable('type', 'html');
		
		$product_page_location->set_file('/');
		
		$product_page_location
			->set_get_variable('product_id', $product->get_id());

        return $product_page_location;
    }
	
	/**
	 * Link to add a product to the shopping basket.
	 *
	 * Used in:
	 * 	- get_product_hlisting_div
	 */
	public function
        get_add_to_shopping_basket_link()
	{
		$product_row = $this->get_element();

		$add_to_basket_link = new HTMLTags_A();
		$add_to_basket_link->set_attribute_str('class', 'add-to-basket-link');
		$add_to_basket_link->set_attribute_str('id', 'add-to-basket-link');

		$add_to_basket_location = new HTMLTags_URL();

		$add_to_basket_location->set_file('/');
		$add_to_basket_location->set_get_variable('section', 'plug-ins');
		$add_to_basket_location->set_get_variable('module', 'shop');
		$add_to_basket_location->set_get_variable('page', 'shopping-basket');
		$add_to_basket_location->set_get_variable('type', 'redirect-script');

		$add_to_basket_location
			->set_get_variable('add_product_id', $product_row->get_id());
		$add_to_basket_location
			->set_get_variable('add_product_quantity', 1);

		$add_to_basket_link->set_href($add_to_basket_location);
		$add_to_basket_link->append_tag_to_content(new HTMLTags_Span('Add to Basket'));

		return $add_to_basket_link;
	}

	public function
		get_full_product_div_in_public()
	{
		$full_product_div = new HTMLTags_Div();

		$product = $this->get_element();

		$design_photograph = $product->get_design_photograph();
		$design_photograph_renderer = $design_photograph->get_renderer();

		$database = $product->get_database();
		$shopping_baskets_table = $database->get_table('hpi_shop_shopping_baskets');

		$hlisting_div = new HTMLTags_Div();
		$hlisting_div->set_attribute_str('id', 'single-product');
		$hlisting_div->set_attribute_str('class', 'hlisting offer-sale full-item');

		$hlisting_summary_div = new HTMLTags_Div();
		$hlisting_summary_div->set_attribute_str('class', 'summary');
		$hlisting_summary_div->append_str_to_content($product->get_name());
		$hlisting_div->append_tag_to_content($hlisting_summary_div);

		$hlisting_description_div = new HTMLTags_Div();
		$hlisting_description_div->set_attribute_str('class', 'description');

		$hlisting_images_div = new HTMLTags_Div();
		$hlisting_images_div->set_attribute_str('class', 'images');

		if (isset($_GET['thumbnail_photograph_id']))
		{
			$photographs_table = $database->get_table('hpi_shop_photographs');
			$main_photograph = $photographs_table->get_row_by_id($_GET['thumbnail_photograph_id']);
		}
		else
		{
			$main_photograph = $product->get_main_photograph();
		}
		$main_photograph_renderer = $main_photograph->get_renderer();
		$main_img = $main_photograph_renderer->get_full_size_img();
		$hlisting_images_div->append_tag_to_content($main_img);

		$thumbnail_div = $this->get_extras_thumbnail_div($main_photograph);
		$hlisting_images_div->append_tag_to_content($thumbnail_div);

		$design_img = $design_photograph_renderer->get_full_size_img();
		$hlisting_images_div->append_tag_to_content($design_img);

		$hlisting_description_div->append_tag_to_content($hlisting_images_div);

//                $hlisting_description_p = new HTMLTags_P($product->get_description());
//                $hlisting_description_div->append_tag_to_content($hlisting_description_p);
		$hlisting_description_div->append_str_to_content($product->get_description());
		$hlisting_div->append_tag_to_content($hlisting_description_div);

		$product_details_ul = $this->get_product_details_ul();
		$product_details_div = new HTMLTags_Div();
		$product_details_div->set_attribute_str('class', 'details');
		$product_details_div->append_tag_to_content($product_details_ul);

		// CHECK TO SEE IF PRODUCT IS IN SHOPPING BASKET
		$shopping_basket_already_exists =
			$shopping_baskets_table
			->check_for_product_in_current_session($product->get_id(), session_id());

		if ($shopping_basket_already_exists)
		{
			$conditions['product_id'] = $product->get_id();
			$conditions['session_id'] = "'" . session_id() . "'";
			$conditions['deleted'] = 'no';
			$conditions['moved_to_orders'] = 'no';
			$shopping_basket_row = $shopping_baskets_table->get_rows_where($conditions);

			//print_r($shopping_basket_row);
			$previous_quantity = $shopping_basket_row[0]->get_quantity();

			$previous_purchase_p = new HTMLTags_P();
			$previous_purchase_p->set_attribute_str('class', 'previous-purchase');

			$previous_purchase_text = <<<TXT
You already have&nbsp;
TXT;
			$previous_purchase_text .= $shopping_basket_row[0]->get_quantity();
			$previous_purchase_text .= <<<TXT
&nbsp;of these in your Shopping Basket.
TXT;
			$previous_purchase_p->append_str_to_content($previous_purchase_text);
			$product_details_div->append_tag_to_content($previous_purchase_p);
		}
		else
		{

		}

		if ($product->is_active() && !$product->is_out_of_stock())
		{
			//Link to ADD TO BASKET
			$add_to_basket_link = $this->get_add_to_shopping_basket_link();
			$add_to_basket_link_p = new HTMLTags_P();
			$add_to_basket_link_p->set_attribute_str('class', 'options');
			$add_to_basket_link_p->append_tag_to_content($add_to_basket_link);

			$product_details_div->append_tag_to_content($add_to_basket_link_p);
		}
		else
		{
			if ($product->is_out_of_stock())
			{
				$other_products_link = new HTMLTags_A();
				$other_products_link->
					append_str_to_content(
						'See other products'
					);

				$other_products_location = new HTMLTags_URL();
				$other_products_location->set_file('/');
				$other_products_location->set_get_variable('section', 'plug-ins');
				$other_products_location->set_get_variable('module', 'shop');
				$other_products_location->set_get_variable('page', 'products');
				$other_products_location->set_get_variable('type', 'html');

				$other_products_link
					->set_href($other_products_location);

				$other_products_available_p = new HTMLTags_P();
				$other_products_available_p
					->append_tag_to_content($other_products_link);

				$product_details_div->append_tag_to_content($other_products_available_p);
			}
			else
			{
				$customer_regions_table = $database->get_table('hpi_shop_customer_regions');
				$customer_region =
					$customer_regions_table->get_row_by_id($_SESSION['customer_region_id']);
				$product_not_available_p = new HTMLTags_P();
				$product_not_available_p
					->append_str_to_content('This product is not available in&nbsp;');
				$product_not_available_p->append_str_to_content($customer_region->get_name_with_the());
				$product_not_available_p->append_str_to_content('.');

				$product_details_div->append_tag_to_content($product_not_available_p);

				$product_category = $product->get_product_category();

				if ($product_category->is_active())
				{
					$other_products_in_category_link = new HTMLTags_A();
					$other_products_in_category_link->
						append_str_to_content(
							'See other&nbsp;'
							.
							$product_category->get_name()
							.
							'&nbsp;available in&nbsp;'
							.
							$customer_region->get_name_with_the()
						);

					$other_products_in_category_location = new HTMLTags_URL();
					$other_products_in_category_location->set_file('/');
					$other_products_in_category_location->set_get_variable('section', 'plug-ins');
					$other_products_in_category_location->set_get_variable('module', 'shop');
					$other_products_in_category_location
						->set_get_variable('page', 'product-category');
					$other_products_in_category_location->set_get_variable('type', 'html');
					$other_products_in_category_location->
						set_get_variable('product_category_id', $product_category->get_id());

					$other_products_in_category_link
						->set_href($other_products_in_category_location);

					$other_products_available_p = new HTMLTags_P();
					$other_products_available_p
						->append_tag_to_content($other_products_in_category_link);

					$product_details_div->append_tag_to_content($other_products_available_p);
				}
				else
				{
					$all_products_in_region_link = new HTMLTags_A();
					$all_products_in_region_link->
						append_str_to_content(
							'See other products available in&nbsp;'
							.
							$customer_region->get_name_with_the()
						);

					$all_products_in_region_location = new HTMLTags_URL();
					$all_products_in_region_location->set_file('/');
					$all_products_in_region_location->set_get_variable('section', 'plug-ins');
					$all_products_in_region_location->set_get_variable('module', 'shop');
					$all_products_in_region_location->set_get_variable('page', 'products');
					$all_products_in_region_location->set_get_variable('type', 'html');
					$all_products_in_region_location->set_get_variable('page', 'products');
					$all_products_in_region_location->
						set_get_variable('customer_region_session', $customer_region->get_id());

					$all_products_in_region_link->set_href($all_products_in_region_location);

					$other_products_available_p = new HTMLTags_P();
					$other_products_available_p
						->append_tag_to_content($all_products_in_region_link);

					$product_details_div->append_tag_to_content($other_products_available_p);
				}
			}
		}

		$hlisting_div->append_tag_to_content($product_details_div);


		$full_product_div->append_tag_to_content($hlisting_div);

		return $full_product_div;
	}

	public function
		get_extras_thumbnail_div(Shop_PhotographRow $photograph_to_ignore)
	{
		$product = $this->get_element();

		$page_manager = PublicHTML_PageManager::get_instance();
		$current_page_url = $page_manager->get_script_uri();

		$extras_thumbnail_div = new HTMLTags_Div();
		$extras_thumbnail_div->set_attribute_str('class', 'extras_thumbnails');

		$extra_photographs = $product->get_extra_photographs();
		$extra_photographs[] = $product->get_main_photograph();

		foreach ($extra_photographs as $extra_photograph)
		{
			if ($extra_photograph->get_id() != $photograph_to_ignore->get_id())
			{
				$thumbnail_action = clone $current_page_url;
				$thumbnail_action->
					set_get_variable('thumbnail_photograph_id', $extra_photograph->get_id());
				$thumbnail_action->set_get_variable('product_id', $product->get_id());

				$thumbnail_link = new HTMLTags_A();
				$thumbnail_link->set_href($thumbnail_action);

				$renderer = $extra_photograph->get_renderer();
				$thumbnail_link->append_tag_to_content($renderer->get_thumbnail_img());
				$extras_thumbnail_div->append_tag_to_content($thumbnail_link);
			}
		}

		return $extras_thumbnail_div;
	}
	
	/**
	 * Returns a UL that tells the customer about this product.
	 *
	 * Details:
	 * 	- Price
	 * 	- The date the product was first listed
	 * 	- The availability of the product.
	 */
	public function
        get_product_details_ul()
	{
		$product = $this->get_element();
		$product_details_ul = new HTMLTags_UL();
		
		/*
		 * The price.
		 */
		$product_price_li = new HTMLTags_LI();
//                $product_price_li->append_str_to_content('Price:&nbsp;');
		$product_price_span = new HTMLTags_Span();
		$product_price_span->set_attribute_str('class', 'price');

		$database = $product->get_database();
		$customer_regions_table
            = $database->get_table('hpi_shop_customer_regions');
		$customer_region
            = $customer_regions_table
                ->get_row_by_id($_SESSION['customer_region_id']);
		$currency = $customer_region->get_currency();

		$product_currency_price
            = $product->get_product_currency_price($currency->get_id());
		#print_r($product_currency_price);
//
//                $product_price_span
//                        ->append_str_to_content($currency->get_symbol());
//                $product_price_span
//                        ->append_str_to_content($product_currency_price->get_price());

		$sum_of_money
            = new Shop_SumOfMoney(
                $product_currency_price->get_price(),
                $currency
            );

		$product_price_span
			->append_str_to_content($sum_of_money->get_as_string());

		$product_price_li->append_tag_to_content($product_price_span);

		$product_details_ul->append_tag_to_content($product_price_li);
		
		/*
		 * When the product was listed.
		 */
//                
//                $product_listed_li = new HTMLTags_LI();
//                $product_listed_li->append_str_to_content('Listed:&nbsp;');
//                $product_listed_abbr = new HTMLTags_Abbr();
//                $product_listed_abbr->set_attribute_str('class', 'dtlisted');

//                $date_added = $product->get_added();
//                $datetime_iso8601 = Formatting_DateTime::datetime_to_ISO8601($date_added);
//                $product_listed_abbr->set_attribute_str('title', $datetime_iso8601);
//                $datetime_human_readable =
//                        Formatting_DateTime::datetime_to_human_readable($date_added);
//                $product_listed_abbr->append_str_to_content($datetime_human_readable);

//                $product_listed_li->append_tag_to_content($product_listed_abbr);
//                $product_details_ul->append_tag_to_content($product_listed_li);
//                
		/*
		 * The availability of the product.
		 */
		
		$product_availability_li = new HTMLTags_LI();
//                $product_availability_li->append_str_to_content('Availability:&nbsp;');
		$product_availability_span = new HTMLTags_Span();
		$product_availability_span->set_attribute_str('class', 'availability');
		if (!$product->uses_stock_level())
		{
			$product_availability_span->append_str_to_content('In Stock');
		}
		else
		{
			if ($product->is_out_of_stock())
			{
				$product_availability_span->append_str_to_content('Out of Stock');
			}
			else
			{
				#print_r($product->get_available_stock_level());exit;
				$product_availability_span->append_str_to_content(
					$product->get_available_stock_level() . '&nbsp;in Stock'
				);
			}
		}
		
		$product_availability_li->append_tag_to_content($product_availability_span);
		$product_details_ul->append_tag_to_content($product_availability_li);

		return $product_details_ul;
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with the confirmation div for items deleted
	 * from the shopping basket.
	 * ----------------------------------------
	 */
	
	private function
		get_deleted_shopping_basket_confirmation_div_for_url(
			HTMLTags $undo_url
		)
	{
		$product = $this->get_element();

		return
			Shop_ShoppingBasketsTableRenderer
				::get_deleted_shopping_basket_confirmation_div(
					$product->get_name(),
					$url
				);
	}
	
	/**
	 * Shown when a customer deletes an item from their shopping
	 * basket.
	 *
	 * The item is restored by adding a new item to the shopping
	 * baskets table.
	 */
	public function
		get_deleted_shopping_basket_confirmation_div($quantity)
	{
		$product = $this->get_element();
		$undo_location = Shop_ShoppingBasketsTable::get_public_redirect_script_url;
		$undo_location->set_get_variable('add_product_id', $product->get_id());
		$undo_location->set_get_variable('add_product_quantity', $quantity);
		return $this->get_deleted_shopping_basket_confirmation_div_for_url($undo_location);
	}
	
	/**
	 * Modelled closely on
	 *
	 *  get_deleted_shopping_basket_confirmation_div
	 *
	 * above.
	 * 
	 * The div here allows a customer to restore a shopping basket
	 * by its ID rather than create a new one for the product.
	 *
	 * This is necessary for products with additional characteristics
	 * like size or colour.
	 *
	 * This is actually redundant and has never been used or tested.
	 *
	 * See
	 *
	 * Shop_ShoppingBasketsTableRenderer::get_deleted_shopping_basket_confirmation_div_for_sbid
	 *
	 * @param $sbid The shopping basket ID.
	 */
	public function
		get_deleted_shopping_basket_confirmation_div_for_sbid($sbid)
	{
		$undo_location = Shop_ShoppingBasketsTable::get_restore_shopping_basket_item_url($sbid);
		return $this->get_deleted_shopping_basket_confirmation_div_for_url($undo_location);
	}

	public function
		get_product_links_ul_in_public()
	{
		$product = $this->get_element();
		$product_category = $product->get_product_category();
		// Links to this product, product categories, all products and checkout
		//

		//
		$product_links_ul = new HTMLTags_UL();

		if ($product_category->is_active())
		{
			$other_products_in_category_link = new HTMLTags_A();
			$other_products_in_category_link->
				append_str_to_content(
					'See all&nbsp;'
					.
					$product_category->get_name()
				);

			//$other_products_in_category_location = new HTMLTags_URL();
			//$other_products_in_category_location->set_file('/');
			//$other_products_in_category_location->set_get_variable('page', 'products');
			//$other_products_in_category_location->
			//	set_get_variable('product_category_id', $product_category->get_id());
            $product_category_renderer = $product_category->get_renderer();

            $other_products_in_category_location = $product_category_renderer->get_page_url_in_public();

			$other_products_in_category_link->set_href($other_products_in_category_location);

			$other_products_available_li = new HTMLTags_LI();
			$other_products_available_li->append_tag_to_content($other_products_in_category_link);

			$product_links_ul->append_tag_to_content($other_products_available_li);
		}
//
//                /*
//                 * Link to all the products.
//                 */
//                $all_products_link = new HTMLTags_A('See all Products');
//                $all_products_location = new HTMLTags_URL();
//                $all_products_location->set_file('/hpi/shop/products.html');

//                $all_products_link->set_href($all_products_location);
//                $all_products_li = new HTMLTags_LI();
//                $all_products_li->append_tag_to_content($all_products_link);

//                $product_links_ul->append_tag_to_content($all_products_li);

		return $product_links_ul;
	}

	public function
		get_paged_public_all_comments_div($current_page_url)
	{
		$product = $this->get_element();
//                $comments = $product->get_comments();
		$database = $product->get_database();
		$comments_table = $database->get_table('hpi_shop_comments');

		$all_comments_div = new HTMLTags_Div();

		####################################################################
		#
		# Display some of the data in the comments table.
		#
		####################################################################

		if ($product->count_comments() >= 11) {
			/*
			 * DIV for limits and previous and nexts.
			 */
			$limit_previous_next_div = new HTMLTags_Div();
			$limit_previous_next_div->set_attribute_str('class', 'table_pages_div');

			/*
			 * To allow the user to set the number of extras to show at a time.
			 */
//                        $limit_action = new HTMLTags_URL();
//                        $limit_action->set_file('/');

			$limit_form = new Database_LimitForm($current_page_url, LIMIT, '10 20 50');

//                        $limit_form->add_hidden_input('page', $page);

			$limit_form->add_hidden_input('order_by', ORDER_BY);
			$limit_form->add_hidden_input('direction', DIRECTION);
			$limit_form->add_hidden_input('offset', OFFSET);

			$limit_previous_next_div->append_tag_to_content($limit_form);

			/*
			 * Go the previous or next list of extras.
			 */
			$previous_next_url = clone $current_page_url;
			$previous_next_url->set_get_variable('product_id', $product->get_id());

//                        $previous_next_url->set_get_variable('order_by', ORDER_BY);
//                        $previous_next_url->set_get_variable('direction', DIRECTION);

			#print_r($previous_next_url);

			$row_count = $product->count_comments();

			#echo "\$row_count: $row_count\n";

			$previous_next_ul = new Database_PreviousNextUL(
				$previous_next_url,
				OFFSET,
				LIMIT,
				$row_count
			);

			$limit_previous_next_div->append_tag_to_content($previous_next_ul);

			$all_comments_div->append_tag_to_content($limit_previous_next_div);
		}
		# ------------------------------------------------------------------

		/**
		 * The table.
		 */
		$rows_html_table = new HTMLTags_Table();
		$rows_html_table->set_attribute_str('class', 'table_pages');

		/*
		 * The caption.
		 */
		#$caption = new HTMLTags_Caption(
		#    'All Comments'
		#);
		#$rows_html_table->append_tag_to_content($caption);
		#
		/**
		 * The Heading Row.
		 */
		#$sort_href = new HTMLTags_URL();
		#$sort_href->set_file('/index.php');
		#
		#$sort_href->set_get_variable('page', $page);
		#
		#$sort_href->set_get_variable('limit', LIMIT);
		#
		#$heading_row = new Database_SortableHeadingTR($sort_href, DIRECTION);

		#$fields = $comments_table->get_fields();
		#
		#foreach ($fields as $field) {
		#    $heading_row->append_sortable_field_name($field->get_name());
		#}
		#
		#$field_names = explode(' ', 'name comment added');
		#
		#foreach ($field_names as $field_name) {
		#    $heading_row->append_sortable_field_name($field_name);
		#}

		#$buy_th = new HTMLTags_TH('Buy This');
		#
		#$heading_row->append_tag_to_content($buy_th);

		#$rows_html_table->append_tag_to_content($heading_row);

		# ------------------------------------------------------------------

		/**
		 * Display the contents of the table.
		 */
		#$order_by = isset($_GET['order_by']) ? $_GET['order_by'] : 'id';
		#$direction = isset($_GET['direction']) ? $_GET['direction'] : 'ASC';
		#$table_renderer->render_all_data_table($order_by, $direction);

		$conditions['status'] = 'accepted';
		$conditions['product_id'] = $product->get_id();

		$comments = $comments_table->get_rows_where($conditions, ORDER_BY, DIRECTION, OFFSET, LIMIT);

		foreach ($comments as $comment) {
			$row_renderer = $comment->get_renderer();

			#$data_tr = $row_renderer->get_admin_database_tr();
			$data_tr = $row_renderer->get_public_comments_hreview_tr();

			$rows_html_table->append_tag_to_content($data_tr);
		}

		# ------------------------------------------------------------------

		$all_comments_div->append_tag_to_content($rows_html_table);

		if ($product->count_comments() >= 11) {
			$all_comments_div->append_tag_to_content($limit_previous_next_div);
		}

		return $all_comments_div;
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with product tags.
	 * ----------------------------------------
	 */
	
	public function
		get_tags_td()
	{
		$tags_td = new HTMLTags_TD();
		$tags_str = $this->get_tags_as_csv();
		#print_r($tags_str);
		$tags_td->append_str_to_content($tags_str);

		return $tags_td;
	}

	public function
		get_tags_as_csv()
	{
		$row = $this->get_element();
		#print_r($thumbnail_image_row_renderer);
		$database = $row->get_database();

		$tags = $row->get_tags_strs();
		#print_r($tags);

		$tags_str = '';
		for ($i = 0; $i < count($tags); $i++) {
			if ($i > 0) {
				$tags_str .= ', ';
			}
			$tags_str .= $tags[$i];
		}

		return $tags_str;
	}

	public function
		get_tags_as_space_separated()
	{
		$row = $this->get_element();
		#print_r($thumbnail_image_row_renderer);
		$database = $row->get_database();

		$tags = $row->get_tags_strs();
		#print_r($tags);

		$tags_str = '';

		for ($i = 0; $i < count($tags); $i++) {
			if ($i > 0) {
				$tags_str .= ' ';
			}

			$tags_str .= $tags[$i];
		}

		return $tags_str;
	}

	public function
		get_tag_cloud_div($current_url, $javascript = FALSE)
	{
		$product_row = $this->get_element();
		$database = $product_row->get_database();
		$tags_table = $database->get_table('hpi_shop_product_tags');

		#$product_row = $products_table->get_row_by_id($_GET['product_id']);
		#$database = $product_row->get_database();

		$tag_cloud_div = new HTMLTags_Div();
		$tag_cloud_div->set_attribute_str('id', 'tag_cloud_div');

		$tag_cloud_heading = new HTMLTags_Heading(3);
		$tag_cloud_heading->append_str_to_content('Tags for this product');

		$tag_cloud_div->append_tag_to_content($tag_cloud_heading);

		$tag_cloud_list = new HTMLTags_OL();

		$tags = $product_row->get_tags_with_counts(
			'hpi_shop_product_tags.tag',
			'ASC'
		);

		foreach ($tags as $tag) {

			$tag_cloud_line = new HTMLTags_LI();

			$tag_cloud_href = clone $current_page_url;
			$tag_cloud_href->set_get_variable('tag_id', $tag->get_id());

			$tag_cloud_link = new HTMLTags_A();
			$tag_cloud_link->set_href($tag_cloud_href);
			$tag_cloud_link->set_attribute_str('id', $tag->get_id());

			if ($javascript) {
				$onclick = 'javascript:return tagsOnClick(this);';
				$tag_cloud_link->set_attribute_str('onclick', $onclick);

			}

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
		get_product_tag_editing_form($redirect_script_url, $cancel_location)
	{
		$mysql_user_factory = Database_MySQLUserFactory::get_instance();
		$mysql_user = $mysql_user_factory->get_for_this_project();
		$database = $mysql_user->get_database();

		$product_row = $this->get_element();

		$products_table = $database->get_table('hpi_shop_products');

		$product_editing_form = new HTMLTags_SimpleOLForm('product_tag_editing');

		$product_editing_action = clone $redirect_script_url;

		$product_editing_action->set_get_variable('edit_tags', '1');
		$product_editing_action->set_get_variable('product_id', $product_row->get_id());

		$product_editing_form->set_action($product_editing_action);

		$product_editing_form->set_legend_text('Edit the tags for this product');
		/*
		 * The tags
		 */
		$value_of_tags_input = $this->get_tags_as_space_separated();
		$product_editing_form
			->add_input_name_with_value('tags', $value_of_tags_input, 'Tags (Space separated)');
		/*
		 * The update button.
		 */
		$product_editing_form->set_submit_text('Update');

		$product_editing_form->set_cancel_location($cancel_location);

		return $product_editing_form;
	}

	public function
		get_product_principal_tag_editing_form($redirect_script_url, $cancel_location)
	{
		$mysql_user_factory = Database_MySQLUserFactory::get_instance();
		$mysql_user = $mysql_user_factory->get_for_this_project();
		$database = $mysql_user->get_database();

		$product_row = $this->get_element();
		$products_table = $database->get_table('hpi_shop_products');

		$product_editing_form = new HTMLTags_SimpleOLForm('product_tag_editing');

		$product_editing_action = clone $redirect_script_url;
		$product_editing_action->set_get_variable('set_principal_tags', '1');
		$product_editing_action->set_get_variable('product_id', $product_row->get_id());

		$product_editing_form->set_action($product_editing_action);

		$product_editing_form->set_legend_text('Set the principal tags for this product');
		/*
		 * The tags
		 */

		$input_li = $this->get_principal_tag_form_checkbox_li();
		$product_editing_form->add_input_li($input_li);

		/*
		 * The update button.
		 */
		$product_editing_form->set_submit_text('Update');

		$product_editing_form->set_cancel_location($cancel_location);

		return $product_editing_form;
	}

	public function
		get_principal_tag_form_checkbox_li()
	{
		$mysql_user_factory = Database_MySQLUserFactory::get_instance();
		$mysql_user = $mysql_user_factory->get_for_this_project();
		$database = $mysql_user->get_database();

		$product_row = $this->get_element();
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

			if ($product_row->has_tag($principal_tag))
			{
				#print_r('saul');
				$input->set_attribute_str('checked', 'checked');
			}

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
	
	/*
	 * ----------------------------------------
	 * Functions to do with the stock editing form.
	 * ----------------------------------------
	 */
	
	public function
		get_stock_level_editing_form($redirect_script_url, $cancel_location)
	{
		$mysql_user_factory = Database_MySQLUserFactory::get_instance();
		$mysql_user = $mysql_user_factory->get_for_this_project();
		$database = $mysql_user->get_database();

		$product_row = $this->get_element();
		$products_table = $database->get_table('hpi_shop_products');

		$product_editing_form = new HTMLTags_SimpleOLForm('stock_level_editing');

		$product_editing_action = clone $redirect_script_url;
		$product_editing_action->set_get_variable('set_stock_level', '1');
		$product_editing_action->set_get_variable('product_id', $product_row->get_id());

		$product_editing_form->set_action($product_editing_action);

		$product_editing_form->set_legend_text('Set the stock level for this product');

		/*
		 * The stock_level
		 */
		$stock_level_field = $products_table->get_field('stock_level');
		$stock_level_field_renderer = $stock_level_field->get_renderer();
		$input_tag = $stock_level_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'stock_level');
		$input_tag->set_attribute_str('value', $product_row->get_stock_level());
		$product_editing_form->add_input_tag(
			'stock_level',
			$input_tag
		);
		/*
		 * The stock_buffer_level
		 */
		$stock_buffer_level_field = $products_table->get_field('stock_buffer_level');
		$stock_buffer_level_field_renderer = $stock_buffer_level_field->get_renderer();
		$input_tag = $stock_buffer_level_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'stock_buffer_level');
		$input_tag->set_attribute_str('value', $product_row->get_stock_buffer_level());
		$product_editing_form->add_input_tag(
			'stock_buffer_level',
			$input_tag
		);
		/*
		 * The update button.
		 */
		$product_editing_form->set_submit_text('Update');

		$product_editing_form->set_cancel_location($cancel_location);

		return $product_editing_form;
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with setting the meta tags of a page displaying
	 * this product.
	 * ----------------------------------------
	 */

	public function
		get_head_meta_description_string($just_design_img = 'no')
	{
		$product = $this->get_element();

		$meta_title = $product->get_name();
		$meta_description = $product->get_description();

		if ($just_design_img= 'yes')
		{
			$product_photograph_thumbnail_urls = array();
			$product_photograph_thumbnail_urls[] = $product->get_design_photograph_thumbnail_url();
		}
		else
		{
			$product_photograph_thumbnail_urls = $product->get_all_photograph_thumbnail_urls();
		}

		$head_meta_description = <<<TXT
<meta
	name="title"
	content="$meta_title"
/>
<meta
	name="description"
	content="A T-Shirt for sale at the Connected Films Shop"
/>
TXT;

		$head_meta_description .= "\r\n";
		foreach($product_photograph_thumbnail_urls as $product_photograph_thumbnail_url)
		{
			if (isset($_SERVER['HTTPS']))
			{
				$http_or_https = 'https';
			}
			else
			{
				$http_or_https = 'http';
			}
			$url = $http_or_https . '://' . $_SERVER['SERVER_NAME'];
			$url .= $product_photograph_thumbnail_url->get_as_string();
			$head_meta_description .= <<<TXT
<link
	rel="image_src"
	href="$url"
/>
TXT;

			$head_meta_description .= "\r\n";
		}

		$head_meta_description .= <<<TXT
<meta
	name="medium"
	content="image"
/>

TXT;

		$head_meta_description .= "\r\n";
		return $head_meta_description;
	}

	/*
	 * ----------------------------------------
	 * Functions to do with sharing this product on a social
	 * network.
	 * ----------------------------------------
	 */
	
	public function
		get_social_network_links_ul()
	{
		$product = $this->get_element();

		$share_links_ul = new HTMLTags_UL();

		$facebook_li = new HTMLTags_LI();

		if (isset($_SERVER['HTTPS']))
		{
			$http_or_https = 'https';
		}
		else
		{
			$http_or_https = 'http';
		}

		$product_page_url = $this->get_product_page_url();
		$product_page_url_string = $http_or_https
			. '://'
			. $_SERVER['SERVER_NAME']
			. $product_page_url->get_as_string();

		$facebook_link = <<<TXT
<script>function fbs_click() {u=location.href;t=document.title;window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=626,height=436');return false;}</script><a href="http://www.facebook.com/share.php?u=$product_page_url_string" onclick="return fbs_click()" target="_blank">Share on Facebook</a>
TXT;

		$facebook_li->append_str_to_content($facebook_link);

		$share_links_ul->append_tag_to_content($facebook_li);
		return $share_links_ul;
	}

	public function
		get_share_links_ul_in_public()
	{
		$share_links_ul = new HTMLTags_UL();

		$share_product_link = new HTMLTags_A('Spread the word!');
		$share_product_location = $this->get_product_page_url();
		$share_product_location->set_get_variable('share_product', '1');

		$share_product_link->set_href($share_product_location);

		$share_product_li = new HTMLTags_LI();
		$share_product_li->append_tag_to_content($share_product_link);

		$share_links_ul->append_tag_to_content($share_product_li);

		return $share_links_ul;
	}

	public function
		get_share_product_div_in_public()
	{
		$product = $this->get_element();
		$product_name = $product->get_name();
		$product_brand = $product->get_product_brand();
		$product_brand_name = $product_brand->get_name();

		$this_product_location = $this->get_product_page_url();
		$this_product_comments_location = $this->get_product_page_comments_url();

		$product_category = $product->get_product_category();
		$product_category_name = $product_category->get_name();
		$product_category_name_minus_s = rtrim($product_category_name, 's');

		$share_product_div = new HTMLTags_Div();
		$share_product_div->set_attribute_str('id', 'share_product_div');

		$share_h_em = new HTMLTags_Em($product_name);
		$share_h = new HTMLTags_Heading(2);
		$share_h->append_tag_to_content($share_h_em);
		$share_h->append_str_to_content('&nbsp;spread the word');
		$share_product_div->append_tag_to_content($share_h);

		$product_img_div = new HTMLTags_Div();
		$product_img_div->set_attribute_str('class', 'product_img_div');

		$design_photograph = $product->get_design_photograph();
		$design_photograph_renderer = $design_photograph->get_renderer();
		$design_medium_size_img = $design_photograph_renderer->get_absolute_medium_size_img();
		$design_medium_size_img->set_attribute_str('class', 'share_product_img');

		$design_img_link = new HTMLTags_A();
		$design_img_link->set_href($this_product_location);
		$design_img_link->append_tag_to_content($design_medium_size_img);

		$main_photograph = $product->get_main_photograph();
		$main_photograph_renderer = $main_photograph->get_renderer();
		$main_medium_size_img = $main_photograph_renderer->get_absolute_medium_size_img();
		$main_medium_size_img->set_attribute_str('class', 'share_product_img');

		$main_img_link = new HTMLTags_A();
		$main_img_link->set_href($this_product_location);
		$main_img_link->append_tag_to_content($main_medium_size_img);

		$product_img_div->append_tag_to_content($main_img_link);
		$product_img_div->append_tag_to_content($design_img_link);

		$share_product_div->append_tag_to_content($product_img_div);

		$share_text = <<<TXT
Help us spread the word about this $product_category_name_minus_s,
and the other $product_brand_name products. There are a few ways you
can do this here, if you think of any more then please let us know how they
work out in the&nbsp;
TXT;

		$comments_link = new HTMLTags_A('comments');
		$comments_link->set_href($this_product_comments_location);

		$share_div_p = new HTMLTags_P($share_text);
		$share_div_p->append_tag_to_content($comments_link);
		$share_div_p->append_str_to_content('.');
		$share_product_div->append_tag_to_content($share_div_p);

//                $this_product_link = new HTMLTags_A('Go back to&nbsp;' . $product_name);
//                $this_product_location = $this->get_product_page_url();
//                $this_product_link->set_href($this_product_location);
//
//                $share_product_div->append_tag_to_content($this_product_link);

		$social_network_h =  new HTMLTags_Heading(
			3, 'Share ' . $product_category_name_minus_s . ' with Facebook etc.'
		);
		$share_product_div->append_tag_to_content($social_network_h);
//                $social_network_text = <<<TXT
//TXT;

//                $share_product_div->append_tag_to_content(new HTMLTags_P($social_network_text));
		$social_network_links_ul = $this->get_social_network_links_ul();
		$share_product_div->append_tag_to_content($social_network_links_ul);

		$embed_h =  new HTMLTags_Heading(
			3, 'Feature ' . $product_category_name_minus_s . ' on your own website'
		);
		$share_product_div->append_tag_to_content($embed_h);
		$embed_text = <<<TXT
Copy and paste this code into your own web page, blog, or MySpace page.
TXT;

		$share_product_div->append_tag_to_content(new HTMLTags_P($embed_text));
		$embed_form = $this->get_embed_form();
		$share_product_div->append_tag_to_content($embed_form);

		return $share_product_div;
	}

	public function
		get_embed_form()
	{
		$embed_form = new HTMLTags_Form();
		$embed_form->set_attribute_str('name', 'embedForm');
		$embed_form->set_attribute_str('id', 'embedForm');

		$embed_label = new HTMLTags_Label('Embed Code:');
		$embed_label->set_attribute_str('for', 'embed_code');
		$embed_form->append_tag_to_content($embed_label);

		$embed_input = new HTMLTags_Input();
		$embed_input->set_attribute_str('name', 'embed_code');
		$embed_input->set_attribute_str('class', 'embedField');
		$embed_input->set_attribute_str('value', $this->get_embed_code());
		$embed_input->set_attribute_str(
			'onclick',
			'javascript:document.embedForm.embed_code.focus();document.embedForm.embed_code.select();'
		);
		$embed_input->set_attribute_str('readonly', 'true');
		$embed_input->set_attribute_str('type', 'text');
		$embed_form->append_tag_to_content($embed_input);

		return $embed_form;
	}

	public function
		get_embed_code()
	{
		$embed_div = $this->get_embed_div();
		$string = urlencode($embed_div->get_as_string());
		$string = ereg_replace("%0A", "", $string);
		$string = urldecode($string);
		return htmlentities($string);
	}

	public function
		get_embed_div()
	{
		$embed_div_style = <<<TXT
width: 400px; margin: 20px auto;text-align: center;
TXT;

		$embed_img_style = <<<TXT
display: inline; margin: 0; padding: 0;vertical-align: middle;
TXT;

		$embed_a_style = <<<TXT
display: block;text-align:center;
TXT;

		$embed_span_style = <<<TXT
display: block; font-size: 90%; text-align: center;
TXT;

		$embed_div = new HTMLTags_Div();
		$embed_div->set_attribute_str('style', $embed_div_style);

		$product = $this->get_element();

		$design_photograph = $product->get_design_photograph();
		$design_photograph_renderer = $design_photograph->get_renderer();
		$design_medium_size_img = $design_photograph_renderer->get_absolute_medium_size_img();
		$design_medium_size_img->set_attribute_str('style', $embed_img_style);

		$main_photograph = $product->get_main_photograph();
		$main_photograph_renderer = $main_photograph->get_renderer();
		$main_medium_size_img = $main_photograph_renderer->get_absolute_medium_size_img();
		$main_medium_size_img->set_attribute_str('style', $embed_img_style);

		$design_img_a = new HTMLTags_A();
		$this_product_location = $this->get_absolute_product_page_url();
		$design_img_a->set_href($this_product_location);

		$main_img_a = new HTMLTags_A();
		$this_product_location = $this->get_absolute_product_page_url();
		$main_img_a->set_href($this_product_location);

		$product_name_a = new HTMLTags_A();
		$this_product_location = $this->get_absolute_product_page_url();
		$product_name_a->set_href($this_product_location);
		$main_img_a->append_tag_to_content($main_medium_size_img);

		$design_img_a->append_tag_to_content($design_medium_size_img);

		$embed_div->append_tag_to_content($main_img_a);
		$embed_div->append_tag_to_content($design_img_a);

		$product_name = $product->get_name();
		$shop_mention_span = new HTMLTags_Span('Only at the Connected Films Shop');
		$shop_mention_span->set_attribute_str('style', $embed_span_style);

		$product_name_a->append_str_to_content($product_name);
		$product_name_a->set_attribute_str('style', $embed_a_style);

		$embed_div->append_tag_to_content($product_name_a);
		$embed_div->append_tag_to_content($shop_mention_span);

		return $embed_div;
	}
}
?>
