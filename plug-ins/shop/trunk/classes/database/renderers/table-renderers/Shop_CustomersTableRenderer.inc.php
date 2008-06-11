<?php
/**
 * Shop_CustomersTableRenderer
 *
 * @copyright Clear Line Web Design, 2007-04-09
 */

require_once PROJECT_ROOT
. '/haddock/database/classes/renderers/'
. 'Database_TableRenderer.inc.php';

require_once PROJECT_ROOT
	. '/haddock/html-tags/classes/standard/'
	. 'HTMLTags_UL.inc.php';
 
class
	Shop_CustomersTableRenderer
	extends
	Database_TableRenderer
{
	public function
		get_form_li(
			$name,
			HTMLTags_InputTag $input_tag,
			$label_text = null,
			$post_content = ''
		)
	{
		#echo "In HTMLTags_SimpleOLForm::add_input_tag(...)\n";

		$input_li = new HTMLTags_LI();

		if (!isset($label_text)) {
			$l_t_l_o_ws
				= Formatting_ListOfWords::get_list_of_words_for_string(
					$name,
					'_'
				);

			$label_text = $l_t_l_o_ws->get_words_as_capitalised_string();
			#    echo "\$label_text: $label_text\n";
			#} else {
			#    echo "\$label_text: $label_text\n";
		}

		#echo "After if\n";

		$input_label = new HTMLTags_Label($label_text);
		$input_label->set_attribute_str('for', $name);
		#$input_label->set_attribute_str('id', $name);

		$input_li->append_tag_to_content($input_label);

		$input_li->append_tag_to_content($input_tag);

		if (strlen($post_content) > 0) {

			$input_li->append_str_to_content($post_content);

		}

		$input_msg_box = new HTMLTags_Span();
		$input_msg_box->set_attribute_str('id', $name . 'msg');
		$input_msg_box->set_attribute_str('class', 'rules');

		$input_li->append_tag_to_content($input_msg_box);

		if (count($this->input_lis) == 0) {
			$this->first_input_name = $name;
		}

		return $input_li;
	}

	public function get_simplified_customer_adding_form(
		HTMLTags_URL $redirect_script_url,
		HTMLTags_URL $cancel_url
	)
	{
		/* form should just have name, email one address box and postcode, country name already filled in */
		$customers_table = $this->get_element();
		$database = $customers_table->get_database();
		//$email_addresses_table = $database->get_table('hpi_shop_email_addresses');
		$telephone_numbers_table = $database->get_table('hpi_shop_telephone_numbers');
		$addresses_table = $database->get_table('hpi_shop_addresses');

		$customer_adding_form = new HTMLTags_Form('customer_adding');
		$customer_adding_form->set_attribute_str('class', 'cmxform'); 
		$customer_adding_form->set_attribute_str('id', 'customer-details-form'); 

		$customer_adding_form->set_action($redirect_script_url);

		#$customer_adding_form = new HTMLTags_TagContent();
        
		#
		# The Log In Details field set.
		#
		$log_in_details_field_set = new HTMLTags_FieldSet();
		$log_in_details_field_set->append_tag_to_content(new HTMLTags_Legend('Log In Details'));

		$log_in_details_field_set_inputs_list = new HTMLTags_OL();

		/*
		 * The email_address
		 */
		$email_address_field = $customers_table->get_field('email_address');
		$email_address_field_renderer = $email_address_field->get_renderer();
		$input_tag = $email_address_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'email_address');

		$email_address_li = $this->get_form_li(
			'email_address',
			$input_tag
		);        

		$log_in_details_field_set_inputs_list->append_tag_to_content($email_address_li); 

		/*
		 * The password
		 */
		$password_field = $customers_table->get_field('password');
		$password_field_renderer = $password_field->get_renderer();
		$input_tag = $password_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'password');
		$password_li = $this->get_form_li(
			'password',
			$input_tag
		); 

		$log_in_details_field_set_inputs_list->append_tag_to_content($password_li); 

		$log_in_details_field_set->append_tag_to_content($log_in_details_field_set_inputs_list);
		$customer_adding_form->append_tag_to_content($log_in_details_field_set);

		#
		# SUBMIT BUTTON
		#
		$submit_button = new HTMLTags_Input();

		$submit_button->set_attribute_str('type', 'submit');
		$submit_button->set_attribute_str('value', 'Add');
		$submit_button->set_attribute_str('class', 'submit');

		$submit_buttons_div = new HTMLTags_Div();
		$submit_buttons_div->set_attribute_str('class', 'submit_buttons_div');

		$submit_buttons_div->append_tag_to_content($submit_button);

		$cancel_button = new HTMLTags_Input();

		$onclick = 'document.location.href=(\'';
		$onclick .= $cancel_url->get_as_string();
		$onclick .= "')";

		$cancel_button->set_attribute_str('type', 'button');
		$cancel_button->set_attribute_str('value', 'Cancel');
		$cancel_button->set_attribute_str('onclick', $onclick);
		$cancel_button->set_attribute_str('class', 'submit');

		$submit_buttons_div->append_tag_to_content($cancel_button);

		$customer_adding_form->append_tag_to_content($submit_buttons_div);

		# The Fields:
		//                $last_added_id = $customers_table->add_simplified_customer(
		//                        $_POST['full_name'],
		//                        $_POST['password'],
		//                        $_POST['email_address'],
		//                        $_POST['telephone_number'],
		//                        $_POST['full_address'],
		//                        $_POST['postal_code'],
		//                        $_POST['country_name'],
		//                        $_POST['customer_region_id']
		//                )
		return $customer_adding_form;
	}

	public function get_simplified_customer_and_address_adding_form(
		HTMLTags_URL $redirect_script_url,
		HTMLTags_URL $cancel_url
	)
	{
		/* form should just have name, email one address box and postcode, country name already filled in */
		$customers_table = $this->get_element();
		$database = $customers_table->get_database();
		//$email_addresses_table = $database->get_table('hpi_shop_email_addresses');
		$telephone_numbers_table = $database->get_table('hpi_shop_telephone_numbers');
		$addresses_table = $database->get_table('hpi_shop_addresses');

		$customer_adding_form = new HTMLTags_Form('customer_adding');
		$customer_adding_form->set_attribute_str('class', 'cmxform'); 
		$customer_adding_form->set_attribute_str('id', 'customer-details-form'); 

		$customer_adding_form->set_action($redirect_script_url);

		#$customer_adding_form = new HTMLTags_TagContent();
        
		#
		# The Log In Details field set.
		#
		$log_in_details_field_set = new HTMLTags_FieldSet();
		$log_in_details_field_set->append_tag_to_content(new HTMLTags_Legend('Log In Details'));

		$log_in_details_field_set_inputs_list = new HTMLTags_OL();

		/*
		 * The email_address
		 */
		$email_address_field = $customers_table->get_field('email_address');
		$email_address_field_renderer = $email_address_field->get_renderer();
		$input_tag = $email_address_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'email_address');

		$email_address_li = $this->get_form_li(
			'email_address',
			$input_tag
		);        

		$log_in_details_field_set_inputs_list->append_tag_to_content($email_address_li); 

		/*
		 * The password
		 */
		$password_field = $customers_table->get_field('password');
		$password_field_renderer = $password_field->get_renderer();
		$input_tag = $password_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'password');
		$password_li = $this->get_form_li(
			'password',
			$input_tag
		); 

		$log_in_details_field_set_inputs_list->append_tag_to_content($password_li); 

		$log_in_details_field_set->append_tag_to_content($log_in_details_field_set_inputs_list);
		$customer_adding_form->append_tag_to_content($log_in_details_field_set);

		#
		# The Customer field set.
		#
		$customer_details_field_set = new HTMLTags_FieldSet();
		$customer_details_field_set->append_tag_to_content(new HTMLTags_Legend('Shipping Details'));

		$customer_details_field_set_inputs_list = new HTMLTags_OL();

		/*
		 * The first_name
		 */
		$first_name_field = $customers_table->get_field('first_name');
		$first_name_field_renderer = $first_name_field->get_renderer();
		$input_tag = $first_name_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'first_name');
		$first_name_li = $this->get_form_li(
			'first_name',
			$input_tag
		);        
		$customer_details_field_set_inputs_list->append_tag_to_content($first_name_li);


		/*
		 * The last_name
		 */
		$last_name_field = $customers_table->get_field('last_name');
		$last_name_field_renderer = $last_name_field->get_renderer();
		$input_tag = $last_name_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'last_name');
		$last_name_li = $this->get_form_li(
			'last_name',
			$input_tag
		);        
		$customer_details_field_set_inputs_list->append_tag_to_content($last_name_li);

		/*
		 * The telephone_number
		 */
		$telephone_number_field = $telephone_numbers_table->get_field('telephone_number');
		$telephone_number_field_renderer = $telephone_number_field->get_renderer();
		$input_tag = $telephone_number_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'telephone_number');
		
		$telephone_number_li = $this->get_form_li(
			'telephone_number',
			$input_tag
		);
		$customer_details_field_set_inputs_list->append_tag_to_content($telephone_number_li);

		/*
		 * The full_address
		 * which will be put straight into street_address		 *
		 * in add_simplified_customer()
		 */
		$address_li = $this->get_address_form_input_li();
		$customer_details_field_set_inputs_list->append_tag_to_content($address_li);

		/*
		 * The address_postal_code
		 */
		$address_field = $addresses_table->get_field('postal_code');
		$address_field_renderer = $address_field->get_renderer();
		$input_tag = $address_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'postal_code');

		$address_postal_code_li= $this->get_form_li(
			'postal_code',
			$input_tag
		);
		$customer_details_field_set_inputs_list->append_tag_to_content($address_postal_code_li);

		/*
		 * The address_country_name
		 */

		$address_field = $addresses_table->get_field('country_name');
		$address_field_renderer = $address_field->get_renderer();
		$input_tag = $address_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'country_name');

		if (isset($_SESSION['customer_region_id']))
		{
			$customer_regions_table =$database->get_table('hpi_shop_customer_regions');
			$customer_region = $customer_regions_table->get_row_by_id($_SESSION['customer_region_id']);
			$input_tag->set_attribute_str('value', $customer_region->get_name());
		}

		$address_country_name_li= $this->get_form_li(
			'country_name',
			$input_tag
		);
		$customer_details_field_set_inputs_list->append_tag_to_content($address_country_name_li);

		$customer_details_field_set->append_tag_to_content($customer_details_field_set_inputs_list);
		$customer_adding_form->append_tag_to_content($customer_details_field_set);

		#
		# SUBMIT BUTTON
		#
		$submit_button = new HTMLTags_Input();

		$submit_button->set_attribute_str('type', 'submit');
		$submit_button->set_attribute_str('value', 'Add');
		$submit_button->set_attribute_str('class', 'submit');

		$submit_buttons_div = new HTMLTags_Div();
		$submit_buttons_div->set_attribute_str('class', 'submit_buttons_div');

		$submit_buttons_div->append_tag_to_content($submit_button);

		$cancel_button = new HTMLTags_Input();

		$onclick = 'document.location.href=(\'';
		$onclick .= $cancel_url->get_as_string();
		$onclick .= "')";

		$cancel_button->set_attribute_str('type', 'button');
		$cancel_button->set_attribute_str('value', 'Cancel');
		$cancel_button->set_attribute_str('onclick', $onclick);
		$cancel_button->set_attribute_str('class', 'submit');

		$submit_buttons_div->append_tag_to_content($cancel_button);

		$customer_adding_form->append_tag_to_content($submit_buttons_div);

		# The Fields:
		//                $last_added_id = $customers_table->add_simplified_customer(
		//                        $_POST['full_name'],
		//                        $_POST['password'],
		//                        $_POST['email_address'],
		//                        $_POST['telephone_number'],
		//                        $_POST['full_address'],
		//                        $_POST['postal_code'],
		//                        $_POST['country_name'],
		//                        $_POST['customer_region_id']
		//                )
		return $customer_adding_form;
	}

	public function

		get_address_form_input_li()
	{
		$input_li = new HTMLTags_LI();

		$input_label = new HTMLTags_Label('Address');
		$input_label->set_attribute_str('for', 'full_address');

		$input_li->append_tag_to_content($input_label);

		$input_li->append_tag_to_content($this->get_address_form_input());

		$input_msg_box = new HTMLTags_Span();
		$input_msg_box->set_attribute_str('id', 'full_address' . 'msg');
		$input_msg_box->set_attribute_str('class', 'rules');

		$input_li->append_tag_to_content($input_msg_box);

		return $input_li;
	}

	public function
		get_address_form_input()
	{
		$full_address_form_input = new HTMLTags_TextArea();

		$full_address_form_input->set_attribute_str('cols', 50);
		$full_address_form_input->set_attribute_str('rows', 7);
		$full_address_form_input->set_attribute_str('name', 'full_address');
		$full_address_form_input->set_attribute_str('id', 'full_address');

		return $full_address_form_input;
	}

	public function get_customer_adding_form(
		HTMLTags_URL $redirect_script_url,
		HTMLTags_URL $cancel_url
	)
	{
		$customers_table = $this->get_element();
		$database = $customers_table->get_database();
		//$email_addresses_table = $database->get_table('hpi_shop_email_addresses');
		$telephone_numbers_table = $database->get_table('hpi_shop_telephone_numbers');
		$addresses_table = $database->get_table('hpi_shop_addresses');

		$customer_adding_form = new HTMLTags_SimpleOLForm('customer_adding');

		$customer_adding_form->set_attribute_str('class', 'cmxform'); 
		$customer_adding_form->set_attribute_str('id', 'customer-details-form'); 

		$customer_adding_form->set_action($redirect_script_url);

		$customer_adding_form->set_legend_text('Add a customer');

		# The Fields:
		//$last_added_id = $customers_table->add_customer(
		//            $_POST['full_name'],
		//            $_POST['password'],
		//            $_POST['customer_region_id'],
		//            $_POST['email_address'],
		//            $_POST['telephone_number'],
		//            $_POST['post_office_box'],
		//            $_POST['extended_address'],
		//            $_POST['street_address'],
		//            $_POST['locality'],
		//            $_POST['region'],
		//            $_POST['postal_code'],
		//            $_POST['country_name'],
		//            $_POST['customer_region_id'] = $_SESSION['customer_region_id']
		//        );
		/*
		 * The first_name
		 */
		$first_name_field = $customers_table->get_field('first_name');
		$first_name_field_renderer = $first_name_field->get_renderer();
		$input_tag = $first_name_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'first_name');
		$customer_adding_form->add_input_tag(
			'first_name',
			$input_tag
		);        

		/*
		 * The last_name
		 */
		$last_name_field = $customers_table->get_field('last_name');
		$last_name_field_renderer = $last_name_field->get_renderer();
		$input_tag = $last_name_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'last_name');
		$customer_adding_form->add_input_tag(
			'last_name',
			$input_tag
		);        

		/*
		 * The password
		 */
		$password_field = $customers_table->get_field('password');
		$password_field_renderer = $password_field->get_renderer();
		$input_tag = $password_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'password');
		$customer_adding_form->add_input_tag(
			'password',
			$input_tag
		); 
		/*
		 * The customer_region_id
		 */
		$customer_region_li = $this->get_customer_region_form_select_li();

		//                $customer_region_select_li = $this->get_customer_region_form_select_li();
		//                $customer_adding_form->append_tag_to_content($customer_region_select_li);
		$customer_adding_form->add_input_li($customer_region_li);
		/*
		 * The email_address
		 */
		$email_address_field = $customers_table->get_field('email_address');
		$email_address_field_renderer = $email_address_field->get_renderer();
		$input_tag = $email_address_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'email_address');
		$customer_adding_form->add_input_tag(
			'email_address',
			$input_tag
		);
		/*
		 * The telephone_number
		 */
		$telephone_number_field = $telephone_numbers_table->get_field('telephone_number');
		$telephone_number_field_renderer = $telephone_number_field->get_renderer();
		$input_tag = $telephone_number_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'telephone_number');
		$customer_adding_form->add_input_tag(
			'telephone_number',
			$input_tag
		);
		/*
		 * The address_post_office_box
		 */
		$address_field = $addresses_table->get_field('post_office_box');
		$address_field_renderer = $address_field->get_renderer();
		$input_tag = $address_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'address_post_office_box');
		$customer_adding_form->add_input_tag(
			'address_post_office_box',
			$input_tag
		);
		/*
		 * The address_extended_address
		 */
		$address_field = $addresses_table->get_field('extended_address');
		$address_field_renderer = $address_field->get_renderer();
		$input_tag = $address_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'extended_address');
		$customer_adding_form->add_input_tag(
			'extended_address',
			$input_tag
		);
		/*
		 * The address_street_address
		 */
		$address_field = $addresses_table->get_field('street_address');
		$address_field_renderer = $address_field->get_renderer();
		$input_tag = $address_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'street_address');
		$customer_adding_form->add_input_tag(
			'street_address',
			$input_tag
		);
		/*
		 * The address_locality
		 */
		$address_field = $addresses_table->get_field('locality');
		$address_field_renderer = $address_field->get_renderer();
		$input_tag = $address_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'locality');
		$customer_adding_form->add_input_tag(
			'locality',
			$input_tag
		);
		/*
		 * The address_region
		 */
		$address_field = $addresses_table->get_field('region');
		$address_field_renderer = $address_field->get_renderer();
		$input_tag = $address_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'region');
		$customer_adding_form->add_input_tag(
			'region',
			$input_tag
		);
		/*
		 * The address_postal_code
		 */
		$address_field = $addresses_table->get_field('postal_code');
		$address_field_renderer = $address_field->get_renderer();
		$input_tag = $address_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'postal_code');
		$customer_adding_form->add_input_tag(
			'postal_code',
			$input_tag
		);

		/*
		 * The address_country_name
		 */
		$address_field = $addresses_table->get_field('country_name');
		$address_field_renderer = $address_field->get_renderer();
		$input_tag = $address_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'country_name');
		$customer_adding_form->add_input_tag(
			'country_name',
			$input_tag
		);

		/*
		 * The add button.
		 */
		$customer_adding_form->set_submit_text('Add');

		$customer_adding_form->set_cancel_location($cancel_url);

		return $customer_adding_form;
	}

	public function
		get_customer_region_form_select_li()
	{
		$input_li = new HTMLTags_LI();

		$input_label = new HTMLTags_Label('Shipping Region');
		$input_label->set_attribute_str('for', 'customer_region_id');

		$input_li->append_tag_to_content($input_label);

		$input_li->append_tag_to_content($this->get_customer_region_form_select());

		$input_msg_box = new HTMLTags_Span();
		$input_msg_box->set_attribute_str('id', 'customer_region_id' . 'msg');
		$input_msg_box->set_attribute_str('class', 'rules');

		$input_li->append_tag_to_content($input_msg_box);

		return $input_li;
	}	

	public function
		get_customer_region_form_select()
	{
		$customers_table = $this->get_element();
		$database = $customers_table->get_database();
		$customer_regions_table = $database->get_table('hpi_shop_customer_regions');
		$customer_regions = $customer_regions_table->get_all_rows();

		$select = new HTMLTags_Select();
		$select->set_attribute_str('name', 'customer_region_id');

		foreach ($customer_regions as $customer_region) 
		{
			$customer_region_text = '';
			$customer_region_text .= $customer_region->get_name();

			$option = new HTMLTags_Option($customer_region_text);
			$option->set_attribute_str('value', $customer_region->get_id());
			$select->add_option($option);
		}
		if (isset($_SESSION['customer_region_id']))
		{
			$select->set_value($_SESSION['customer_region_id']);
		}
		return $select;
	}

	public function
		get_customer_log_in_form(
			HTMLTags_URL $redirect_script_url,
			HTMLTags_URL $cancel_url
		)
	{
		$customers_table = $this->get_element();
		$database = $customers_table->get_database();
		$email_addresses_table = $database->get_table('hpi_shop_email_addresses');

		$customer_login_form = new HTMLTags_SimpleOLForm('customer_log_in');

		$customer_login_form->set_action($redirect_script_url);

		$customer_login_form->set_legend_text('Customer Log In');

		/*
		 * The email_address
		 */
		$email_address_field = $email_addresses_table->get_field('email_address');
		$email_address_field_renderer = $email_address_field->get_renderer();
		$input_tag = $email_address_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'email_address');
		$customer_login_form->add_input_tag(
			'email_address',
			$input_tag
		);

		/*
		 * The password
		 */
		$password_field = $customers_table->get_field('password');
		$password_field_renderer = $password_field->get_renderer();
		$input_tag = $password_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'password');
		$customer_login_form->add_input_tag(
			'password',
			$input_tag
		); 


		/*
		 * The add button.
		 */
		$customer_login_form->set_submit_text('Add');

		$customer_login_form->set_cancel_location($cancel_url);

		return $customer_login_form;
	}

	public function
		get_customer_details_adding_form(
			HTMLTags_URL $form_location,
			HTMLTags_URL $redirect_script_location,
			HTMLTags_URL $desired_location,
			HTMLTags_URL $cancel_page_location
		)
	{
		$customers_table = $this->get_element();
		$database = $customers_table->get_database();
		$telephone_numbers_table = $database->get_table('hpi_shop_telephone_numbers');
		$addresses_table = $database->get_table('hpi_shop_addresses');
		
		$customer_details_form
			= new HTMLTags_SimpleOLForm('customer_details');

		$customer_details_form->set_attribute_str('id', $this->get_customer_details_form_id());
		$customer_details_form->set_attribute_str(
			'class',
			$this->get_customer_details_form_css_class()
		); 

		$svm = Caching_SessionVarManager::get_instance();

		/*
		 * The action.
		 */
		$customer_details_script_location = clone $redirect_script_location;
		$customer_details_script_location->set_get_variable('customer_details');

		$customer_details_script_location->set_get_variable(
			'desired_location',
			urlencode($desired_location->get_as_string())
		);
		$customer_details_script_location->set_get_variable(
			'form_location',
			urlencode($form_location->get_as_string())
		);

		$customer_details_form->set_action($customer_details_script_location);
		$customer_details_form->set_legend_text($this->get_customer_details_form_legend_text());

		/*
		 * The input tags.
		 */
		/*
		 * The first_name
		 */
		$first_name_field = $customers_table->get_field('first_name');
		$first_name_field_renderer = $first_name_field->get_renderer();
		$input_tag = $first_name_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'first_name');
		$customer_details_form->add_input_tag(
			'first_name',
			$input_tag
		);        


		/*
		 * The last_name
		 */
		$last_name_field = $customers_table->get_field('last_name');
		$last_name_field_renderer = $last_name_field->get_renderer();
		$input_tag = $last_name_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'last_name');
		$customer_details_form->add_input_tag(
			'last_name',
			$input_tag
		);        

		/*
		 * The telephone_number
		 */
		$telephone_number_field = $telephone_numbers_table->get_field('telephone_number');
		$telephone_number_field_renderer = $telephone_number_field->get_renderer();
		$input_tag = $telephone_number_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'telephone_number');
		$customer_details_form->add_input_tag(
			'telephone_number',
			$input_tag
		);

		/*
		 * The address (to be put striaght into street_address)
		 */
		$address_li = $this->get_address_form_input_li();
		$customer_details_form->add_input_li($address_li);
	
		/*
		 * The address_postal_code
		 */
		$address_field = $addresses_table->get_field('postal_code');
		$address_field_renderer = $address_field->get_renderer();
		$input_tag = $address_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'postal_code');
		$customer_details_form->add_input_tag(
			'postal_code',
			$input_tag
		);

		/*
		 * The address_country_name
		 */
		$address_field = $addresses_table->get_field('country_name');
		$address_field_renderer = $address_field->get_renderer();
		$input_tag = $address_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'country_name');
		if (isset($_SESSION['customer_region_id']))
		{
			$customer_regions_table = $database->get_table('hpi_shop_customer_regions');
			$customer_region = $customer_regions_table->get_row_by_id($_SESSION['customer_region_id']);
			$input_tag->set_value($customer_region->get_name());
		}
		$customer_details_form->add_input_tag(
			'country_name',
			$input_tag
		);

		/*
		 * The customer_region_id
		 */
		$customer_region_li = $this->get_customer_region_form_select_li();
		$customer_details_form->add_input_li($customer_region_li);

		/*
		 * The submit button.
		 */
		$customer_details_form->set_submit_text('Add');

		/*
		 * The cancel button
		 */
		$cancel_location = clone $redirect_script_location;

		$cancel_location->set_get_variable('cancel');
		$cancel_location->set_get_variable(
			'cancel_page_location',
			urlencode($cancel_page_location->get_as_string())
		);

		$customer_details_form->set_cancel_location($cancel_location);

		return $customer_details_form;
	}

	public function
		get_customer_details_form_id()
	{
		return 'customer-details-form';
	}

	public function
		get_customer_details_form_css_class()
	{
		return 'cmxform';
	}

	public function
		get_customer_details_form_legend_text()
	{
		return 'Shipping Details';
	}
}
?>
