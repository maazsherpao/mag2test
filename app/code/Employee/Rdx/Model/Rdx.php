<?php
namespace Employee\Rdx\Model;

class Rdx extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Employee\Rdx\Model\ResourceModel\Rdx');
    }
}
?>