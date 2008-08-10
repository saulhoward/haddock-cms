<?php
/**
 * HTMLTags_FillTable
 *
 * @copyright Clear Line Web Design, 2007-02-27
 */

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_Table.inc.php';

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_TR.inc.php';

require_once PROJECT_ROOT
    . '/haddock/html-tags/classes/standard/'
    . 'HTMLTags_TD.inc.php';

class
    HTMLTags_FillTable
extends
    HTMLTags_Table
{
    private $number_of_groups;
    private $orientation;
    private $items_added;
    
    public function
        get_number_of_groups()
    {
        if (isset($this->number_of_groups)) {
            return $this->number_of_groups;
        } else {
            return 3;
        }
    }
    
    public function
        set_number_of_groups($number_of_groups)
    {
        if (isset($this->items_added)) {
            throw new Exception('You cannot set the number of groups of a HTMLTags_FillTable after items have been added!');
        } else {
            if ($number_of_groups < 1) {
                throw new Exception('The number of groups of a HTMLTags_FillTable must be a least 1!');
            } else {
                $this->number_of_groups = $number_of_groups;
            }
        }
    }
    
    public function
        get_orientation()
    {
        if (isset($this->orientation)) {
            return $this->orientation;
        } else {
            return 'V';
        }
    }
    
    public function
        set_orientation($orientation)
    {
        if (isset($this->items_added)) {
            throw new Exception('You cannot set the orientation of a HTMLTags_FillTable after items have been added!');
        } else {
            if (
                strlen($orientation) == 1
                &&
                (
                    strtoupper($orientation) == 'V'
                    ||
                    strtoupper($orientation) == 'H'
                )
            ) {
                $this->orientation = strtoupper($orientation);
            } else {
                throw new Exception('The orientation of a HTMLTags_FillTable must be "V" or "H"!');
            }
        }
    }
    
    public function
        append_array($array)
    {
        if (isset($this->items_added)) {
            throw new Exception('You cannot append an array to a HTMLTags_FillTable more than once!');
        } else {
            $groups_array = $this->split_array($array);
            
            #print_r($groups_array);
            
            for ($i = 0; $i < count($groups_array); $i++) {
                $row = new HTMLTags_TR();
                
                for ($j = 0; $j < count($groups_array[$i]); $j++) {
                    $td = new HTMLTags_TD();
                    
                    if (is_a($groups_array[$i][$j], 'HTMLTags_Tag')) {
                        #echo "tag\n";
                        $td->append_tag_to_content($groups_array[$i][$j]);
                    } else {
                        #echo "non-tag\n";
                        $td->append_str_to_content($groups_array[$i][$j]);
                    }
                    
                    $row->append_tag_to_content($td);
                }
                
                $this->append_tag_to_content($row);
            }
            
            $this->items_added = TRUE;
        }
    }
    
    protected function
        split_array($array)
    {
        $groups_array = array();
        
        if ($this->get_orientation() == 'V') {
            $j = -1;
            $num_rows = count($array) / $this->get_number_of_groups();
            
            if (count($array) % $this->get_number_of_groups() > 0) {
                $num_rows++;
            }
            
            for ($i = 0; $i < count($array); $i++) {
                if ($i % $num_rows == 0) {
                    $j++;
                    $k = 0;
                }
                
                $groups_array[$k][$j] = $array[$i];
                
                $k++;
            }
        } elseif ($this->get_orientation() == 'H') {
            $j = -1;
            for ($i = 0; $i < count($array); $i++) {
                if ($i % $this->get_number_of_groups() == 0) {
                    $j++;
                }
                
                $groups_array[$j][] = $array[$i];
            }
        }
        
        return $groups_array;
    }
}
?>
