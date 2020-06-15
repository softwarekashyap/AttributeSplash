<?php

/**
 * @author Kashyap Team
 * @copyright Copyright (c) 2018 Kashyap (http://kashyapsoftware.com/)
 * @package Kashyap_AttributeSplash
*/

namespace Kashyap\AttributeSplash\Controller\View;

use Magento\Framework\App\Action\Context;

class Index extends \Magento\Framework\App\Action\Action
{
    
    public function __construct(
        Context $context,
        \Magento\Store\Model\StoreManager $storeManager,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Kashyap\AttributeSplash\Helper\Data $attributeSplashHelper,
        \Magento\Framework\App\Request\Http $request,
        \Magento\Framework\Controller\Result\ForwardFactory $resultForwardFactory
        ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->_attributeSplashHelper = $attributeSplashHelper;
        $this->resultForwardFactory = $resultForwardFactory;
        $this->_request = $request;
        parent::__construct($context);
    }
    
    public function execute()
    {
        $attributeId = $this->_request->getParam('id');
        $attributeClolection = $this->_attributeSplashHelper->getAttributeCollection($attributeId);
        
        $resultPageFactory = $this->resultPageFactory->create();
        if($attributeClolection){
            // Add page title
            $resultPageFactory->getConfig()->getTitle()->set(__($attributeClolection->getPageTitle()));
            $resultPageFactory->getConfig()->setDescription(__($attributeClolection->getMetaDescription()));
            $resultPageFactory->getConfig()->setKeywords(__($attributeClolection->getMetaKeywords()));
    
            // Add breadcrumb
            /** @var \Magento\Theme\Block\Html\Breadcrumbs */
            $breadcrumbs = $resultPageFactory->getLayout()->getBlock('breadcrumbs');
            $breadcrumbs->addCrumb('home', [
                'label' => __('Home'),
                'title' => __('Home'),
                'link' => $this->_url->getUrl('')
                    ]
            );
            $breadcrumbs->addCrumb('all designers', [
                'label' => __('All designers'),
                'title' => __('All designers'),
                'link' => $this->_url->getUrl('attributesplash')
                    ]
            );
            $breadcrumbs->addCrumb('designers', [
                'label' => __($attributeClolection->getName()),
                'title' => __($attributeClolection->getName())
                    ]
            );
        }
        return $resultPageFactory;
        
    }
    
}