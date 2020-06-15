<?php

/**
 * @author Kashyap Team
 * @copyright Copyright (c) 2018 Kashyap (http://kashyapsoftware.com/)
 * @package Kashyap_AttributeSplash
*/

namespace Kashyap\AttributeSplash\Controller\Adminhtml\AttributeSplash;

/**
 * Class Edit
 *
 * @package Kashyap\AttributeSplash\Controller\Adminhtml\AttributeSplash
 */
class Edit extends \Kashyap\AttributeSplash\Controller\Adminhtml\AttributeSplash
{

    protected $resultPageFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Edit action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('attributesplash_id');
        $model = $this->_objectManager->create(\Kashyap\AttributeSplash\Model\AttributeSplash::class);
        
        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This Attribute Splash no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $this->_coreRegistry->register('kashyap_attributesplash_attributesplash', $model);
        
        // 3. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Attribute Splash') : __('New Attribute Splash'),
            $id ? __('Edit Attribute Splash') : __('New Attribute Splash')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Attribute Splash'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? __('Edit %1', $model->getName()) : __('New Attribute Splash'));
        return $resultPage;
    }
}

