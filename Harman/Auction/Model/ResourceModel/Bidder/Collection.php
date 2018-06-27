<?php

namespace Harman\Auction\Model\ResourceModel\Bidder;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Harman\Auction\Model\Bidder', 'Harman\Auction\Model\ResourceModel\Bidder');
        $this->_map['fields']['page_id'] = 'main_table.page_id';
    }

}
?>