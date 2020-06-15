<?php

/**
 * @author Kashyap Team
 * @copyright Copyright (c) 2018 Kashyap (http://kashyapsoftware.com/)
 * @package Kashyap_AttributeSplash
*/

namespace Kashyap\AttributeSplash\Model\AttributeSplash;

use Kashyap\AttributeSplash\Model\ResourceModel\AttributeSplash\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;

/**
 * Class DataProvider
 *
 * @package Kashyap\AttributeSplash\Model\AttributeSplash
 */
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{

    protected $dataPersistor;

    protected $loadedData;
    protected $collection;


    /**
     * Constructor
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        DataPersistorInterface $dataPersistor,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        $this->_storeManager=$storeManager;
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        $baseurl =  $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA).'attributesplash/';
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        
        $items = $this->collection->getItems();
        foreach ($items as $model) {
            $this->loadedData[$model->getId()] = $model->getData();
            
            $temp = $model->getData();
            $img = [];
            $img[0]['name'] = $temp['thumbnail'];
            $img[0]['url'] = $baseurl.$temp['thumbnail'];
            $temp['thumbnail'] = $img;
        }
        $data = $this->dataPersistor->get('kashyap_attributesplash_attributesplash');
        
        if (!empty($data)) {
            $model = $this->collection->getNewEmptyItem();
            $model->setData($data);
            $this->loadedData[$model->getId()] = $model->getData();
            $this->dataPersistor->clear('kashyap_attributesplash_attributesplash');
        }
        
        if (empty($this->loadedData)) {
            return $this->loadedData;
        } else {
            if ($model->getData('thumbnail') != null) {
                $t2[$model->getId()] = $temp;
                return $t2;
            } else {
                return $this->loadedData;
            }
        }
        
        return $this->loadedData;
    }
}