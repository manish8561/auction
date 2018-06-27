<?php
namespace Harman\Auction\Block\Adminhtml\Auction\Edit;

/**
 * Admin page left menu
 */
class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('auction_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Auction Information'));
    }
}