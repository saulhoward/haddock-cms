<?php
/**
 * Shop_ProductTextLinksTable
 *
 * @copyright Clear Line Web Design, 2007-03-06
 */

require_once PROJECT_ROOT
. '/haddock/database/classes/elements/'
. 'Database_Table.inc.php';

class
	Shop_ProductTextLinksTable
	extends
	Database_Table
{
	public function
		add_product_text_link (
			$name,
			$product_id,
			$language_id,
			$name_text_id,
			$description_text_id
		)
	{
		$values = array();
			$values['name'] = $name;
			$values['product_id'] = $product_id;
			$values['language_id'] = $language_id;
			$values['name_text_id'] = $name_text_id;
			$values['description_text_id'] = $description_text_id;

		return $this->add($values);
	}

	public function
		edit_product_text_link (
			$edit_id,
			$name,
			$product_id,
			$language_id,
			$name_text_id,
			$description_text_id
		)
	{
		$values = array();
			$values['name'] = $name;
			$values['product_id'] = $product_id;
			$values['language_id'] = $language_id;
			$values['name_text_id'] = $name_text_id;
			$values['description_text_id'] = $description_text_id;

		return $this->update_by_id($edit_id, $values);
	}
}
?>
