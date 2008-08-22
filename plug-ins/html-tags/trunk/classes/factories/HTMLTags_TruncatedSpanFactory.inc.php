<?php
/**
 * HTMLTags_TruncatedSpanFactory
 *
 * @copyright Clear Line Web Design, 2007-03-15
 */
require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/'
    . 'HTMLTags_URL.inc.php';

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_Span.inc.php';
    
class
	HTMLTags_TruncatedSpanFactory
{
	private function 

		__construct(
		)
	{
	}

	public static function 
		get_spans($str_to_split, $num_displayed_char)
	{
		$spans = array();
                 $str_to_split_shortened = '';
                # Shorten the string if it needs it
                $max_length = $num_displayed_char;
                        
                if (strlen($str_to_split) > $max_length){
                 
                    # $str_to_split_shortened = substr($str_to_split, 0, $max_length);          
                    # $pos = strrpos($str_to_split, " ");
                    # 
                    # if($pos === false) {
                    #        $str_to_split_shortened = substr($str_to_split, 0, $max_length)."...";
                    #         
                    # }
                    # 
                    #$str_to_split_shortened =  substr($str_to_split, 0, $pos)."...";
                    
                    $str_to_split_shortened = substr($str_to_split, 0, $max_length);
                    
                        $truncated_span = new HTMLTags_Span();
                                $truncated_span->set_attribute_str('class', 'truncated');
                            
                            $truncated_span->append_str_to_content($str_to_split_shortened);
                            $truncated_span->append_str_to_content('&nbsp;');                            
                        
                                $truncated_span_show_link = new HTMLTags_A('More...');
                                #$truncated_span_show_link->set_attribute_str('onclick', 'javascript: showInline(');
                                $truncated_span_show_link->set_attribute_str('class', 'show');
                                $truncated_span_show_link->set_attribute_str('title', 'Show the rest of this text');
                                
                                    $truncated_span_show_location =  new HTMLTags_URL();
                                    $truncated_span_show_location->set_file('#');
                                
                                $truncated_span_show_link->set_href($truncated_span_show_location);
                
                            $truncated_span->append_tag_to_content($truncated_span_show_link);
                        
                        array_push($spans, $truncated_span);
                            
                        $full_span = new HTMLTags_Span();
                            $full_span->set_attribute_str('class', 'full');
                            
                            $full_span->append_str_to_content($str_to_split);
                                                        $full_span->append_str_to_content('&nbsp;');
                        
                                $full_span_hide_link = new HTMLTags_A('...Hide');
                                $full_span_hide_link->set_attribute_str('class', 'hide');
                                $full_span_hide_link->set_attribute_str('title', 'hide the rest of this text');
                                
                                    $full_span_hide_location =  new HTMLTags_URL();
                                    $full_span_hide_location->set_file('#');
                                
                                $full_span_hide_link->set_href($full_span_hide_location);
                
                            $full_span->append_tag_to_content($full_span_hide_link);
                            
                        array_push($spans, $full_span);
                    
                    } else {
                        
                        $full_span = new HTMLTags_Span();
                            
                            $full_span->append_str_to_content($str_to_split);
                            
                        array_push($spans, $full_span);
                        
                    }
                        
                        return $spans;
        }
                
	public static function 
		get_spans_in_tag(
                    HTMLTags_TagWithContent $tag,
                    $str_to_split,
                    $num_displayed_char
                )
	{
            
            $spans = self::get_spans($str_to_split,$num_displayed_char);
            
            foreach($spans as $span) {
                
                $tag->append_tag_to_content($span);
                
            }
            return $tag;
        }

}


?>
