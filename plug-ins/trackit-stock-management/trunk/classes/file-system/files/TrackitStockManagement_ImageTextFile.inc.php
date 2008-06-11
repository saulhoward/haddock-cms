<?php
/**
 * TrackitStockManagement_ImageTextFile
 *
 * @copyright 2008-05-14, RFI
 */

class
	TrackitStockManagement_ImageTextFile
extends
	TrackitStockManagement_TextFeedFile
{
	public function
		process()
	{
		$product_image_links
			= $this->get_product_image_links();
		
		#print_r($product_image_links);
		
		#foreach (
		#	$product_image_links
		#	as
		#	$product_image_link
		#) {
		#	TrackitStockManagement_ImageFilesHelper
		#		::save_product_image_link(
		#			$product_image_link['product_id'],
		#			$product_image_link['image_order'],
		#			$product_image_link['image_name']
		#		);
		#}
		
		TrackitStockManagement_ImageFilesHelper
			::save_product_image_links(
				$product_image_links
			);
	}
	
	public function
		get_product_image_links()
	{
		$product_image_links = array();
		
		$fields = array();
		
		$fields[] = array(
			'name' => 'site_id',
			'chars' => 3
		);
		
		$fields[] = array(
			'name' => 'product_id',
			'chars' => 15
		);
		
		$fields[] = array(
			'name' => 'image_order',
			'chars' => 2
		);
		
		$fields[] = array(
			'name' => 'image_name'
		);
		
		if ($fh = fopen($this->get_name(), 'r')) {
			/*
			 * Parse the file.
			 */
			while (!feof($fh)) {
				$line = fgets($fh);
				
				$line = rtrim($line);
				
				if (strlen($line) > 0) {
					$values = array();
					
					$offset = 0;
					foreach ($fields as $field) {
						$k = $field['name'];
						
						if (isset($field['chars'])) {
							$v = substr($line, $offset, $field['chars']);
							
							$offset += $field['chars'];
						} else {
							$v = substr($line, $offset);
						}
						
						$v = trim($v);
						
						$values[$k] = $v;
					}
					
					$product_image_links[] = $values;
				}
			}
			
			fclose($fh);
		} else {
			throw new Exception('Unable to open ' . $this->get_name() . '!');
		}
		
		return $product_image_links;
	}
}
?>