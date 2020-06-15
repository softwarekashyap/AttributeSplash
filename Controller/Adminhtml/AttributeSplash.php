<?php

/**
 * @author Kashyap Team
 * @copyright Copyright (c) 2018 Kashyap (http://kashyapsoftware.com/)
 * @package Kashyap_AttributeSplash
*/

namespace Kashyap\AttributeSplash\Controller\Adminhtml;

/**
 * Class AttributeSplash
 *
 * @package Kashyap\AttributeSplash\Controller\Adminhtml
 */
abstract class AttributeSplash extends \Magento\Backend\App\Action
{

    const ADMIN_RESOURCE = 'Kashyap_AttributeSplash::top_level';
    protected $_coreRegistry;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry
    ) {
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context);
    }

    /**
     * Init page
     *
     * @param \Magento\Backend\Model\View\Result\Page $resultPage
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function initPage($resultPage)
    {
        $resultPage->setActiveMenu(self::ADMIN_RESOURCE)
            ->addBreadcrumb(__('Kashyap'), __('Kashyap'))
            ->addBreadcrumb(__('Attribute Splash'), __('Attribute Splash'));
        return $resultPage;
    }
}

