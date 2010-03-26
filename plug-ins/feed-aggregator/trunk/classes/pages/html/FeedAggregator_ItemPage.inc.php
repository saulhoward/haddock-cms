<?php
/**
 * FeedAggregator_ItemPage
 * 
 * @copyright SANH, 2010-03-25
 */

/**
 * Example Item Page for the Feed Aggregator
 */
class
FeedAggregator_ItemPage
extends
FeedAggregator_HTMLPage
{
    public function
        get_item()
    {
        if (!isset($this->item)) {
            $this->set_item();
        }
        return $this->item;
    }

    public function
        set_item()
    {
        if (isset($_GET['item_id'])) {
            $this->item = 
                FeedAggregator_DatabaseHelper::get_item_by_id(
                    $_GET['item_id']
                );
        } else {
            throw new FeedAggregator_Exception('The page name must be set!');
        }
    }

    public function
        content()
    {
        $item_div = $this->get_item_div();
        echo $item_div->get_as_string();
    }

    public function
        get_item_div()
    {
        return FeedAggregator_DisplayHelper::get_item_div(
            $this->get_item()
        );
    }
}
?>
