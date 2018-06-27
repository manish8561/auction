<?php

namespace Harman\Auction\Model\ResourceModel\Auction;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Harman\Auction\Model\Auction', 'Harman\Auction\Model\ResourceModel\Auction');
        $this->_map['fields']['page_id'] = 'main_table.page_id';
    }

}
?>