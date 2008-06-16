<?php
/**
 * PublicHTML_ProjectSpecificHTMLPageClassesHelper
 *
 * @copyright 2008-06-13, Robert Impey
 */

class
	PublicHTML_ProjectSpecificHTMLPageClassesHelper
{
	public static function
		create_project_specific_html_page_class()
	{
		$project_specific_directory
			= HaddockProjectOrganisation_ProjectSpecificDirectoryHelper
				::get_project_specific_directory();
		
		$project_specific_directory->make_sure_classes_directory_exists();
		
		$classes_directory = $project_specific_directory->get_classes_directory();
		
		$html_pages_directory_name
			= $classes_directory->get_name()
				. DIRECTORY_SEPARATOR . 'pages'
				. DIRECTORY_SEPARATOR . 'html';
		
		#echo '$html_pages_directory_name: ' . $html_pages_directory_name . PHP_EOL;
		
		FileSystem_DirectoryHelper
			::mkdir_parents($html_pages_directory_name);
		
		$project_specific_html_page_class_name
			= $project_specific_directory->get_camel_case_root()
				. '_' . 'HTMLPage';
		
		#echo '$project_specific_html_page_class_name: ' . $project_specific_html_page_class_name . PHP_EOL;
		
		$project_specific_html_page_class_file_name
			= $html_pages_directory_name
				. DIRECTORY_SEPARATOR
				. $project_specific_html_page_class_name . '.inc.php';
		
		#echo '$project_specific_html_page_class_file_name: ' . $project_specific_html_page_class_file_name . PHP_EOL;
		
		if (is_file($project_specific_html_page_class_file_name)) {
			throw new ErrorHandling_SprintfException(
				'\'%s\' already exists!',
				array(
					$project_specific_html_page_class_file_name
				)
			);
		} else {
			$date = date('Y-m-d');
			$copyright_holder = $project_specific_directory->get_copyright_holder();
			
			$file_contents = <<<CNT
<?php
/**
 * $project_specific_html_page_class_name
 *
 * @copyright $date, $copyright_holder
 */

class
	$project_specific_html_page_class_name
extends
	PublicHTML_HTMLPage
{
}
?>
CNT;

			if ($fh = fopen($project_specific_html_page_class_file_name, 'w')) {
				fwrite($fh, $file_contents);
				
				fclose($fh);
				
				HaddockProjectOrganisation_AutoloadFilesHelper
					::refresh_autoload_file();
			}
		}
	}
}
?>