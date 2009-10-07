<?php
/**
 * VideoLibrary_ManageTagsAdminPage
 *
 * @copyright RFI 2008-01-08
 */

class
	VideoLibrary_ManageTagsAdminPage
extends
	Database_CRUDAdminPage
{
	protected function
		get_admin_crud_manager_class_name()
	{
		return 'VideoLibrary_TagsCRUDManager';
	}
	
	protected function
		get_data_table_fields()
	{
		return array(
			array(
				'col_name' => 'tag'
			),
			array(
				'col_name' => 'principal'
			),
			array(
				'col_name' => 'id',
				'filter' => 'return VideoLibrary_DatabaseHelper::get_external_videos_count_for_tag_id($str);',
				'title' => 'No. of External Videos'
			)
	 	);
	}
	
	protected function
		get_matching_query_from_clause()
	{
		return <<<SQL
FROM
	hpi_video_library_tags
	
SQL;

	}
	
	protected function
		render_add_something_form_ol()
	{
		$acm = $this->get_admin_crud_manager();
		
		echo "<ol>\n";
		
		$this->render_add_something_form_li_text_input('tag');

		$principal_values = VideoLibrary_DatabaseHelper
			::get_enum_values(
				'hpi_video_library_tags',
				'principal'
			);
		$principal_li = '<li><label for="principal">Principal</label><select name="principal">';
		foreach ($principal_values as $principal_value) {
			$principal_li .= '<option value="' . $principal_value . '">' . $principal_value . '</option>';
		}
		$principal_li .= '</select></li>';

		echo $principal_li;
		
		echo "</ol>\n";
	}
	
	protected function
		render_edit_something_form_ol()
	{
		$acm = $this->get_admin_crud_manager();
		
		echo "<ol>\n";
		
		$this->render_edit_something_form_li_text_input('tag');
	
		$principal_values = VideoLibrary_DatabaseHelper
			::get_enum_values(
				'hpi_video_library_tags',
				'principal'
			);
		$principal_li = '<li><label for="principal">Principal</label><select name="principal">';
		foreach ($principal_values as $principal_value) {
			$principal_li .= '<option value="' . $principal_value . '"';
			$cur_principal_value = ($acm->has_current_var('principal') ? $acm->get_current_var('principal') : NULL);
			if ($cur_principal_value == $principal_value) {
				$principal_li .= ' selected="selected"';
			}
			$principal_li .= '>' . $principal_value . '</option>';
		}
		$principal_li .= '</select></li>';

		echo $principal_li;

		echo "</ol>\n";
	}
	
	protected function
		get_add_something_title()
	{
		return 'Add a Tag';
	}
	
	protected function
		get_body_div_header_heading_content()
	{
		return 'Tags';
	}

	protected function
		get_other_page_link_as()
	{
		$as = array();
			
		/**
		 * Link to the delete all confirmation page.
		 */
		$add_something_a = new HTMLTags_A($this->get_add_something_title());
		
		$add_something_href = $this->get_current_base_url();
		$add_something_href->set_get_variable('content', 'add_something');
		
		$add_something_a->set_href($add_something_href);
		
		$as[] = $add_something_a;
		

		/**
		 * Link to the delete all confirmation page.
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
		return 'Delete All Tags';
	}

	protected function
		get_content_render_method_map()
	{
		$crmm = parent::get_content_render_method_map();
		$crmm['view_tag'] = 'render_content_to_view_a_tag';
		
		return $crmm;
	}

	protected function
		get_data_table_actions()
	{
		$eval_template = $this->get_data_table_actions_content_eval_template();
		
		return array(
			array(
				'name' => 'view',
				'filter' => sprintf($eval_template, 'view_tag')
			),
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

	public function
		render_content_to_view_a_tag()
	{
		echo $this->get_back_link_p();
		if (isset($_GET['id'])) {
			$tag_array = array();
			$tag_array[] = $_GET['id'];
			echo VideoLibrary_DisplayHelper::get_admin_view_tag_div(
				VideoLibrary_DatabaseHelper
				::get_all_external_videos_for_tag_ids_on_admin_page($tag_array)
			)->get_as_string();
		} else {
			echo '<p>Form ID not set!</p>';
		}
		echo $this->get_back_link_p();
	}

	protected function
		get_data_table_caption_content_explanation_part()
	{
		return 'Tags';
	}

	protected function
		get_confirm_deleting_everything_question_object()
	{
		return 'all of the Tags';
	}
}
?>
