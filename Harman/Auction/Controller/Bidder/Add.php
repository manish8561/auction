<?php

namespace Harman\Auction\Controller\Bidder;

class Add extends \Magento\Framework\App\Action\Action
{    
    protected $resultJsonFactory;

    public function __construct(
            \Magento\Framework\App\Action\Context $context,
            \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
    ) {
        parent::__construct($context);
        $this->resultJsonFactory = $resultJsonFactory;       
    }

    public function execute()
    {
        $json['success'] = 'NOK';
        $post = $this->getRequest()->getPostValue();
        if(!empty($post)){
            extract($post);
            $model = $this->_objectManager->create('Harman\Auction\Model\Bidder');

            if($customer_id > 0){
                $customerSession = $this->_objectManager->get('Magento\Customer\Model\Session');       
                $bidder_email =   $customerSession->getCustomer()->getEmail();   
            } 
            $model->setBidderEmail($bidder_email);
            $model->setBidderPrice($bidder_price); 
            $model->setAuctionProductId($auction_product_id);
            $model->setProductId($product_id);
            $model->setCustomerId($customer_id);
            $model->setStatus(1);//pending
            try{
                $model->save();
                $json['message'] = 'Your bid is added successfully!';
                $json['success'] = 'OK';
            }catch(Exception $e){
                $json['error'] = $e->getMessage();
            }
        }
        //echo json_encode($json); 
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->resultJsonFactory->create();
        return $resultJson->setData($json);
    }
}