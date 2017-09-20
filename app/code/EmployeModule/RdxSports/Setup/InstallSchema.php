<?php

namespace EmployeModule\RdxSports\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\DB\Adapter\AdapterInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        if (version_compare($context->getVersion(), '1.0.0') < 0){

		$installer->run('create table emp(emp_id int not null auto_increment, name varchar(100),
email varchar(100),
department varchar(100),
 primary key(emp_id))');
$installer->run('insert into emp values(null,\'maaz\',\'m.maaz@rdxsports.com\',\'Software Development\')');
$installer->run('insert into emp values(null,\'waleed\',\'waleed@rdxsports.com\',\'Software Development\')');


		//demo 
//$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
//$scopeConfig = $objectManager->create('Magento\Framework\App\Config\ScopeConfigInterface');
//demo 

		}

        $installer->endSetup();

    }
}