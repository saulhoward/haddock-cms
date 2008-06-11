<?php
/**
 * Shop_ProductCategoryRowRenderer.inc.php
 *
 * @copyright Clear Line Web Design, 2007-03-03
 */


class
	Shop_ProductCategoryRowRenderer
extends
	Database_RowRenderer
{
	public function
		get_admin_product_categories_html_table_tr($current_page_url)
	{
		$html_row =  new HTMLTags_TR();

		$row = $this->get_element();

		$table = $row->get_table();

		/*
		 * The data.
		 */ 
		$name_field = $table->get_field('name');
		$name_td = $this->get_data_html_table_td($name_field);
		$html_row->append_tag_to_content($name_td);

		$description_field = $table->get_field('description');
		$description_td = $this->get_data_html_table_td($description_field);
		$html_row->append_tag_to_content($description_td);

		$sort_order_field = $table->get_field('sort_order');
		$sort_order_td = $this->get_data_html_table_td($sort_order_field);
		$html_row->append_tag_to_content($sort_order_td);

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
    
    private function
        get_shop_plug_in_action_td(
            $location,
            $a_text,
            $a_id,
            $id_get_var_name
        )
    {
        $td = new HTMLTags_TD();
        
        $row = $this->get_element();
        
		$link = new HTMLTags_A($a_text);
		$link->set_attribute_str('class', 'cool_button');
		$link->set_attribute_str('id', $a_id);

		$location->set_get_variable($id_get_var_name, $row->get_id());

		$link->set_href($location);

		$td->append_tag_to_content($link);

		return $td;        
    }
    
    public function
        get_shop_plug_in_edit_td($edit_location)
    {
		return $this->get_shop_plug_in_action_td(
            $edit_location,
            'Edit',
            'edit_table_button',
            'edit_id'
        );
    }
    
    public function
        get_shop_plug_in_delete_td($delete_location)
    {
        return $this->get_shop_plug_in_action_td(
            $delete_location,
            'Delete',
            'delete_table_button',
            'delete_id'
        );
    }

	public function
		get_product_category_li_in_public()
	{
		$product_category_li = new HTMLTags_LI();

		$product_category = $this->get_element();

		$product_category_link = new HTMLTags_A($product_category->get_name());

		$product_category_location = new HTMLTags_URL();
		$product_category_location->set_file('/');
		
		$product_category_location->set_get_variable('section', 'plug-ins');
		$product_category_location->set_get_variable('module', 'shop');
		$product_category_location->set_get_variable('page', 'product-category');
		$product_category_location->set_get_variable('product_category_id', $product_category->get_id());     

		$product_category_link->set_href($product_category_location);

		$product_category_li->append_tag_to_content($product_category_link);
		return $product_category_li;
	}
	
	/**
	 * @return HTMLTags_URL
	 *  The URL of a page for the products in this category.
	 */
	public function
		get_page_url_in_public()
	{
		$pc = $this->get_element();
		
		$puib = new HTMLTags_URL();
		
		$puib->set_file('/');
		
		$puib->set_get_variable('section', 'plug-ins');
		$puib->set_get_variable('module', 'shop');
		$puib->set_get_variable('page', 'product-category');
		$puib->set_get_variable('type', 'html');
		
		$puib->set_get_variable('product_category_id', $pc->get_id());
		
		return $puib;
	}
}
?>
