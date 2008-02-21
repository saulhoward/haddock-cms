<?php
/**
 * Represents a word.
 *
 * RFI & SANH 2006-11-13
 */

class Formatting_Word
{
    private $word;
    
    public function __construct($word)
    {
        $this->word = $word;
    }
    
    public function get_word()
    {
        return $this->word;
    }
    
    public function get_word_lc()
    {
        return strtolower($this->get_word());
    }
    
    public function get_word_uc_first()
    {
        return ucwords($this->get_word_lc());
    }
}
?>
