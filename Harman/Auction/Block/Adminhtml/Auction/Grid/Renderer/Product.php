<?php
namespace Harman\Auction\Block\Adminhtml\Auction\Grid\Renderer;

class Product extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer 
{
       public function render(\Magento\Framework\DataObject $row)
       {
           $product_id = parent::render($row);

           $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

           $product = $objectManager->create('Magento\Catalog\Model\Product')->load($product_id);

           return $product->getName();
       }
}