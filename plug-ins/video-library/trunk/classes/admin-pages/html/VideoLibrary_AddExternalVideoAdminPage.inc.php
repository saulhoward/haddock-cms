<?php
/**
 * VideoLibrary_AddExternalVideoAdminPage.inc.php
 * @copyright 2010-06-18 SANH
 */

class
VideoLibrary_AddExternalVideoAdminPage
extends
VideoLibrary_AdminPage
{ 
    protected function
        render_head_link_stylesheet()
    {
        parent::render_head_link_stylesheet();
        HTMLTags_LinkRenderer::render_style_sheet_link('/plug-ins/video-library/public-html/styles/admin-styles.css');

        echo <<<HTML
<script type="text/javascript" 
         src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" 
         src="/plug-ins/video-library/public-html/scripts/pages/VideoLibrary_ManageExternalVideosPage.js"></script>
HTML;

    }


	protected function
		get_body_div_header_heading_content()
	{
		return 'Add a Video';
	}

	public function
		get_admin_content_div()
    {
        $div = new HTMLTags_Div();
        $div->append('<h2>NEW Add an External Video</h2>');

        $div->append(VideoLibrary_AdminHelper::get_add_external_video_form());
        return $div;
    }
}
?>
