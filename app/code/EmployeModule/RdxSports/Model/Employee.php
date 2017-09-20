<?php
namespace EmployeModule\RdxSports\Model;

class Employee extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('EmployeModule\RdxSports\Model\ResourceModel\Employee');
    }
}
?>