<?php
/**
 * Shop_ProductTextLinkRow
 *
 * @copyright Clear Line Web Design, 2007-03-03
 */

class
	Shop_ProductTextLinkRow
extends
	Database_Row
{
	public function
		get_product_id()
	{
		return $this->get('product_id');
	}
	public function
		get_language_id()
	{
		return $this->get('language_id');
	}

	public function
		get_name_text_id()
	{
		return $this->get('name_text_id');
	}

	public function
		get_description_text_id()
	{
		return $this->get('description_text_id');
	}

	public function 
		get_name_text()
	{
		$database = $this->get_database();
		$name_texts_table = $database->get_table('hpi_shop_texts');
		$name_text_id = $this->get_name_text_id();
		$name_text_row = $name_texts_table->get_row_by_id($name_text_id);
		return $name_text_row->get_text();
	}

	public function 
		get_description_text()
	{
		$database = $this->get_database();
		$description_texts_table = $database->get_table('hpi_shop_texts');
		$description_text_id = $this->get_description_text_id();
		$description_text_row = $description_texts_table->get_row_by_id($description_text_id);
		return $description_text_row->get_text();
	}
}
?>
