<?php
/**
 * PhotoGallery_GalleryPage
 * 
 * @copyright Clear Line Web Design, 2007-12-10
 */

/**
 * Gallery Page for the PhotoGallery.com site
 */
class
PhotoGallery_GalleryPage
extends
PublicHTML_HTMLPage
{

	public function
		content()
	{
		echo PhotoGallery_GalleryHelper::get_gallery_div();
	}

	public function 
		render_head_script_javascript() 
	{ 
		 echo '<script type="text/javascript" 
		  src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>' . "\n";
		// echo '<script type="text/javascript" src="/scripts/jquery.cycle.lite.min.js"></script>' . "\n";

		 echo '<script type="text/javascript" src="/plug-ins/photo-gallery/public-html/scripts/jquery.galleria.pack.js"></script>' . "\n";
		 echo '<script type="text/javascript" src="/plug-ins/photo-gallery/public-html/scripts/PhotoGallery_GalleryPage.js"></script>' . "\n";
	}
}
?>
