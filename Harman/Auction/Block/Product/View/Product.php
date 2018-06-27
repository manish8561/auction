<?php 

namespace Harman\Auction\Block\Product\View;

use Magento\Catalog\Block\Product\AbstractProduct;

class Product extends AbstractProduct 
{
	public function getBidders(){
		$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
		$product_id = $this->getRequest()->getParam('id');

		/*$product = $objectManager->get('Magento\Framework\Registry')->registry('current_product');
		$product_id = $product->getId();*/
		$model = $objectManager->create('Harman\Auction\Model\Bidder');
    	return $model->getCollection()->addFieldToFilter('product_id', array('eq' => $product_id))->setOrder('bidder_price','desc');
	}

}