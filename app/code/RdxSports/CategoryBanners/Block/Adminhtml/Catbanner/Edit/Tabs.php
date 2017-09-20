<?php
namespace RdxSports\CategoryBanners\Block\Adminhtml\Catbanner\Edit;

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
        $this->setId('catbanner_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Catbanner Information'));
    }
}