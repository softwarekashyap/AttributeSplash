<?php

/**
 * @author Kashyap Team
 * @copyright Copyright (c) 2018 Kashyap (http://kashyapsoftware.com/)
 * @package Kashyap_AttributeSplash
*/


namespace Kashyap\AttributeSplash\Block;

/**
 * Class AttributeSplash
 *
 * @package Kashyap\AttributeSplash\Block
 */
class AttributeSplash extends \Magento\Framework\View\Element\Template
{

    protected $_attributeSplashFactory;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager, 
        \Kashyap\AttributeSplash\Helper\Data $helper,
        \Kashyap\AttributeSplash\Model\AttributeSplashFactory $attributeSplashFactory
    ) 
    {
    	$this->_attributeSplashFactory = $attributeSplashFactory;
        $this->_storeManager = $storeManager; 
        $this->_helper = $helper; 
        parent::__construct($context);
    }
    
    
    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }
    
    public function getAttributeSplashs(){
		$collection = $this->_attributeSplashFactory->create()->getCollection();
		$collection->addFieldToFilter('status' , \Kashyap\AttributeSplash\Model\Status::STATUS_ENABLED);
		$collection->addFieldToFilter('store_views', array('in' => array(0,$this->_storeManager->getStore()->getId())));
		$collection->setOrder('name' , 'ASC');
		$charBarndArray = array();
		foreach($collection as $brand)
		{	
			$name = trim($brand->getName());
			$charBarndArray[strtoupper($name[0])][] = $brand;
		}
		
    	return $charBarndArray;
    }
    
    public function getImageMediaPath(){
    	return $this->getUrl('pub/media',['_secure' => $this->getRequest()->isSecure()]);
    }
    
    public function getAttributeSplashImageURL($imgName)
    {
        return $this->_helper->getAttributeSplashImageURL($imgName);
    }
    
    public function getFeaturedAttributeSplashs(){
		$collection = $this->_attributeSplashFactory->create()->getCollection();
		$collection->addFieldToFilter('status' , \Kashyap\AttributeSplash\Model\Status::STATUS_ENABLED);
		$collection->addFieldToFilter('featured' , \Kashyap\AttributeSplash\Model\Status::STATUS_ENABLED);
		$collection->addFieldToFilter('store_views', array('in' => array(0,$this->_storeManager->getStore()->getId())));
		$collection->setOrder('position' , 'ASC');
    	return $collection;
    }
    
    public function getAttributeSplashsSidebar(){
		$collection = $this->_attributeSplashFactory->create()->getCollection();
		$collection->addFieldToFilter('status' , \Kashyap\AttributeSplash\Model\Status::STATUS_ENABLED);
		$collection->addFieldToFilter('featured' , \Kashyap\AttributeSplash\Model\Status::STATUS_ENABLED);
		$collection->addFieldToFilter('thumbnail', ['neq' => 'NULL']);
		$collection->addFieldToFilter('store_views', array('in' => array(0,$this->_storeManager->getStore()->getId())));
		$collection->addFieldToSelect('name');
		$collection->addFieldToSelect('url_key');
		$collection->addFieldToSelect('thumbnail');
		$collection->addFieldToSelect('description');
		$collection->addFieldToSelect('short_description');
		$collection->setOrder('position' , 'ASC');
    	return $collection;
    }
    
    
    public function getAttributeSplashURL($urlKey)
    {
        return $this->_helper->getAttributeSplashURL($urlKey);
    }
    
    public function getAttributeCollection()
    {
        $requestId = $this->_helper->getRequestId();
        if($requestId){
            return $this->_helper->getAttributeCollection($requestId);
        }
        return array();
    }
    
    public function getCurrentAttributeSplas()
	{
	    $_product = $this->getCurrentProduct();
	    $splashCode = $this->_helper->getAttributeSplashCode();
        $attributeId = $_product->getDataByKey($splashCode);
	    if($attributeId){
            return $this->_helper->getAttributeCollection($attributeId);
        }
	}
	public function getCurrentProduct()
	{
	    return $this->_helper->getCurrentProduct();
	}

    /**
     * @return string
     */
    public function Index()
    {
        return __('Hello Developer! This how to get the storename: %1 and this is the way to build a url: %2', $this->_storeManager->getStore()->getName(), $this->getUrl('contacts'));
    }
}