<?php
/**
 * BannerAds_BannerAdsTable
 *
 * @copyright Clear Line Web Design, 2007-11-02
 */

class
	BannerAds_BannerAdsTable
extends
	Database_Table
{
	public function
		get_banner_ad($name)
	{
		$conditions = array();
		$conditions['name'] = $name;

		$rows = $this->get_rows_where($conditions);

		if (count($rows) == 1) {
			return $rows[0];
		} else {
			if (count($rows) == 0) {
				throw new Exception("No banner ad called $name!");
			} else {
				throw new Exception("More than one banner ad called $name!");
			}
		}
	}

	public function
		add_banner_ad($values)
	{
#		print_r($values); exit;
		return $this->add($values);
	}
}
