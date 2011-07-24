<?php
/**
 * Shop_CustomerRegionsTableRenderer
 *
 * @copyright Clear Line Web Design, 2007-04-09
 */

class
	Shop_CustomerRegionsTableRenderer
	extends
	Database_TableRenderer
{
	public function get_customer_region_adding_form(
		HTMLTags_URL $redirect_script_url,
		HTMLTags_URL $cancel_url
	)
	{
		$customer_regions_table = $this->get_element();

		$customer_region_adding_form = new HTMLTags_SimpleOLForm('customer_region_adding');
		$customer_region_adding_form->set_action($redirect_script_url);
		$customer_region_adding_form->set_legend_text('Add a customer region');

		# The Fields:
		/*
		 * The name
		 */
		$name_field = $customer_regions_table->get_field('name');
		$name_field_renderer = $name_field->get_renderer();
		$input_tag = $name_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'name');
		$customer_region_adding_form->add_input_tag(
			'name',
			$input_tag
		);        
		/*
		 * The description
		 */
		$description_field = $customer_regions_table->get_field('description');
		$description_field_renderer = $description_field->get_renderer();
		$input_tag = $description_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'description');
		$customer_region_adding_form->add_input_tag(
			'description',
			$input_tag
		);

		/*
		 * The currency_id
		 */
		$currency_li = $this->get_currency_form_select_li();
		$customer_region_adding_form->add_input_li($currency_li);
	
		/*
		 * The language_id
		 */
		$language_li = $this->get_language_form_select_li();
		$customer_region_adding_form->add_input_li($language_li);

		/*
		 * The sort_order
		 */
		$sort_order_field = $customer_regions_table->get_field('sort_order');
		$sort_order_field_renderer = $sort_order_field->get_renderer();
		$input_tag = $sort_order_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'sort_order');
		$customer_region_adding_form->add_input_tag(
			'sort_order',
			$input_tag
		);        
	
		/*
		 * The add button.
		 */
		$customer_region_adding_form->set_submit_text('Add');
		$customer_region_adding_form->set_cancel_location($cancel_url);

		return $customer_region_adding_form;
	}

	public function
		get_currency_form_select_li()
	{
		$input_li = new HTMLTags_LI();

		$input_label = new HTMLTags_Label('Currency');
		$input_label->set_attribute_str('for', 'currency_id');

		$input_li->append_tag_to_content($input_label);

		$input_li->append_tag_to_content($this->get_currency_form_select());

		$input_msg_box = new HTMLTags_Span();
		$input_msg_box->set_attribute_str('id', 'currency_id' . 'msg');
		$input_msg_box->set_attribute_str('class', 'rules');

		$input_li->append_tag_to_content($input_msg_box);

		return $input_li;
	}	

	public function
		get_currency_form_select()
	{
		$customer_regions_table = $this->get_element();
		$database = $customer_regions_table->get_database();
		$currencies_table = $database->get_table('hpi_shop_currencies');
		$currencies = $currencies_table->get_all_rows();

		$select = new HTMLTags_Select();
		$select->set_attribute_str('name', 'currency_id');

		foreach ($currencies as $currency) 
		{
			$currency_text = '';
			$currency_text .= $currency->get_name();
			$currency_text .= '&nbsp;(';
			$currency_text .= $currency->get_symbol();
			$currency_text .= ')';

			$option = new HTMLTags_Option($currency_text);
			$option->set_attribute_str('value', $currency->get_id());
			$select->add_option($option);
		}

		return $select;
	}

	public function
		get_language_form_select_li()
	{
		$input_li = new HTMLTags_LI();

		$input_label = new HTMLTags_Label('Language');
		$input_label->set_attribute_str('for', 'language_id');

		$input_li->append_tag_to_content($input_label);

		$input_li->append_tag_to_content($this->get_language_form_select());

		$input_msg_box = new HTMLTags_Span();
		$input_msg_box->set_attribute_str('id', 'language_id' . 'msg');
		$input_msg_box->set_attribute_str('class', 'rules');

		$input_li->append_tag_to_content($input_msg_box);

		return $input_li;
	}	

	public function
		get_language_form_select()
	{
		$customer_regions_table = $this->get_element();
		$database = $customer_regions_table->get_database();
		$languages_table = $database->get_table('hpi_shop_languages');
		$languages = $languages_table->get_all_rows();

		$select = new HTMLTags_Select();
		$select->set_attribute_str('name', 'language_id');

		foreach ($languages as $language) 
		{
			$language_text = '';
			$language_text .= $language->get_name();
			$language_text .= '&nbsp;(';
			$language_text .= $language->get_iso_639_1_code();
			$language_text .= ')';

			$option = new HTMLTags_Option($language_text);
			$option->set_attribute_str('value', $language->get_id());
			$select->add_option($option);
		}

		return $select;
	}

	public function
		get_customer_region_selection_div()
	{
		$page_manager = PublicHTML_PageManager::get_instance();

//                $mysql_user_factory = Database_MySQLUserFactory::get_instance();
//                $mysql_user = $mysql_user_factory->get_for_this_project();
//                $database = $mysql_user->get_database();

		#$customer_regions_table = $database->get_table('hpi_shop_customer_regions');
		$customer_regions_table = $this->get_element();

		$customer_regions = $customer_regions_table->get_all_rows('sort_order', 'ASC');

		$customer_regions_div = new HTMLTags_Div();
		$customer_regions_div->set_attribute_str('id', 'tabs');
		$customer_regions_ul = new HTMLTags_UL();

		foreach ($customer_regions as $customer_region) {
			$customer_region_li = new HTMLTags_LI();

			$customer_region_link_span = new HTMLTags_Span($customer_region->get_name());

			if ($customer_region->get_id() == $_SESSION['customer_region_id']) {
				$double_span = new HTMLTags_Span();
				$double_span->set_attribute_str('class', 'current');
				$double_span->append_tag_to_content($customer_region_link_span);

				$customer_region_li->append_tag_to_content($double_span);              
			} else {
				//$customer_region_link_file = '/';
				//$customer_region_link_location = new HTMLTags_URL();
				//$customer_region_link_location->set_file($customer_region_link_file);
				//$customer_region_link_location->set_get_variable('page', $page_manager->get_page());

				$redirect_script_location
					= PublicHTML_PublicURLFactory
					::get_url(
						'plug-ins',
						'shop',
						'customer-region',
						'redirect-script'
					);
				$redirect_script_location
					->set_get_variable('customer_region_session', $customer_region->get_id());

				$desired_location = $page_manager->get_script_uri();
				if (isset($_GET['product_id']))
				{
					$desired_location
						->set_get_variable(
							'product_id', $_GET['product_id']
						);
				}
				if (isset($_GET['product_category_id']))
				{
					$desired_location
						->set_get_variable(
							'product_category_id', $_GET['product_category_id']
						);
				}
				$redirect_script_location->set_get_variable(
					'desired_location',
					urlencode($desired_location->get_as_string())
				);
				$customer_region_link_anchor = new HTMLTags_A();
				$customer_region_link_anchor->set_href($redirect_script_location);
				$customer_region_link_anchor
					->set_attribute_str(
						'title',
						'Change your location to&nbsp;' . $customer_region->get_name()
					);

				$customer_region_link_anchor->append_tag_to_content($customer_region_link_span);

				$customer_region_li->append_tag_to_content($customer_region_link_anchor);
			}

			$customer_regions_ul->append_tag_to_content($customer_region_li);
		}

		$customer_regions_div->append_tag_to_content($customer_regions_ul);

		#echo $customer_regions_div->get_as_string();
		return $customer_regions_div;
	}
}
?>
