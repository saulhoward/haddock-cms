<?php
/**
 * Shop_ImageRow
 *
 * @copyright Clear Line Web Design, 2007-03-05
 */

require_once PROJECT_ROOT
    . '/haddock/database/classes/elements/row-subclasses/'
    . 'Database_ImageRow.inc.php';
    
class
    Shop_ImageRow
extends
    Database_ImageRow
{
    public function
        has_full_size_image()
    {
        $dbh = $this->get_database_handle();
        
        $thumbnail_id = $this->get_id();
        
        $query = <<<SQL
SELECT
    COUNT(hpi_shop_images.id)
FROM
    hpi_shop_images,
    hpi_shop_photographs
WHERE
    hpi_shop_photographs.thumbnail_image_id = $thumbnail_id
    AND 
    hpi_shop_images.id != $thumbnail_id
    AND
    hpi_shop_photographs.full_size_image_id = hpi_shop_images.id
SQL;
        
        #echo $query;
        
        $result = mysql_query($query, $dbh);
        
        if ($row = mysql_fetch_array($result)) {
            return $row[0] == 1;
        }
        
        return FALSE;
    }
    
    /**
     * This function and the one immediately below it
     * should only be called for thumbnail images.
     */
    public function
        get_full_size_image()
    {
        $dbh = $this->get_database_handle();
        
        $thumbnail_id = $this->get_id();
        
        $query = <<<SQL
SELECT
    hpi_shop_images.id,
    hpi_shop_images.file_type,
    hpi_shop_images.image
FROM
    hpi_shop_images,
    hpi_shop_photographs
WHERE
    hpi_shop_photographs.thumbnail_image_id = $thumbnail_id
    AND 
    hpi_shop_images.id != $thumbnail_id
    AND
    hpi_shop_photographs.full_size_image_id = hpi_shop_images.id
SQL;
        
        #echo $query;
        
        $result = mysql_query($query, $dbh);
        
        if (mysql_num_rows($result) < 1) {
            throw new Exception("No full size image for thumbnail image $thumbnail_id!");
        } elseif (mysql_num_rows($result) > 1) {
            throw new Exception("Multiple full size images for thumbnail image $thumbnail_id!");
        } else {
            $images_table = $this->get_table();
            
            $row_class = $images_table->get_row_class();
            
            #print_r($row_class);
            
            if ($row = mysql_fetch_assoc($result)) {
                
                return $row_class->newInstance($images_table, $row);
            }
        }
    }
    
    #public function
    #    get_full_size_image()
    #{
    #    $database = $this->get_database();
    #    
    #    $images_table = $database->get_table('images');
    #    
    #    $full_size_image_id = $this->get_full_size_image_id();
    #    
    #    echo "\$full_size_image_id: $full_size_image_id\n";
    #    
    #    return $images_table->get_row_by_id($full_size_image_id);
    #}
}
?>
