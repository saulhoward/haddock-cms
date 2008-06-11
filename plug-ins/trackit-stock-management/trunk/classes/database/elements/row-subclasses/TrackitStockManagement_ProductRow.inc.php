<?php
/**
 * TrackitStockManagement_ProductRow
 *
 * @copyright Clear Line Web Design, 2007-11-26
 */

class
	TrackitStockManagement_ProductRow
extends
	Database_Row
{
	public function
		has_main_photograph()
	{
		return strlen($this->get('image_name')) > 0;
	}

	public function
		get_main_photograph()
	{
		$image_name = $this->get('image_name');

		if (strlen($image_name) > 0) {
			$database = $this->get_database();

			$photographs_table = $database->get_table('hpi_shop_photographs');

			$conditions = array();
			$conditions['name'] = $image_name;

			$rows = $photographs_table->get_rows_where($conditions);

			if (count($rows) == 1) {
				return $rows[0];
			}
		}

		return null;
	}
}
?>
