<?php
/**
 * VideoLibrary_RedTube
 *
 * @copyright 2009-01-10, SANH
 */

class
VideoLibrary_RedTube
extends
VideoLibrary_ExternalVideoProvider
{
	public function
		get_video_embed_code()
	{
		return <<<HTML
		<object height="344" width="434">
			<param name="movie" value="http://embed.redtube.com/player/">
			<param name="FlashVars" value="id=%video_id&style=redtube">
			<embed 
				src="http://embed.redtube.com/player/?id=%video_id&style=redtube" 
				pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" 
				type="application/x-shockwave-flash" height="344" width="434" />
		</object>
HTML;

	}
}
?>
