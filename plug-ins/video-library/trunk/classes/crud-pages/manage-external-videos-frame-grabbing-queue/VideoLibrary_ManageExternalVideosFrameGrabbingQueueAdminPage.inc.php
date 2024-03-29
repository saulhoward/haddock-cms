<?php
/**
 * VideoLibrary_ManageExternalVideosFrameGrabbingQueueAdminPage
 *
 * @copyright RFI 2008-01-08
 */

class
VideoLibrary_ManageExternalVideosFrameGrabbingQueueAdminPage
extends
Database_CRUDAdminPage
{
    protected function
        get_admin_crud_manager_class_name()
    {
        return 'VideoLibrary_ExternalVideosFrameGrabbingQueueCRUDManager';
    }

    protected function
        get_data_table_fields()
    {
        return array(
            array(
                'col_name' => 'last_processed',
                'filter' => 'if ($str != NULL) return date("F j, Y", strtotime($str)); else return "Queueing...";'
            ),
            array(
                'col_name' => 'external_video_id',
                'title' => 'Video ID'
            ),
            array(
                'col_name' => 'external_video_id',
                'filter' => 'return VideoLibrary_ExternalVideosFrameGrabbingQueueHelper::get_video_name_for_external_video_id($str);',
                'title' => 'Name'
            ),
            array(
                'col_name' => 'external_video_id',
                'filter' => 'return VideoLibrary_ExternalVideosFrameGrabbingQueueHelper::get_thumbnail_img_str_for_external_video_id($str);',
                'title' => 'Current Thumbnail'
            ),
            array(
                'col_name' => 'id',
                'filter' => 'return VideoLibrary_ManageExternalVideosFrameGrabbingQueueAdminPage::get_requeue_video_link($str);',
                'title' => 'Requeue'
            ),
             array(
                'col_name' => 'external_video_id',
                'filter' => 'return VideoLibrary_ManageExternalVideosFrameGrabbingQueueAdminPage::get_admin_video_view_link($str);',
                'title' => 'View'
            )

       );
    }

    public function
        get_admin_video_view_link($id)
    {
        $url = VideoLibrary_URLHelper::get_admin_video_view_url($id)->get_as_string();
        return '<a href="' . $url . '">View</a>';
    }

    public function
        get_requeue_video_link($id)
    {
		$u = $this->get_redirect_script_url();
		$u->set_get_variable('action', 'requeue_video');
		$u->set_get_variable('id', $id);

        $a = new HTMLTags_A('Requeue');
        $a->set_href($u);
        return $a->get_as_string();
    }

    protected function
        get_matching_query_from_clause()
    {
        return <<<SQL
FROM
    hpi_video_library_external_videos_frame_grabbing_queue

SQL;

    }

    protected function
        get_default_limit()
    {
        return '50';
    }

    protected function
        get_default_order_by()
    {
        return 'IFNULL(last_processed, 9999)';
    }

    protected function
        get_default_direction()
    {
        return 'DESC';
    }

    protected function
        get_body_div_header_heading_content()
    {
        return 'External Videos Frame Grabbing Queue';
    }

    protected function
        get_other_page_link_as()
    {
        $as = array();
        /**
         * Link to the reset all confirmation page.
         */
        $reset_all_a = new HTMLTags_A($this->get_reset_everything_title());

        $reset_all_href = $this->get_current_base_url();
        $reset_all_href->set_get_variable('content', 'reset_everything');

        $reset_all_a->set_href($reset_all_href);

        $as[] = $reset_all_a;
        /**
         * Link to the delete all confirmation page.
         */
        $delete_all_a = new HTMLTags_A($this->get_delete_everything_title());

        $delete_all_href = $this->get_current_base_url();
        $delete_all_href->set_get_variable('content', 'delete_everything');

        $delete_all_a->set_href($delete_all_href);

        $as[] = $delete_all_a;

        return $as;
    }

    protected function
        get_delete_everything_title()
    {
        return 'Empty the Queue';
    }


    protected function
        get_reset_everything_title()
    {
        return 'Reset all External Videos in the Queue';
    }

    protected function
        get_content_render_method_map()
    {
        $crmm = parent::get_content_render_method_map();
        $crmm['reset_everything'] = 'render_content_to_reset_everything';

        return $crmm;
    }

    public function
        render_content_to_reset_everything()
    {
        VideoLibrary_DatabaseHelper::reset_external_videos_frame_grabbing_queue();

        $back_a = new HTMLTags_A('Back to the Queue');
        $back_href = $this->get_current_base_url();
        $back_a->set_href($back_href);
        $back_a_str = $back_a->get_as_string();

        echo <<<HTML
<h2>Reset all External Videos in the Frame Grabbing Queue</h2>
<p>
        All videos have been re-queued and will be processed again on 
        the next running of the frame grabbing script.
</p>
<ul>
        <li>
        $back_a_str
        </li>
</ul>
HTML;

    }

    public function
        render_content_to_delete_everything()
    {
        VideoLibrary_DatabaseHelper::delete_all_external_videos_in_frame_grabbing_queue();

        $back_a = new HTMLTags_A('Back to the Queue');
        $back_href = $this->get_current_base_url();
        $back_a->set_href($back_href);
        $back_a_str = $back_a->get_as_string();

        echo <<<HTML
<h2>Remove all External Videos from the Frame Grabbing Queue</h2>
<p>
        All videos have been removed and the queue has been emptied.
</p>
<ul>
        <li>
        $back_a_str
        </li>
</ul>
HTML;

    }

    protected function
        get_data_table_actions()
    {
        $eval_template = $this->get_data_table_actions_content_eval_template();

        return array(
        array(
        'name' => 'delete',
        'filter' => sprintf($eval_template, 'delete_something')
        )
        );
    }


    protected function
        get_data_table_caption_content_explanation_part()
    {
        return 'External Videos Frame Grabbing Queue';
    }

    protected function
        get_confirm_deleting_everything_question_object()
    {
        return 'all of the External Videos from the Frame Grabbing Queue';
    }
}
?>
