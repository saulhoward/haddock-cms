<?php
/**
 * Shop_languagesTable
 *
 * @copyright Clear Line Web Design, 2007-04-09
 */
    
class
    Shop_languagesTable
extends
    Database_Table
{
    public function
        add_language(
            $name,
            $iso_639_1_code
        )
    {
        $values = array();
        
        $values['name'] = $name;
        $values['iso_639_1_code'] = $iso_639_1_code;
        
        return $this->add($values);
    }
    
    public function
        edit_language(
            $edit_id,
            $name,
            $iso_639_1_code
       )
    {
        $values = array();
        
        $values['name'] = $name;
        $values['iso_639_1_code'] = $iso_639_1_code;
       
        return $this->update_by_id($edit_id, $values);
    }
    
}
?>
