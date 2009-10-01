<?php
/**
 * VideoLibrary_XVideos
 *
 * @copyright 2009-01-10, SANH
 */

class
VideoLibrary_XVideos
extends
VideoLibrary_ExternalVideoProvider
{
	public function
		get_video_embed_code()
	{
		$internal_id = $this->get_providers_internal_id();

		return <<<HTML
<object width="510" height="400" classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" ><param name="quality" value="high" /><param name="bgcolor" value="#000000" /><param name="allowScriptAccess" value="always" /><param name="movie" value="http://static.xvideos.com/swf/flv_player_site_v4.swf" /><param name="allowFullScreen" value="true" />
<param name="flashvars" value="id_video=$internal_id" />
<embed src="http://static.xvideos.com/swf/flv_player_site_v4.swf" allowscriptaccess="always" width="510" height="400" menu="false" quality="high" bgcolor="#000000" allowfullscreen="true" 
flashvars="id_video=$internal_id" 
type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object>

HTML;

	}
}
?>
