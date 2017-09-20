<?php
namespace EmployeModule\RdxSports\Block\Adminhtml\Employee\Edit;

/**
 * Admin page left menu
 */
class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('employee_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Employee Information'));
    }
}