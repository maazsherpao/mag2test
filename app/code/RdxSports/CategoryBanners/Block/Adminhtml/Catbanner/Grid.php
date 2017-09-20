<?php
namespace RdxSports\CategoryBanners\Block\Adminhtml\Catbanner;

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * @var \Magento\Framework\Module\Manager
     */
    protected $moduleManager;

    /**
     * @var \RdxSports\CategoryBanners\Model\catbannerFactory
     */
    protected $_catbannerFactory;

    /**
     * @var \RdxSports\CategoryBanners\Model\Status
     */
    protected $_status;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Data $backendHelper
     * @param \RdxSports\CategoryBanners\Model\catbannerFactory $catbannerFactory
     * @param \RdxSports\CategoryBanners\Model\Status $status
     * @param \Magento\Framework\Module\Manager $moduleManager
     * @param array $data
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \RdxSports\CategoryBanners\Model\CatbannerFactory $CatbannerFactory,
        \RdxSports\CategoryBanners\Model\Status $status,
        \Magento\Framework\Module\Manager $moduleManager,
        array $data = []
    ) {
        $this->_catbannerFactory = $CatbannerFactory;
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
        $this->setDefaultSort('catbanners_id');
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
        $collection = $this->_catbannerFactory->create()->getCollection();
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
            'catbanners_id',
            [
                'header' => __('ID'),
                'type' => 'number',
                'index' => 'catbanners_id',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id'
            ]
        );


		
				$this->addColumn(
					'banner_title',
					[
						'header' => __('Banner Title'),
						'index' => 'banner_title',
					]
				);
				
						
						$this->addColumn(
							'banner_category',
							[
								'header' => __('Select Category'),
								'index' => 'banner_category',
								'type' => 'options',
								'options' => \RdxSports\CategoryBanners\Block\Adminhtml\Catbanner\Grid::getOptionArray1()
							]
						);
						
						
				$this->addColumn(
					'banner_url',
					[
						'header' => __('Banner URL'),
						'index' => 'banner_url',
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
                        //'field' => 'catbanners_id'
                    //]
                //],
                //'filter' => false,
                //'sortable' => false,
                //'index' => 'stores',
                //'header_css_class' => 'col-action',
                //'column_css_class' => 'col-action'
            //]
        //);
		

		
		   $this->addExportType($this->getUrl('categorybanners/*/exportCsv', ['_current' => true]),__('CSV'));
		   $this->addExportType($this->getUrl('categorybanners/*/exportExcel', ['_current' => true]),__('Excel XML'));

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

        $this->setMassactionIdField('catbanners_id');
        //$this->getMassactionBlock()->setTemplate('RdxSports_CategoryBanners::catbanner/grid/massaction_extended.phtml');
        $this->getMassactionBlock()->setFormFieldName('catbanner');

        $this->getMassactionBlock()->addItem(
            'delete',
            [
                'label' => __('Delete'),
                'url' => $this->getUrl('categorybanners/*/massDelete'),
                'confirm' => __('Are you sure?')
            ]
        );

        $statuses = $this->_status->getOptionArray();

        $this->getMassactionBlock()->addItem(
            'status',
            [
                'label' => __('Change status'),
                'url' => $this->getUrl('categorybanners/*/massStatus', ['_current' => true]),
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
        return $this->getUrl('categorybanners/*/index', ['_current' => true]);
    }

    /**
     * @param \RdxSports\CategoryBanners\Model\catbanner|\Magento\Framework\Object $row
     * @return string
     */
    public function getRowUrl($row)
    {
		
        return $this->getUrl(
            'categorybanners/*/edit',
            ['catbanners_id' => $row->getId()]
        );
		
    }

	
		static public function getOptionArray1()
		{
            $data_array=array(); 
            return($data_array);
		}
		static public function getValueArray1()
		{
            $data_array=array();
            return($data_array);
		}
		

}