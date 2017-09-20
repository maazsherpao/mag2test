<?php
namespace RdxSports\CategoryBanners\Model;

class Catbanner extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('RdxSports\CategoryBanners\Model\ResourceModel\Catbanner');
    }
}
?>