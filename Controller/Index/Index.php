<?php

/**
 * @author Kashyap Team
 * @copyright Copyright (c) 2018 Kashyap (http://kashyapsoftware.com/)
 * @package Kashyap_AttributeSplash
*/


namespace Kashyap\AttributeSplash\Controller\Index;

use Magento\Customer\Controller\AccountInterface;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Framework\App\Action\Action
{

    /**
     * @var \Magento\Framework\App\RequestInterface
     */
    protected $_request;

    /**
     * @var \Magento\Framework\App\ResponseInterface
     */
    protected $_response;

    /**
     * @var \Magento\Framework\Controller\Result\RedirectFactory
     */
    protected $resultRedirectFactory;

    /**
     * @var \Magento\Framework\Controller\ResultFactory
     */
    protected $resultFactory;

    /**
     * @var \Kashyap\AttributeSplash\Helper\Data
     */
    protected $_brandHelper;

    /**
     * @var \Magento\Framework\Controller\Result\ForwardFactory
     */
    protected $resultForwardFactory;

    /**
     * @param Context                                             $context              
     * @param \Magento\Store\Model\StoreManager                   $storeManager         
     * @param \Magento\Framework\View\Result\PageFactory          $resultPageFactory    
     * @param \Kashyap\AttributeSplash\Helper\Data            $attributeSplashHelper          
     * @param \Magento\Framework\Controller\Result\ForwardFactory $resultForwardFactory 
     */
    public function __construct(
        Context $context,
        \Magento\Store\Model\StoreManager $storeManager,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Kashyap\AttributeSplash\Helper\Data $attributeSplashHelper,
        \Magento\Framework\Controller\Result\ForwardFactory $resultForwardFactory
        ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->_attributeSplashHelper = $attributeSplashHelper;
        $this->resultForwardFactory = $resultForwardFactory;
        parent::__construct($context);
    }

    /**
     * Default customer account page
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        if(!$this->_attributeSplashHelper->getConfig('general_settings/enable')){
            return $this->resultForwardFactory->create()->forward('noroute');
        }
        
        $resultPageFactory = $this->resultPageFactory->create();

        // Add page title
        $resultPageFactory->getConfig()->getTitle()->set(__($this->_attributeSplashHelper->getConfig('general_settings/page_title')));

        // Add breadcrumb
        /** @var \Magento\Theme\Block\Html\Breadcrumbs */
        $breadcrumbs = $resultPageFactory->getLayout()->getBlock('breadcrumbs');
        $breadcrumbs->addCrumb('home', [
            'label' => __('Home'),
            'title' => __('Home'),
            'link' => $this->_url->getUrl('')
                ]
        );
        $breadcrumbs->addCrumb('designers', [
            'label' => __($this->_attributeSplashHelper->getConfig('general_settings/page_title')),
            'title' => __($this->_attributeSplashHelper->getConfig('general_settings/page_title'))
                ]
        );
        return $resultPageFactory;
    }
}