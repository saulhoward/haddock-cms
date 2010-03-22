<?php
/**
 * VideoLibrary_AdminHelper
 *
 * @copyright 2009-01-10, SANH
 * 
 */

class
VideoLibrary_AdminHelper
{
    public static function
        get_link_to_edit_video_admin_page_div(
            $video_id
        )
    {
        $div = new HTMLTags_Div();
        $div->set_attribute_str('class', 'admin');
        $a = new HTMLTags_A('Edit this Video');
        $a->set_attribute_str('class', 'edit');
        $a->set_href(
            VideoLibrary_URLHelper::get_edit_external_video_admin_page_url($video_id)
        );
        $div->append($a);
        return $div;
    }

    public static function
        get_logged_in_admin_user_name()
    {
        try
        {
            $alm = Admin_LoginManager::get_instance();
            return $alm->get_name();
        }
        catch (Exception  $e)
        {
            return 'unknown';
        }
    }
}
?>
