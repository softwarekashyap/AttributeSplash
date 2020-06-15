<?php

/**
 * @author Kashyap Team
 * @copyright Copyright (c) 2018 Kashyap (http://kashyapsoftware.com/)
 * @package Kashyap_AttributeSplash
*/

namespace Kashyap\AttributeSplash\Model;

use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Catalog\Model\ResourceModel\Product\Attribute\CollectionFactory as AttributeCollectionFactory;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;

class Layer extends \Magento\Catalog\Model\Layer
{
    protected $_request;

    public function __construct(
        \Magento\Catalog\Model\Layer\ContextInterface $context,
        \Magento\Catalog\Model\Layer\StateFactory $layerStateFactory,
        AttributeCollectionFactory $attributeCollectionFactory,
        \Magento\Catalog\Model\ResourceModel\Product $catalogProduct,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Registry $registry,
        CategoryRepositoryInterface $categoryRepository,
        CollectionFactory $productCollectionFactory,
        \Magento\Framework\App\Request\Http $request,
        \Kashyap\AttributeSplash\Model\AttributeSplashFactory $attributeSplashCoolection,
        \Kashyap\AttributeSplash\Helper\Data $attributeSplashHelper,
        array $data = []
    ) {
       
        $this->productCollectionFactory = $productCollectionFactory;
        $this->attributeSplashCoolection = $attributeSplashCoolection;
        $this->_attributeSplashHelper = $attributeSplashHelper;
        $this->_request = $request;
        parent::__construct(
            $context,
            $layerStateFactory,
            $attributeCollectionFactory,
            $catalogProduct,
            $storeManager,
            $registry,
            $categoryRepository,
            $data
        );
    }

    public function getAttributeSplash()
    { 
        $attributeSplash_params = $this->_request->getParams();
        $id = $this->_request->getParam('id');
        if($id) {
            $model = $this->attributeSplashCoolection->create()->getCollection(); 
            $attributeSplashCode = $this->_attributeSplashHelper->getAttributeSplashCode();
            $model->addFieldToFilter('attribute_id',$id);
            return $model->getFirstItem();
        }
        return false;
    }

    public function getProductCollection()
    {     
        //here you assign your own custom collection of products
        $collection = $this->productCollectionFactory->create();
        $this->prepareProductCollection($collection);
        $attributeSplashCode = $this->_attributeSplashHelper->getAttributeSplashCode();

        $attributeSplash = $this->getAttributeSplash();
       
        $collection->addAttributeToSelect('*');
        $collection->addAttributeToSelect('name');
        $collection->addStoreFilter()->addAttributeToFilter($attributeSplashCode , $attributeSplash->getAttributeId());
        
        $collection->addAttributeToFilter('status', Status::STATUS_ENABLED);
        $collection->addAttributeToFilter('visibility', array('neq' => \Magento\Catalog\Model\Product\Visibility::VISIBILITY_NOT_VISIBLE));
        
  
        return $collection;
    }

}