<?php
/**
 * Shop_CustomerRegionSupplierLinksTable
 *
 * @copyright Clear Line Web Design, 2007-03-06
 */

class
	Shop_CustomerRegionSupplierLinksTable
extends
	Database_Table
{
	public function
		add_customer_region_supplier_link (
			$supplier_id,
			$customer_region_id
		)
	{
		$values = array();
		$values['supplier_id'] = $supplier_id;
		$values['customer_region_id'] = $customer_region_id;

		$id = $this->add($values);
		return $id;
	}

	public function
		edit_customer_region_supplier_link (
			$edit_id,
			$supplier_id
		)
	{
		$values = array();
		$values['supplier_id'] = $supplier_id;
		$values['customer_region_id'] = $customer_region_id;

		return $this->update_by_id($edit_id, $values);
	}
}
?>
