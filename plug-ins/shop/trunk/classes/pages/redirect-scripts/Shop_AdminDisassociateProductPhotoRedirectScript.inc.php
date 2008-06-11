<?php
/**
 * Shop_AdminDisassociateProductPhotoRedirectScript
 *
 * @copyright Clear Line Web Design, 2008-02-08
 */

class
	Shop_AdminDisassociateProductPhotoRedirectScript
extends
	Admin_RestrictedRedirectScript
{
	protected function
		do_actions()
	{
		if (isset($_GET['product_id'])) {
			if (isset($_GET['photograph_id'])) {
				Shop_ProductsHelper
					::disassociate_product_photo(
						$_GET['product_id'],
						$_GET['photograph_id']
					);
			}
			
			$this->set_return_to_url(Shop_ProductsHelper::get_admin_edit_product_page_url($_GET['product_id']));
		} else {
			$this->set_return_to_url(Shop_ProductsHelper::get_admin_products_page_url());
		}
		
		#print_r($this); exit;
	}
}
?>