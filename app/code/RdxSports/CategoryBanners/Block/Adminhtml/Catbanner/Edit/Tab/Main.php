<?php

namespace RdxSports\CategoryBanners\Block\Adminhtml\Catbanner\Edit\Tab;

/**
 * Catbanner edit form main tab
 */
class Main extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @var \RdxSports\CategoryBanners\Model\Status
     */
    protected $_status;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
        \Magento\Catalog\Helper\Category $category,
        \Magento\Catalog\Model\CategoryRepository $categoryRepository,
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        \RdxSports\CategoryBanners\Model\Status $status,
        array $data = []
    ) {
        $this->_systemStore = $systemStore;
        $this->_status = $status;
        parent::__construct($context, $registry, $formFactory, $data);
        $this->category = $category;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Prepare form
     *
     * @return $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareForm()
    {
        /* @var $model \RdxSports\CategoryBanners\Model\BlogPosts */
        $model = $this->_coreRegistry->registry('catbanner');

        $isElementDisabled = false;

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $form->setHtmlIdPrefix('page_');

        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Banner Information')]);

        if ($model->getId()) {
            $fieldset->addField('catbanners_id', 'hidden', ['name' => 'catbanners_id']);
        }

		$categories = $this->category->getStoreCategories();
        //$optionArray = $this->categories->toOptionArray();
        //$ChildCategoryValue = '';

        $ChildCategoryValue = array();
        foreach($categories as $category) {
        $ChildCategoryValue = array($category->getId() => $category->getName());
        }
//print_r($ChildCategoryValue);

        $fieldset->addField(
            'banner_title',
            'text',
            [
                'name' => 'banner_title',
                'label' => __('Banner Title'),
                'title' => __('Banner Title'),
				'required' => true,
                'disabled' => $isElementDisabled
            ]
        );
									
						
        $fieldset->addField(
            'banner_category',
            'select',
            [
                'label' => __('Select Category'),
                'title' => __('Select Category'),
                'name' => 'banner_category',
				'required' => true,
                'options' => $ChildCategoryValue,
                'disabled' => $isElementDisabled
            ]
        );
						
						
        $fieldset->addField(
            'banner_url',
            'text',
            [
                'name' => 'banner_url',
                'label' => __('Banner URL'),
                'title' => __('Banner URL'),
				'required' => true,
                'disabled' => $isElementDisabled
            ]
        );
									

        $fieldset->addField(
            'banner_image',
            'image',
            [
                'name' => 'banner_image',
                'label' => __('Banner Image'),
                'title' => __('Banner Image'),
				'required' => true,
                'disabled' => $isElementDisabled
            ]
        );
						
						

        if (!$model->getId()) {
            $model->setData('is_active', $isElementDisabled ? '0' : '1');
        }

        $form->setValues($model->getData());
        $this->setForm($form);
		
        return parent::_prepareForm();
    }

    /**
     * Prepare label for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabLabel()
    {
        return __('Item Information');
    }

    /**
     * Prepare title for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabTitle()
    {
        return __('Item Information');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
    
    public function getTargetOptionArray(){
    	return array(
    				'_self' => "Self",
					'_blank' => "New Page",
    				);
    }
}
