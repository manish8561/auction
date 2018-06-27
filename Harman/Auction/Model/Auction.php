<?php
namespace Harman\Auction\Model;

class Auction extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Harman\Auction\Model\ResourceModel\Auction');
    }
}
?>