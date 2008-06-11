<?php
/**
 * Shop_TextsTable
 *
 * @copyright Clear Line Web Design, 2007-04-09
 */

require_once PROJECT_ROOT
    . '/haddock/database/classes/elements/'
    . 'Database_Table.inc.php';
    
class
    Shop_TextsTable
extends
    Database_Table
{
    public function
        add_text(
		$text
	)
    {
        $values = array();
        
        $values['text'] = $text;
        
        return $this->add($values);
    }
    
    public function
        edit_email_address(
            $edit_id,
		$text
	)
    {
        $values = array();
        
        $values['text'] = $text;

	return $this->update_by_id($edit_id, $values);
    }
    
}
?>
