<?php
/**
 * TrackitStockManagement_ImageFilesHelper
 *
 * @copyright 2008-05-14, RFI
 */

class
	TrackitStockManagement_ImageFilesHelper
{
	public static function
		get_unprocessed_image_text_files()
	{
		$unprocessed_image_text_file_names
			= TrackitStockManagement_FeedFilesHelper
				::get_unprocessed_image_text_file_names();
		
		$unprocessed_image_text_files = array();
		
		foreach ($unprocessed_image_text_file_names as $uitfn) {
			$unprocessed_image_text_files[]
				= new TrackitStockManagement_ImageTextFile(
					$uitfn
				);
		}
		
		return $unprocessed_image_text_files;
	}
	
	public static function
		save_product_image_links(
			$product_image_links
		)
	{
		foreach (
			$product_image_links
			as
			$product_image_link
		) {
			self
				::save_product_image_link(
					$product_image_link['product_id'],
					$product_image_link['image_order'],
					$product_image_link['image_name']
				);
		}
	}
	
	public static function
		save_product_image_link(
			$product_id,
			$image_order,
			$image_name
		)
	{
		$pk_product_id
			= TrackitStockManagement_ProductsHelper
				::get_id_for_product_id(
					$product_id
				);
		
		$image_id
			= self
				::get_id_for_name(
					$image_name
				);
		
		Database_ModifyingStatementHelper
			::apply_statement(
				new Database_SQLInsertStatement(
<<<SQL
INSERT INTO
	hpi_trackit_stock_management_product_image_links
SET
	product_id = $pk_product_id,
	image_id = $image_id,
	sort_order = $image_order
SQL

				)
			);
	}
	
	public static function
		get_id_for_name(
			$name
		)
	{
		$rows
			= Database_FetchingHelper
				::get_rows_for_query(
					new Database_SQLSelectQuery(
<<<SQL
SELECT
	id
FROM
	hpi_trackit_stock_management_images
WHERE
	name = '$name'
SQL

					)
				);
		
		if (count($rows) == 0) {
			/*
			 * Add the image.
			 */
			return Database_ModifyingStatementHelper
				::apply_statement(
					new Database_SQLInsertStatement(
<<<SQL
INSERT INTO
	hpi_trackit_stock_management_images
SET
	name = '$name'
SQL

					)
				);
		} else {
			$row = $rows[0];
			
			return $row['id'];
		}
	}
	
	public static function
		reset_image_files()
	{
		TrackitStockManagement_FeedFilesHelper
			::reset_image_files_processed_status();
		
		Database_TableHelper
			::empty_tables(
				'hpi_trackit_stock_management_images hpi_trackit_stock_management_product_image_links'
			);
	}
}
?>