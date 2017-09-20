<?php
namespace Employee\Rdx\Model\ResourceModel;

class Rdx extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('employee', 'employee_id');
    }
}
?>