<?php
/**
 * TrackitStockManagement_ManageProductsAdminPage
 *
 * @copyright 2008-04-29, RFI
 */

class
	TrackitStockManagement_ManageProductsAdminPage
extends
	Database_CRUDAdminPage
{
	public function
		get_admin_crud_manager_class_name()
	{
		return 'TrackitStockManagement_ProductsCRUDAdminManager';
	}
	
	public function
		get_matching_query_from_clause()
	{
		return <<<SQL
FROM
	hpi_trackit_stock_management_products
	
SQL;

	}
	
	protected function
		get_data_table_fields()
	{
		return array(
			array(
				'col_name' => 'product_id'
			),
			array(
				'col_name' => 'supplier_code'
			),
			array(
				'col_name' => 'unit_price'
			),
			array(
				'col_name' => 'description',
				'sortable' => 'no',
				'filter' => '$str = Strings_FilteringHelper::truncate_with_ellipsis_and_convert_html_entities($str);'
			)
		);
	}
	
	protected function
		get_data_table_actions()
	{
		return array();
	}
	
	protected function
		render_other_pages_ul()
	{
	}
	
	protected function
		get_body_div_header_heading_content()
	{
		return 'Products in the TrackIt System';
	}
}
?>