<?php

class 
	PhotoGallery_StartPageWidget
extends
	Admin_StartPageWidget
{
	protected function
		get_widget_title()
	{
		return 'Photo Gallery';
	}

	protected function
		get_widget_content()
	{
		return PhotoGallery_GalleryHelper::get_widget_content();
	}
}
?>
