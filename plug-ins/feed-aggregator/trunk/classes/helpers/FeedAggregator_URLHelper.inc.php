<?php
/**
 * FeedAggregator_URLHelper
 *
 * @copyright 2010-03-26, SANH
 */

class
FeedAggregator_URLHelper
{
    public static function
        get_item_page_url()
    {
        $cmf = HaddockProjectOrganisation_ConfigManagerFactory::get_instance();
        $config_manager = 
            $cmf->get_config_manager('plug-ins', 'feed-aggregator');
        $item_page_class_name= $config_manager->get_item_page_class_name();

        return self
            ::get_oo_page_url(
                $item_page_class_name
            );
    }

    public static function
        get_item_page_url_for_item_id(
            $item_id
        )
    {
        $item_page_url = self::get_item_page_url();
        $item_page_url->set_get_variable("item_id", $item_id);
        return $item_page_url;
    }

    public static function
        get_oo_page_url(
            $page_class,
            $get_variables = NULL
        )
    {
        /**
         * Copied from PublicHTML_URLHelper so I can use 
         * the FeedAggregator_URL class
         */
        $url = new FeedAggregator_URL();
        if (
            PublicHTML_ServerCapabilitiesHelper
            ::has_mod_rewrite()
        ) {
            $url->set_file('/');
        } else {
            $url->set_file('/haddock/public-html/public-html/index.php');
        }

        $url->set_get_variable('oo-page');
        $url->set_get_variable('page-class', $page_class);

        if (isset($get_variables)) {
            foreach ($get_variables as $k => $v) {
                $url->set_get_variable($k, urlencode($v));
            }
        }

        return $url;
    }
}
?>
