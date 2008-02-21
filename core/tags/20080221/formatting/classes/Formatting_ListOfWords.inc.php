<?php
/**
 * Represents a list of words that can be formatted
 * in various ways.
 *
 * RFI & SANH 2006-11-13
 */

require_once PROJECT_ROOT
    . '/haddock/formatting/classes/'
    . 'Formatting_Word.inc.php';

class
    Formatting_ListOfWords
{
    private $words;
    
    public function
        __construct($words)
    {
        $this->words = $words;
    }
    
    public static function
        get_list_of_words_for_string($str, $separator = ' ')
    {
        $words_in_str = explode($separator, $str);
        
        $words = array();
        
        foreach ($words_in_str as $w_i_s) {
            $words[] = new Formatting_Word($w_i_s);
        }
        
        $list_of_words = new Formatting_ListOfWords($words);
        
        return $list_of_words;
    }
    
    public function
        get_words()
    {
        return $this->words;
    }
    
    public function
        get_words_as_string($separator = ' ')
    {
        $words = $this->get_words();
        
        $str = '';
        
        $first = TRUE;
        foreach ($words as $word) {
            if ($first) {
                $first = FALSE;
            } else {
                $str .= $separator;
            }
            
            $str .= $word->get_word();
        }
        
        return $str;
    }
    
    public function
        get_words_as_camel_case_string()
    {
        $words = $this->get_words();
        
        $str = '';
        
        $first = TRUE;
        foreach ($words as $word) {
            $str .= $word->get_word_uc_first();
        }
        
        return $str;
    }
    
    public function
        get_words_as_delimited_lc_string($delimiter)
    {
        $words = $this->get_words();
        
        $str = '';
        
        $first = TRUE;
        foreach ($words as $word) {
            if ($first) {
                $first = FALSE;
            } else {
                $str .= $delimiter;
            }
            
            $str .= $word->get_word_lc();
        }
        
        return $str;
    }
    
    public function
        get_words_as_capitalised_string()
    {
        $words = $this->get_words();
        
        $str = '';
        
        $first = TRUE;
        foreach ($words as $word) {
            if ($first) {
                $first = FALSE;
            } else {
                $str .= ' ';
            }
            
            $str .= $word->get_word_uc_first();
        }
        
        return $str;
    }
    
    public function
        get_words_as_conjunction_list($conjunction)
    {
        $words = $this->get_words();
        
        $str = '';
        
        for ($i = 0; $i < count($words); $i++) {
            if ($i == (count($words) - 1)) {
                $str .= " $conjunction ";
            }
            
            $str .= $words[$i]->get_word();
            
            if ($i < (count($words) - 2)) {
                $str .= ', ';
            }
        }
        
        return $str;
    }
    
    public static function
        capitalise_delimited_string($str, $delim = ' ')
    {
        $low = self::get_list_of_words_for_string($str, $delim);
        
        return $low->get_words_as_capitalised_string();
    }
}
?>
