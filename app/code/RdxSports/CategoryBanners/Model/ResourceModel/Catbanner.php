<?php
namespace RdxSports\CategoryBanners\Model\ResourceModel;

class Catbanner extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('catbanners', 'catbanners_id');
    }
}
?>