<?php
/**
 * Database_TableSpecificationFile
 *
 * @copyright Clear Line Web Design, 2007-02-02
 */

#require_once PROJECT_ROOT
#    . '/haddock/file-system/classes/'
#    . 'FileSystem_TextFileWithComments.inc.php';

class
    Database_TableSpecificationFile
extends
    FileSystem_TextFileWithComments
{
    public function
        save_table_structure(
            Database_Table $table
        )
    {
        $handle = fopen($this->get_name(), 'w');
        
        /*
         * The fields.
         */
        fwrite($handle, "# The fields\n\n");
        
        $fields = $table->get_fields();
        foreach ($fields as $field) {
            #print_r($field);
            
            fwrite($handle, $field->get_name() . '.type='
                . $field->get_type() . "\n"
            );
            
            fwrite(
                $handle, $field->get_name() . '.null='
                . ($field->can_be_null() ? 'Yes' : 'No')
                . "\n"
            );
            
            if ($field->has_default()) {
                fwrite($handle, $field->get_name() . '.default='
                    . $field->get_default() . "\n"
                );
            }
            
            fwrite($handle, "\n");
        }
        
        /*
         * The keys.
         */
        $keys = $table->get_keys();
        foreach ($keys as $key) {
            
        }
        
        fclose($handle);
    }
}
?>
