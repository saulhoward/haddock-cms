<?php
/**
 * FeedAggegator_ManageRetrievalQueueAdminPage
 *
 * @copyright RFI 2008-01-08
 */

class
FeedAggegator_ManageRetrievalQueueAdminPage
extends
Database_CRUDAdminPage
{
    protected function
        render_head_link_stylesheet()
    {
        parent::render_head_link_stylesheet();
        HTMLTags_LinkRenderer::render_style_sheet_link('/plug-ins/video-library/public-html/styles/admin-styles.css');
    }

    protected function
        get_admin_crud_manager_class_name()
    {
        return 'FeedAggegator_RetrievalQueueCRUDManager';
    }

    protected function
        get_data_table_fields()
    {
        return array(
            array(
                'col_name' => 'feed_id',
                'filter'   => 'return FeedAggegator_DatabaseHelper::get_feed_name_for_feed_id($str);'
            ),
            array(
                'col_name' => 'last_retrieved'
            ),
            array(
                'col_name' => 'status'
            ),
            array(
                'col_name' => 'frequency_days'
            ) 
        );
    }

    protected function
        get_matching_query_from_clause()
    {
        return <<<SQL
FROM
    hpi_feed_aggregator_retrieval_queue

SQL;

    }

    public function
        get_form_help_message()
    {
        return <<<HTML
<div>
<ul>
    <li>
        Message here!
    </li>
</ul>
</div>
HTML;

    }

    protected function
        render_edit_something_form_ol()
    {
        $acm = $this->get_admin_crud_manager();

        echo "<ol>\n";
        $this->render_edit_something_form_li_text_input('frequency_days');
        /*
         * Status
         */
        echo "</ol>\n";

        // echo $this->get_form_help_message();
    }

    protected function
        get_body_div_header_heading_content()
    {
        return 'FeedRetrievalQueue';
    }

    protected function
        get_other_page_link_as()
    {
        $as = array();
        /**
         * Link to the reset all confirmation page.
         */
        $delete_all_a = new HTMLTags_A($this->get_delete_everything_link_text());

        $delete_all_href = $this->get_current_base_url();
        $delete_all_href->set_get_variable('content', 'delete_everything');

        $delete_all_a->set_href($delete_all_href);

        $as[] = $delete_all_a;

        return $as;
    }

    protected function
        get_delete_everything_title()
    {
        return 'Delete all FeedRetrievalQueue';
    }

    protected function
        get_content_render_method_map()
    {
        $crmm = parent::get_content_render_method_map();
        // $crmm['view_video'] = 'render_content_to_view_a_video';

        return $crmm;
    }

    protected function
        get_data_table_actions()
    {
        $eval_template = $this->get_data_table_actions_content_eval_template();

        return array(
            array(
                'name' => 'edit',
                'filter' => sprintf($eval_template, 'edit_something')
            ),
            array(
                'name' => 'delete',
                'filter' => sprintf($eval_template, 'delete_something')
            )
        );
    }

    protected function
        get_data_table_caption_content_explanation_part()
    {
        return 'Feed';
    }

    protected function
        get_confirm_deleting_everything_question_object()
    {
        return 'all of the FeedRetrievalQueue';
    }

    protected function
        get_default_order_by()
    {
        return "title";
    }

    protected function
        get_default_direction()
    {
        return 'DESC';
    }
}
?>
