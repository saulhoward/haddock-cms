<?php
/**
 * The content of the run-all-tests page
 * in the admin section
 * of the unit-tests module.
 *
 * @copyright Clear Line Web Design, 2007-03-21
 */

#require_once PROJECT_ROOT
#	. '/haddock/html-tags/classes/standard/'
#	. 'HTMLTags_Div.inc.php';
#
#require_once PROJECT_ROOT
#	. '/haddock/html-tags/classes/standard/'
#	. 'HTMLTags_Table.inc.php';
#
#require_once PROJECT_ROOT
#	. '/haddock/html-tags/classes/standard/'
#	. 'HTMLTags_TR.inc.php';
#	
#require_once PROJECT_ROOT
#	. '/haddock/html-tags/classes/standard/'
#	. 'HTMLTags_TH.inc.php';
#	
#require_once PROJECT_ROOT
#	. '/haddock/html-tags/classes/standard/'
#	. 'HTMLTags_TD.inc.php';
#	
#require_once PROJECT_ROOT
#	. '/haddock/haddock-project-organisation/classes/'
#	. 'HaddockProjectOrganisation_ProjectDirectoryFinder.inc.php';
	
/*
 * -----------------------------------------------------------------------------
 */

$content_div = new HTMLTags_Div();
$content_div->set_attribute_str('id', 'content');

/*
 * Find all the tests.
 */
$project_directory_finder
	= HaddockProjectOrganisation_ProjectDirectoryFinder::get_instance();

$project_directory
	= $project_directory_finder->get_project_directory_for_this_project();

$unit_tests_php_class_files
	= $project_directory->get_all_unit_tests_php_class_files();

$unit_tests_html_table = new HTMLTags_Table();

$heading_tr = new HTMLTags_TR();

$heading_tr->append_tag_to_content(new HTMLTags_TH('Name'));
$heading_tr->append_tag_to_content(new HTMLTags_TH('Passes'));
$heading_tr->append_tag_to_content(new HTMLTags_TH('Tests'));
$heading_tr->append_tag_to_content(new HTMLTags_TH('Result'));
$heading_tr->append_tag_to_content(new HTMLTags_TH('Time (s)'));

$unit_tests_html_table->append_tag_to_content($heading_tr);

$total_passes = 0;
$total_tests = 0;
$everything_passes = TRUE;
$total_time_all_tests = 0;

foreach ($unit_tests_php_class_files as $u_t_p_c_f) {
	$u_t_tr = new HTMLTags_TR();
	
	$u_t_tr->append_tag_to_content(new HTMLTags_TD($u_t_p_c_f->get_php_class_name()));
	
	$count_passed_tests = $u_t_p_c_f->count_passed_tests();
	$total_passes += $count_passed_tests;
	
	$u_t_tr->append_tag_to_content(
		new HTMLTags_TD($count_passed_tests)
	);
	
	$count_test_functions
		= $u_t_p_c_f->count_test_functions();
	$total_tests += $count_test_functions;
	
	$u_t_tr->append_tag_to_content(
		new HTMLTags_TD($count_test_functions)
	);
	
	$passes_all_tests = $u_t_p_c_f->passes_all_tests();
	
	if ($everything_passes && !$passes_all_tests) {
		$everything_passes = FALSE;
	}
	
	$result_td = new HTMLTags_TD($passes_all_tests ? 'Pass' : 'Fail');
	
	$result_td->set_attribute_str(
		'class',
		($passes_all_tests ? 'pass' : 'fail')
	);
	
	$u_t_tr->append_tag_to_content(
		$result_td
	);
	
	$total_test_time = $u_t_p_c_f->get_total_test_time();
	$total_time_all_tests += $total_test_time;
	
	$u_t_tr->append_tag_to_content(
		new HTMLTags_TD(
			sprintf('%.5f', $total_test_time)
		)
	);
	
	$unit_tests_html_table->append_tag_to_content($u_t_tr);
}

$summary_tr = new HTMLTags_TR();

$summary_tr->set_attribute_str('class', 'summary');

$summary_tr->append_tag_to_content(new HTMLTags_TD('Summary'));
$summary_tr->append_tag_to_content(new HTMLTags_TD($total_passes));
$summary_tr->append_tag_to_content(new HTMLTags_TD($total_tests));
$result_td = new HTMLTags_TD($everything_passes ? 'Pass' : 'Fail');
	
$result_td->set_attribute_str(
	'class',
	($everything_passes ? 'pass' : 'fail')
);

$summary_tr->append_tag_to_content(
	$result_td
);
$summary_tr->append_tag_to_content(
	new HTMLTags_TD(sprintf('%.5f', $total_time_all_tests))
);

$unit_tests_html_table->append_tag_to_content($summary_tr);

$content_div->append_tag_to_content($unit_tests_html_table);

/*
 * -----------------------------------------------------------------------------
 */
echo $content_div->get_as_string();

?>