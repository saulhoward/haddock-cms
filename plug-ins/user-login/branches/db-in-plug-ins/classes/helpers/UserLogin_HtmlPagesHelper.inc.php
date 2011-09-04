<?php
/**
 * UserLogin_HtmlPagesHelper
 *
 * @copyright 2011-07-30, Robert Impey
 */

class
	UserLogin_HtmlPagesHelper
{
    public static function
        create_html_pages()
    {
        /* 
         * Find the project specific directory for the classes.
         */
                $project_specific_directory
			= HaddockProjectOrganisation_ProjectSpecificDirectoryHelper
				::get_project_specific_directory();
		
		$project_specific_directory->make_sure_classes_directory_exists();
		
		$classes_directory = $project_specific_directory->get_classes_directory();
		
		$html_pages_directory_name
			= $classes_directory->get_name()
				. DIRECTORY_SEPARATOR . 'pages'
				. DIRECTORY_SEPARATOR . 'html';
		
		FileSystem_DirectoryHelper
			::mkdir_parents($html_pages_directory_name);
		
                $project_specific_html_page_class_name
                    = $project_specific_directory->get_camel_case_root()
                        . '_' . 'HTMLPage';
                
                /* 
                 * Create the abstract class for the user login pages.
                 */
                
		$project_specific_user_login_html_page_class_name
			= $project_specific_directory->get_camel_case_root()
				. '_' . 'UserLoginHtmlPage';
		
		$project_specific_user_login_html_page_class_file_name
			= $html_pages_directory_name
				. DIRECTORY_SEPARATOR
				. $project_specific_user_login_html_page_class_name . '.inc.php';
		
		if (is_file($project_specific_user_login_html_page_class_file_name)) {
			echo "'$project_specific_user_login_html_page_class_file_name' already exists!" . PHP_EOL;
		} else {
			$date = date('Y-m-d');
			$copyright_holder = $project_specific_directory->get_copyright_holder();
			
			$file_contents = <<<CNT
<?php
/**
 * $project_specific_user_login_html_page_class_name
 *
 * @copyright $date, $copyright_holder
 */

abstract class
	$project_specific_user_login_html_page_class_name
extends
	$project_specific_html_page_class_name
{
    public function
        get_error_message_div()
    {
        return UserLogin_DisplayHelper::get_error_message_div();
    }

    public function
        get_login_status_div()
    {
        return UserLogin_DisplayHelper::get_login_status_div();
    }
}
?>
CNT;

			if ($fh = fopen($project_specific_user_login_html_page_class_file_name, 'w')) {
				fwrite($fh, $file_contents);
				
				fclose($fh);
				
				HaddockProjectOrganisation_AutoloadFilesHelper
					::refresh_autoload_file();
			}
		}
                
                /* 
                 * Create the registration page.
                 */
                
		$project_specific_registration_html_page_class_name
			= $project_specific_directory->get_camel_case_root()
				. '_' . 'UserLoginRegistrationHtmlPage';
		
		$project_specific_registration_html_page_class_file_name
			= $html_pages_directory_name
				. DIRECTORY_SEPARATOR
				. $project_specific_registration_html_page_class_name . '.inc.php';
		
		if (is_file($project_specific_registration_html_page_class_file_name)) {
			echo "'$project_specific_registration_html_page_class_file_name' already exists!" . PHP_EOL;
		} else {
			$date = date('Y-m-d');
			$copyright_holder = $project_specific_directory->get_copyright_holder();
			
			$file_contents = <<<CNT
<?php
/**
 * $project_specific_registration_html_page_class_name
 *
 * @copyright $date, $copyright_holder
 */

class
	$project_specific_registration_html_page_class_name
extends
	$project_specific_user_login_html_page_class_name
{
    public function
        content()
    {
        \$div = new HTMLTags_Div();
        \$div->append(\$this->get_error_message_div());
        \$div->append(\$this->get_registration_div());
        echo \$div->get_as_string();
    }

    public function
        get_registration_div()
    {
        return UserLogin_DisplayHelper::get_registration_div();
    }
}
?>
CNT;

			if ($fh = fopen($project_specific_registration_html_page_class_file_name, 'w')) {
				fwrite($fh, $file_contents);
				
				fclose($fh);
				
				HaddockProjectOrganisation_AutoloadFilesHelper
					::refresh_autoload_file();
			}
		}
    }
        
}
?>