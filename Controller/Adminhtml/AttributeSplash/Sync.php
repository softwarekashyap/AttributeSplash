<?php

/**
 * @author Kashyap Team
 * @copyright Copyright (c) 2018 Kashyap (http://kashyapsoftware.com/)
 * @package Kashyap_AttributeSplash
*/

namespace Kashyap\AttributeSplash\Controller\Adminhtml\AttributeSplash;

use Magento\Catalog\Model\Product\Url as ProductUrl;


/**
 * Class NewAction
 *
 * @package Kashyap\AttributeSplash\Controller\Adminhtml\AttributeSplash
 */
class Sync extends \Kashyap\AttributeSplash\Controller\Adminhtml\AttributeSplash
{

    protected $resultForwardFactory;
    
    
    /**
     * @var ProductUrl
     */
    private $productUrl;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Kashyap\AttributeSplash\Model\AttributeSplashFactory $attributeSplashFactory,
        \Kashyap\AttributeSplash\Helper\Data $attributeSplashHelper,
        ProductUrl $productUrl,
        \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory
    ) {
    	$this->_attributeSplashFactory = $attributeSplashFactory;
        $this->resultForwardFactory = $resultForwardFactory;
        $this->_attributeSplashHelper = $attributeSplashHelper;
        $this->productUrl = $productUrl;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * New action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $model = $this->_objectManager->create(
            'Magento\Catalog\Model\ResourceModel\Eav\Attribute'
        )->setEntityTypeId(
            \Magento\Catalog\Model\Product::ENTITY
        );
        $attributeSplashCode = $this->_attributeSplashHelper->getAttributeSplashCode();
        $model->loadByCode(\Magento\Catalog\Model\Product::ENTITY,$attributeSplashCode);

        foreach($model->getOptions() as $option)
        {
            if($option->getValue())
            { 
                $id = (int)$option->getValue();
                if ($id) {
                    $attributeId = '';
                    $allCollection = $this->_attributeSplashFactory->create()->getCollection(); 
                    $collection = $allCollection->addFieldToFilter('attribute_id' , $id)->getFirstItem();
                    
                    if($collection->getAttributeId() != $id){
                        $data = array(
                            'name' => $option->getLabel(),
                            'attribute_id' => $option->getValue(),
                            'url_key' => $this->productUrl->formatUrlKey($option->getLabel()),
                            'status' => 1,
                            'store_views' => 0,
                            'position' => 0,
                        );  
                        
                        $collection->setData($data);
                        
                        try{
                            $collection->save();
                            
                        } catch(\Exception $e) {
                        
                        }
                    }
                }
            }
        }
        $this->messageManager->addSuccess(__('Synchronized Successfully'));
        $this->_redirect('kashyap_attributesplash/*/');
    }
}