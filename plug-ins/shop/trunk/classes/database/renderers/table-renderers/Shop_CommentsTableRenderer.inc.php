<?php
/**
 * Shop_CommentsTableRenderer
 *
 * @copyright Clear Line Web Design, 2007-02-16
 */

class
	Shop_CommentsTableRenderer
	extends
	Database_TableRenderer
{
	/**
	 * A table to display the comments in public, with pages
	 */
	public function
		get_paged_public_all_comments_div($page)
	{
		$comments_table = $this->get_element();
		$all_comments_div = new HTMLTags_Div();

		####################################################################
		#
		# Display some of the data in the comments table.
		#
		####################################################################

		if ($comments_table->count_all_rows() >= 11) {
			/*
			 * DIV for limits and previous and nexts.
			 */
			$limit_previous_next_div = new HTMLTags_Div();
			$limit_previous_next_div->set_attribute_str('class', 'table_pages_div');

			/*
			 * To allow the user to set the number of extras to show at a time.
			 */
			$limit_action = new HTMLTags_URL();
			$limit_action->set_file('/');

			$limit_form = new Database_LimitForm($limit_action, LIMIT, '10 20 50');

			$limit_form->add_hidden_input('page', $page);

			$limit_form->add_hidden_input('order_by', ORDER_BY);
			$limit_form->add_hidden_input('direction', DIRECTION);
			$limit_form->add_hidden_input('offset', OFFSET);

			$limit_previous_next_div->append_tag_to_content($limit_form);

			/*
			 * Go the previous or next list of extras.
			 */
			$previous_next_url = new HTMLTags_URL();
			$previous_next_url->set_file('/');

			$previous_next_url->set_get_variable('page', $page);

			$previous_next_url->set_get_variable('order_by', ORDER_BY);
			$previous_next_url->set_get_variable('direction', DIRECTION);

			#print_r($previous_next_url);

			$row_count = $comments_table->count_public_comments();

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

		/**
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

		$rows = $comments_table->get_rows_where($conditions, ORDER_BY, DIRECTION, OFFSET, LIMIT);

		foreach ($rows as $row) {
			$row_renderer = $row->get_renderer();

			#$data_tr = $row_renderer->get_admin_database_tr();
			$data_tr = $row_renderer->get_public_comments_hreview_tr();

			$rows_html_table->append_tag_to_content($data_tr);
		}

		# ------------------------------------------------------------------

		$all_comments_div->append_tag_to_content($rows_html_table);

		if ($comments_table->count_all_rows() >= 11) {            
			$all_comments_div->append_tag_to_content($limit_previous_next_div);
		}

		return $all_comments_div;
	}

	/**
	 * A table to display the comments in public, with pages
	 */
	public function
		get_public_short_comments_div($page)
	{
		$comments_table = $this->get_element();
		$short_comments_div = new HTMLTags_Div();

		# ------------------------------------------------------------------

		/**
		 * The table.
		 */
		$rows_html_table = new HTMLTags_Table();
		$rows_html_table->set_attribute_str('class', 'table_short');

		$conditions['status'] = 'accepted';

		$rows = $comments_table->get_rows_where($conditions, ORDER_BY, DIRECTION, OFFSET, LIMIT);

		foreach ($rows as $row) {
			$row_renderer = $row->get_renderer();

			#$data_tr = $row_renderer->get_admin_database_tr();
			$data_tr = $row_renderer->get_public_comments_hreview_tr();

			$rows_html_table->append_tag_to_content($data_tr);
		}

		# ------------------------------------------------------------------

		$short_comments_div->append_tag_to_content($rows_html_table);

		return $short_comments_div;
	}

	public function
		get_public_front_page_comments_div($page)
	{
		$comments_table = $this->get_element();
		$short_comments_div = new HTMLTags_Div();

		# ------------------------------------------------------------------

		/**
		 * The table.
		 */
		$rows_html_table = new HTMLTags_Table();
		$rows_html_table->set_attribute_str('class', 'table_short');

		$conditions['front_page'] = 'yes';
		$conditions['status'] = 'accepted';

		$rows = $comments_table->get_rows_where($conditions, ORDER_BY, DIRECTION, OFFSET, LIMIT);

		foreach ($rows as $row) {
			$row_renderer = $row->get_renderer();

			#$data_tr = $row_renderer->get_admin_database_tr();
			$data_tr = $row_renderer->get_public_comments_hreview_tr();

			$rows_html_table->append_tag_to_content($data_tr);
		}

		# ------------------------------------------------------------------

		$short_comments_div->append_tag_to_content($rows_html_table);

		return $short_comments_div;
	}

	public function
		get_admin_comment_adding_form($add_comment_url, $cancel_location)
	{
		$mysql_user_factory = Database_MySQLUserFactory::get_instance();
		$mysql_user = $mysql_user_factory->get_for_this_project(); 
		$database = $mysql_user->get_database();

		$comments_table = $database->get_table('hpi_shop_comments');
		$commenters_table = $database->get_table('hpi_shop_commenters');

		$comment_adding_form = new HTMLTags_SimpleOLForm('comment_adding');

		$comment_adding_form->set_action($add_comment_url);

		$comment_adding_form->set_legend_text('Add a comment');

		#Added 	Status 	Front Page 	Name 	Comment

		/*
		 * The name
		 */
		$name_field = $commenters_table->get_field('name');

		$name_field_renderer = $name_field->get_renderer();

		$input_tag = $name_field_renderer->get_form_input();

		$input_tag->set_attribute_str('id', 'name');

		$comment_adding_form->add_input_tag(
			'name',
			$input_tag
		);        

		/*
		 * The email
		 */
		$email_field = $commenters_table->get_field('email');

		$email_field_renderer = $email_field->get_renderer();

		$input_tag = $email_field_renderer->get_form_input();

		$input_tag->set_attribute_str('id', 'email');

		$comment_adding_form->add_input_tag(
			'email',
			$input_tag
		);

		/*
		 * The homepage_title
		 */
		$homepage_title_field = $commenters_table->get_field('homepage_title');

		$homepage_title_field_renderer = $homepage_title_field->get_renderer();

		$input_tag = $homepage_title_field_renderer->get_form_input();

		$input_tag->set_attribute_str('id', 'homepage_title');

		$comment_adding_form->add_input_tag(
			'homepage_title',
			$input_tag
		);

		/*
		 * The url
		 */
		$url_field = $commenters_table->get_field('url');

		$url_field_renderer = $url_field->get_renderer();

		$input_tag = $url_field_renderer->get_form_input();

		$input_tag->set_attribute_str('id', 'url');

		$comment_adding_form->add_input_tag(
			'url',
			$input_tag,
			'URL'
		);

		/*
		 * The comment
		 */
		$comment_field = $comments_table->get_field('comment');

		$comment_field_renderer = $comment_field->get_renderer();

		$input_tag = $comment_field_renderer->get_form_input();

		$input_tag->set_attribute_str('id', 'comment');

		$comment_adding_form->add_input_tag(
			'comment',
			$input_tag
		);

		/*
		 * The product_id
		 */
		$product_li = $this->get_product_form_select_li();
		$comment_adding_form->add_input_li($product_li);

		/*
		 * The status enum
		 */
		$status_field = $comments_table->get_field('status');

		$status_field_renderer = $status_field->get_renderer();

		$input_tag = $status_field_renderer->get_form_input();

		$input_tag->set_attribute_str('id', 'status');

		$comment_adding_form->add_input_tag(
			'status',
			$input_tag
		);

		/*
		 * The front_page enum
		 */
		$front_page_field = $comments_table->get_field('front_page');

		$front_page_field_renderer = $front_page_field->get_renderer();

		$input_tag = $front_page_field_renderer->get_form_input();

		$input_tag->set_attribute_str('id', 'front_page');

		$comment_adding_form->add_input_tag(
			'front_page',
			$input_tag
		);

		/*
		 * The update button.
		 */
		$comment_adding_form->set_submit_text('Add');

		$comment_adding_form->set_cancel_location($cancel_location);

		return $comment_adding_form;
	}

	public function
		get_product_form_select_li()
	{
		$input_li = new HTMLTags_LI();

		$input_label = new HTMLTags_Label('Product');
		$input_label->set_attribute_str('for', 'product_id');

		$input_li->append_tag_to_content($input_label);

		$input_li->append_tag_to_content($this->get_product_form_select());

		$input_msg_box = new HTMLTags_Span();
		$input_msg_box->set_attribute_str('id', 'product_id' . 'msg');
		$input_msg_box->set_attribute_str('class', 'rules');

		$input_li->append_tag_to_content($input_msg_box);

		return $input_li;
	}	

	public function
		get_product_form_select()
	{
		$customer_regions_table = $this->get_element();
		$database = $customer_regions_table->get_database();
		$products_table = $database->get_table('hpi_shop_products');
		$products = $products_table->get_all_rows();

		$select = new HTMLTags_Select();
		$select->set_attribute_str('name', 'product_id');

		foreach ($products as $product) 
		{
			$product_text = '';
			$product_text .= $product->get_name();

			$option = new HTMLTags_Option($product_text);
			$option->set_attribute_str('value', $product->get_id());
			$select->add_option($option);
		}

		return $select;
	}



	public function
		get_comment_adding_form()
	{
		$mysql_user_factory = Database_MySQLUserFactory::get_instance();
		$mysql_user = $mysql_user_factory->get_for_this_project(); 
		$database = $mysql_user->get_database();

		$comments_table = $database->get_table('hpi_shop_comments');
		$commenters_table = $database->get_table('hpi_shop_commenters');

		$redirect_script_url = new HTMLTags_URL();
		$redirect_script_url->set_file('/admin/redirect-script.php');
		$redirect_script_url->set_get_variable('type', 'redirect-script');        
		$redirect_script_url->set_get_variable('module', 'shop');
		$redirect_script_url->set_get_variable('page', 'comments');

		$cancel_location = new HTMLTags_URL();
		$cancel_location->set_file('/admin/shop/comments.html');

		$comment_adding_form = new HTMLTags_SimpleOLForm('comment_adding');

		$comment_adding_action = clone $redirect_script_url;

		$comment_adding_action->set_get_variable('add_comment');

		$comment_adding_form->set_action($comment_adding_action);

		$comment_adding_form->set_legend_text('Add a comment');

		#Added 	Status 	Front Page 	Name 	Comment

		/*
		 * The name
		 */
		$name_field = $commenters_table->get_field('name');

		$name_field_renderer = $name_field->get_renderer();

		$input_tag = $name_field_renderer->get_form_input();

		$input_tag->set_attribute_str('id', 'name');

		$comment_adding_form->add_input_tag(
			'name',
			$input_tag
		);        

		/*
		 * The email
		 */
		$email_field = $commenters_table->get_field('email');

		$email_field_renderer = $email_field->get_renderer();

		$input_tag = $email_field_renderer->get_form_input();

		$input_tag->set_attribute_str('id', 'email');

		$comment_adding_form->add_input_tag(
			'email',
			$input_tag
		);

		/*
		 * The homepage_title
		 */
		$homepage_title_field = $commenters_table->get_field('homepage_title');

		$homepage_title_field_renderer = $homepage_title_field->get_renderer();

		$input_tag = $homepage_title_field_renderer->get_form_input();

		$input_tag->set_attribute_str('id', 'homepage_title');

		$comment_adding_form->add_input_tag(
			'homepage_title',
			$input_tag
		);

		/*
		 * The url
		 */
		$url_field = $commenters_table->get_field('url');

		$url_field_renderer = $url_field->get_renderer();

		$input_tag = $url_field_renderer->get_form_input();

		$input_tag->set_attribute_str('id', 'url');

		$comment_adding_form->add_input_tag(
			'url',
			$input_tag,
			'URL'
		);

		/*
		 * The comment
		 */
		$comment_field = $comments_table->get_field('comment');

		$comment_field_renderer = $comment_field->get_renderer();

		$input_tag = $comment_field_renderer->get_form_input();

		$input_tag->set_attribute_str('id', 'comment');

		$comment_adding_form->add_input_tag(
			'comment',
			$input_tag
		);

		/*
		 * The status enum
		 */
		$status_field = $comments_table->get_field('status');

		$status_field_renderer = $status_field->get_renderer();

		$input_tag = $status_field_renderer->get_form_input();

		$input_tag->set_attribute_str('id', 'status');

		$comment_adding_form->add_input_tag(
			'status',
			$input_tag
		);

		/*
		 * The front_page enum
		 */
		$front_page_field = $comments_table->get_field('front_page');

		$front_page_field_renderer = $front_page_field->get_renderer();

		$input_tag = $front_page_field_renderer->get_form_input();

		$input_tag->set_attribute_str('id', 'front_page');

		$comment_adding_form->add_input_tag(
			'front_page',
			$input_tag
		);

		/*
		 * The update button.
		 */
		$comment_adding_form->set_submit_text('Add');

		$comment_adding_form->set_cancel_location($cancel_location);

		return $comment_adding_form;
	}

	public function
		get_csv_adding_form()
	{
		$comments_table = $this->get_element();

		$csv_adding_form = new HTMLTags_SimpleOLForm('csv_adding');

		$csv_adding_form->set_attribute_str('enctype', 'multipart/form-data');

		$legend_text = 'Add a CSV file';

		$csv_adding_form->set_legend_text($legend_text);

		/*
		 * THE FILE
		 */
		$file_input_tag = new HTMLTags_Input();

		$file_input_tag_name = 'user_file[]';

		$file_input_tag->set_attribute_str('type', 'file');
		$file_input_tag->set_attribute_str('id', $file_input_tag_name);
		$file_input_tag->set_attribute_str('name', $file_input_tag_name);

		$csv_adding_form->add_input_tag(
			$file_input_tag_name,
			$file_input_tag,
			'File'
		);

		$csv_adding_form->add_hidden_input('MAX_FILE_SIZE', '1000000');

		$csv_adding_form->set_submit_text('Add');

		return $csv_adding_form;
	}
}
?>
