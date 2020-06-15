<?php

/**
 * @author Kashyap Team
 * @copyright Copyright (c) 2018 Kashyap (http://kashyapsoftware.com/)
 * @package Kashyap_AttributeSplash
*/

namespace Kashyap\AttributeSplash\Helper;

use Magento\Catalog\Model\Product\Attribute\Repository as AttributeRepository;
use Magento\Catalog\Model\Product\Url as ProductUrl;
use Magento\Framework\Data\Collection\AbstractDb;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{

    /** @var \Magento\Store\Model\StoreManagerInterface */
    protected $_storeManager;

    /**
     * @var OptionCollectionFactory
     */
    private $optionCollectionFactory;

    /**
     * @var ProductUrl
     */
    private $productUrl;
    
    /**
     * AttributeSplashAliases config node per website
     *
     * @var array
     */
    protected $_config = [];

    /**
     * Template filter factory
     *
     * @var \Magento\Catalog\Model\Template\Filter\Factory
     */
    protected $_templateFilterFactory;

    /**
     * @var \Magento\Cms\Model\Template\FilterProvider
     */
    protected $_filterProvider;
    
    /**
     * @var AttributeRepository
     */
    private $attributeRepository;

    protected $_request;
    
    public $attributeSplashCoolection;

    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Kashyap\AttributeSplash\Model\AttributeSplashFactory $attributeSplashCoolection,
        AttributeRepository $repository,
        ProductUrl $productUrl,
        \Magento\Cms\Model\Template\FilterProvider $filterProvider,
        \Magento\Framework\Registry $frameworkRegistry
        ) {
        parent::__construct($context);
        $this->_filterProvider              = $filterProvider;
        $this->_storeManager                = $storeManager;
        $this->attributeRepository          = $repository;
        $this->productUrl                   = $productUrl;
        $this->_attributeSplashCoolection   = $attributeSplashCoolection;
        $this->_request                     = $context->getRequest();
        $this->_frameworkRegistry           = $frameworkRegistry;
    }

    /**
     * Return AttributeSplashAliases config value by key and store
     *
     * @param string $key
     * @param \Magento\Store\Model\Store|int|string $store
     * @return string|null
     */
    public function getConfig($key, $store = null)
    {
        $store = $this->_storeManager->getStore($store);
        $websiteId = $store->getWebsiteId();

        $result = $this->scopeConfig->getValue(
            'attributesplash/'.$key,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $store);
        return $result;
    }

    public function filter($str)
    {
        $html = $this->_filterProvider->getPageFilter()->filter($str);
        return $html;
    }

    public function getSearchFormUrl(){
        $url        = $this->_storeManager->getStore()->getBaseUrl();
        $url_prefix = $this->getConfig('general_settings/url_prefix');
        
        $urlPrefix  = '';
        if ($url_prefix) {
            $urlPrefix = $url_prefix . '/';
        }
        return $url . $urlPrefix . 'search';
    }
    
    public function getSearchKey(){
        return $this->_request->getParam('s');
    }
    
    public function getRequestId(){
        return $this->_request->getParam('id');
    }
    
    /**
     * @return string
     */
    public function getAttributeSplashCode()
    {
        return $this->getConfig('general_settings/attribute_code');
    }
    
    /**
     * @return string
     */
    public function getAttributeSplashURL($urlKey)
    {
        $urlRoute = $this->getConfig('general_settings/route');
        $urlSuffix = $this->getConfig('general_settings/url_suffix');
        if($urlRoute){
            $urlKey = $urlRoute ."/". $urlKey;
        }
        if($urlSuffix){
            $urlKey = $urlKey . $urlSuffix;
        }
        return $this->_storeManager->getStore()->getBaseUrl().$urlKey;
    }
    
    public function getAttributeSplashImageURL($imgName)
    {
        if($imgName){
            return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA).'attributesplash/'.$imgName;
        }
    }
    
        
    public function getAttributeCollection($attributeId)
    {
        $model = $this->_attributeSplashCoolection->create()->getCollection();
		$model->addFieldToFilter('status' , \Kashyap\AttributeSplash\Model\Status::STATUS_ENABLED);
		$model->addFieldToFilter('store_views', array('in' => array(0,$this->_storeManager->getStore()->getId())));
        /*$model->addFieldToSelect('name');
        $model->addFieldToSelect('page_title');
        $model->addFieldToSelect('meta_keywords');
        $model->addFieldToSelect('meta_description');
        $model->addFieldToSelect('thumbnail');*/
        $model->addFieldToFilter('attribute_id',$attributeId);
        return $attributeClolection = $model->getFirstItem();
    }
    
    public function getNameLink($_product)
    {
        $splashCode = $this->getAttributeSplashCode();
        $attributeId = $_product->getDataByKey($splashCode);
        if($attributeId){
            $collection = $this->getAttributeCollection($attributeId);
            return '<a href="'. $this->getAttributeSplashURL($collection->getUrlKey()).'">'.$collection->getName().'</a>';
        }
    }
    
    public function getCurrentProduct()
    {
         return  $this->_frameworkRegistry->registry('current_product');
    }
}