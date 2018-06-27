<?php

namespace Harman\Auction\Block\Adminhtml\Auction\Edit\Tab;

/**
 * Auction edit form main tab
 */
class Main extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @var \Harman\Auction\Model\Status
     */
    protected $_status;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        \Harman\Auction\Model\Status $status,
        array $data = []
    ) {
        $this->_systemStore = $systemStore;
        $this->_status = $status;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form
     *
     * @return $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareForm()
    {
        /* @var $model \Harman\Auction\Model\BlogPosts */
        $model = $this->_coreRegistry->registry('auction');


        $isElementDisabled = false;

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $form->setHtmlIdPrefix('page_');

        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Item Information')]);

        if ($model->getId()) {
            $fieldset->addField('auction_product_id', 'hidden', ['name' => 'auction_product_id']);
        }

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $Session = $objectManager->create('Magento\Framework\Session\SessionManager');
        $Session->setAuctionProduct($model->getProductId());
        //$Session->getMyValue();
		
        $field = $fieldset->addField(
            'product_id',
            'text',
            [
                'name' => 'product_id',
                'label' => __('Product'),
                'title' => __('Product'),				
                'disabled' => $isElementDisabled,               
            ]
        );
     
        $renderer = $this->getLayout()->createBlock(
       'Harman\Auction\Block\Adminhtml\Auction\Edit\Tab\Renderer\Product');
 
        $field->setRenderer($renderer);
					
        $fieldset->addField(
            'starting_price',
            'text',
            [
                'name' => 'starting_price',
                'label' => __('Starting Price'),
                'title' => __('Starting Price'),
				
                'disabled' => $isElementDisabled
            ]
        );
					
        $fieldset->addField(
            'reserve_price',
            'text',
            [
                'name' => 'reserve_price',
                'label' => __('Reserve Price'),
                'title' => __('Reserve Price'),
				
                'disabled' => $isElementDisabled
            ]
        );
					

        $dateFormat = $this->_localeDate->getDateFormat(
            \IntlDateFormatter::MEDIUM
        );
        $timeFormat = $this->_localeDate->getTimeFormat(
            \IntlDateFormatter::MEDIUM
        );

        $fieldset->addField(
            'start_auction_time',
            'date',
            [
                'name' => 'start_auction_time',
                'label' => __('Start Auction Time'),
                'title' => __('Start Auction Time'),
                    'date_format' => $dateFormat,
                    'time_format' => $timeFormat,
				
                'disabled' => $isElementDisabled
            ]
        );
						
						
						

        $dateFormat = $this->_localeDate->getDateFormat(
            \IntlDateFormatter::MEDIUM
        );
        $timeFormat = $this->_localeDate->getTimeFormat(
            \IntlDateFormatter::MEDIUM
        );

        $fieldset->addField(
            'end_auction_time',
            'date',
            [
                'name' => 'end_auction_time',
                'label' => __('End Auction Time'),
                'title' => __('End Auction Time'),
                    'date_format' => $dateFormat,
                    'time_format' => $timeFormat,
				
                'disabled' => $isElementDisabled
            ]
        );
						
						
						
        $fieldset->addField(
            'min_qty',
            'text',
            [
                'name' => 'min_qty',
                'label' => __('Minimum Quantity'),
                'title' => __('Minimum Quantity'),
				
                'disabled' => $isElementDisabled
            ]
        );
					
        $fieldset->addField(
            'max_qty',
            'text',
            [
                'name' => 'max_qty',
                'label' => __('Maximum Quantity'),
                'title' => __('Maximum Quantity'),
				
                'disabled' => $isElementDisabled
            ]
        );
									
						
        $fieldset->addField(
            'increment_enable',
            'select',
            [
                'label' => __('Increment Enable'),
                'title' => __('Increment Enable'),
                'name' => 'increment_enable',
				
                'options' => \Harman\Auction\Block\Adminhtml\Auction\Grid::getOptionArray7(),
                'disabled' => $isElementDisabled
            ]
        );
						
						
        $fieldset->addField(
            'increment_step',
            'text',
            [
                'name' => 'increment_step',
                'label' => __('Increment Step'),
                'title' => __('Increment Step'),
				
                'disabled' => $isElementDisabled
            ]
        );
					

        if (!$model->getId()) {
            $model->setData('status', $isElementDisabled ? '1' : '2');
        }

        $form->setValues($model->getData());
        $this->setForm($form);
		
        return parent::_prepareForm();
    }

    /**
     * Prepare label for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabLabel()
    {
        return __('Item Information');
    }

    /**
     * Prepare title for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabTitle()
    {
        return __('Item Information');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
    
    public function getTargetOptionArray(){
    	return array(
    				'_self' => "Self",
					'_blank' => "New Page",
    				);
    }

}