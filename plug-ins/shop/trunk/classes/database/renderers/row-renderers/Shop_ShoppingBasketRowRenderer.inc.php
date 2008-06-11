<?php
/**
 * Shop_ShoppingBasketRowRenderer.inc.php
 *
 * @copyright Clear Line Web Design, 2007-03-03
 */

class
	Shop_ShoppingBasketRowRenderer
extends
	Database_RowRenderer
{
	public function
		get_admin_shopping_basket_html_table_tr($current_page_url)
	{
		$html_row =  new HTMLTags_TR();

		$row = $this->get_element();

		$table = $row->get_table();

		/*
		 * The data.
		 */ 

		$image_td = $this->get_product_image_td();
		$html_row->append_tag_to_content($image_td);

		$added_field = $table->get_field('added');
		$added_td = $this->get_data_html_table_td($added_field);
		$html_row->append_tag_to_content($added_td);

		$session_id_field = $table->get_field('session_id');
		$session_id_td = $this->get_data_html_table_td($session_id_field);
		$html_row->append_tag_to_content($session_id_td);

		$quantity_field = $table->get_field('quantity');
		$quantity_td = $this->get_data_html_table_td($quantity_field);
		$html_row->append_tag_to_content($quantity_td);

		$deleted_field = $table->get_field('deleted');
		$deleted_td = $this->get_data_html_table_td($deleted_field);
		$html_row->append_tag_to_content($deleted_td);

		$customer_region_td = $this->get_customer_region_td();
		$html_row->append_tag_to_content($customer_region_td);

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

	public function
		get_product_image_td()
	{
		try
		{
			$shopping_basket = $this->get_element();
			$product = $shopping_basket->get_product();
			$product_renderer = $product->get_renderer();

			return $product_renderer->get_image_td();
		}
		catch (Exception $e)
		{
			return new HTMLTags_TD();
		}
	}

	public function
		get_customer_region_td()
	{
		try
		{
			$shopping_basket = $this->get_element();
			$customer_region = $shopping_basket->get_customer_region();

			return new HTMLTags_TD($customer_region->get_name());
		}
		catch (Exception $e)
		{
			return new HTMLTags_TD();
		}
	}


	public function
		get_mini_shopping_basket_tr()
	{
		$shopping_basket = $this->get_element();
		$product = $shopping_basket->get_product();
		$database = $shopping_basket->get_database();
		$customer_regions_table = $database->get_table('hpi_shop_customer_regions');
		$customer_region = $customer_regions_table->get_row_by_id($_SESSION['customer_region_id']);

		$currency = $customer_region->get_currency();
		$product_currency_price = $product->get_product_currency_price($currency->get_id());
//                $product_price = new Shop_SumOfMoney($product_currency_price->get_price(), $currency);
		$sub_total_price = new Shop_SumOfMoney($shopping_basket->get_sub_total(), $currency);

		$mini_tr = new HTMLTags_TR();

		$name_td = new HTMLTags_TD($product->get_name());
//                $price_td = new HTMLTags_TD($product_price->get_as_string());
		$quantity_td = new HTMLTags_TD($shopping_basket->get_quantity());
		$sub_total_td = new HTMLTags_TD($sub_total_price->get_as_string());

		$mini_tr->append_tag_to_content($name_td);
//                $mini_tr->append_tag_to_content($price_td);
		$mini_tr->append_tag_to_content($quantity_td);
		$mini_tr->append_tag_to_content($sub_total_td);

		return $mini_tr;
	}
	
	/**
	 * This TR is displayed when the user is looking at the contens of their
	 * shopping basket.
	 */
	public function
		get_full_shopping_basket_tr()
	{
		$shopping_basket = $this->get_element();
		$product = $shopping_basket->get_product();
		$database = $shopping_basket->get_database();
		$customer_regions_table = $database->get_table('hpi_shop_customer_regions');
		$customer_region = $customer_regions_table->get_row_by_id($_SESSION['customer_region_id']);
		$currency = $customer_region->get_currency();

		$product_currency_price = $product->get_product_currency_price($currency->get_id());
		$product_price = new Shop_SumOfMoney($product_currency_price->get_price(), $currency);
		$sub_total_price = new Shop_SumOfMoney($shopping_basket->get_sub_total(), $currency);
		$full_tr = new HTMLTags_TR();

		#$name_td = new HTMLTags_TD($product->get_name());
		$name_td = $this->get_product_page_link_td();
		
		$price_td = new HTMLTags_TD($product_price->get_as_string());
		
		$quantity_td = $this->get_editable_quantity_td();
		
		$sub_total_td = new HTMLTags_TD($sub_total_price->get_as_string());
		
		$delete_a_td = new HTMLTags_TD();
		$delete_a_td->append_tag_to_content($this->get_delete_row_a());

		$full_tr->append_tag_to_content($name_td);
		$full_tr->append_tag_to_content($price_td);
		$full_tr->append_tag_to_content($quantity_td);
		$full_tr->append_tag_to_content($sub_total_td);
		$full_tr->append_tag_to_content($delete_a_td);

		return $full_tr;
	}
	
	/**
	 * The TD that shows the user what product they've put
	 * in their basket.
	 */
	public function
		get_product_page_link_td()
	{
		$shopping_basket = $this->get_element();
		
		#print_r($shopping_basket);
		#exit;
		
		$product = $shopping_basket->get_product();
		$product_renderer = $product->get_renderer();
		
		if ($product->has_main_photograph()) {
			$main_photograph = $product->get_main_photograph();
			$main_photograph_renderer = $main_photograph->get_renderer();
			
			$thumb_img = $main_photograph_renderer->get_thumbnail_img();
			$thumb_str = $thumb_img->get_as_string();
		} else {
			$thumb_str = '<img src="/plug-ins/shop/public-html/images/no-image-available-thumbnail.png" />';
		}
		
		$product_page_link = new HTMLTags_A();
		#$product_page_link->set_attribute_str('class', 'summary-link');

		$product_page_location = $product_renderer->get_product_page_url();

		$product_page_link->set_href($product_page_location);

		$product_page_link->append_str_to_content($thumb_str);
		$product_page_link->append_str_to_content($product->get_name());
		
		$name_td = new HTMLTags_TD();
		
		$name_td->append_tag_to_content($product_page_link);
		
		/*
		 * The variation of this product (size and colour)
		 */
		
		$variation_p = new HTMLTags_P();
		
		$variation_p->append_str_to_content('Size: ');
		$variation_p->append_str_to_content($shopping_basket->get('size'));
		
		$variation_p->append_str_to_content('&nbsp;');
		
		$variation_p->append_str_to_content('Colour: ');
		$variation_p->append_str_to_content($shopping_basket->get('colour'));
		
		$name_td->append_tag_to_content($variation_p);
		
		return $name_td;
	}

	public function
		get_editable_quantity_td()
	{
		$editable_quantity_td = new HTMLTags_TD();

		$shopping_basket_row = $this->get_element();

		$shopping_baskets_table = $shopping_basket_row->get_table();

		$shopping_basket_editing_action = new HTMLTags_URL();
		$shopping_basket_editing_action->set_file('/');

		$shopping_basket_editing_action->set_get_variable('section', 'plug-ins');
		$shopping_basket_editing_action->set_get_variable('module', 'shop');
		$shopping_basket_editing_action->set_get_variable('page', 'shopping-basket');
		$shopping_basket_editing_action->set_get_variable('type', 'redirect-script');

		$shopping_basket_editing_action
			->set_get_variable('edit_shopping_basket_id', $shopping_basket_row->get_id());

		$cancel_location = new HTMLTags_URL();
		$cancel_location->set_file('/shopping-basket.html');

		$shopping_basket_editing_form = new HTMLTags_SimpleOLForm('shopping_basket_editing');
		$shopping_basket_editing_form->set_action($shopping_basket_editing_action);
		$shopping_basket_editing_form->set_legend_text('Edit the amount');

		/*
		 * The quantity
		 */
		$quantity_field = $shopping_baskets_table->get_field('quantity');

		$quantity_field_renderer = $quantity_field->get_renderer();

		$input_tag = $quantity_field_renderer->get_form_input();

		$input_tag->set_value($shopping_basket_row->get_quantity());

		$input_tag->set_attribute_str('id', 'quantity');

		$shopping_basket_editing_form->add_input_tag(
			'quantity',
			$input_tag
		);

		/*
		 * The update button.
		 */
		$shopping_basket_editing_form->set_submit_text('Update');

		$shopping_basket_editing_form->set_cancel_location($cancel_location);

		$editable_quantity_td->append_tag_to_content($shopping_basket_editing_form);

		return $editable_quantity_td;
	}

	public function
		get_delete_row_a()
	{
		$shopping_basket = $this->get_element();

		$delete_row_link = new HTMLTags_A('Delete');
		$delete_row_link->set_attribute_str('class', 'cool_button');

		$delete_row_location = new HTMLTags_URL();
		$delete_row_location->set_file('/');

		$delete_row_location->set_get_variable('section', 'plug-ins');
		$delete_row_location->set_get_variable('module', 'shop');
		$delete_row_location->set_get_variable('page', 'shopping-basket');
		$delete_row_location->set_get_variable('type', 'redirect-script');

		$delete_row_location
			->set_get_variable('delete_shopping_basket_id',
				$shopping_basket->get_id()
			);

		$delete_row_link->set_href($delete_row_location);

		return $delete_row_link;
	}

	public function
		get_added_confirmation_div()
	{

		$shopping_basket = $this->get_element();
		$product = $shopping_basket->get_product();

		$confirmation_div = new HTMLTags_Div();

		$confirmation_text = <<<TXT
You have added&nbsp;
TXT;
		$confirmation_text .= $product->get_name();

		$confirmation_text .= <<<TXT
&nbsp;to your Shopping Basket.
TXT;

		$confirmation_text_p = new HTMLTags_P($confirmation_text);
		$confirmation_div->append_tag_to_content($confirmation_text_p);

		$all_products_link = new HTMLTags_A('View All Products');
		//            $all_products_link->set_attribute_str('class', 'all_products');

		$all_products_location = new HTMLTags_URL();
		$all_products_location->set_file('/hpi/shop/products.html');
		//            $all_products_location->set_get_variable('page', 'shopping_baskets');

		$all_products_link->set_href($all_products_location);

		$confirmation_div->append_tag_to_content($all_products_link);

		return $confirmation_div;
	}

	public function
		get_edited_confirmation_div()
	{

		$shopping_basket = $this->get_element();
		$product = $shopping_basket->get_product();

		$confirmation_div = new HTMLTags_Div();

		$confirmation_text = <<<TXT
You have changed the amount of&nbsp;
TXT;
		$confirmation_text .= $product->get_name();

		$confirmation_text .= <<<TXT
&nbsp;in your Shopping Basket.
TXT;

		$confirmation_text_p = new HTMLTags_P($confirmation_text);
		$confirmation_div->append_tag_to_content($confirmation_text_p);

		$all_products_link = new HTMLTags_A('View All Products');
		//            $all_products_link->set_attribute_str('class', 'all_products');

		$all_products_location = new HTMLTags_URL();
		$all_products_location->set_file('/hpi/shop/products.html');
		//            $all_products_location->set_get_variable('page', 'shopping_baskets');

		$all_products_link->set_href($all_products_location);

		$confirmation_div->append_tag_to_content($all_products_link);

		return $confirmation_div;
	}

	public function
		get_checkout_shopping_basket_tr()
	{
		$shopping_basket = $this->get_element();
		$product = $shopping_basket->get_product();
		$database = $shopping_basket->get_database();
		$customer_regions_table = $database->get_table('hpi_shop_customer_regions');
		$customer_region = $customer_regions_table->get_row_by_id($_SESSION['customer_region_id']);
		$currency = $customer_region->get_currency();
		$product_currency_price = $product->get_product_currency_price($currency->get_id());

		$full_tr = new HTMLTags_TR();

		$name_and_image_td = $this->get_product_td();
//                $name_td = new HTMLTags_TD($product->get_name());

		$product_price = new Shop_SumOfMoney($product_currency_price->get_price(), $currency);
		$sub_total_price = new Shop_SumOfMoney($shopping_basket->get_sub_total(), $currency);

		$price_td = new HTMLTags_TD($product_price->get_as_string());
		$quantity_td = new HTMLTags_TD($shopping_basket->get_quantity());
		$sub_total_td = new HTMLTags_TD($sub_total_price->get_as_string());

		$full_tr->append_tag_to_content($name_and_image_td);
		$full_tr->append_tag_to_content($price_td);
		$full_tr->append_tag_to_content($quantity_td);
		$full_tr->append_tag_to_content($sub_total_td);

		return $full_tr;
	}

	public function
		get_product_td()
	{
		$shopping_basket = $this->get_element();
		$product = $shopping_basket->get_product();

		$photograph = $product->get_main_photograph();
		$photograph_renderer = $photograph->get_renderer();

		$product_td = new HTMLTags_TD();
		$product_td->append_tag_to_content($photograph_renderer->get_thumbnail_img());
		$product_td->append_str_to_content($product->get_name());

		return $product_td;
	}
}    
?>
