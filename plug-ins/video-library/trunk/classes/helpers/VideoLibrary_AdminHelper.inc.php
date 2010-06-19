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

	public static function
		get_manage_external_videos_html_table()
	{
        /*
         * This is currently just copied from SIte Texts!!!!
         */

		$html = '';
		try
		{
			$html .= <<<HTML
<table>
	<thead>
		<tr>
			<th>Page</th>
			<th>Section</th>
			<th>Edit</th>
		</tr>
	</thead>
	<tbody>
HTML;

			$pages = self::get_site_text_pages();

			foreach ($pages as $page_name => $sections) {

				foreach ($sections as $section_name => $should_be_null) {

					$edit_link = self::get_admin_page_edit_section_url(
						$page_name,
						$section_name
					)->get_as_string();

					if (
						(isset($_GET['page']))
						&&
						(isset($_GET['section']))
						&&
						($_GET['page'] == $page_name)
						&&
						($_GET['section'] == $section_name)
					) {
						$html .= <<<HTML
		<tr id="selected">
			<td>$page_name</td>
			<td>$section_name</td>
			<td>Editing...</td>
		</tr>
HTML;

					} else {
						$html .= <<<HTML
		<tr>
			<td>$page_name</td>
			<td>$section_name</td>
			<td><a href="$edit_link">Edit</a></td>
		</tr>
HTML;

					}
				}
			}

			$html .= <<<HTML
	</tbody>
</table>
HTML;

		}
		catch (Admin_FileException $e)
		{
			$html .= '<div id="warning" class="error">'
				. '<p><em>Please contact your Website Administrator</em></p><p>'
				. $e->getMessage()
				. '</p></div>';
		}

		return $html;
	}

	public static function
		get_add_external_video_form()
	{
        $html = '';

        $post_url = '/?oo-page=1&page-class=VideoLibrary_AddExternalVideoAdminRedirectScript';
        $html .= '<form class="basic-form" id="basic-form" method="post" action="' . $post_url . '">';
        $html .= '<fieldset> <legend>' . $title . '</legend>';
        $html .= "<ol>\n";
        $library_values = VideoLibrary_DatabaseHelper
            ::get_external_video_libraries(TRUE);
        //$library_li = '<li><label for="external_video_library_id">Library</label><select name="external_video_library_id">';
        //foreach ($library_values as $library_value) {
        //$library_li .= '<option value="' . $library_value['id'] . '">' . $library_value['name'] . '</option>';
        //}
        //$library_li .= '</select></li>';

        $library_li = '<li><label for="external_video_library_id">Library</label><div id="library-selector" class="radio-inputs">';
        $i = 0;
        foreach ($library_values as $library_value) {
            $library_li .= '<label><input type="radio" name="external_video_library_id" value="' . $library_value['id'] . '"';
            // if ($i == 0) $library_li .= ' checked="checked"';
            $i++; 
            $library_li .= '>';
            $library_li .= $library_value['name'] . '<br /></label>';
        }
        $library_li .= '</div></li>';


        $html .= $library_li;

        $provider_values = VideoLibrary_DatabaseHelper
            ::get_external_video_providers();
        //$provider_li = '<li><label for="external_video_provider_id">Provider</label><select name="external_video_provider_id">';
        //foreach ($provider_values as $provider_value) {
        //$provider_li .= '<option value="' . $provider_value['id'] . '">' . $provider_value['name'] . '</option>';
        //}
        //$provider_li .= '</select></li>';

        $provider_li = '<li><label for="external_video_provider_id">Provider</label><div id="external_video_provider_ids" class="radio-inputs">';
        $i = 0;
        foreach ($provider_values as $provider_value) {
            $provider_li .= '<label><input type="radio" name="external_video_provider_id" value="' . $provider_value['id'] . '"';
            // if ($i == 0) $provider_li .= ' checked="checked"';
            $i++; 
            $provider_li .= '>';
            $provider_li .= $provider_value['name'] . '<br /></label>';
        }
        $provider_li .= '</div></li>';


        $html .= $provider_li;

        $html .= self::get_form_li_text_input('name');
        $html .= self::get_form_li_text_input('providers_internal_id');
        $html .= self::get_form_li_text_input('length');

        $status_values = VideoLibrary_DatabaseHelper
            ::get_enum_values(
                'hpi_video_library_external_videos',
                'status'
            );
        // $status_li = '<li><label for="status">Status</label><select name="status">';
        $status_li = '<li><label for="status">Status</label><div class="radio-inputs">';
        foreach ($status_values as $status_value) {
            $status_li .= '<label><input type="radio" name="status" value="' . $status_value . '"';
            if ($status_value == 'hide') $status_li .= ' checked="checked"';
            $i++; 
            $status_li .= '>';
            $status_li .= $status_value . '<br /></label>';

            // $status_li .= '<option value="' . $status_value . '">' . $status_value . '</option>';
        }
        $status_li .= '</div></li>';
        // $status_li .= '</select></li>';
        $html .= $status_li;

        $html .= '<fieldset class="tags-fieldset" id="tags-fieldset"><legend>Tags</legend>';
        $html .= self::get_form_li_text_input('tags');
        // $html .= self::get_tags_list_for_form($library_values);
        $html .= '</fieldset>';

        $html .= "</ol>\n";

	$html .= <<<HTML
	<div class="submit_buttons_div">
		<input
			type="submit"
			value="Add this Video"
			class="submit"
		/>
		<input
			type="button"
			value="Cancel"
			class="submit"
		/>
	</div>
	</fieldset>
HTML;
        $html .= "</form>\n";
        $html .= self::get_form_help_message();

        return $html;

	}

    public function
        get_tags_list_for_form($library_values)
    {
        $div = '<div id="tags-list">';
        // $div .= '<h3>Principal Tags</h3>';
        // $div .= VideoLibrary_DisplayHelper::get_tags_empty_links_list(
        // VideoLibrary_DatabaseHelper::get_tags(TRUE)
        // )->get_as_string();

        foreach ($library_values as $library_value) {
            $principal_lib_tags = VideoLibrary_DatabaseHelper::
                get_tags_for_external_library_id($library_value['id'], TRUE);
            $lib_tags = VideoLibrary_DatabaseHelper::
                get_tags_for_external_library_id($library_value['id']);
            if (count($lib_tags) > 0) {
                $div .= '<div class="library ' . $library_value['id']  .'">';
                $div .= '<div class="principal-tags ' . $library_value['name']  .'">';
                $div .= '<h3>Principal ' . $library_value['name'] . ' Tags</h3>';
                $div .= VideoLibrary_DisplayHelper::
                    get_tags_empty_links_list($principal_lib_tags)->get_as_string();
                $div .= '</div>';

                $div .= '<h3>All ' . $library_value['name'] . ' Tags</h3>';
                $div .= VideoLibrary_DisplayHelper::
                    get_tags_empty_links_list($lib_tags)->get_as_string();
                $div .= '</div>';
            }
        }

        // $div .= '<h3>All Tags</h3>';
        // $div .= VideoLibrary_DisplayHelper::get_tags_empty_links_list(
            // VideoLibrary_DatabaseHelper::get_tags()
        // )->get_as_string();

        $div .= '</div>';
        return $div;
    }

    public function
        get_form_help_message()
    {
        return <<<HTML
<div>
<ul>
    <li>
        Providers Internal ID is the code to identify the video from the original site.
    </li>

    <li>
        Status will hide or show the video to users.
    </li>


    <li>
        Choose <em>all</em> tags that match the video. 
    </li>
    <li>
        Write any new tags in the 'Tags' box, and they will be added. Use commas to separate tags.
    </li>
    <li>
        Principal tags are used in the sidebar and on the categories page.
    </li>
</ul>
</div>
HTML;

    }


	protected function
		get_form_li_text_input(
			$name,
			$value = NULL,
			$title = NULL
		)
	{
		if (!isset($title)) {
			$title
				= Formatting_ListOfWordsHelper
					::capitalise_delimited_string($name, '_');
		}
$html = <<<HTML
<li>
	<label for="$name">$title</label>
	<input
		type="text"
		name="$name"
		id="$name"
HTML;

		if (isset($value)) {
			$html .=  "value=\"$value\"";
		}

$html .= <<<HTML

	/>
</li>
HTML;

return $html;
	}
	
}
?>
