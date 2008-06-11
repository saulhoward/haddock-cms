<?php
/**
 * Shop_ProductBrandRow
 *
 * @copyright Clear Line Web Design, 2007-09-19
 */

class
Shop_ProductBrandRow
extends
Database_Row
{
	public function 
		get_name()
	{
		return $this->get('name');
	}

	public function 
		get_description()
	{
		return $this->get('description');
	}

	public function 
		get_owner()
	{
		return $this->get('owner');
	}

	public function 
		get_url()
	{
		return $this->get('url');
	}

	public function 
		get_full_size_image_id()
	{
		return $this->get('full_size_image_id');
	}

	public function 
		get_full_size_image()
	{
		$database = $this->get_database();

		#$images_table = $database->get_table('hpi_shop_images');
		$images_table = $database->get_table('hc_database_images');

		$full_size_image_id = $this->get_full_size_image_id();

		return $images_table->get_row_by_id($full_size_image_id);
	}

	public function 
		get_thumbnail_image()
	{
		$database = $this->get_database();

		#$images_table = $database->get_table('hpi_shop_images');
		$images_table = $database->get_table('hc_database_images');

		$thumbnail_image_id = $this->get_thumbnail_image_id();

		return $images_table->get_row_by_id($thumbnail_image_id);
	}

	public function 
		set_full_size_image_id($full_size_image_id)
	{
		$this->set_full_size_image_id('$full_size_image_id');
	}

	public function 
		get_thumbnail_image_id()
	{
		return $this->get('thumbnail_image_id');
	}

	public function 
		set_thumbnail_image_id($thumbnail_image_id)
	{
		$this->set_thumbnail_image_id('$thumbnail_image_id');
	}

	public function
		get_thumbnail_image_row()
	{
		$database = $this->get_database();

		#$images_table = $database->get_table('hpi_shop_images');
		$images_table = $database->get_table('hc_database_images');

		return $images_table->get_row_by_id($this->get_thumbnail_image_id());
	}

	public function
		get_displayable_products()
	{
		$database = $this->get_database();
		$products_table = $database->get_table('hpi_shop_products');

		$conditions = array();
		$conditions['product_brand_id'] = $this->get_id();
		$conditions['status'] = 'display';
		$products = $products_table->get_rows_where($conditions);

		return $products;
	}
}
?>
