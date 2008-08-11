<?php
/**
 * Database_Renderer
 *
 * @copyright Clear Line Web Design, 2006-09-20
 */

/**
 * In order to separate database and program logic
 * from presentation code and HTML, many of the
 * classes have renderers.
 *
 * e.g.
 *
 * $foo_rows = $foos_table->get_all_row();
 *
 * echo "<ul>\n";
 *
 * foreach ($foo_rows as $foo_row) {
 *      $foo_row_renderer = $foo_row->get_renderer();
 *      $foo_row_renderer->render_li();
 * }
 *
 * echo "</ul>\n";
 *
 * All these renderers should extend this class.
 *
 * To start with, this class will be empty but
 * the intention is that the methods can be
 * migrated from subclasses up the inheritance
 * hierarchy.
 */
class
    Database_Renderer
{
    private $element;
    
    public function __construct($element)
    {
        $this->element = $element;
    }
    
    public function get_element()
    {
        return $this->element;
    }
}

?>
