<?php
/**
 * Shop_CommentRowRenderer
 *
 * @copyright Clear Line Web Design, 2007-02-16
 */

class
	Shop_CommentRowRenderer
	extends
	Database_RowRenderer
{
	/**
	 * The paragraph tag for a comment.
	 *
	 * This method is called in the public pages
	 * to display a comment.
	 */
	public function
		get_html_p()
	{
		$comment = $this->get_element();

		$html_p = new HTMLTags_P();

		$html_p->append_str_to_content('&quot;');

		$html_p->append_str_to_content($comment->get_comment());

		$html_p->append_str_to_content('&quot;');

		$html_p->append_str_to_content(' &#150; ');

		$html_p->append_str_to_content($comment->get_name());

		if ($comment->has_url()) {
			$html_p->append_str_to_content(', ');

			$html_p->append_tag_to_content($this->get_html_a());
		}

		return $html_p;
	}

	/**
	 * Provides a link to the page of the person who
	 * gave the comment.
	 */
	public function
		get_html_a()
	{
		$comment = $this->get_element();
		$commenter = $comment->get_commenter();

		if ($commenter->has_url()) {
			if ($commenter->has_homepage_title()) {
				$html_a = new HTMLTags_A($commenter->get_homepage_title());
			} else {
				$html_a = new HTMLTags_A($commenter->get_url());
			}

			$url = new HTMLTags_URL($commenter->get_url());

			$html_a->set_href($url);

			$html_a->set_attribute_str('target', '_blank');

			return $html_a;
		} else {
			throw new Exception(
				'The comment with id '
				. $comment->get_id()
				. ' does not have a URL!'
			);
		}
	}

	/**
	 * An HTML table that has all the data
	 * (except the sort order and id) of a row
	 * in the comments table.
	 *
	 * Used in the admin page to list all the
	 * comments.
	 */
	public function
		get_all_data_vertical_html_table()
	{
		$table = new HTMLTags_Table();

		$comment = $this->get_element();
		$commenter = $comment->get_commenter();
		/*
		 * ---------------------------------------------------------------------
		 */

		/*
		 * The name.
		 */
		$name_tr = new HTMLTags_TR();

		$name_tr->append_tag_to_content(new HTMLTags_TD('Name:'));

		$name_tr->append_tag_to_content(
			new HTMLTags_TD($commenter->get_name())
		);

		$table->append_tag_to_content($name_tr);

		/*
		 * The URL.
		 */
		$url_tr = new HTMLTags_TR();

		$url_tr->append_tag_to_content(new HTMLTags_TD('URL:'));

		$url_tr->append_tag_to_content(
			new HTMLTags_TD($commenter->get_url())
		);

		$table->append_tag_to_content($url_tr);

		/*
		 * The Homepage Title.
		 */
		$homepage_title_tr = new HTMLTags_TR();

		$homepage_title_tr->append_tag_to_content(
			new HTMLTags_TD('Homepage Title:')
		);

		$homepage_title_tr->append_tag_to_content(
			new HTMLTags_TD($commenter->get_homepage_title())
		);

		$table->append_tag_to_content($homepage_title_tr);

		/*
		 * The Link to their webpage.
		 */
		if ($commenter->has_url()) {
			$link_tr = new HTMLTags_TR();

			$link_tr->append_tag_to_content(
				new HTMLTags_TD('Link:')
			);

			$link_td = new HTMLTags_TD();

			$link_td->append_tag_to_content($this->get_html_a());

			$link_tr->append_tag_to_content($link_td);

			$table->append_tag_to_content($link_tr);
		}

		/*
		 * The comment.
		 */
		$comment_tr = new HTMLTags_TR();

		$comment_tr->append_tag_to_content(new HTMLTags_TD('comment:'));

		$comment_tr->append_tag_to_content(
			new HTMLTags_TD($comment->get_comment())
		);

		$table->append_tag_to_content($comment_tr);

		/*
		 * The date added.
		 */
		$added_tr = new HTMLTags_TR();

		$added_tr->append_tag_to_content(new HTMLTags_TD('Added:'));

		$added_tr->append_tag_to_content(
			new HTMLTags_TD($comment->get_added())
		);

		/*
		 * ---------------------------------------------------------------------
		 */

		$table->append_tag_to_content($added_tr);

		return $table;
	}

	public function get_public_comments_html_table_tr()    
	{
		$comment = $this->get_element();
		$commenter = $comment->get_commenter();

		/*
		 * The name.
		 */
		$comment_row = new HTMLTags_TR();

		if ($commenter->has_url()) {

			$link_td = new HTMLTags_TD();

			$link_td->append_tag_to_content($this->get_html_a());

			$comment_row->append_tag_to_content($link_td);

		} else {
			$name_td = new HTMLTags_TD($commenter->get_name());
			$comment_row->append_tag_to_content($name_td);
		}

		/*
		 * The comments.
		 */

		$comments_td = new HTMLTags_TD($comment->get_comment());

		$comment_row->append_tag_to_content($comments_td);

		/*
		 * The date added.
		 */
		$added_td = new HTMLTags_TD($comment->get_added());

		$comment_row->append_tag_to_content($added_td);

		return $comment_row;
	}

	public function get_public_comments_hreview_tr()    
	{
		$comment = $this->get_element();
		$commenter = $comment->get_commenter();

		$comment_row = new HTMLTags_TR();

		$comment_row_td = new HTMLTags_TD();

		$product = $comment->get_product();

		$item_reviewed = $product->get_name();
		$review = $comment->get_comment();
		$reviewer = $commenter->get_name();
		$date_reviewed = $comment->get_added();

		$hreview_div = new HTMLTags_HReviewDiv($item_reviewed, $review, $reviewer, $date_reviewed);

		$comment_row_td->append_tag_to_content($hreview_div);

		$comment_row->append_tag_to_content($comment_row_td);

		return $comment_row;
	}

	public function get_admin_comments_html_table()
	{
		$comment_row = $this->get_element();
		/**
		 * The table.
		 */
		$rows_html_table = new HTMLTags_Table();

		/**
		 * The caption.
		 */
		$caption = new HTMLTags_Caption(
			'Comment to be deleted'
		);
		$rows_html_table->append_tag_to_content($caption);

		/**
		 * The Heading Row.
		 */
		$heading_tr = new HTMLTags_TR();

		$heading_tr->append_tag_to_content(new HTMLTags_TH('Added'));
		$heading_tr->append_tag_to_content(new HTMLTags_TH('Modified'));
		$heading_tr->append_tag_to_content(new HTMLTags_TH('Product Id'));
		$heading_tr->append_tag_to_content(new HTMLTags_TH('Status'));
		$heading_tr->append_tag_to_content(new HTMLTags_TH('Front Page'));
		$heading_tr->append_tag_to_content(new HTMLTags_TH('Name'));
		$heading_tr->append_tag_to_content(new HTMLTags_TH('Comment'));

		$rows_html_table->append_tag_to_content($heading_tr);

		/**
		 * Display the contents of the table.
		 */
		$data_tr = $this->get_admin_comments_html_table_tr_without_actions();

		$rows_html_table->append_tag_to_content($data_tr);

		return $rows_html_table;


		return $comment_table;
	}

	public function get_admin_comments_html_table_tr($current_page_url, $redirect_script_url) 
	{

		$comment = $this->get_element();
		$commenter = $comment->get_commenter();

		$html_row =  new HTMLTags_TR();

		$row = $this->get_element();

		$table = $row->get_table();
		$database = $row->get_database();

		/*
		 * The data.
		 */ 

		$added_field = $table->get_field('added');
		$added_td = $this->get_data_html_table_td($added_field);
		$html_row->append_tag_to_content($added_td);

		$modified_field = $table->get_field('modified');
		$modified_td = $this->get_data_html_table_td($modified_field);
		$html_row->append_tag_to_content($modified_td);

		$status_field = $table->get_field('status');
		$status_td = $this->get_data_html_table_td($status_field);
		$html_row->append_tag_to_content($status_td);

		$front_page_field = $table->get_field('front_page');
		$front_page_td = $this->get_data_html_table_td($front_page_field);
		$html_row->append_tag_to_content($front_page_td);

		$product_td = $this->get_product_image_td();
		$html_row->append_tag_to_content($product_td);

		$name_td = new HTMLTags_TD($commenter->get_name());
		$html_row->append_tag_to_content($name_td);

		$comment_field = $table->get_field('comment');
		$comment_td = $this->get_data_html_table_td($comment_field);
		$html_row->append_tag_to_content($comment_td);

		/*
		 * The accept td.
		 */
		$accept_td = new HTMLTags_TD();

		if ($comment->get_status() != 'accepted')
		{
			$accept_link = new HTMLTags_A('Accept');
			$accept_link->set_attribute_str('class', 'cool_button');
			$accept_link->set_attribute_str('id', 'accept_table_button');

			$accept_location = clone $redirect_script_url;
			$accept_location->set_get_variable('edit_id', $row->get_id());
			$accept_location->set_get_variable('set_status', 'accepted');

			$accept_link->set_href($accept_location);

			$accept_td->append_tag_to_content($accept_link);
		}
		$html_row->append_tag_to_content($accept_td);


		/*
		 * The spam td.
		 */
		$spam_td = new HTMLTags_TD();

		if ($comment->get_status() != 'spam')
		{
			$spam_link = new HTMLTags_A('Spam');
			$spam_link->set_attribute_str('class', 'cool_button');
			$spam_link->set_attribute_str('id', 'spam_table_button');

			$spam_location = clone $redirect_script_url;
			$spam_location->set_get_variable('edit_id', $row->get_id());
			$spam_location->set_get_variable('set_status', 'spam');

			$spam_link->set_href($spam_location);

			$spam_td->append_tag_to_content($spam_link);
		}
		$html_row->append_tag_to_content($spam_td);


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

	public function get_admin_comments_html_table_tr_without_actions()
	{

		$comment = $this->get_element();
		$commenter = $comment->get_commenter();

		$html_row =  new HTMLTags_TR();

		$row = $this->get_element();

		$table = $row->get_table();
		$database = $row->get_database();

		/*
		 * The data.
		 */ 

		$added_field = $table->get_field('added');

		$added_td = $this->get_data_html_table_td($added_field);

		$html_row->append_tag_to_content($added_td);

		$modified_field = $table->get_field('modified');

		$modified_td = $this->get_data_html_table_td($modified_field);

		$html_row->append_tag_to_content($modified_td);

		$status_field = $table->get_field('status');

		$status_td = $this->get_data_html_table_td($status_field);

		$html_row->append_tag_to_content($status_td);

		$front_page_field = $table->get_field('front_page');

		$front_page_td = $this->get_data_html_table_td($front_page_field);

		$html_row->append_tag_to_content($front_page_td);

		$name_td = new HTMLTags_TD($commenter->get_name());

		$html_row->append_tag_to_content($name_td);

		$comment_field = $table->get_field('comment');

		$comment_td = $this->get_data_html_table_td($comment_field);

		$html_row->append_tag_to_content($comment_td);

		$product_td = $this->get_product_td();
		$html_row->append_tag_to_content($product_td);

		return $html_row;
	}

	public function
		get_comment_editing_form($comment_editing_action, $cancel_location)
	{
		$mysql_user_factory = Database_MySQLUserFactory::get_instance();
		$mysql_user = $mysql_user_factory->get_for_this_project(); 
		$database = $mysql_user->get_database();

		$comment_row = $this->get_element();
		$commenter = $comment_row->get_commenter();

		$comments_table = $database->get_table('hpi_shop_comments');
		$commenters_table = $database->get_table('hpi_shop_commenters');

		$comment_editing_form = new HTMLTags_SimpleOLForm('comment_editing');

		$comment_editing_action->set_get_variable('edit_id', $comment_row->get_id());

		$comment_editing_form->set_action($comment_editing_action);

		$comment_editing_form->set_legend_text('Edit this comment');

		#Added 	Status 	Front Page 	Name 	Comment

		/*
		 * The name
		 */
		$name_field = $commenters_table->get_field('name');

		$name_field_renderer = $name_field->get_renderer();

		$input_tag = $name_field_renderer->get_form_input();

		$input_tag->set_value($commenter->get_name());

		$input_tag->set_attribute_str('id', 'name');

		$comment_editing_form->add_input_tag(
			'name',
			$input_tag
		);        

		/*
		 * The email
		 */
		$email_field = $commenters_table->get_field('email');

		$email_field_renderer = $email_field->get_renderer();

		$input_tag = $email_field_renderer->get_form_input();

		$input_tag->set_value($commenter->get_email());

		$input_tag->set_attribute_str('id', 'email');

		$comment_editing_form->add_input_tag(
			'email',
			$input_tag
		);

		/*
		 * The homepage_title
		 */
		$homepage_title_field = $commenters_table->get_field('homepage_title');

		$homepage_title_field_renderer = $homepage_title_field->get_renderer();

		$input_tag = $homepage_title_field_renderer->get_form_input();

		$input_tag->set_value($commenter->get_homepage_title());

		$input_tag->set_attribute_str('id', 'homepage_title');

		$comment_editing_form->add_input_tag(
			'homepage_title',
			$input_tag
		);

		/*
		 * The url
		 */
		$url_field = $commenters_table->get_field('url');

		$url_field_renderer = $url_field->get_renderer();

		$input_tag = $url_field_renderer->get_form_input();

		$input_tag->set_value($commenter->get_url());

		$input_tag->set_attribute_str('id', 'url');

		$comment_editing_form->add_input_tag(
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

		$input_tag->set_value($comment_row->get_comment());

		$input_tag->set_attribute_str('id', 'comment');

		$comment_editing_form->add_input_tag(
			'comment',
			$input_tag
		);

		/*
		 * The product_id
		 */
		$product_li = $this->get_product_form_select_li();
		$comment_editing_form->add_input_li($product_li);


		/*
		 * The status enum
		 */
		$status_field = $comments_table->get_field('status');

		$status_field_renderer = $status_field->get_renderer();

		$input_tag = $status_field_renderer->get_form_input();

		$input_tag->set_value($comment_row->get_status());

		$input_tag->set_attribute_str('id', 'status');

		$comment_editing_form->add_input_tag(
			'status',
			$input_tag
		);

		/*
		 * The front_page enum
		 */
		$front_page_field = $comments_table->get_field('front_page');

		$front_page_field_renderer = $front_page_field->get_renderer();

		$input_tag = $front_page_field_renderer->get_form_input();

		$input_tag->set_value($comment_row->get_front_page());

		$input_tag->set_attribute_str('id', 'front_page');

		$comment_editing_form->add_input_tag(
			'front_page',
			$input_tag
		);

		/*
		 * The update button.
		 */
		$comment_editing_form->set_submit_text('Update');

		$comment_editing_form->set_cancel_location($cancel_location);

		return $comment_editing_form;
	}

	public function
		get_product_td()
	{
		$comment = $this->get_element();
		$product = $comment->get_product();
		$product_td = new HTMLTags_TD();
		$product_td->append_str_to_content($product->get_name());
		return $product_td;
	}

	public function
		get_product_image_td()
	{
		$comment = $this->get_element();
		$product = $comment->get_product();
		$product_renderer = $product->get_renderer();

		return $product_renderer->get_image_td();
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
		$comment = $this->get_element();
		$database = $comment->get_database();
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

			if ($product->get_id() == $comment->get_product_id())
			{
				$option->set_attribute_str('selected', 'selected');
			}
			$select->add_option($option);
		}

		return $select;
	}


}
?>
