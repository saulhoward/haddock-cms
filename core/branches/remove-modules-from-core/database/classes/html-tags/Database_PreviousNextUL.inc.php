<?php
/**
 * Database_PreviousNextUL
 *
 * @copyright Clear Line Web Design, 2007-02-21
 */

require_once PROJECT_ROOT
    . '/haddock/database/classes/elements/'
    . 'Database_Table.inc.php';

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/'
    . 'HTMLTags_URL.inc.php';

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_UL.inc.php';

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_LI.inc.php';

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_A.inc.php';

require_once PROJECT_ROOT
    . '/haddock/formatting/classes/'
    . 'Formatting_CountingNumber.inc.php';

class
    Database_PreviousNextUL
extends
    HTMLTags_UL
{
    private $link_href;
    
    private $offset;
    private $limit;
    
    private $row_count;
    
    public function __construct(
        HTMLTags_URL $link_href,
        $offset,
        $limit,
        $row_count
    )
    {
        #echo "Start: Database_PreviousNextUL::__construct()\n";
        
        parent::__construct();
        
        $this->set_attribute_str('class', 'inline_list');
        
        #$this->table = $table;
        
        $this->link_href = $link_href;
        
        if ($offset < 0) {
            throw new Exception(
                'The offset for a Database_PreviousNextUL cannot be negative!'
            );
        }
        
        $this->offset = $offset;
        
        if ($limit < 1) {
            throw new Exception(
                'The limit for a Database_PreviousNextUL must be at least 1!'
            );
        }
        
        $this->limit = $limit;
        
        if (($this->offset % $this->limit) > 0) {
            throw new Exception(
                'The offset should be a multiple of the limit in a Database_PreviousNextUL!'
            );
        }
        
        #if ($row_count < 1) {
        #    throw new Exception(
        #        'The maximum number of links either side of the current page must be at least one in a Database_PreviousNextUL!'
        #    );
        #}
        
        $this->row_count = $row_count;
        
        #echo "End: Database_PreviousNextUL::__construct()\n";
    }
    
    public function
        __toString()
    {
        return 'Database_PreviousNextUL';
    }
    
    # No! No! No!
    # Use the delegate pattern?
    public function append_str_to_content($str)
    {
        throw new Exception('Attempt to append string to the content of Database_PreviousNextUL');
    }
    
    public function append_tag_to_content(HTMLTags_Tag $tag)
    {
        throw new Exception('Attempt to append tag to the content of Database_PreviousNextUL');
    }
    
    public function get_content()
    {
        #echo "\$this->offset: $this->offset\n";
        #echo "\$this->limit: $this->limit\n";
        
        $content = new HTMLTags_TagContent();
        
        /*
         * Are we at the beginning?
         */
        if ($this->offset > 0) {
            $first_offset = 0;
            $previous_offset = $this->offset - $this->limit;
            
            $first_page_li = new HTMLTags_LI();
            
            $link_to_first_page = new HTMLTags_A('first'); # How will we set this to 'primero' etc?
            
            $first_page_href = clone($this->link_href);
            $first_page_href->set_get_variable(
                'offset',
                0
            );
            
            $first_page_href->set_get_variable('limit', $this->limit);
            
            $link_to_first_page->set_href($first_page_href);
            
            $first_page_li->append_tag_to_content($link_to_first_page);
            
            $content->append_tag($first_page_li);
            
            /*
             * Do previous and first collide?
             */
            if ($first_offset < $previous_offset) {
                $previous_page_li = new HTMLTags_LI();
                
                $link_to_previous_page = new HTMLTags_A('previous'); 
                
                $previous_page_href = clone($this->link_href);
                $previous_page_href->set_get_variable(
                    'offset',
                    $previous_offset
                );
                
                $previous_page_href->set_get_variable('limit', $this->limit);
                
                $link_to_previous_page->set_href($previous_page_href);
                
                $previous_page_li->append_tag_to_content($link_to_previous_page);
                
                $content->append_tag($previous_page_li);
            }
        }
        
        /*
         * Current
         * 
         * offset to offset + limit
         */
        $current_page_li = new HTMLTags_LI();
        
        $current_msg = ($this->offset + 1);
        $current_msg .= ' to ';
        
        #$row_count = $this->table->count_all_rows();
        
        $current_msg .=
            ($this->offset + $this->limit) < $this->row_count ?
            ($this->offset + $this->limit) :
            $this->row_count;
        
        $current_page_li->append_str_to_content($current_msg);
        
        $content->append_tag($current_page_li);
        
        /*
         * Are there more rows to show?
         */
        #echo "\$row_count: $row_count\n";
        if (($this->offset + $this->limit) < $this->row_count) {
            #echo "There are more pages\n";
            $next_offset = $this->offset + $this->limit;
            $last_offset = (
                $this->row_count
                -
                (
                    ($this->row_count % $this->limit) == 0 ?
                    $this->limit :
                    $this->row_count % $this->limit
                )
            );
            
            /*
             * Do next and final collide?
             */
            if (
                $next_offset
                <
                $last_offset
            ) {
                $next_page_li = new HTMLTags_LI();
                
                $link_to_next_page = new HTMLTags_A('next');
                
                $next_page_href = clone($this->link_href);
                $next_page_href->set_get_variable(
                    'offset',
                    $next_offset
                );
                
                $next_page_href->set_get_variable('limit', $this->limit);
                
                $link_to_next_page->set_href($next_page_href);
                
                $next_page_li->append_tag_to_content($link_to_next_page);
                
                $content->append_tag($next_page_li);
            }
            
            $last_page_li = new HTMLTags_LI();
            
            $link_to_last_page = new HTMLTags_A('last'); 
            
            $last_page_href = clone($this->link_href);
            $last_page_href->set_get_variable(
                'offset',
                $last_offset
            );
            
            $last_page_href->set_get_variable('limit', $this->limit);
            
            $link_to_last_page->set_href($last_page_href);
            
            $last_page_li->append_tag_to_content($link_to_last_page);
            
            $content->append_tag($last_page_li);
        }
        
        return $content;
    }
    
    #public function get_content()
    #{
    #    $content = new HTMLTags_TagContent();
    #    
    #    ## The link to the first page.
    #    #if (($this->offset / $this->limit) >= ($this->max_links_either_side + 1)) {
    #    #    $first_page_li = new HTMLTags_LI();
    #    #    
    #    #    $link_to_first_page = new HTMLTags_A('First'); # How will we set this to 'primero' etc?
    #    #    
    #    #    $first_page_href = clone($this->link_href);
    #    #    $first_page_href->set_get_variable('offset', 0);
    #    #    $first_page_href->set_get_variable('limit', $this->limit);
    #    #    
    #    #    $link_to_first_page->set_href($first_page_href);
    #    #    
    #    #    $first_page_li->append_tag_to_content($link_to_first_page);
    #    #    
    #    #    $content->append_tag($first_page_li);
    #    #}
    #    
    #    # The link to the previous pages.
    #    $current_offset = $this->offset - $this->limit;
    #    $previous_offsets = array();
    #    
    #    while (
    #        ($current_offset > ($this->limit * -1))
    #        &&
    #        (
    #            $current_offset
    #            >=
    #            (
    #                $this->offset
    #                -
    #                (
    #                    $this->limit
    #                    *
    #                    $this->max_links_either_side
    #                )
    #            )
    #        )
    #    ) {
    #        $previous_offsets[] = $current_offset;
    #        
    #        $current_offset -= $this->limit;
    #    }
    #    
    #    #print_r($previous_offsets);
    #    
    #    $previous_offsets = array_reverse($previous_offsets);
    #    
    #    foreach ($previous_offsets as $p_o) {
    #        $previous_page_li = new HTMLTags_LI();
    #        
    #        $to = $p_o + $this->limit;
    #        
    #        if ($p_o < 0) {
    #            $p_o = 0;
    #        }
    #        
    #        $from = $p_o + 1;
    #        
    #        #$previous_link_text = Formatting_CountingNumber::get_cardinal_range($from, $to);
    #        $previous_link_text = "$from to $to";
    #        $link_to_previous_page = new HTMLTags_A($previous_link_text);
    #        
    #        $previous_page_href = clone($this->link_href);
    #        $previous_page_href->set_get_variable('offset', $p_o);
    #        $previous_page_href->set_get_variable('limit', $this->limit);
    #        
    #        $link_to_previous_page->set_href($previous_page_href);
    #        
    #        $previous_page_li->append_tag_to_content($link_to_previous_page);
    #        
    #        $content->append_tag($previous_page_li);
    #    }
    #    
    #    $row_count = $this->table->count_all_rows();
    #    
    #    # The LI for the current page.
    #    $from = $this->offset + 1;
    #    if ($row_count < ($this->offset + $this->limit)) {
    #        $to = $row_count + 1;
    #    } else {
    #        $to = $this->offset + $this->limit;
    #    }
    #    
    #    #$current_text = Formatting_CountingNumber::get_cardinal_range($from, $to);
    #    $current_text = "$from to $to";
    #    
    #    $current_page_li = new HTMLTags_LI($current_text);
    #    $content->append_tag($current_page_li);
    #    
    #    #echo $row_count;
    #    
    #    # The link to the next pages.
    #    $current_offset = $this->offset + $this->limit;
    #    
    #    #echo $current_offset;
    #    #echo ($row_count - (2 * $this->limit));
    #    #echo $this->offset;
    #    #echo ($this->offset + ($this->max_links_either_side * $this->limit));
    #    
    #    while (
    #        ($current_offset <= $row_count)
    #        and
    #        ($current_offset <=
    #            (
    #                $this->offset
    #                +
    #                (
    #                    $this->max_links_either_side
    #                    *
    #                    $this->limit
    #                )
    #            )
    #        )
    #    ) {
    #        $next_page_li = new HTMLTags_LI();
    #        
    #        $from = $current_offset + 1;
    #        $to = $current_offset + $this->limit;
    #        
    #        if ($to > $row_count) {
    #            $to = $row_count + 1;
    #        }
    #        
    #        #$next_link_text = Formatting_CountingNumber::get_cardinal_range($from, $to);
    #        $next_link_text = "$from to $to";
    #        
    #        $link_to_next_page = new HTMLTags_A($next_link_text); 
    #        
    #        $next_page_href = clone($this->link_href);
    #        $next_page_href->set_get_variable('offset', $current_offset);
    #        $next_page_href->set_get_variable('limit', $this->limit);
    #        
    #        $link_to_next_page->set_href($next_page_href);
    #        
    #        $next_page_li->append_tag_to_content($link_to_next_page);
    #        
    #        $content->append_tag($next_page_li);
    #        
    #        $current_offset += $this->limit;
    #    }
    #    
    #    ## The link to the last page.
    #    #if (
    #    #    ($row_count - $this->limit)
    #    #    >=
    #    #    (
    #    #        $this->offset
    #    #        +
    #    #        (
    #    #            $this->limit
    #    #            *
    #    #            ($this->max_links_either_side - 1)
    #    #        )
    #    #    )
    #    #) {
    #    #    $last_page_li = new HTMLTags_LI();
    #    #    
    #    #    $link_to_last_page = new HTMLTags_A('Last'); 
    #    #    
    #    #    $last_page_href = clone($this->link_href);
    #    #    
    #    #    if (($row_count % $this->limit) == 0) {
    #    #        $last_offset = $row_count - $this->limit;
    #    #    } else {
    #    #        $last_offset = floor($row_count / $this->limit) * $this->limit;
    #    #    }
    #    #    
    #    #    $last_page_href->set_get_variable('offset', $last_offset);
    #    #    $last_page_href->set_get_variable('limit', $this->limit);
    #    #    
    #    #    $link_to_last_page->set_href($last_page_href);
    #    #    
    #    #    $last_page_li->append_tag_to_content($link_to_last_page);
    #    #    
    #    #    $content->append_tag($last_page_li);
    #    #}
    #    
    #    
    #    return $content;
    #}
}
?>
