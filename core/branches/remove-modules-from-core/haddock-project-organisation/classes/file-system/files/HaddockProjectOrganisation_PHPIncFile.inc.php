<?php
/**
 * HaddockProjectOrganisation_PHPIncFile
 *
 * @copyright Clear Line Web Design, 2007-08-27
 */

class
	HaddockProjectOrganisation_PHPIncFile
extends
    FileSystem_PHPIncFile
{
    private $title_line;
    private $copyright_holder;
    private $date;
    private $body;
    
    public function
        get_title_line()
    {
        return $this->title_line;
    }
    
    public function
        set_title_line($title_line)
    {
        $this->title_line = $title_line;
    }
    
    public function
        get_copyright_holder()
    {
        return $this->copyright_holder;
    }
    
    public function
        set_copyright_holder($copyright_holder)
    {
        $this->copyright_holder = $copyright_holder;
    }
    
    public function
        get_date()
    {
        if (!isset($this->date)) {
            $this->date = date('Y-m-d');
        }
        
        return $this->date;
    }
    
    public function
        set_date($date)
    {
        $this->date = $date;
    }
    
    public function
        get_body()
    {
        return $this->body;
    }
    
    public function
        set_body($body)
    {
        $this->body = $body;
    }
    
    public function
        get_as_string()
    {
        if (is_file($this->get_name())) {
            #echo $this->get_name() . " already exists, returning contents.\n";
            
            return $this->get_contents();
        } else {
            #echo $this->get_name() . " doesn't exist, generating contents.\n";
            
            $str = '';
            
            $str .= "<?php\n";
            
            $str .= "/**\n";
            $str .= ' * ' . $this->get_title_line() . "\n";
            $str .= " *\n";
            
            $date = $this->get_date();
            $str .= ' * @copyright ' . $this->get_copyright_holder() . ", $date\n";
            $str .= " */\n";
            $str .= "\n";
            
            $str .= $this->get_body();
            
            $str .= "\n";
            $str .= "?>\n";
            
            return $str;
        }
    }
}
?>
