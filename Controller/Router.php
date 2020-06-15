<?php

/**
 * @author Kashyap Team
 * @copyright Copyright (c) 2018 Kashyap (http://kashyapsoftware.com/)
 * @package Kashyap_AttributeSplash
*/

namespace Kashyap\AttributeSplash\Controller;

use Magento\Framework\App\RouterInterface;
use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\DataObject;
use Magento\Framework\Event\ManagerInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Url;

class Router implements RouterInterface
{
    /**
     * @var \Magento\Framework\App\ActionFactory
     */
    protected $actionFactory;

    /**
     * Event manager
     * @var \Magento\Framework\Event\ManagerInterface
     */
    protected $eventManager;

    /**
     * Response
     * @var \Magento\Framework\App\ResponseInterface
     */
    protected $response;

    /**
     * @var bool
     */
    protected $dispatched;

    /**
     * AttributeSplash Factory
     *
     * @var \Kashyap\AttributeSplash\Model\AttributeSplash $attributeSplashCollection
     */
    protected $_attributeSplashCollection;

    /**
     * AttributeSplash Helper
     */
    protected $_attributeSplashHelper;

    /**
     * Store manager
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @param ActionFactory          								$actionFactory   
     * @param ResponseInterface      								$response        
     * @param ManagerInterface       								$eventManager    
     * @param \Kashyap\AttributeSplash\Model\AttributeSplash  	$attributeSplashCollection 
     * @param \Kashyap\AttributeSplash\Helper\Data  			$attributeSplashHelper     
     * @param StoreManagerInterface  								$storeManager    
     */
    public function __construct(
    	ActionFactory $actionFactory,
    	ResponseInterface $response,
        ManagerInterface $eventManager,
        \Kashyap\AttributeSplash\Model\AttributeSplashFactory $attributeSplashCollection,
        \Kashyap\AttributeSplash\Helper\Data $attributeSplashHelper,
        StoreManagerInterface $storeManager
        )
    {
    	$this->actionFactory = $actionFactory;
        $this->eventManager = $eventManager;
        $this->response = $response;
        $this->_attributeSplashHelper = $attributeSplashHelper;
        $this->_attributeSplashCollection = $attributeSplashCollection;
        $this->storeManager = $storeManager;
        $this->attributeSplashCode = $attributeSplashHelper->getAttributeSplashCode();
    }
    /**
     * @param RequestInterface $request
     * @return \Magento\Framework\App\ActionInterface
     */
    public function match(RequestInterface $request)
    {
       $result = "";
       $identifier = trim($request->getPathInfo() , '/');
       $istUrlCollection = $this->isExistUrl($identifier);
       
       if(($this->isExistUrlKey($identifier)) && ($istUrlCollection)){
           $this->setAttributeSplashIdentifier($identifier);
            $request->setModuleName('attributesplash')
                ->setControllerName('view')
                ->setActionName('index')
                ->setParam('id', $istUrlCollection['attribute_id']);
            $request->setAlias(\Magento\Framework\Url::REWRITE_REQUEST_PATH_ALIAS, $identifier);
            $request->setAlias(\Magento\Framework\UrlInterface::REWRITE_REQUEST_PATH_ALIAS, '/' . $identifier);
            $request->setPathInfo('/' . $identifier);
            return;
            /*$params = array_merge($request->getParams(), $istUrlCollection['attribute_id']);
            $request->setParams($params);*/
        
       }
       return $result;
    }
    
   
    /**
     * @param RequestInterface $request
     *
     * @return string
     */
    private function getPath(RequestInterface $request)
    {
        $identifier = trim($request->getPathInfo(), '/');
        $suffix = $this->_attributeSplashHelper->getConfig('general_settings/url_suffix');
        if (!empty($suffix) && strpos($identifier, $suffix) !== false) {
            $suffixPosition = strrpos($identifier, $suffix);
            if ($suffixPosition !== false && $suffixPosition == strlen($identifier) - strlen($suffix)) {
                $identifier = substr($identifier, 0, $suffixPosition);
            }
        }

        return $identifier;
    }

    /**
     * @param string $identifier
     *
     * @return string
     */
    private function setAttributeSplashIdentifier($identifier)
    {
        $attributeSplashUrlKey = $this->_attributeSplashHelper->getConfig('general_settings/route');
        $identifier = trim($identifier, '/');

        if (!empty($attributeSplashUrlKey) && strpos($identifier, $attributeSplashUrlKey . '/') === 0) {
            $identifier = ltrim(substr($identifier, strlen($attributeSplashUrlKey . '/')), '/');
        }

        return $identifier;
    }
    
      /**
     * @param string $identifier
     *
     * @return bool
     */
    private function isExistUrlKey($identifier)
    {
        $attributeSplashUrlKey = $this->_attributeSplashHelper->getConfig('general_settings/route');

        return $attributeSplashUrlKey ? strpos($identifier, $attributeSplashUrlKey) !== false : true;
    }
    
    private function isExistUrl($identifier)
    {   
        $urlKey = $identifier;
        $attributeSplashUrlKey = $this->_attributeSplashHelper->getConfig('general_settings/route');
        $attributeSplashUrlSuffix = $this->_attributeSplashHelper->getConfig('general_settings/url_suffix');
        if($attributeSplashUrlKey){
            $identifiers = explode('/',$identifier);
            if(isset($identifiers[1])){
                $urlKey = $identifiers[1];
            }
        }
        
        if($attributeSplashUrlSuffix){
            $identifiers = explode('/',$identifier);
            if(isset($identifiers[1])){
                $identifier = $identifiers[1];
                $identifiersSuffix = explode('.',$identifier);
                if(isset($identifiersSuffix[0])){
                    $urlKey = $identifiersSuffix[0];
                }
            }
        }
        
        $collection = $this->_attributeSplashCollection->create()->getCollection();
        $collection = $collection->addFieldToFilter('url_key' , $urlKey);
		$collection->addFieldToFilter('status' , \Kashyap\AttributeSplash\Model\Status::STATUS_ENABLED);
		$collection->addFieldToFilter('store_views', array('in' => array(0,$this->storeManager->getStore()->getId())));

        if (is_object($collection)){
            return $collection->getFirstItem()->getData();
        }
        
        return array();
    }
}