<?php

namespace Harman\Auction\Controller\Adminhtml\auction;

use Magento\Backend\App\Action;

class Product extends \Magento\Backend\App\Action
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Framework\Registry $registry
     */
    public function __construct(
        Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
        //\Magento\Framework\Registry $registry
    ) {
        $this->resultPageFactory = $resultPageFactory;
        //$this->_coreRegistry = $registry;
        parent::__construct($context);
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return true;
    }

    /**
     * Init actions
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    // protected function _initAction()
    // {
    //     // load layout, set active menu and breadcrumbs
    //     /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
    //     $resultPage = $this->resultPageFactory->create();
    //     $resultPage->setActiveMenu('Harman_Auction::Auction')
    //         ->addBreadcrumb(__('Harman Auction'), __('Harman Auction'))
    //         ->addBreadcrumb(__('Manage Item'), __('Manage Item'));
    //     return $resultPage;
    // }

    /**
     * Edit Item
     *
     * @return \Magento\Backend\Model\View\Result\Page|\Magento\Backend\Model\View\Result\Redirect
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('auction_product_id');
        $model = $this->_objectManager->create('Harman\Auction\Model\Auction');


        return $resultPage;
    }
}