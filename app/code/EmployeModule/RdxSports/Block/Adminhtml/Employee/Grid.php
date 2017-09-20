<?php
namespace EmployeModule\RdxSports\Block\Adminhtml\Employee;

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * @var \Magento\Framework\Module\Manager
     */
    protected $moduleManager;

    /**
     * @var \EmployeModule\RdxSports\Model\employeeFactory
     */
    protected $_employeeFactory;

    /**
     * @var \EmployeModule\RdxSports\Model\Status
     */
    protected $_status;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Data $backendHelper
     * @param \EmployeModule\RdxSports\Model\employeeFactory $employeeFactory
     * @param \EmployeModule\RdxSports\Model\Status $status
     * @param \Magento\Framework\Module\Manager $moduleManager
     * @param array $data
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \EmployeModule\RdxSports\Model\EmployeeFactory $EmployeeFactory,
        \EmployeModule\RdxSports\Model\Status $status,
        \Magento\Framework\Module\Manager $moduleManager,
        array $data = []
    ) {
        $this->_employeeFactory = $EmployeeFactory;
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
        $this->setDefaultSort('employee_id');
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
        $collection = $this->_employeeFactory->create()->getCollection();
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
            'employee_id',
            [
                'header' => __('ID'),
                'type' => 'number',
                'index' => 'employee_id',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id'
            ]
        );


		
				$this->addColumn(
					'name',
					[
						'header' => __('Employee Name'),
						'index' => 'name',
					]
				);
				
				$this->addColumn(
					'email',
					[
						'header' => __('Employee Email'),
						'index' => 'email',
					]
				);
				
						
						$this->addColumn(
							'dempartment',
							[
								'header' => __('Employee Department'),
								'index' => 'dempartment',
								'type' => 'options',
								'options' => \EmployeModule\RdxSports\Block\Adminhtml\Employee\Grid::getOptionArray2()
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
                        //'field' => 'employee_id'
                    //]
                //],
                //'filter' => false,
                //'sortable' => false,
                //'index' => 'stores',
                //'header_css_class' => 'col-action',
                //'column_css_class' => 'col-action'
            //]
        //);
		

		
		   $this->addExportType($this->getUrl('rdxsports/*/exportCsv', ['_current' => true]),__('CSV'));
		   $this->addExportType($this->getUrl('rdxsports/*/exportExcel', ['_current' => true]),__('Excel XML'));

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

        $this->setMassactionIdField('employee_id');
        //$this->getMassactionBlock()->setTemplate('EmployeModule_RdxSports::employee/grid/massaction_extended.phtml');
        $this->getMassactionBlock()->setFormFieldName('employee');

        $this->getMassactionBlock()->addItem(
            'delete',
            [
                'label' => __('Delete'),
                'url' => $this->getUrl('rdxsports/*/massDelete'),
                'confirm' => __('Are you sure?')
            ]
        );

        $statuses = $this->_status->getOptionArray();

        $this->getMassactionBlock()->addItem(
            'status',
            [
                'label' => __('Change status'),
                'url' => $this->getUrl('rdxsports/*/massStatus', ['_current' => true]),
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
        return $this->getUrl('rdxsports/*/index', ['_current' => true]);
    }

    /**
     * @param \EmployeModule\RdxSports\Model\employee|\Magento\Framework\Object $row
     * @return string
     */
    public function getRowUrl($row)
    {
		
        return $this->getUrl(
            'rdxsports/*/edit',
            ['employee_id' => $row->getId()]
        );
		
    }

	
		static public function getOptionArray2()
		{
            $data_array=array(); 
			$data_array[0]='Software Development';
			$data_array[1]='Content Writing';
			$data_array[2]='Product Listing';
			$data_array[3]='B2B ';
			$data_array[4]='Warehouse';
			$data_array[5]='Delivery';
            return($data_array);
		}
		static public function getValueArray2()
		{
            $data_array=array();
			foreach(\EmployeModule\RdxSports\Block\Adminhtml\Employee\Grid::getOptionArray2() as $k=>$v){
               $data_array[]=array('value'=>$k,'label'=>$v);		
			}
            return($data_array);

		}
		

}