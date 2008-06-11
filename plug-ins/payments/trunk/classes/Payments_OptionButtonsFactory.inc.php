<?php
/**
 * Payments_OptionButtonsFactory
 *
 * @copyright Clear Line Web Design, 2007-10-04
 */

/**
 * Each module that implements the payments plug-in
 * should provide a method that returns a "button"
 * or form that takes the user to a payments page.
 */
class
    Payments_OptionButtonsFactory
{
    private $payment_plug_ins;
    
    private static $instance;
    
    /*
     * ----------------------------------------
     * Funtions to do with the singleton pattern.
     * ----------------------------------------
     */
    
    private function
        __construct()
    {
    }

    public static function
        get_instance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new Payments_OptionButtonsFactory();
        }

        return self::$instance;
    }
    
    /*
     * ----------------------------------------
     * Methods to do with finding the payment option buttons.
     * ----------------------------------------
     */
    
    public function
        get_payment_plug_ins()
    {
        if (!isset($this->payment_plug_ins)) {
            $this->payment_plug_ins = array();
            
            $pdf
                = HaddockProjectOrganisation_ProjectDirectoryFinder
                    ::get_instance();
            
            $pd = $pdf->get_project_directory_for_this_project();
            
            $payments_plug_in_module
                = $pd->get_plug_in_module_directory('payments');
            
            #print_r($payments_plug_in_module); exit;
            
            $this->payment_plug_ins = $payments_plug_in_module->get_payment_plug_ins();
        }
        
        #print_r($this->payment_plug_ins); exit;
        
        return $this->payment_plug_ins;
    }
    
    /*
     * ----------------------------------------
     * Methods to do with putting all the button tags together.
     * ----------------------------------------
     */
    
    public function
        get_option_button_tags()
    {
        $option_button_tags = array();
        
        foreach ($this->get_payment_plug_ins() as $ppi) {
            $option_button_tags[] = $ppi->get_payment_button_tag();
        }
        
        return $option_button_tags;
    }
    
    public function
        get_html_ul()
    {
        $ul = new HTMLTags_UL();
        
        foreach ($this->get_option_button_tags() as $obt) {
            $li = new HTMLTags_LI();
            
            $li->append_tag_to_content($obt);
            
            $ul->add_li($li);
        }
        
        return $ul;
    }
    
    public function
        get_html_div()
    {
        $html_div = new HTMLTags_Div();
        
        $html_div->set_attribute_str('id', 'payment_option_buttons');
        
        $html_div->append_tag_to_content($this->get_html_ul());
        
        return $html_div;
    }
}
?>