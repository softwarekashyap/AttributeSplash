<?php

/**
 * @author Kashyap Team
 * @copyright Copyright (c) 2018 Kashyap (http://kashyapsoftware.com/)
 * @package Kashyap_AttributeSplash
*/

namespace Kashyap\AttributeSplash\Controller\Adminhtml\AttributeSplash;

use Magento\Framework\Exception\LocalizedException;

/**
 * Class Save
 *
 * @package Kashyap\AttributeSplash\Controller\Adminhtml\AttributeSplash
 */
class Save extends \Magento\Backend\App\Action
{

    protected $dataPersistor;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Kashyap\AttributeSplash\Model\ImageUploader $imageUploader,
        \Kashyap\AttributeSplash\Model\AttributeSplashFactory $attributeSplashCollection,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->imageUploader = $imageUploader;
        $this->_attributeSplashCollection = $attributeSplashCollection;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        
        if ($data) {
            $id = $this->getRequest()->getParam('attributesplash_id');
        
            $model = $this->_objectManager->create(\Kashyap\AttributeSplash\Model\AttributeSplash::class)->load($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This Attribute Splash no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }
            
            $urlKey = $data['url_key'];
            if($id){
                $collection = $this->_attributeSplashCollection->create()->getCollection();
                $collection = $collection->addFieldToFilter('url_key' , $urlKey)->getFirstItem();
                
            } else {
                $collection = $this->_attributeSplashCollection->create()->getCollection();
                $collection = $collection->addFieldToFilter('url_key' , $urlKey)->getFirstItem();
            }
            
            if($collection->getAttributesplashId() !='' &&  $id != $collection->getAttributesplashId()){
                $this->messageManager->addErrorMessage(__('URL Key Should be Unique.'));
                $this->dataPersistor->set('kashyap_attributesplash_attributesplash', $data);
                return $resultRedirect->setPath('*/*/edit', ['attributesplash_id' => $this->getRequest()->getParam('attributesplash_id')]);
                
            }
            
            if ($data['store_views']) {
                $data['store_views'] = implode(',', $data['store_views']);
            }
            
            if (isset($data['thumbnail'][0]['name']) && isset($data['thumbnail'][0]['tmp_name'])) {
                $data['thumbnail'] = $data['thumbnail'][0]['name'];
                $this->imageUploader->moveFileFromTmp($data['thumbnail']);
                
            } elseif (isset($data['thumbnail'][0]['name']) && !isset($data['image'][0]['tmp_name'])) {
                $data['thumbnail'] = $data['thumbnail'][0]['name'];
                
            } else {
                $data['thumbnail'] = null;
            }
            
            $model->setData($data);
        
            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('You saved the Attribute Splash.'));
                $this->dataPersistor->clear('kashyap_attributesplash_attributesplash');
        
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['attributesplash_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Attribute Splash.'));
            }
        
            $this->dataPersistor->set('kashyap_attributesplash_attributesplash', $data);
            return $resultRedirect->setPath('*/*/edit', ['attributesplash_id' => $this->getRequest()->getParam('attributesplash_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}

