<?php
namespace Emipro\Blog\Controller\Adminhtml\Grid;
 
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\App\Action;
class Index extends Action
{
   
    protected $resultPageFactory;
 
   
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
       
    }
 
   
    public function execute()
    {
       
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Emipro_Blog::grid');
        $resultPage->addBreadcrumb(__('CMS'), __('CMS'));
        $resultPage->addBreadcrumb(__('Manage Grid View'), __('Manage Grid View'));
        $resultPage->getConfig()->getTitle()->prepend(__('Manage  Blog'));
 
        return $resultPage;
    }
}