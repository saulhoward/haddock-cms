<?php
/**
 * VideoLibrary_PornHub
 *
 * @copyright 2009-01-10, SANH
 */

class
VideoLibrary_PornHub
extends
VideoLibrary_ExternalVideoProvider
{
	public function
		get_video_embed_code()
	{
		//$internal_id = $this->get_providers_internal_id();

		return <<<HTML

<object type="application/x-shockwave-flash" data="http://cdn-www.pornhub.com/flash/embed_player_v1.3.swf" width="608" height="476"><param name="movie" value="http://cdn-www.pornhub.com/flash/embed_player_v1.3.swf" /><param name="bgColor" value="#000000" /><param name="allowfullscreen" value="true" /><param name="allowScriptAccess" value="always" /><param name="FlashVars" value="options=http://www.pornhub.com/embed_player.php?id=%video_id"/></object>

HTML;

	}
}
?>
