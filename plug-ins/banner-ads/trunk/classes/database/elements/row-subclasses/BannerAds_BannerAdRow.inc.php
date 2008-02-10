<?php
/**
 * BannerAds_BannerAdRow
 *
 * @copyright Clear Line Web Design, 2007-11-03
 */

class
	BannerAds_BannerAdRow
extends
	Database_Row
{
	public function
		get_embed()
	{
		return $this->get('embed');
	}
}
?>
