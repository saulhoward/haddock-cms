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
        get_feed_summary_div($feed)
    {
        if ($feed['items'] == '') {
            throw new Exception('Feed contains no items.');
        }
        $div = new HTMLTags_Div();
        foreach ($feed['items'] as $item) {
            $item_div = new HTMLTags_Div();
            $item_div->append($item['title']);
            $item_div->append($item['summary']);
            $div->append($item_div);
        }
        return $div;
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
