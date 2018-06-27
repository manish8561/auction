<?php 
namespace Harman\Auction\Block\Adminhtml\Auction\Edit\Tab\Renderer;

class Product extends \Magento\Backend\Block\Widget\Form\Renderer\Fieldset\Element implements
       \Magento\Framework\Data\Form\Element\Renderer\RendererInterface
{
	
       protected $_template = 'Harman_Auction::auction/form/renderer/product.phtml';

       public function render(\Magento\Framework\Data\Form\Element\AbstractElement $element)
       {
               $this->_element = $element;
            
               $html = $this->toHtml();
               
               return $html;
       }       
}