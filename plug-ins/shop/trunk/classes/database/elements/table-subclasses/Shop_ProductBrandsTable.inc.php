<?php
/**
 * Shop_ProductBrandsTable
 *
 * @copyright Clear Line Web Design, 2007-09-19
 */

class
Shop_ProductBrandsTable
extends
Database_Table
{
	public function
		add_product_brand (
			$name,
			$owner,
			$description,
			$url,
			$display_image_file,
			$thumbnail_image_file
		)
	{

		$files[] = $display_image_file;
		$files[] = $thumbnail_image_file;
		$returned_image_ids = $this->add_image_files($files);

		$product_brand_values = array();
		$product_brand_values['name'] = $name;
		$product_brand_values['owner'] = $owner;
		$product_brand_values['description'] = $description;
		$product_brand_values['url'] = $url;
		$product_brand_values['full_size_image_id'] = $returned_image_ids['display'];
		$product_brand_values['thumbnail_image_id'] = $returned_image_ids['thumbnail'];

		$product_brand_id = $this->add($product_brand_values);

		return $product_brand_id;
	}

	public function
		edit_product_brand (
			$edit_id,
			$name,
			$owner,
			$description,
			$url
			)
	{

		$product_brand_values = array();
		$product_brand_values['name'] = $name;
		$product_brand_values['owner'] = $owner;
		$product_brand_values['description'] = $description;
		$product_brand_values['url'] = $url;

		$this->update_by_id($edit_id, $product_brand_values);

	}

	public function
		delete_product_brand (
			$delete_id
		)
	{
		$database = $this->get_database();

		$images_table = $database->get_table('hc_database_images');

		$product_brand_row = $this->get_row_by_id($delete_id);

		#
		#Delete from Images table
		#
		$images_table->delete_by_id($product_brand_row->get_full_size_image_id());
		$images_table->delete_by_id($product_brand_row->get_thumbnail_image_id());

		#
		#Delete from Photographs table
		#
		$this->delete_by_id($product_brand_row->get_id());

	}

	/**
	 * Move to Database_ImagesTable? 
	 * - almost certainly, as this is the same funciton as in PhotogrpahsTable
	 */
	public function
		add_image_files(
			$files
		)
	{
		#print_r($file);
		$database = $this->get_database();
		$images_table = $database->get_table('hc_database_images');

		$image_ids = array();

		foreach ($files as $file) {

			$size = $file['size'][0];
			$mime = $file['type'][0];
			$file_name = basename($file['name'][0]);

			$content = file_get_contents($file['tmp_name'][0]);
			$content = gzdeflate($content);

			$values['file_type'] = $mime;
			$values['image'] = $content;

			#print_r($values);
			$image_ids[] = $images_table->add($values);
		}

		$returned_image_ids['display'] = $image_ids[0];
		$returned_image_ids['thumbnail'] = $image_ids[1];

		return $returned_image_ids;
	}

	public function
		get_active_product_brands()
	{

		/*
		 * RFI 2008-01-18
		 */
//                return $this->get_all_rows();

		/*
		 * SANH 2008-09-15
		 */
		$brands = $this->get_all_rows();
		$brands_with_stock = array();
		foreach($brands as $brand)
		{
//                        print_r(MashShop_ProductsHelper::get_stock_level_for_product_brand($brand->get_id()));
			if (MashShop_ProductsHelper::get_stock_level_for_product_brand($brand->get_id()) > 0)
			{
				$brands_with_stock[] = $brand;
			}
		}
//                exit;
//                print_r($brands_with_stock);exit;
		return $brands_with_stock;
		

		/* OLDE CODE */
		$database = $this->get_database();
		$customer_regions_table = $database->get_table('hpi_shop_customer_regions');

		#$customer_region = $customer_regions_table->get_row_by_id($_SESSION['customer_region_id']);
		$customer_region = $customer_regions_table->get_current_customer_region();
//                $products = $customer_region->get_active_products();

		$active_product_brands = array();

		$product_brands = $this->get_all_rows();

		foreach ($product_brands as $product_brand) {
			$products = $product_brand->get_displayable_products();
			
			foreach ($products as $product) {
				$customer_region_suppliers = $customer_region->get_suppliers();
				$product_supplier = $product->get_supplier();
				foreach ($customer_region_suppliers as $customer_region_supplier) {
					if ($customer_region_supplier->get_id() == $product_supplier->get_id()) {
						if (count($active_product_brands) > 0) {
							foreach ($active_product_brands as $active_product_brand) 
							{
								if 
									(
										$active_product_brand->get_id() 
										!= 
										$product_brand->get_id()
									) {

									$active_product_brands[] =
										$product_brand;
								}

							}
						} else {
							$active_product_brands[] = $product_brand;
						}
					}
				}
			}
		}
		return $active_product_brands;
	}

	public function
		get_active_product_brands_for_tag($product_tag)
	{
		/*
		 * RFI 2008-01-18
		 */
//                $active_product_brands = $this->get_active_product_brands();
//                return $active_product_brands;

		/*
		 * SANH 2008-09-15
		 */
		$brands = $this->get_all_rows();
		$brands_with_stock = array();
		foreach($brands as $brand)
		{
//                        print_r(MashShop_ProductsHelper::get_stock_level_for_product_brand($brand->get_id()));
			if (MashShop_ProductsHelper::get_stock_level_for_product_brand_and_tag($brand->get_id(), $product_tag->get_id()) > 0)
			{
				$brands_with_stock[] = $brand;
			}
		}
//                exit;
//                print_r($brands_with_stock);exit;
		return $brands_with_stock;
		
	
		$active_product_brands_for_tag = array();

		foreach ($active_product_brands as $active_product_brand)
		{

			$products = $active_product_brand->get_displayable_products();
			
			foreach ($products as $product) 
			{

				if ($product->has_tag($product_tag))
				{

					$active_product_brands_for_tag[] = $active_product_brand;

				}
			}
		}
		return $active_product_brands_for_tag;
	}
}
?>
