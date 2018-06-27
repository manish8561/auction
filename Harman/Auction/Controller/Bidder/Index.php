<?php

namespace Harman\Auction\Controller\Bidder;

class Index extends \Magento\Framework\App\Action\Action
{
    public function execute()
    {
    	$contact = $this->_objectManager->create('Harman\Auction\Model\Bidder');
    	$collection = $contact->getCollection();
        /*$contact->setBidderEmail('Paul Dupond');
        $contact->save();*/
        
         return $collection->getData();
   
    }
}