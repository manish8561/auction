<?php
namespace Harman\Auction\Model\ResourceModel;

class Auction extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('harman_auction_product', 'auction_product_id');
    }
}
?>