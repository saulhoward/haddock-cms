<?php
/**
 * FeedAggregator_DisplayHelper
 *
 * @copyright 2010-03-19, SANH
 */

class
FeedAggregator_DisplayHelper
{
    public static function
        get_item_div($item)
    {
        $item_div = new HTMLTags_Div();
        $item_div->set_attribute_str('class', 'item');
        $item_div->append('<h3>' . self::get_item_link($item) . '</h3>');
        $item_div->append($item['full_content']);
        return $item_div;
    }


    public static function
        get_feed_summary_div($feed)
    {
        if ($feed['items'] == '') {
            throw new Exception('Feed contains no items.');
        }
        $div = new HTMLTags_Div();
        $div->set_attribute_str('class', 'feed');
        $div->append('<h3>' . $feed['title'] . '</h3>');
        foreach ($feed['items'] as $item) {
            $item_div = new HTMLTags_Div();
            $item_div->set_attribute_str('class', 'item');
            $item_div->append('<h4>' . self::get_item_link($item) . '</h4>');
            $item_div->append($item['summary']);
            $div->append($item_div);
        }
        return $div;
    }

    public static function
        get_item_link($item)
    {
        $url = FeedAggregator_URLHelper::
            get_item_page_url_for_item_id($item['id']);
        $a = new HTMLTags_A($item['title']);
        $a->set_href($url);
        return $a;
    }

    public static function
        get_tags_csv_string(
            $tags
        )
    {
        //print_r($tags);exit;
        $html = '';
        $i = 0;
        foreach ($tags as $tag) {
            if ($i != 0) {
                $html .= ', ';
            }
            $i++;
            $html .= $tag['tag'];
        }
        return $html;
    }

    public static function
        get_tags_empty_links_list(
            $tags
        )
    {
        $ul = new HTMLTags_UL();
        $ul->set_attribute_str('class', 'tags-empty-links-list');
        foreach ($tags as $tag) {
            $li = new HTMLTags_LI();
            $li->set_attribute_str('tag', $tag['tag']);
            $li->append($tag['tag']);
            $ul->append($li);
        }
        return $ul;
    }
}
?>
