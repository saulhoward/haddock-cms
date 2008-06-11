<?php
/**
 * TrackitStockManagement_ProductRowRenderer
 *
 * @copyright Clear Line Web Design, 2007-11-26
 */

class
	TrackitStockManagement_ProductRowRenderer
extends
	Database_RowRenderer
{
	public function
		get_image_td()
	{
		$product = $this->get_element();
		$photograph = $product->get_main_photograph();
		#print_r($photograph);exit;

		if (isset($photograph)) {
			$photograph_renderer = $photograph->get_renderer();

			return $photograph_renderer->get_thumbnail_image_td();
		} else {
			return new HTMLTags_TD();
		}
	}

	public function
		get_image_img()
	{
		$product = $this->get_element();
		$photograph = $product->get_main_photograph();
		#print_r($photograph);exit;

		if (isset($photograph)) {
			$photograph_renderer = $photograph->get_renderer();

			return $photograph_renderer->get_thumbnail_img();
		} else {
			return NULL;
		}
	}

	public function
		get_set_image_link_td()
	{
		$set_image_link_td = new HTMLTags_TD();

		$product = $this->get_element();

		$link = new HTMLTags_A('Set Image');

		$link->set_attribute_str('class', 'cool_button');

		$url = Admin_AdminIncluderURLFactory::get_url(
			'plug-ins',
			'trackit-stock-management',
			'set-product-image',
			'html'
		);

		$url->set_get_variable('product_id', $product->get_id());

		$link->set_href($url);

		$set_image_link_td->append_tag_to_content($link);

		return $set_image_link_td;
	}

	public function
		get_product_id_with_link_td()
	{
		$td = new HTMLTags_TD();
		$product = $this->get_element();

		$link = new HTMLTags_A($product->get('product_id'));

		$url = Admin_AdminIncluderURLFactory::get_url(
			'plug-ins',
			'trackit-stock-management',
			'product',
			'html'
		);

		$url->set_get_variable('product_id', $product->get_id());

		$link->set_href($url);

		$td->append_tag_to_content($link);

		return $td;
	}
}
?>
