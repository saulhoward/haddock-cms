<?php
/**
 * Shop_ProductBrandRowRenderer
 *
 * @copyright Clear Line Web Design, 2007-09-19
 */

class
	Shop_ProductBrandRowRenderer
	extends
	Database_RowRenderer
{
	public function
		get_admin_product_brand_html_table()
	{
		$product_brand_row = $this->get_element();
		/**
		 * The table.
		 */
		$rows_html_table = new HTMLTags_Table();

		/**
		 * The caption.
		 */
		$caption = new HTMLTags_Caption(
			'Product Brand: ' . $product_brand_row->get_name()
		);
		$rows_html_table->append_tag_to_content($caption);

		/**
		 * The Heading Row.
		 */
		$heading_tr = new HTMLTags_TR();

		$heading_tr->append_tag_to_content(new HTMLTags_TH('Name'));
		$heading_tr->append_tag_to_content(new HTMLTags_TH('Owner'));
		$heading_tr->append_tag_to_content(new HTMLTags_TH('Description'));
		$heading_tr->append_tag_to_content(new HTMLTags_TH('URL'));
		$heading_tr->append_tag_to_content(new HTMLTags_TH('Image'));

		$rows_html_table->append_tag_to_content($heading_tr);

		/**
		 * Display the contents of the table.
		 */
		$data_tr
			= $this
			->get_admin_product_brands_html_table_tr_without_actions();

		$rows_html_table->append_tag_to_content($data_tr);

		return $rows_html_table;
	}

	public function
		get_admin_product_brands_html_table_tr($current_page_url)
	{
		$html_row =  new HTMLTags_TR();

		$row = $this->get_element();

		$table = $row->get_table();
		$database = $row->get_database();

		/*
		 * The data.
		 */ 
		$thumbnail_image_td = $this->get_thumbnail_image_td();
		$html_row->append_tag_to_content($thumbnail_image_td);

		$name_field = $table->get_field('name');
		$name_td = $this->get_data_html_table_td($name_field);
		$html_row->append_tag_to_content($name_td);

		$owner_field = $table->get_field('owner');
		$owner_td = $this->get_data_html_table_td($owner_field);
		$html_row->append_tag_to_content($owner_td);

		$description_field = $table->get_field('description');
		$description_td = $this->get_data_html_table_td($description_field);
		$html_row->append_tag_to_content($description_td);

		$url_field = $table->get_field('url');
		$url_td = $this->get_data_html_table_td($url_field);
		$html_row->append_tag_to_content($url_td);

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
		get_admin_product_brands_html_table_tr_without_actions()
	{
		$html_row =  new HTMLTags_TR();

		$row = $this->get_element();

		$table = $row->get_table();
		$database = $row->get_database();

		/*
		 * The data.
		 */ 

		$name_field = $table->get_field('name');
		$name_td = $this->get_data_html_table_td($name_field);
		$html_row->append_tag_to_content($name_td);

		$owner_field = $table->get_field('owner');
		$owner_td = $this->get_data_html_table_td($owner_field);
		$html_row->append_tag_to_content($owner_td);

		$description_field = $table->get_field('description');
		$description_td = $this->get_data_html_table_td($description_field);
		$html_row->append_tag_to_content($description_td);

		$url_field = $table->get_field('url');
		$url_td = $this->get_data_html_table_td($url_field);
		$html_row->append_tag_to_content($url_td);

		$thumbnail_image_td = $this->get_thumbnail_image_td();
		$html_row->append_tag_to_content($thumbnail_image_td);

		return $html_row;
	}

	public function
		get_thumbnail_image_td()
	{
		$thumbnail_image_td = new HTMLTags_TD();

		$row = $this->get_element();

		$thumbnail_image_row = $row->get_thumbnail_image_row();
		#print_r($thumbnail_image_row);

		$thumbnail_image_row_renderer
			= $thumbnail_image_row->get_renderer();
		#print_r($thumbnail_image_row_renderer);

		$img_tag = $thumbnail_image_row_renderer->get_img_in_public_images();

		//$database = $row->get_database();
		//
		//$images_table = $database->get_table('hc_database_images');
		//
		//$images_field = $images_table->get_field('image');
		//
		//return
		//    $thumbnail_image_row_renderer
		//        ->get_data_html_table_td_with_image($images_field);

		$full_a = new HTMLTags_A();

		$full_size_image = $row->get_full_size_image();
		#print_r($full_size_image);

		$full_size_image_renderer = $full_size_image->get_renderer();

		$full_size_image_url = $full_size_image_renderer->get_html_url_in_public_images();

		$full_a->set_href($full_size_image_url);

		$full_a->append_tag_to_content($img_tag);

		$thumbnail_image_td->append_tag_to_content($full_a);

		return $thumbnail_image_td;
	}

	public function
		get_thumbnail_img()
	{
		$row = $this->get_element();

		$thumbnail_image_row = $row->get_thumbnail_image_row();
		#print_r($thumbnail_image_row);

		$thumbnail_image_row_renderer
			= $thumbnail_image_row->get_renderer();
		#print_r($thumbnail_image_row_renderer);

		return
			$thumbnail_image_row_renderer
			->get_img_in_public_images();
	}

	public function
		get_thumbnail_img_with_drop_shadow_div()
	{
		$row = $this->get_element();

		$thumbnail_image_row = $row->get_thumbnail_image_row();
		#print_r($thumbnail_image_row);

		$thumbnail_image_row_renderer
			= $thumbnail_image_row->get_renderer();
		#print_r($thumbnail_image_row_renderer);

		$drop_shadow_div = new HTMLTags_Div();
		$drop_shadow_div->set_attribute_str('class', 'img-shadow');

		$drop_shadow_div->append_tag_to_content($thumbnail_image_row_renderer->get_img_in_public_images());

		return $drop_shadow_div;

	}

	public function
		get_thumbnail_img_with_drop_shadow_with_a_div($javascript = FALSE)
	{
		$row = $this->get_element();

		$thumbnail_image_row = $row->get_thumbnail_image_row();
		#print_r($thumbnail_image_row);

		$full_size_image_id = $row->get_id();

		$gallery_image_page_a = new HTMLTags_A();
		$gallery_image_page_a->set_attribute_str('class', 'thumbnailLink');
		$gallery_image_page_a->set_attribute_str('id', $full_size_image_id);
		if ($javascript) {
			$onclick = 'javascript:return thumbnailsOnClick(this);';
			$gallery_image_page_a->set_attribute_str('onclick', $onclick);

		}

		$full_size_image_href = new HTMLTags_URL();
		$full_size_image_href->set_file('/');

		$full_size_image_href->set_get_variable('page', 'gallery');
		$full_size_image_href->set_get_variable('product_brand_id', $full_size_image_id);

		$gallery_image_page_a->set_href($full_size_image_href);

		$thumbnail_image_row_renderer = $thumbnail_image_row->get_renderer();
		#print_r($thumbnail_image_row_renderer);

		$drop_shadow_div = new HTMLTags_Div();
		$drop_shadow_div->set_attribute_str('class', 'img-shadow');
		$gallery_image_page_a->append_tag_to_content($thumbnail_image_row_renderer->get_img_in_public_images());

		$drop_shadow_div->append_tag_to_content($gallery_image_page_a);

		return $drop_shadow_div;

	}

	public function
		get_full_size_img()
	{
		$product_brand_row = $this->get_element();

		$full_size_image_row = $product_brand_row->get_full_size_image();

		$full_size_image_row_renderer = $full_size_image_row->get_renderer();
		$full_size_img = $full_size_image_row_renderer->get_img_in_public_images();

		return $full_size_img;

	}

	public function
		get_full_size_image_html_url()
	{
		$product_brand_row = $this->get_element();

		$full_size_image_row = $product_brand_row->get_full_size_image();

		$full_size_image_row_renderer = $full_size_image_row->get_renderer();
		$full_size_html_url = $full_size_image_row_renderer->get_html_url_in_public_images();

		return $full_size_html_url;

	}

	public function
		get_full_size_img_with_drop_shadow_div()
	{
		$product_brand_row = $this->get_element();

		$full_size_image_row = $product_brand_row->get_full_size_image();
		#
		#$full_size_image_row_id = $row->get_full_size_image_id();
		##print_r($thumbnail_image_row);
		#
		#$database = $row->get_database();
		#
		#$images_table = $database->get_table('images');
		#$image_row = $images_table->get_row_by_id($full_size_image_row_id);
		#
		##print_r($thumbnail_image_row_renderer);

		$drop_shadow_div = new HTMLTags_Div();
		$drop_shadow_div->set_attribute_str('class', 'img-shadow');

		$full_size_image_row_renderer = $full_size_image_row->get_renderer();
		$drop_shadow_div->append_tag_to_content($full_size_image_row_renderer->get_img_in_public_images());

		return $drop_shadow_div;
	}

	public function
		get_product_brand_editing_form($redirect_script_url, $cancel_location)
	{
		$mysql_user_factory = Database_MySQLUserFactory::get_instance();
		$mysql_user = $mysql_user_factory->get_for_this_project(); 
		$database = $mysql_user->get_database();

		$product_brand_row = $this->get_element();

		$product_brands_table = $database->get_table('hpi_shop_product_brands');

		$product_brand_editing_form = new HTMLTags_SimpleOLForm('product_brand_editing');
		$product_brand_editing_form->set_attribute_str('enctype', 'multipart/form-data');

		$product_brand_editing_action = clone $redirect_script_url;

		$product_brand_editing_action->set_get_variable('edit_id', $product_brand_row->get_id());

		$product_brand_editing_form->set_action($product_brand_editing_action);

		$product_brand_editing_form->set_legend_text('Edit this product_brand');

		/*
		 * The name
		 */
		$name_field = $product_brands_table->get_field('name');
		$name_field_renderer = $name_field->get_renderer();
		$input_tag = $name_field_renderer->get_form_input();
		$input_tag->set_value($product_brand_row->get_name());
		$input_tag->set_attribute_str('id', 'name');
		$product_brand_editing_form->add_input_tag(
			'name',
			$input_tag
		);        

		/*
		 * The owner
		 */
		$owner_field = $product_brands_table->get_field('owner');
		$owner_field_renderer = $owner_field->get_renderer();
		$input_tag = $owner_field_renderer->get_form_input();
		$input_tag->set_value($product_brand_row->get_owner());
		$input_tag->set_attribute_str('id', 'owner');
		$product_brand_editing_form->add_input_tag(
			'owner',
			$input_tag
		);        

		/*
		 * The description
		 */
		$description_field = $product_brands_table->get_field('description');
		$description_field_renderer = $description_field->get_renderer();
		$input_tag = $description_field_renderer->get_form_input();
		$input_tag->set_value($product_brand_row->get_description());
		$input_tag->set_attribute_str('id', 'description');
		$product_brand_editing_form->add_input_tag(
			'description',
			$input_tag
		);        

		/*
		 * The url
		 */
		$url_field = $product_brands_table->get_field('url');
		$url_field_renderer = $url_field->get_renderer();
		$input_tag = $url_field_renderer->get_form_input();
		$input_tag->set_value($product_brand_row->get_url());
		$input_tag->set_attribute_str('id', 'url');
		$product_brand_editing_form->add_input_tag(
			'url',
			$input_tag
		);        

		/*
		 * The update button.
		 */
		$product_brand_editing_form->set_submit_text('Update');

		$product_brand_editing_form->set_cancel_location($cancel_location);

		return $product_brand_editing_form;
	}
}
?>
