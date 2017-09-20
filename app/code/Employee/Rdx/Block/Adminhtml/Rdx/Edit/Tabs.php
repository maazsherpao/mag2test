<?php
namespace Employee\Rdx\Block\Adminhtml\Rdx\Edit;

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
        $this->setId('rdx_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Rdx Information'));
    }
}