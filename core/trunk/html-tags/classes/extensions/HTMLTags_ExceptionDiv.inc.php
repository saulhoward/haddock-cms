<?php
/**
 * HTMLTags_ExceptionDiv
 *
 * @copyright Clear Line Web Design, 2006-11-29
 */

#require_once PROJECT_ROOT
#    . '/haddock/html-tags/classes/standard/'
#    . 'HTMLTags_Div.inc.php';
#
#require_once PROJECT_ROOT
#    . '/haddock/html-tags/classes/standard/'
#    . 'HTMLTags_P.inc.php';
#
#require_once PROJECT_ROOT
#    . '/haddock/html-tags/classes/standard/'
#    . 'HTMLTags_OL.inc.php';
#
#require_once PROJECT_ROOT
#    . '/haddock/html-tags/classes/standard/'
#    . 'HTMLTags_LI.inc.php';
#
#require_once PROJECT_ROOT
#    . '/haddock/html-tags/classes/standard/'
#    . 'HTMLTags_BR.inc.php';
#
#require_once PROJECT_ROOT
#    . '/haddock/html-tags/classes/standard/'
#    . 'HTMLTags_Pre.inc.php';
#
#require_once PROJECT_ROOT
#    . '/haddock/formatting/classes/'
#    . 'Formatting_FileName.inc.php';

class
    HTMLTags_ExceptionDiv
extends
    HTMLTags_Div
{
    public function
        __construct(
			Exception $e,
			$print_trace = FALSE
		)
    {
        parent::__construct();
        
        $this->set_attribute_str('id', 'exception');
        
		/*
		 * The exception class p.
		 */
		
        $this->append_tag_to_content(new HTMLTags_P(get_class($e)));
		
		/*
		 * The exception message p.
		 */
		
        $this->append_tag_to_content(new HTMLTags_P($e->getMessage()));
		
		/*
		 * The exception's trace list.
		 */
		
		if ($print_trace) {
			$trace_list = new HTMLTags_OL();
			$trace_list->set_attribute_str('id', 'trace-list');
			
			foreach ($e->getTrace() as $data) {
				$trace_item = new HTMLTags_LI();
				
				#print_r($location);
				foreach (array_keys($data) as $key) {
					$trace_item->append_str_to_content("$key:");
					#$trace_item->append_tag_to_content(new HTMLTags_BR());
					
					if (is_array($data[$key])) {
						foreach ($data[$key] as $datum) {
							$trace_item->append_str_to_content('    ');
							
							if (is_numeric($datum) || is_string($datum)) {
								$trace_item->append_str_to_content(
									'&quot;' . $datum . '&quot;'
								);
							}
							
							$trace_item->append_tag_to_content(
								new HTMLTags_BR()
							);
						}
					} else if (strtolower($key) == 'file') {
						$formatted_filename = new Formatting_FileName(
							$data[$key]
						);
						$formatted_filename_pre = new HTMLTags_Pre(
							$formatted_filename->get_pretty_name()
						);
						$trace_item->append_tag_to_content(
							$formatted_filename_pre
						);
						$trace_item->append_tag_to_content(
							new HTMLTags_BR()
						);
					} else {
						$trace_item->append_str_to_content('    ');
						#echo $data[$key];
						#print_r($data[$key]);
						$trace_item->append_str_to_content(
							'' . $data[$key]
						);
						$trace_item->append_tag_to_content(
							new HTMLTags_BR()
						);
					}
				}
				
				$trace_list->append_tag_to_content($trace_item);
			}
			
			$this->append_tag_to_content($trace_list);
		}
    }
}
?>