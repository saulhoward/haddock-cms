<?php
/**
 * Shop_OrderRowRenderer.inc.php
 *
 * @copyright Clear Line Web Design, 2007-03-03
 */

class
	Shop_OrderRowRenderer
extends
	Database_RowRenderer
{
	public function
		get_admin_order_html_table_tr($current_page_url)
	{
		$html_row =  new HTMLTags_TR();

		$row = $this->get_element();

		$table = $row->get_table();

		/*
		 * The data.
		 */ 

		$added_field = $table->get_field('added');
		$added_td = $this->get_data_html_table_td($added_field);
		$html_row->append_tag_to_content($added_td);
		
		/*
		 * RFI 2008-01-18
		 */
		#$image_td = $this->get_product_image_td();
		#$html_row->append_tag_to_content($image_td);

		#$supplier_td = $this->get_product_supplier_td();
		#$html_row->append_tag_to_content($supplier_td);

		#$quantity_field = $table->get_field('quantity');
		#$quantity_td = $this->get_data_html_table_td($quantity_field);
		#$html_row->append_tag_to_content($quantity_td);

		$txn_id_td = $this->get_txn_id_td();
		$html_row->append_tag_to_content($txn_id_td);

		$customer_td = $this->get_customer_td();
		$html_row->append_tag_to_content($customer_td);

		$status_field = $table->get_field('status');
		$status_td = $this->get_data_html_table_td($status_field);
		$html_row->append_tag_to_content($status_td);

		/*
		 * The edit td.
		 */
		$edit_td = new HTMLTags_TD();
		$edit_link = new HTMLTags_A('View Order');
		$edit_link->set_attribute_str('class', 'cool_button');
		$edit_link->set_attribute_str('id', 'edit_table_button');
		$edit_location = clone $current_page_url;
		$edit_location->set_get_variable('edit_id', $row->get_id());
		$edit_link->set_href($edit_location);
		$edit_td->append_tag_to_content($edit_link);
		$html_row->append_tag_to_content($edit_td);

		return $html_row;
	}

	public function
		get_product_supplier_td()
	{
		$order = $this->get_element();
		$product = $order->get_product();
		$supplier = $product->get_supplier();

		return new HTMLTags_TD($supplier->get_name());
	}


	public function
		get_product_image_td()
	{
		$order = $this->get_element();
		$product = $order->get_product();
		$product_renderer = $product->get_renderer();

		return $product_renderer->get_image_td();
	}

	public function
		get_customer_td()
	{
		$order = $this->get_element();
		$customer = $order->get_customer();

		return new HTMLTags_TD($customer->get_full_name_and_country_string());
	}
	
	public function
		get_txn_id_td()
	{
		$order = $this->get_element();
		$txn_id = $order->get('txn_id');

		return new HTMLTags_TD($txn_id);
	}
	
	public function
		get_mini_order_tr()
	{
		$order = $this->get_element();
		$product = $order->get_product();
		$database = $order->get_database();
		$customer_regions_table = $database->get_table('hpi_shop_customer_regions');
		$customer_region = $customer_regions_table->get_row_by_id($_SESSION['customer_region_id']);
		$currency = $customer_region->get_currency();

		$product_currency_price = $product->get_product_currency_price($currency->get_id());
		$mini_tr = new HTMLTags_TR();

		$name_td = new HTMLTags_TD($product->get_name());
		$price_td = new HTMLTags_TD($product_currency_price->get_price());
		$quantity_td = new HTMLTags_TD($order->get_quantity());
		$sub_total_td = new HTMLTags_TD($order->get_sub_total());

		$mini_tr->append_tag_to_content($name_td);
		$mini_tr->append_tag_to_content($price_td);
		$mini_tr->append_tag_to_content($quantity_td);
		$mini_tr->append_tag_to_content($sub_total_td);

		return $mini_tr;
	}

	public function
		get_public_order_tr()
	{
		$order = $this->get_element();
//                $product = $order->get_product();
		$database = $order->get_database();
		$customer_regions_table = $database->get_table('hpi_shop_customer_regions');
		$customer_region = $customer_regions_table->get_row_by_id($_SESSION['customer_region_id']);
		$currency = $customer_region->get_currency();

//                $product_currency_price = $product->get_product_currency_price($currency->get_id());
//                $product_price = new Shop_SumOfMoney($product_currency_price->get_price(), $currency);

		$full_tr = new HTMLTags_TR();

		$added_str = strftime('%e %b, %G', strtotime($order->get_added()));
		$added_td = new HTMLTags_TD($added_str);
		$id_td = new HTMLTags_TD($order->get_txn_id());
//                $name_td = new HTMLTags_TD($product->get_name());
//                $price_td = new HTMLTags_TD($product_price->get_as_string());
//                $quantity_td = new HTMLTags_TD($order->get_quantity());
		$status_td = new HTMLTags_TD($order->get_status());

		$full_tr->append_tag_to_content($added_td);
		$full_tr->append_tag_to_content($id_td);
//                $full_tr->append_tag_to_content($name_td);
//                $full_tr->append_tag_to_content($price_td);
//                $full_tr->append_tag_to_content($quantity_td);
		$full_tr->append_tag_to_content($status_td);

		return $full_tr;
	}


	public function
		get_public_order_supplier_tr($current_page_url)
	{
		$order = $this->get_element();
		$product = $order->get_product();
		$customer = $order->get_customer();
		$customer_region = $customer->get_customer_region();
		$database = $order->get_database();

		$full_tr = new HTMLTags_TR();

		$added_str = strftime('%e %b, %G', strtotime($order->get_added()));
		$added_td = new HTMLTags_TD($added_str);

		$id_td = new HTMLTags_TD($order->get_id());

		$name_td = new HTMLTags_TD($product->get_name());

		$customer_td = new HTMLTags_TD($customer->get_full_name_and_country_string() . '&nbsp;');
		$customer_td->append_tag_to_content(new HTMLTags_BR());

		$shipping_em = new HTMLTags_Em($customer_region->get_name());
		$shipping_em->set_attribute_str('class', 'shipping');
		$customer_td->append_tag_to_content($shipping_em);

		$quantity_td = new HTMLTags_TD($order->get_quantity());
		$status_td = new HTMLTags_TD($order->get_status());

		$full_tr->append_tag_to_content($added_td);
		$full_tr->append_tag_to_content($id_td);
		$full_tr->append_tag_to_content($name_td);
		$full_tr->append_tag_to_content($customer_td);
		$full_tr->append_tag_to_content($quantity_td);
		$full_tr->append_tag_to_content($status_td);

		/*
		 * The edit td.
		 */
		$edit_td = new HTMLTags_TD();
		$edit_link = new HTMLTags_A('Set Status');
		$edit_link->set_attribute_str('class', 'cool_button');
		$edit_link->set_attribute_str('id', 'edit_table_button');
		$edit_location = clone $current_page_url;
		$edit_location->set_get_variable('set_status_order_id', $order->get_id());
		$edit_link->set_href($edit_location);
		$edit_td->append_tag_to_content($edit_link);
		$full_tr->append_tag_to_content($edit_td);

		return $full_tr;
	}

	public function
		get_editable_quantity_td()
	{
		$editable_quantity_td = new HTMLTags_TD();

		$order_row = $this->get_element();

		$orders_table = $order_row->get_table();

		$order_editing_action = new HTMLTags_URL();
		$order_editing_action->set_file('/');
		$order_editing_action->set_get_variable('page', 'shopping-basket');
		$order_editing_action->set_get_variable('type', 'redirect-script');
		$order_editing_action
			->set_get_variable('edit_order_id', $order_row->get_id());

		$cancel_location = new HTMLTags_URL();
		$cancel_location->set_file('/shopping-basket.html');

		$order_editing_form = new HTMLTags_SimpleOLForm('order_editing');
		$order_editing_form->set_action($order_editing_action);
		$order_editing_form->set_legend_text('Edit the amount');

		/*
		 * The quantity
		 */
		$quantity_field = $orders_table->get_field('quantity');

		$quantity_field_renderer = $quantity_field->get_renderer();

		$input_tag = $quantity_field_renderer->get_form_input();

		$input_tag->set_value($order_row->get_quantity());

		$input_tag->set_attribute_str('id', 'quantity');

		$order_editing_form->add_input_tag(
			'quantity',
			$input_tag
		);        

		/*
		 * The update button.
		 */
		$order_editing_form->set_submit_text('Update');

		$order_editing_form->set_cancel_location($cancel_location);

		$editable_quantity_td->append_tag_to_content($order_editing_form);

		return $editable_quantity_td;
	}

	public function
		get_delete_row_a()
	{

		$order = $this->get_element();

		$delete_row_link = new HTMLTags_A('Delete');
		$delete_row_link->set_attribute_str('class', 'cool_button');

		$delete_row_location = new HTMLTags_URL();
		$delete_row_location->set_file('/');
		$delete_row_location->set_get_variable('page', 'shopping-basket');

		$delete_row_location->set_get_variable('type', 'redirect-script');
		$delete_row_location
			->set_get_variable('delete_order_id',
				$order->get_id());

		$delete_row_link->set_href($delete_row_location);

		return $delete_row_link;
	}

	public function
		get_added_confirmation_div()
	{

		$order = $this->get_element();
		$product = $order->get_product();

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
		$all_products_location->set_file('/products.html');
		//            $all_products_location->set_get_variable('page', 'orders');

		$all_products_link->set_href($all_products_location);

		$confirmation_div->append_tag_to_content($all_products_link);

		return $confirmation_div;
	}

	public function
		get_edited_confirmation_div()
	{

		$order = $this->get_element();
		$product = $order->get_product();

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
		$all_products_location->set_file('/products.html');
		//            $all_products_location->set_get_variable('page', 'orders');

		$all_products_link->set_href($all_products_location);

		$confirmation_div->append_tag_to_content($all_products_link);

		return $confirmation_div;
	}

	public function
		get_checkout_order_tr()
	{
		$order = $this->get_element();
		$product = $order->get_product();
		$database = $order->get_database();
		$customer_regions_table = $database->get_table('hpi_shop_customer_regions');
		$customer_region = $customer_regions_table->get_row_by_id($_SESSION['customer_region_id']);
		$currency = $customer_region->get_currency();
		$product_currency_price = $product->get_product_currency_price($currency->get_id());

		$full_tr = new HTMLTags_TR();

		$name_td = new HTMLTags_TD($product->get_name());
		$price_td = new HTMLTags_TD($product_currency_price->get_price());
		$quantity_td = new HTMLTags_TD($order->get_quantity());
		$sub_total_td = new HTMLTags_TD($order->get_sub_total());

		$full_tr->append_tag_to_content($name_td);
		$full_tr->append_tag_to_content($price_td);
		$full_tr->append_tag_to_content($quantity_td);
		$full_tr->append_tag_to_content($sub_total_td);

		return $full_tr;
	}

	public function
		get_order_editing_form_div(
			HTMLTags_URL $redirect_script_url,
			HTMLTags_URL $cancel_url
		)
	{
		$order_editing_div = new HTMLTags_Div();
		$order_editing_div->append_tag_to_content(
			$this->get_order_editing_form($redirect_script_url, $cancel_url)
		);
		
		$order_editing_div->append_tag_to_content($this->get_order_description_div());
		
		$order_editing_div->append_str_to_content($this->get_products_table_as_str());
		
		$order_editing_div->append_tag_to_content($this->get_order_editing_description_p());

		return $order_editing_div;
	}

	public function get_order_editing_form(
		HTMLTags_URL $redirect_script_url,
		HTMLTags_URL $cancel_url
	)
	{
		$order_row = $this->get_element();
		$database = $order_row->get_database();
		$orders_table = $database->get_table('hpi_shop_orders');

		$order_editing_form = new HTMLTags_SimpleOLForm('order_editing');
		$order_editing_form->set_attribute_str('class', 'cmxform');
		$order_editing_form->set_action($redirect_script_url);
		$order_editing_form->set_legend_text('Set the status of this order');

		/*
		 * The status
		 */
		$status_li = $this->get_status_form_select_li();
		$order_editing_form->add_input_li($status_li);       

		/*
		 * The edit button.
		 */
		$order_editing_form->set_submit_text('Update');
		$order_editing_form->set_cancel_location($cancel_url);
		return $order_editing_form;
	}

	public function
		get_order_description_div()
	{
		$order = $this->get_element();
		$customer = $order->get_customer();
		#$product = $order->get_product();
		$address = $customer->get_address();

		$description_div = new HTMLTags_Div();
		$description_div->set_attribute_str('class', 'details');

		$html = 
			'<h3>Order #'
			.
			$order->get_id()
			.
			':</h3><dl><dt>Customer:</dt><dd>'
			.
			$customer->get_first_name() 
			.
			'&nbsp;'
			.
			$customer->get_last_name() 
			.
			'</dd><dt>Address:</dt><dd>'
			.
			$address->get_street_address() 
			.
			',<br />'
			.
			$address->get_locality() 
			.
			',<br />'
			.
			$address->get_postal_code()
			.
			',<br />'
			.
			$address->get_country_name() 
			.
			'</dd><dt>Order received:</dt><dd>'
			.
			date('F j, Y, g:i a', strtotime($order->get_added()))
			.
			'</dd>'
			.
			'<dt>Transaction ref:</dt><dd>'
			.
			$order->get_txn_id()
			.
			'</dd></dl>';

		$description_div->append_str_to_content($html);
		return $description_div;
	}

	public function
		get_order_editing_description_p()
	{
		$text = <<<TXT
If the status is pending, the payment has not been confirmed yet. If the status is paid, the payment is confirmed. Set the status to dispatched once you have sent the item off.
TXT;
		$description_p = new HTMLTags_P($text);
		$description_p->set_attribute_str('class', 'form_explanation');
		return $description_p;
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
		$order = $this->get_element();
		$database = $order->get_database();
		$orders_table = $database->get_table('hpi_shop_orders');
		$status_field = $orders_table->get_field('status');
		$statuses = $status_field->get_options();

		$select = new HTMLTags_Select();
		$select->set_attribute_str('name', 'status');

		foreach ($statuses as $status) 
		{
			$option = new HTMLTags_Option($status);
			$option->set_attribute_str('value', $status);
			if ($order->get_status() == $status)
			{
				$option->set_attribute_str('selected', 'selected');
			}
			$select->add_option($option);
		}

		return $select;
	}
	
	public function
		get_products_table_as_str()
	{
		ob_start();
		
		$order = $this->get_element();
		
		$txn_id = $order->get('txn_id');
		
		$dbh = DB::m();
		
#		$query = <<<SQL
#SELECT
#	hpi_shop_products.name AS product_name,
#	hpi_trackit_stock_management_products.product_id AS trackit_product_id,
#	hpi_trackit_stock_management_products.supplier_code AS trackit_supplier_code,
#	hpi_shop_shopping_baskets.size AS size,
#	hpi_shop_shopping_baskets.colour AS colour,
#	hpi_shop_shopping_baskets.quantity AS order_quantity,
#	hpi_trackit_stock_management_stock_levels.quantity AS quantity_in_stock
#FROM
#	hpi_shop_shopping_baskets,
#	hpi_shop_products,
#	hpi_trackit_stock_management_products,
#	hpi_trackit_stock_management_stock_levels
#WHERE
#	hpi_shop_shopping_baskets.txn_id = $txn_id
#	AND
#	hpi_shop_shopping_baskets.product_id = hpi_shop_products.id
#	AND
#	hpi_shop_shopping_baskets.product_id = hpi_trackit_stock_management_products.shop_product_id
#	AND
#	(
#		hpi_shop_shopping_baskets.size = hpi_trackit_stock_management_stock_levels.size
#		AND
#		hpi_shop_shopping_baskets.colour = hpi_trackit_stock_management_stock_levels.colour
#		AND
#		hpi_trackit_stock_management_products.product_id = hpi_trackit_stock_management_stock_levels.product_id
#	)
#SQL;

		$query = <<<SQL
SELECT
	hpi_shop_products.name AS product_name,
	hpi_trackit_stock_management_products.product_id AS trackit_product_id,
	hpi_trackit_stock_management_products.supplier_code AS trackit_supplier_code,
	hpi_shop_shopping_baskets.size AS size,
	hpi_shop_shopping_baskets.colour AS colour,
	hpi_shop_shopping_baskets.quantity AS order_quantity,
	hpi_trackit_stock_management_stock_levels.quantity AS quantity_in_stock,
	hpi_shop_product_photograph_links.photograph_id AS photograph_id
FROM
	hpi_shop_shopping_baskets
		INNER JOIN hpi_shop_products
			ON hpi_shop_shopping_baskets.product_id = hpi_shop_products.id
		INNER JOIN hpi_trackit_stock_management_products
			ON hpi_shop_shopping_baskets.product_id = hpi_trackit_stock_management_products.shop_product_id
		INNER JOIN hpi_trackit_stock_management_stock_levels
			ON hpi_trackit_stock_management_products.product_id = hpi_trackit_stock_management_stock_levels.product_id
		LEFT JOIN hpi_shop_product_photograph_links
			ON hpi_shop_products.id = hpi_shop_product_photograph_links.product_id
WHERE
	hpi_shop_shopping_baskets.txn_id = $txn_id
SQL;

		/* Removed these last two AND clauses cos some products weren't showing! */
//        AND
//        (
//                hpi_shop_shopping_baskets.size = hpi_trackit_stock_management_stock_levels.size
//                AND
//                hpi_shop_shopping_baskets.colour = hpi_trackit_stock_management_stock_levels.colour
//        )
//        AND
//        hpi_shop_product_photograph_links.type = 'main'
//SQL;

		#echo "$query\n"; exit;
		
		#INNER JOIN 	hpi_trackit_stock_management_stock_levels ON
		#	hpi_trackit_stock_management_products.shop_product_id = hpi_trackit_stock_management_stock_levels.product_id
		
		$result = mysql_query($query, $dbh);
		
		$products = array();
		
		while ($row = mysql_fetch_assoc($result)) {
			$products[] = $row;
		}
		
		#print_r($products);
		
		$order_row = $this->get_element();
		$database = $order_row->get_database();
		$photographs_table = $database->get_table('hpi_shop_photographs');
		
?>
<table id="order_products">
	<caption>Products</caption>
	<thead>
		<tr>
			<th>Name</th>
			<th>Product ID</th>
			<th>Supplier Code</th>
			<th>Size</th>
			<th>Colour</th>
			<th>Order Quantity</th>
			<th>Quantity in stock</th>
			<th>Photograph</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($products as $product): ?>
		<tr>
			<td><?php echo $product['product_name']; ?></td>
			<td><?php echo $product['trackit_product_id']; ?></td>
			<td><?php echo $product['trackit_supplier_code']; ?></td>
			<td><?php echo $product['size']; ?></td>
			<td><?php echo $product['colour']; ?></td>
			<td><?php echo floor($product['order_quantity']); ?></td>
			<td><?php echo floor($product['quantity_in_stock']); ?></td>
			<td><?php
			if (isset($product['photograph_id'])) {
				$photograph_row = $photographs_table->get_row_by_id($product['photograph_id']);
				$photograph_row_renderer = $photograph_row->get_renderer();
				
				echo $photograph_row_renderer->get_thumbnail_image_a();
			}
			?></td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>
<?php
		
		return ob_get_clean();
	}
}    
?>
