<?php
/**
 * Shop_ProductBrandsTableRenderer
 *
 * @copyright Clear Line Web Design, 2007-09-19
 */

class
	Shop_ProductBrandsTableRenderer
	extends
	Database_TableRenderer
{
	public function
		get_product_brand_adding_form($product_brand_adding_action, $cancel_location)
	{
//                $mysql_user_factory = Database_MySQLUserFactory::get_instance();
//                $mysql_user = $mysql_user_factory->get_for_this_project(); 
//                $database = $mysql_user->get_database();

//                $product_brands_table = $database->get_table('hpi_shop_product_brands');

		$product_brands_table = $this->get_element();

		$product_brand_adding_form = new HTMLTags_SimpleOLForm('product_brand_adding');
		$product_brand_adding_form->set_attribute_str('enctype', 'multipart/form-data');

		#$product_brand_adding_action->set_get_variable('table', $product_brands_table->get_name());

		$product_brand_adding_form->set_action($product_brand_adding_action);

		$product_brand_adding_form->set_legend_text('Add a product_brand');

		/*
		 * The name
		 */
		$name_field = $product_brands_table->get_field('name');
		$name_field_renderer = $name_field->get_renderer();
		$input_tag = $name_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'name');
		$product_brand_adding_form->add_input_tag(
			'name',
			$input_tag
		);        

		/*
		 * The owner
		 */
		$owner_field = $product_brands_table->get_field('owner');
		$owner_field_renderer = $owner_field->get_renderer();
		$input_tag = $owner_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'owner');
		$product_brand_adding_form->add_input_tag(
			'owner',
			$input_tag
		);        



		/*
		 * The description
		 */
		$description_field = $product_brands_table->get_field('description');
		$description_field_renderer = $description_field->get_renderer();
		$input_tag = $description_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'description');
		$product_brand_adding_form->add_input_tag(
			'description',
			$input_tag
		);        


		/*
		 * The url
		 */
		$url_field = $product_brands_table->get_field('url');
		$url_field_renderer = $url_field->get_renderer();
		$input_tag = $url_field_renderer->get_form_input();
		$input_tag->set_attribute_str('id', 'url');
		$product_brand_adding_form->add_input_tag(
			'url',
			$input_tag
		);        

		/* THE FULL SIZE IMAGE UPLOAD */
		$full_size_image_file_input_tag = new HTMLTags_Input();

		$full_size_image_file_input_tag_name = 'display_image_file[]';

		$full_size_image_file_input_tag->set_attribute_str('type', 'file');
		$full_size_image_file_input_tag->set_attribute_str('id', $full_size_image_file_input_tag_name);
		$full_size_image_file_input_tag->set_attribute_str('name', $full_size_image_file_input_tag_name);

		$product_brand_adding_form->add_input_tag(
			$full_size_image_file_input_tag_name,
			$full_size_image_file_input_tag,
			'Photograph File'
		);

		/* THE THUMBNAIL IMAGE UPLOAD */
		$thumbnail_image_file_input_tag = new HTMLTags_Input();

		$thumbnail_image_file_input_tag_name = 'thumbnail_image_file[]';

		$thumbnail_image_file_input_tag->set_attribute_str('type', 'file');
		$thumbnail_image_file_input_tag->set_attribute_str('id', $thumbnail_image_file_input_tag_name);
		$thumbnail_image_file_input_tag->set_attribute_str('name', $thumbnail_image_file_input_tag_name);

		$product_brand_adding_form->add_input_tag(
			$thumbnail_image_file_input_tag_name,
			$thumbnail_image_file_input_tag,
			'Thumbnail File'
		);
		$product_brand_adding_form->add_hidden_input('MAX_FILE_SIZE', '1000000');

		/*
		 * The add button.
		 */
		$product_brand_adding_form->set_submit_text('Add');

		$product_brand_adding_form->set_cancel_location($cancel_location);

		return $product_brand_adding_form;
	}

	public function
		get_gallery_front_page_img()
	{
		$product_brands_table = $this->get_element();
		$front_page_product_brand_row = $product_brands_table->get_front_page_image();
		#print_r($front_page_product_brand_row);
		$front_page_product_brand_row_renderer = $front_page_product_brand_row->get_renderer();
		#print_r($front_page_product_brand_row_renderer);
		return $front_page_product_brand_row_renderer->get_full_size_img();

	}


}
?>
