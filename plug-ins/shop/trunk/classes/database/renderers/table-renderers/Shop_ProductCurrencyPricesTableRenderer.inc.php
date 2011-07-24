<?php
/**
 * Shop_ProductCurrencyPricesTableRenderer
 *
 * @copyright Clear Line Web Design, 2007-04-09
 */

class
	Shop_ProductCurrencyPricesTableRenderer
	extends
	Database_TableRenderer
{
	public function
		get_product_currency_price_editing_form(
			$product_id,
			$redirect_script_url,
			$cancel_href
		)
	{
		$product_currency_prices_table = $this->get_element();
		$database = $product_currency_prices_table->get_database();
		$products_table = $database->get_table('hpi_shop_products');
		$currencies_table = $database->get_table('hpi_shop_currencies');
		$product = $products_table->get_row_by_id($product_id);

		$product_currency_price_editing_form = new HTMLTags_SimpleOLForm('product_currency_price_editing');
		$product_currency_price_editing_form->set_action($redirect_script_url);
		$legend_text = '';
		$legend_text .= 'Edit prices for&nbsp;';
		$legend_text .= $product->get_name();
		$product_currency_price_editing_form->set_legend_text($legend_text);

		$currencies = $currencies_table->get_all_rows();

		foreach ($currencies as $currency)
		{
			/*
			 * The price
			 */
			$conditions = array();
			$conditions['product_id'] = $product_id;
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

			$input_label_title = '';
			$input_label_title .= $currency->get_id();
				
			$input_label = new HTMLTags_Label($input_label_text);
			$input_label->set_attribute_str('for', $input_label_title);

			$input_li->append_tag_to_content($input_label);

			$input = new HTMLTags_Input();
			$input->set_attribute_str('type', 'text');
			$input->set_attribute_str('name', $input_label_title);
			$input->set_value($current_price);

			$input_li->append_tag_to_content($input);
			$product_currency_price_editing_form->add_input_li($input_li);
		}
		/*
		 * The add button.
		 */
		$product_currency_price_editing_form->set_submit_text('Edit');

		$product_currency_price_editing_form->set_cancel_location($cancel_href);

		return $product_currency_price_editing_form;
	}
}
?>
