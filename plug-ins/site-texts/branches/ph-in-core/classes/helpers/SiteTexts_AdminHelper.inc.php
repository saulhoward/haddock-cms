<?php
/**
 * SiteTexts_AdminHelper
 *
 * Functions to help build the Admin page for
 * editing and creating Site Texts
 * 
 * @copyright 2009-06-13, Saul Howard
 */

class
SiteTexts_AdminHelper
{
	public static function
		get_site_text_pages()
	{
		$path =	PROJECT_ROOT . DIRECTORY_SEPARATOR . 'site-texts' . DIRECTORY_SEPARATOR;
		$pages = self::list_directories_in_directory($path);
		return $pages;
	}

	public static function
		list_directories_in_directory($path)
	{
		/**
		 * Recursive, although we only expect two levels of directories
		 * (/page/section/en.txt)
		 */
		$dirs = array();
		$dir_handle = @opendir($path) or die("Unable to open $path");
		while ($file = readdir($dir_handle)) {

			if(
				$file == "." 
				|| $file == ".." 
				|| substr($file, 0, 1) == "." 
				|| substr($file, -1) == "~"
			)
				continue;
			if (is_dir($path . $file)) {
				$dirs[$file] = self::
					list_directories_in_directory(
						$path . $file . '/'
					);
			}
		}
		closedir($dir_handle);
		if (count($dirs) < 1) {
			$dirs = NULL;
		}
		return $dirs;
	}

	public static function
		get_manage_site_texts_html_table()
	{
		$html = <<<HTML
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

		return $html;
	}

	public static function
		get_edit_forms_for_section(
			$page,
			$section
		)
	{
		$html = '';
		$html .= <<<HTML
<h2>Edit text for the <em>$section</em> section on the <em>$page</em> page</h2>
HTML;

		$languages = self::get_languages_in_section($page, $section);
		foreach ($languages as $language) {
			$html .= self::get_edit_form_for_language($language);
		}
		return $html;
	}

	public static function
		get_edit_form_for_language($language)
	{
		$path = $language['path'];
		$name = $language['name'];
		$page = $language['page'];
		$section = $language['section'];
		$post_url = self::get_admin_page_edit_language_post_url()->get_as_string();
		$contents = '';
		$filter_function = '';
		$lines = file($path);

		foreach ($lines as $line_num => $line) {
			if ($line_num == 0) {
				$filter_function = $line;
				continue;
			}
			$contents .= $line;
		}

		$html = '';
		$html .= <<<HTML
<div class="language-form">
	<h3>Edit text in <em>$name</em></h3>
	<form method="post" action="$post_url">
<ol>
<li>
		<textarea name="contents">
$contents
		</textarea>
</li>
<li>
		<input type="hidden" name="filter_function" value="$filter_function" />
		<input type="hidden" name="page" value="$page" />
		<input type="hidden" name="section" value="$section" />
		<input type="hidden" name="language" value="$name" />
		<input type="hidden" name="path" value="$path" />
		<input class="submit" type="submit" value="Edit" /> 
</li>
</ol>
	</form>
</div>
HTML;

		return $html;
	}

	public static function
		get_languages_in_section($page, $section)
	{
		$path =	PROJECT_ROOT 
			. DIRECTORY_SEPARATOR 
			. 'site-texts' 
			. DIRECTORY_SEPARATOR
			. $page
			. DIRECTORY_SEPARATOR
			.$section
			. DIRECTORY_SEPARATOR;

		$languages = array();

		$dir_handle = @opendir($path) or die("Unable to open $path");

		while ($file = readdir($dir_handle)) {
			if(
				$file == "." 
				|| $file == ".." 
				|| substr($file, 0, 1) == "." 
				|| substr($file, -1) == "~"
			)
				continue;
			$languages[] = array(
				'name' => substr($file, 0, 2),
				'path' => $path . $file,
				'page' => $page,
				'section' => $section
			);
		}

		closedir($dir_handle);

		return $languages;
	}

	public static function
		get_admin_page_edit_section_url(
			$page_name,
			$section_name
		)
	{
                $get_variables = array(
                        "page" => $page_name,
                        "section" => $section_name
                );
                return PublicHTML_URLHelper
                        ::get_oo_page_url('SiteTexts_ManageSiteTextsAdminPage', $get_variables);
	}

	public static function
		get_admin_manage_site_texts_url()
	{
                return PublicHTML_URLHelper
                        ::get_oo_page_url('SiteTexts_ManageSiteTextsAdminPage');
	}

	public static function
		get_admin_page_edit_language_post_url()
	{
                return PublicHTML_URLHelper
                        ::get_oo_page_url('SiteTexts_EditSiteTextRedirectScript');
	}
}
?>
