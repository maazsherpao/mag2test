<?php

namespace RdxSports\CategoryBanners\Model\ResourceModel\Catbanner;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('RdxSports\CategoryBanners\Model\Catbanner', 'RdxSports\CategoryBanners\Model\ResourceModel\Catbanner');
        $this->_map['fields']['page_id'] = 'main_table.page_id';
    }

}
?>