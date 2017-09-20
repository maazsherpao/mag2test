<?php

namespace EmployeModule\RdxSports\Model\ResourceModel\Employee;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('EmployeModule\RdxSports\Model\Employee', 'EmployeModule\RdxSports\Model\ResourceModel\Employee');
        $this->_map['fields']['page_id'] = 'main_table.page_id';
    }

}
?>