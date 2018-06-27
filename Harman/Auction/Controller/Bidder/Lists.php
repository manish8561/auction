<?php

namespace Harman\Auction\Controller\Bidder;

class Lists extends \Magento\Framework\App\Action\Action
{
    protected $resultFactory;
    protected $template;

    public function __construct(
            \Magento\Framework\App\Action\Context $context           
    ) {
        parent::__construct($context);
    }
    public function execute()
    {       
        $resultPage = $this->resultFactory->create(
            \Magento\Framework\Controller\ResultFactory::TYPE_PAGE);

        $block = $resultPage->getLayout()
            ->createBlock('Harman\Auction\Block\Product\View\Product')
            ->setTemplate('Harman_Auction::product/view/bidder.phtml')
            ->toHtml();
        $this->getResponse()->setBody($block);
    }
}