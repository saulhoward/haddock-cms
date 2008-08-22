<?php
/**
 * PublicHTML_GDPNGImage
 *
 * @copyright 2008-05-15, SANH
 */

abstract class
	PublicHTML_GDPNGImage
extends
	PublicHTML_PNGImage
{
	public function load_png($imgname)
	{
		// If file isn't found
		// imagecreatefrompng() returns error msg and breaks the code
		// this function returns an error image instead of breaking
		//
		$im = @imagecreatefrompng($imgname); /* Attempt to open */
		if (!$im) { /* See if it failed */
			$im  = imagecreatetruecolor(150, 30); /* Create a blank image */
			$bgc = imagecolorallocate($im, 255, 255, 255);
			$tc  = imagecolorallocate($im, 0, 0, 0);
			imagefilledrectangle($im, 0, 0, 150, 30, $bgc);
			/* Output an errmsg */
			imagestring($im, 1, 5, 5, "Error loading $imgname", $tc);
		}
		return $im;
	}
}
?>
