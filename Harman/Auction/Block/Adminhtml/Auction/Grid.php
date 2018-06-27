<?php
namespace Harman\Auction\Block\Adminhtml\Auction;

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * @var \Magento\Framework\Module\Manager
     */
    protected $moduleManager;

    /**
     * @var \Harman\Auction\Model\auctionFactory
     */
    protected $_auctionFactory;

    /**
     * @var \Harman\Auction\Model\Status
     */
    protected $_status;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Data $backendHelper
     * @param \Harman\Auction\Model\auctionFactory $auctionFactory
     * @param \Harman\Auction\Model\Status $status
     * @param \Magento\Framework\Module\Manager $moduleManager
     * @param array $data
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Harman\Auction\Model\AuctionFactory $AuctionFactory,
        \Harman\Auction\Model\Status $status,
        \Magento\Framework\Module\Manager $moduleManager,
        array $data = []
    ) {
        $this->_auctionFactory = $AuctionFactory;
        $this->_status = $status;
        $this->moduleManager = $moduleManager;
        parent::__construct($context, $backendHelper, $data);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('postGrid');
        $this->setDefaultSort('auction_product_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(false);
        $this->setVarNameFilter('post_filter');
    }

    /**
     * @return $this
     */
    protected function _prepareCollection()
    {
        $collection = $this->_auctionFactory->create()->getCollection();
        $this->setCollection($collection);

        parent::_prepareCollection();

        return $this;
    }

    /**
     * @return $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'auction_product_id',
            [
                'header' => __('ID'),
                'type' => 'number',
                'index' => 'auction_product_id',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id'
            ]
        );
		
		$this->addColumn(
			'product_id',
			[
				'header' => __('Product'),
				'index' => 'product_id',
                'filter' => false,
                'renderer' => 'Harman\Auction\Block\Adminhtml\Auction\Grid\Renderer\Product',
			]
		);
		
		$this->addColumn(
			'starting_price',
			[
				'header' => __('Starting Price'),
				'index' => 'starting_price',
			]
		);
		
		$this->addColumn(
			'reserve_price',
			[
				'header' => __('Reserve Price'),
				'index' => 'reserve_price',
			]
		);
		
		$this->addColumn(
			'start_auction_time',
			[
				'header' => __('Start Auction Time'),
				'index' => 'start_auction_time',
				'type'      => 'datetime',
			]
		);
			
			
		$this->addColumn(
			'end_acution_time',
			[
				'header' => __('End Auction Time'),
				'index' => 'end_auction_time',
				'type'      => 'datetime',
			]
		);
			
			
		$this->addColumn(
			'min_qty',
			[
				'header' => __('Minimum Quantity'),
				'index' => 'min_qty',
			]
		);
		
		$this->addColumn(
			'max_qty',
			[
				'header' => __('Maximum Quantity'),
				'index' => 'max_qty',
			]
		);
		
				
		$this->addColumn(
			'increment_enable',
			[
				'header' => __('Increment Enable'),
				'index' => 'increment_enable',
				'type' => 'options',
				'options' => \Harman\Auction\Block\Adminhtml\Auction\Grid::getOptionArray7()
			]
		);
				
				
		$this->addColumn(
			'increment_step',
			[
				'header' => __('Increment Step'),
				'index' => 'increment_step',
			]
		);
        $this->addColumn(
            'status',
            [
                'header' => __('Status'),
                'index' => 'status',
                'type' => 'options',
                'options' => \Harman\Auction\Model\Status::getOptionArray()
            ]
        );
				
        //$this->addColumn(
            //'edit',
            //[
                //'header' => __('Edit'),
                //'type' => 'action',
                //'getter' => 'getId',
                //'actions' => [
                    //[
                        //'caption' => __('Edit'),
                        //'url' => [
                            //'base' => '*/*/edit'
                        //],
                        //'field' => 'auction_product_id'
                    //]
                //],
                //'filter' => false,
                //'sortable' => false,
                //'index' => 'stores',
                //'header_css_class' => 'col-action',
                //'column_css_class' => 'col-action'
            //]
        //);		

		
	   $this->addExportType($this->getUrl('auction/*/exportCsv', ['_current' => true]),__('CSV'));
	   $this->addExportType($this->getUrl('auction/*/exportExcel', ['_current' => true]),__('Excel XML'));

        $block = $this->getLayout()->getBlock('grid.bottom.links');
        if ($block) {
            $this->setChild('grid.bottom.links', $block);
        }

        return parent::_prepareColumns();
    }

	
    /**
     * @return $this
     */
    protected function _prepareMassaction()
    {

        $this->setMassactionIdField('auction_product_id');
        //$this->getMassactionBlock()->setTemplate('Harman_Auction::auction/grid/massaction_extended.phtml');
        $this->getMassactionBlock()->setFormFieldName('auction');

        $this->getMassactionBlock()->addItem(
            'delete',
            [
                'label' => __('Delete'),
                'url' => $this->getUrl('auction/*/massDelete'),
                'confirm' => __('Are you sure?')
            ]
        );

        $statuses = $this->_status->getOptionArray();

        $this->getMassactionBlock()->addItem(
            'status',
            [
                'label' => __('Change status'),
                'url' => $this->getUrl('auction/*/massStatus', ['_current' => true]),
                'additional' => [
                    'visibility' => [
                        'name' => 'status',
                        'type' => 'select',
                        'class' => 'required-entry',
                        'label' => __('Status'),
                        'values' => $statuses
                    ]
                ]
            ]
        );


        return $this;
    }
		

    /**
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('auction/*/index', ['_current' => true]);
    }

    /**
     * @param \Harman\Auction\Model\auction|\Magento\Framework\Object $row
     * @return string
     */
    public function getRowUrl($row)
    {
		
        return $this->getUrl(
            'auction/*/edit',
            ['auction_product_id' => $row->getId()]
        );
		
    }

	
	static public function getOptionArray7()
	{
        $data_array=array(); 
		$data_array[1]='Yes';
		$data_array[2]='No';
        return($data_array);
	}
	static public function getValueArray7()
	{
        $data_array=array();
		foreach(\Harman\Auction\Block\Adminhtml\Auction\Grid::getOptionArray7() as $k=>$v){
           $data_array[]=array('value'=>$k,'label'=>$v);		
		}
        return($data_array);

	}		

}