<?php
/**
 * Database_SortableHeadingTR
 *
 * @copyright 2007-03-08, RFI
 */

#require_once PROJECT_ROOT
#    . '/haddock/html-tags/classes/'
#    . 'HTMLTags_URL.inc.php';
#
#require_once PROJECT_ROOT
#    . '/haddock/html-tags/classes/standard/'
#    . 'HTMLTags_TR.inc.php';
#
#require_once PROJECT_ROOT
#    . '/haddock/html-tags/classes/standard/'
#    . 'HTMLTags_TH.inc.php';
#
#require_once PROJECT_ROOT
#    . '/haddock/html-tags/classes/standard/'
#    . 'HTMLTags_A.inc.php';
#
#require_once PROJECT_ROOT
#    . '/haddock/formatting/classes/'
#    . 'Formatting_ListOfWords.inc.php';

class
    Database_SortableHeadingTR
extends
    HTMLTags_TR
{
    private $href;
    
    private $current_direction;
    
    public function
        __construct(
            HTMLTags_URL $href,
            $current_direction
        )
    {
        parent::__construct();
        
        $this->href = $href;
        $this->current_direction = $current_direction;
    }
    
    private function
        get_next_direction()
    {
        if ($this->current_direction == 'ASC') {
            return 'DESC';
        }
        
        return 'ASC';
    }
    
    private function
        get_next_href($sortable_field_name)
    {
        $href_clone = clone($this->href);
        
        $href_clone->set_get_variable('order_by', $sortable_field_name);
        $href_clone->set_get_variable('direction', $this->get_next_direction());
        
        return $href_clone;
    }
    
    /**
     * There should be some way to override that capitalisation.
     */
    public function
        append_sortable_field_name(
			$sortable_field_name,
			$title = NULL
		)
    {
        $th = new HTMLTags_TH();
        
		if (!isset($title)) {
			$s_f_n_l_o_ws
				= Formatting_ListOfWordsHelper
					::get_list_of_words_for_string($sortable_field_name, '_');
					
			$title = $s_f_n_l_o_ws->get_words_as_capitalised_string();
		}
        
        $sort_link = new HTMLTags_A($title);
        
        $sort_link->set_href($this->get_next_href($sortable_field_name));
        
        $th->append_tag_to_content($sort_link);
        
        $this->append_tag_to_content($th);
    }
    
    public function
        append_sortable_field_names_str($sortable_field_names_str)
    {
        foreach (explode(' ', $sortable_field_names_str) as $s_f_n) {
            $this->append_sortable_field_name($s_f_n);
        }
    }
    
    public function
        append_nonsortable_field_name(
			$field_name,
			$title = NULL
		)
    {
        $th = new HTMLTags_TH();
        
		if (!isset($title)) {
			$f_n_l_o_ws
				= Formatting_ListOfWordsHelper
					::get_list_of_words_for_string($field_name, '_');
			
			$title = $f_n_l_o_ws->get_words_as_capitalised_string();
		}
        
        $th->append_str_to_content($title);
        
        $this->append_tag_to_content($th);
    }
}
?>