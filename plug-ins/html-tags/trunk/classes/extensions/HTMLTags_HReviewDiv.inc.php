<?php
/**
 * HTMLTags_HReviewDiv
 *
 * @copyright Clear Line Web Design, 2006-11-29
 */

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_Div.inc.php';

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_BR.inc.php';
    
require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_Abbr.inc.php';

require_once PROJECT_ROOT
    . '/haddock/formatting/classes/'
    . 'Formatting_DateTime.inc.php';

class
    HTMLTags_HReviewDiv
extends
    HTMLTags_Div
{
    public function
        __construct($item_reviewed, $review, $reviewer, $date_reviewed)
    {
        parent::__construct();
            
            $this->set_attribute_str('class', 'hreview');

            $item_div = new HTMLTags_Div();
                $item_div->set_attribute_str('class', 'item');
            
            $item_div->append_str_to_content($item_reviewed);
            
            $this->append_tag_to_content($item_div);

            $description_div = new HTMLTags_Div();
                $description_div->set_attribute_str('class', 'description');

            $description_p = new HTMLTags_P($review);
            
            $description_div->append_tag_to_content($description_p);
            
            $this->append_tag_to_content($description_div);
            
                $reviewer_vcard_span = new HTMLTags_Span();
                    $reviewer_vcard_span->set_attribute_str('class', 'reviewer vcard');
            
                $reviewer_fn_span = new HTMLTags_Span();
                    $reviewer_fn_span->set_attribute_str('class', 'fn');
                    $reviewer_fn_span->append_str_to_content($reviewer);
            
            $reviewer_vcard_span->append_tag_to_content($reviewer_fn_span);
            
            $random_br_tag = new HTMLTags_BR();
            $reviewer_vcard_span->append_tag_to_content($random_br_tag);
            
            $date_reviewed_abbr = new HTMLTags_Abbr();
                $date_reviewed_abbr->set_attribute_str('class', 'dtreviewed');
                
                $datetime_iso8601 = Formatting_DateTime::datetime_to_ISO8601($date_reviewed);       
                $date_reviewed_abbr->set_attribute_str('title', $datetime_iso8601);
                
                $datetime_human_readable = Formatting_DateTime::datetime_to_human_readable($date_reviewed);      
                $date_reviewed_abbr->append_str_to_content($datetime_human_readable);
                
            $reviewer_vcard_span->append_tag_to_content($date_reviewed_abbr);
            
            $this->append_tag_to_content($reviewer_vcard_span);
            
            return $this;

    }

}
?>
