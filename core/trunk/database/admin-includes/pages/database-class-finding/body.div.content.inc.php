<?php
/**
 * This script searches a project directory
 * for possible classes that are subclasses of
 * Database_Element.
 *
 * The class files that are found are presented
 * to the user, who can change the values or
 * accept them and then commit them to the
 * database-class-name.txt file in "project-specific".
 *
 * The file names are relative to PROJECT_ROOT.
 *
 * If there is already a database-class-name.txt file,
 * the values from that are also presented to the user.
 *
 * @copyright Clear Line Web Design, 2006-11-21
 */

require_once PROJECT_ROOT
    . '/haddock/formatting/classes/'
    . 'Formatting_FileName.inc.php';

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_Div.inc.php';

require_once PROJECT_ROOT
    . '/haddock/haddock-project-organisation/classes/finders/'
    . 'HaddockProjectOrganisation_ProjectDirectoryFinder.inc.php';

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_P.inc.php';

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_Form.inc.php';

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_FieldSet.inc.php';

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_Legend.inc.php';

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_Heading.inc.php';

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_OL.inc.php';

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_LI.inc.php';

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_Label.inc.php';

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_Select.inc.php';

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_Option.inc.php';

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_Input.inc.php';
    
require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_Pre.inc.php';

/*
 * -----------------------------------------------------------------------------
 */

$content_div = new HTMLTags_Div();
$content_div->set_attribute_str('id', 'content');

$project_directory_finder
    = HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();

$project_directory
    = $project_directory_finder->get_project_directory_for_this_project();

$project_specific_directory
    = $project_directory->get_project_specific_directory();

if ($project_specific_directory->has_database_class_name_file()) {
    $p = new HTMLTags_P('This project has a database class name file.');
    $content_div->append_tag_to_content($p);
    
    $database_class_name_file
        = $project_specific_directory->get_database_class_name_file();
} else {
    $p = new HTMLTags_P(
        'This project doesn\'t have a database class name file yet.'
    );
    
    $content_div->append_tag_to_content($p);
    
    $database_class_name_file = null;
}

/*
 * Find the database classes.
 */

$database_class_finder
    = $project_directory->get_database_class_finder();

$database_class_files
    = $database_class_finder->get_database_class_files();
$database_renderer_files
    = $database_class_finder->get_database_renderer_files();

$table_class_files
    = $database_class_finder->get_table_class_files();
$table_renderer_files
    = $database_class_finder->get_table_renderer_files();

$row_class_files
    = $database_class_finder->get_row_class_files();
$row_renderer_files
    = $database_class_finder->get_row_renderer_files();

$field_class_files
    = $database_class_finder->get_field_class_files();
$field_renderer_files
    = $database_class_finder->get_field_renderer_files();

/*
 * -----------------------------------------------------------------------------
 * Show the user their options.
 * -----------------------------------------------------------------------------
 */

/*
 * Create a nicely formatted file name for the project directory.
 */
$p_r_formatted = new Formatting_FileName(PROJECT_ROOT);
$p_r_formatted_pre
    = new HTMLTags_Pre($p_r_formatted->get_pretty_name());

if (
    (
        count($database_class_files)  +
        count($database_renderer_files)  +
        count($table_class_files)  +
        count($table_renderer_files)  +
        count($row_class_files)  +
        count($row_renderer_files)  +
        count($field_class_files)  +
        count($field_renderer_files)  
    )
    ==
    0
) {
    $p = new HTMLTags_P();
    
    $p->append_str_to_content('No classes found in:');    
    
    $p->append_tag_to_content($p_r_formatted_pre);
    
    $content_div->append_tag_to_content($p);
} else {   
    $database_classes_heading = new HTMLTags_Heading(
        3,
        'Database Classes found in '
    );
    
    $content_div->append_tag_to_content($database_classes_heading);
    
    $content_div->append_tag_to_content($p_r_formatted_pre);
    
    /*
     * -------------------------------------------------------------------------
     */
    
    $d_c_n_c_form = new HTMLTags_Form();
    
    $d_c_n_c_form->set_attribute_str(
        'name',
        'database_class_names_committing'
    );
    
    $d_c_n_c_form->set_attribute_str(
        'action',
        '/admin/redirect-script.php?module=database&page=database-class-finding'
    );
    
    $d_c_n_c_form->set_attribute_str('method', 'POST');
    
    $d_c_n_c_form->set_attribute_str('class', 'basic-form');
    
    /*
     * -------------------------------------------------------------------------
     */
    
    $d_c_n_c_field_set = new HTMLTags_FieldSet();
    
    $field_set_legend
        = new HTMLTags_Legend('Database class names committing');
    
    $d_c_n_c_field_set->append_tag_to_content($field_set_legend);
    
    /*
     * -------------------------------------------------------------------------
     */
    
    /*
     * The database class files.
     */
    if (count($database_class_files) > 0) {
        /*
         * ---------------------------------------------------------------------
         */
        
        $database_classes_heading = new HTMLTags_Heading(
            3,
            'Database Classes'
        );
        
        $d_c_n_c_field_set->append_tag_to_content(
            $database_classes_heading
        );
        
        $database_classes_list = new HTMLTags_OL();
        
        $database_class_li = new HTMLTags_LI();
        
        /*
         * ---------------------------------------------------------------------
         */
        
        /*
         * The Label.
         */
        $database_class_select_label
            = new HTMLTags_Label('Database Class');
        $database_class_select_label->set_attribute_str(
            'for',
            'database_class'
        );
        
        $database_class_li->append_tag_to_content(
            $database_class_select_label
        );
        
        /*
         * ---------------------------------------------------------------------
         */
        
        /*
         * For checking whether the name of one of the files
         * that were found is equal to that of the file
         * that is currently set in the database class name file.
         */
        $current_database_class_file = null;
        if (isset($database_class_name_file)) {
            if ($database_class_name_file->has_database_class_file()) {
                $current_database_class_file
                    = $database_class_name_file->get_database_class_file();
            }
        }
        
        /*
         * ---------------------------------------------------------------------
         */
        
        /*
         * The Select Box
         */
        $database_class_select = new HTMLTags_Select();
        $database_class_select->set_attribute_str('id', 'database_class');
        $database_class_select->set_attribute_str('name', 'database_class');
        
        /*
         * Add the options.
         */
        foreach ($database_class_files as $database_class_file) {
            $database_class_relative_filename
                = $database_class_file->get_name_relative_to_dir(
                    PROJECT_ROOT
                );
            
            $option = new HTMLTags_Option(
                $database_class_file->get_php_class_name()
            );
            
            $option->set_attribute_str(
                'value',
                $database_class_relative_filename
            );
            
            if ($database_class_file->equals($current_database_class_file)) {
                $option->set_attribute_str('selected');
            }
            
            $database_class_select->add_option($option);
        }
        
        /*
         * ---------------------------------------------------------------------
         */
        
        $database_class_li->append_tag_to_content($database_class_select);
        
        $database_classes_list->add_li($database_class_li);
        
        $d_c_n_c_field_set->append_tag_to_content($database_classes_list);
        
        /*
         * ---------------------------------------------------------------------
         */
    }
    
    /*
     * -------------------------------------------------------------------------
     */
    
    /*
     * The database renderers.
     */
    if (count($database_renderer_files) > 0) {
        $database_renderers_heading = new HTMLTags_Heading(
            3,
            'Database Renderers'
        );
        
        $d_c_n_c_field_set->append_tag_to_content(
            $database_renderers_heading
        );
        
        $database_renderers_list = new HTMLTags_OL();
        
        $database_renderer_li = new HTMLTags_LI();
        
        $database_renderer_select_label
            = new HTMLTags_Label('Database Renderer');
        
        $database_renderer_select_label->set_attribute_str(
            'for',
            'database_renderer'
        );
        
        $database_renderer_li->append_tag_to_content(
            $database_renderer_select_label
        );
        
        $database_renderer_select = new HTMLTags_Select();
        
        $database_renderer_select->set_attribute_str(
            'id',
            'database_renderer'
        );
        
        $database_renderer_select->set_attribute_str(
            'name',
            'database_renderer'
        );
        
        $current_database_renderer_class_file = null;
        if (isset($database_class_name_file)) {
            if (
                $database_class_name_file
                ->has_database_renderer_class_file()
            ) {
                $current_database_renderer_class_file
                    = $database_class_name_file
                        ->get_database_renderer_class_file();
            }
        }
        
        foreach ($database_renderer_files as $database_renderer_file) {
            $database_renderer_relative_filename
                = $database_renderer_file
                    ->get_name_relative_to_dir(PROJECT_ROOT);
            
            $option
                = new HTMLTags_Option(
                    $database_renderer_file->get_php_class_name()
                );
            
            $option->set_attribute_str(
                'value',
                $database_renderer_relative_filename
            );
            
            if (
                $database_renderer_file
                ->equals($current_database_renderer_class_file)
            ) {
                $option->set_attribute_str('selected');
            }
            
            $database_renderer_select->add_option($option);
        }
        
        $database_renderer_li->append_tag_to_content(
            $database_renderer_select
        );
        
        $database_renderers_list->add_li($database_renderer_li);
        
        $d_c_n_c_field_set->append_tag_to_content(
            $database_renderers_list
        );
    }
    
    /*
     * -------------------------------------------------------------------------
     */
    
    /*
     * The table classes.
     */
    if (count($table_class_files) > 0) {
        $table_classes_heading = new HTMLTags_Heading(3, 'Table Classes');
        $d_c_n_c_field_set->append_tag_to_content($table_classes_heading);
        
        $table_classes_list = new HTMLTags_OL();
        
        # The table classes.
        $table_names = array_keys($table_class_files);
        
        foreach ($table_names as $table_name) {
            $table_class_li = new HTMLTags_LI();
            
            $input_name = 'table-' . $table_name . '-class';
            
            $table_class_select_label
                #= new HTMLTags_Label("Class for the $table_name table");
                = new HTMLTags_Label($table_name);
            $table_class_select_label->set_attribute_str('for', $input_name);
            
            $table_class_li->append_tag_to_content($table_class_select_label);
            
            $table_class_select = new HTMLTags_Select();
            $table_class_select->set_attribute_str('id', $input_name);
            $table_class_select->set_attribute_str('name', $input_name);
    
            $current_table_class_file = null;
            if (isset($database_class_name_file)) {
                if (
                    $database_class_name_file
                    ->has_table_class_file($table_name)
                ) {
                    $current_table_class_file
                        = $database_class_name_file
                            ->get_table_class_file($table_name);
                }
            }
            
            foreach ($table_class_files[$table_name] as $table_class_file) {
                $table_class_relative_filename
                    = $table_class_file->get_name_relative_to_dir(PROJECT_ROOT);
                
                $option
                    #= new HTMLTags_Option($table_class_relative_filename);
                    = new HTMLTags_Option(
                        $table_class_file->get_php_class_name()
                    );
                
                $option->set_attribute_str(
                    'value',
                    $table_class_relative_filename
                );
                
                if ($table_class_file->equals($current_table_class_file)) {
                    $option->set_attribute_str('selected');
                }
                
                $table_class_select->add_option($option);
            }
            
            $table_class_li->append_tag_to_content($table_class_select);
            
            $table_classes_list->add_li($table_class_li);
        }
        
        $d_c_n_c_field_set->append_tag_to_content($table_classes_list);
    }
    
    /*
     * -------------------------------------------------------------------------
     */
    
    /*
     * The table renderers.
     */
    if (count($table_renderer_files) > 0) {
        $table_renderers_heading = new HTMLTags_Heading(3, 'Table Renderers');
        $d_c_n_c_field_set->append_tag_to_content($table_renderers_heading);
        
        $table_renderers_list = new HTMLTags_OL();
        
        $table_names = array_keys($table_renderer_files);
    
        foreach ($table_names as $table_name) {
            $table_renderer_li = new HTMLTags_LI();
            
            $input_name = 'table-' . $table_name . '-renderer';
            
            $table_renderer_select_label
                #= new HTMLTags_Label("Renderer for the $table_name table");
                = new HTMLTags_Label($table_name);
            $table_renderer_select_label->set_attribute_str(
                'for',
                $input_name
            );
            
            $table_renderer_li->append_tag_to_content(
                $table_renderer_select_label
            );
            
            $table_renderer_select = new HTMLTags_Select();
            $table_renderer_select->set_attribute_str('id', $input_name);
            $table_renderer_select->set_attribute_str('name', $input_name);
            
            $current_table_renderer_class_file = null;
            if (isset($database_class_name_file)) {
                if (
                    $database_class_name_file
                    ->has_table_renderer_class_file($table_name)
                ) {
                    $current_table_renderer_class_file
                        = $database_class_name_file
                            ->get_table_renderer_class_file($table_name);
                }
            }
            
            foreach (
                $table_renderer_files[$table_name]
                as
                $table_renderer_class_file
            ) {
                $table_renderer_relative_filename
                    = $table_renderer_class_file
                        ->get_name_relative_to_dir(PROJECT_ROOT);
                
                $option
                    #= new HTMLTags_Option($table_renderer_relative_filename);
                    = new HTMLTags_Option(
                        $table_renderer_class_file->get_php_class_name()
                    );
                
                $option->set_attribute_str(
                    'value',
                    $table_renderer_relative_filename
                );
                
                if (
                    $table_renderer_class_file
                    ->equals($current_table_renderer_class_file)
                ) {
                    $option->set_attribute_str('selected');
                }
                
                $table_renderer_select->add_option($option);
            }
            
            $table_renderer_li->append_tag_to_content($table_renderer_select);
            
            $table_renderers_list->add_li($table_renderer_li);
        }
        
        $d_c_n_c_field_set->append_tag_to_content($table_renderers_list);
    } 
    
    /*
     * -------------------------------------------------------------------------
     */
    
    /*
     * The row classes.
     */
    if (count($row_class_files) > 0) {
        $row_classes_heading = new HTMLTags_Heading(3, 'Row Classes');
        $d_c_n_c_field_set->append_tag_to_content($row_classes_heading);
        
        $row_classes_list = new HTMLTags_OL();
        
        # The row classes.
        $table_names = array_keys($row_class_files);
        
        foreach ($table_names as $table_name) {
            $row_class_li = new HTMLTags_LI();
            
            $input_name = 'row-' . $table_name . '-class';
            
            $row_class_select_label
                = new HTMLTags_Label($table_name);
            
            $row_class_select_label->set_attribute_str('for', $input_name);
            
            $row_class_li->append_tag_to_content($row_class_select_label);
            
            $row_class_select = new HTMLTags_Select();
            $row_class_select->set_attribute_str('id', $input_name);
            $row_class_select->set_attribute_str('name', $input_name);
            
            $current_row_class_file = null;
            if (isset($database_class_name_file)) {
                if (
                    $database_class_name_file->has_row_class_file($table_name)
                ) {
                    $current_row_class_file
                        = $database_class_name_file->get_row_class_file(
                            $table_name
                        );
                }
            }
            
            foreach ($row_class_files[$table_name] as $row_class_file) {
                $row_class_relative_filename
                    = $row_class_file->get_name_relative_to_dir(PROJECT_ROOT);
                $option
                    #= new HTMLTags_Option($row_class_relative_filename);
                    = new HTMLTags_Option($row_class_file->get_php_class_name());
                    
                $option->set_attribute_str(
                    'value',
                    $row_class_relative_filename
                );
                
                if ($row_class_file->equals($current_row_class_file)) {
                    $option->set_attribute_str('selected');
                }
                
                $row_class_select->add_option($option);
            }
            
            $row_class_li->append_tag_to_content($row_class_select);
            
            $row_classes_list->add_li($row_class_li);
        }
        
        $d_c_n_c_field_set->append_tag_to_content($row_classes_list);
    }
    
    /*
     * -------------------------------------------------------------------------
     */
    
    /*
     * The row renderers.
     */
    if (count($row_renderer_files) > 0) {
        $row_renderers_heading = new HTMLTags_Heading(3, 'Row Renderers');
        $d_c_n_c_field_set->append_tag_to_content($row_renderers_heading);
        
        $table_names = array_keys($row_renderer_files);
        
        $row_renderers_list = new HTMLTags_OL();
        
        foreach ($table_names as $table_name) {
            $row_renderer_li = new HTMLTags_LI();
            
            $input_name = 'row-' . $table_name . '-renderer';
            
            $row_renderer_select_label
                = new HTMLTags_Label($table_name);
            
            $row_renderer_select_label->set_attribute_str('for', $input_name);
            
            $row_renderer_li->append_tag_to_content($row_renderer_select_label);
            
            $row_renderer_select = new HTMLTags_Select();
            $row_renderer_select->set_attribute_str('id', $input_name);
            $row_renderer_select->set_attribute_str('name', $input_name);
            
            $current_row_renderer_class_file = null;
            if (isset($database_class_name_file)) {
                if ($database_class_name_file->has_row_renderer_class_file($table_name)) {
                    $current_row_renderer_class_file = $database_class_name_file->get_row_renderer_class_file($table_name);
                }
            }
            
            foreach ($row_renderer_files[$table_name] as $row_renderer_class_file) {
                $row_renderer_class_relative_filename = $row_renderer_class_file->get_name_relative_to_dir(PROJECT_ROOT);
                
                $option
                    = new HTMLTags_Option(
                        $row_renderer_class_file->get_php_class_name()
                    );
                
                $option->set_attribute_str('value', $row_renderer_class_relative_filename);
                
                if ($row_renderer_class_file->equals($current_row_renderer_class_file)) {
                    $option->set_attribute_str('selected');
                }
                
                $row_renderer_select->add_option($option);
            }
            
            $row_renderer_li->append_tag_to_content($row_renderer_select);
            
            $row_renderers_list->add_li($row_renderer_li);
        }
        
        $d_c_n_c_field_set->append_tag_to_content($row_renderers_list);
    }
    
    /*
     * -------------------------------------------------------------------------
     */
    
    /*
     * The field classes.
     */
    if (count($field_class_files) > 0) {
        $field_classes_heading = new HTMLTags_Heading(3, 'Field Classes');
        $d_c_n_c_field_set->append_tag_to_content($field_classes_heading);
        
        $field_classes_list = new HTMLTags_OL();
        
        # The field classes.
        $table_names = array_keys($field_class_files);
        
        foreach ($table_names as $table_name) {
            $table_li = new HTMLTags_LI();
            
            $table_name_heading = new HTMLTags_Heading(4, $table_name);
            $table_li->append_tag_to_content($table_name_heading);
            
            $table_fields_list = new HTMLTags_OL();
            
            $field_names = array_keys($field_class_files[$table_name]);
            
            foreach ($field_names as $field_name) {
                $field_class_li = new HTMLTags_LI();
                
                $input_name =
                    'field-'
                    . $table_name
                    . '-'
                    . $field_name
                    . '-class';
                
                $field_class_select_label
                    = new HTMLTags_Label($field_name);
                
                $field_class_select_label->set_attribute_str('for', $input_name);
            
                $field_class_li->append_tag_to_content($field_class_select_label);
                
                $field_class_select = new HTMLTags_Select();
                $field_class_select->set_attribute_str('id', $input_name);
                $field_class_select->set_attribute_str('name', $input_name);
                
                $current_field_class_file = null;
                if (isset($database_class_name_file)) {
                    if (
                        $database_class_name_file
                        ->has_field_class_file($table_name, $field_name)
                    ) {
                        $current_field_class_file = $database_class_name_file->get_field_class_file($table_name, $field_name);
                    }
                }
                
                foreach ($field_class_files[$table_name][$field_name] as $field_class_file) {
                    $field_class_relative_filename = $field_class_file->get_name_relative_to_dir(PROJECT_ROOT);
                    
                    $option
                        #= new HTMLTags_Option($field_class_relative_filename);
                        = new HTMLTags_Option(
                            $field_class_file->get_php_class_name()
                        );
                    
                    $option->set_attribute_str('value', $field_class_relative_filename);
                    
                    if ($field_class_file->equals($current_field_class_file)) {
                        $option->set_attribute_str('selected');
                    }
                    
                    $field_class_select->add_option($option);
                }
                
                $field_class_li->append_tag_to_content($field_class_select);
                
                $table_fields_list->add_li($field_class_li);
            }
            
            $table_li->append_tag_to_content($table_fields_list);
            
            $field_classes_list->append_tag_to_content($table_li);
        }
        
        $d_c_n_c_field_set->append_tag_to_content($field_classes_list);
    }
    
    /*
     * The field renderers.
     */ 
    if (count($field_renderer_files) > 0) {
        $field_renderers_heading = new HTMLTags_Heading(3, 'Field Renderers');
        $d_c_n_c_field_set->append_tag_to_content($field_renderers_heading);
        
        $table_names = array_keys($field_renderer_files);
        
        $field_renderers_list = new HTMLTags_OL();
        
        foreach ($table_names as $table_name) {
            $table_li = new HTMLTags_LI();
            
            $table_name_heading = new HTMLTags_Heading(4, $table_name);
            $table_li->append_tag_to_content($table_name_heading);
            
            $table_fields_list = new HTMLTags_OL();
            
            $field_names = array_keys($field_renderer_files[$table_name]);
            
            foreach ($field_names as $field_name) {
                $field_renderer_li = new HTMLTags_LI();
                
                $input_name = 'field-'
                    . $table_name
                    . '-'
                    . $field_name
                    . '-renderer';
                
                $field_renderer_select_label
                    = new HTMLTags_Label($field_name);
                $field_renderer_select_label->set_attribute_str('for', $input_name);
            
                $field_renderer_li->append_tag_to_content($field_renderer_select_label);
                
                $field_renderer_select = new HTMLTags_Select();
                $field_renderer_select->set_attribute_str('id', $input_name);
                $field_renderer_select->set_attribute_str('name', $input_name);
                
                $current_field_renderer_class_file = null;
                if (isset($database_class_name_file)) {
                    if ($database_class_name_file->has_field_renderer_class_file($table_name, $field_name)) {
                        $current_field_renderer_class_file = $database_class_name_file->get_field_renderer_class_file($table_name, $field_name);
                    }
                }
                
                foreach ($field_renderer_files[$table_name][$field_name] as $field_renderer_class_file) {
                    $field_renderer_class_relative_filename = $field_renderer_class_file->get_name_relative_to_dir(PROJECT_ROOT);
                    
                    $option
                        = new HTMLTags_Option(
                            $field_renderer_class_file->get_php_class_name()
                        );
                    
                    $option->set_attribute_str('value', $field_renderer_class_relative_filename);
                    
                    if ($field_renderer_class_file->equals($current_field_renderer_class_file)) {
                        $option->set_attribute_str('selected');
                    }
                    
                    $field_renderer_select->add_option($option);
                }
                
                $field_renderer_li->append_tag_to_content($field_renderer_select);
                
                $table_fields_list->add_li($field_renderer_li);
            }
            
            $table_li->append_tag_to_content($table_fields_list);
            
            $field_renderers_list->append_tag_to_content($table_li);
        }
        
        $d_c_n_c_field_set->append_tag_to_content($field_renderers_list);
    }
    
    /*
     * -------------------------------------------------------------------------
     */
    
    $d_c_n_c_form->append_tag_to_content($d_c_n_c_field_set);
    
    $commit_button = new HTMLTags_Input();
    $commit_button->set_attribute_str('type', 'submit');
    $commit_button->set_attribute_str('value', 'Commit');
    $commit_button->set_attribute_str('class', 'submit');
    $d_c_n_c_form->append_tag_to_content($commit_button);
    
    $cancel_button = new HTMLTags_Input();
    $cancel_button->set_attribute_str('type', 'button');
    $cancel_button->set_attribute_str(
        'onclick',
        "document.location.href=('/admin/database/home.html')"
    );
    
    $cancel_button->set_attribute_str('value', 'Cancel');
    $cancel_button->set_attribute_str('class', 'submit');
    $d_c_n_c_form->append_tag_to_content($cancel_button);

    $content_div->append_tag_to_content($d_c_n_c_form);
}

echo $content_div;
?>
