<?php

namespace Employee\Rdx\Model\ResourceModel\Rdx;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Employee\Rdx\Model\Rdx', 'Employee\Rdx\Model\ResourceModel\Rdx');
        $this->_map['fields']['page_id'] = 'main_table.page_id';
    }

}
?>