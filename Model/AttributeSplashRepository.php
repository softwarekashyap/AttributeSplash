<?php

/**
 * @author Kashyap Team
 * @copyright Copyright (c) 2018 Kashyap (http://kashyapsoftware.com/)
 * @package Kashyap_AttributeSplash
*/

namespace Kashyap\AttributeSplash\Model;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Exception\CouldNotSaveException;
use Kashyap\AttributeSplash\Api\Data\AttributeSplashSearchResultsInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Kashyap\AttributeSplash\Api\AttributeSplashRepositoryInterface;
use Kashyap\AttributeSplash\Api\Data\AttributeSplashInterfaceFactory;
use Kashyap\AttributeSplash\Model\ResourceModel\AttributeSplash\CollectionFactory as AttributeSplashCollectionFactory;
use Kashyap\AttributeSplash\Model\ResourceModel\AttributeSplash as ResourceAttributeSplash;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;

/**
 * Class AttributeSplashRepository
 *
 * @package Kashyap\AttributeSplash\Model
 */
class AttributeSplashRepository implements AttributeSplashRepositoryInterface
{

    protected $searchResultsFactory;

    protected $dataObjectHelper;

    protected $dataObjectProcessor;

    protected $attributeSplashFactory;

    protected $attributeSplashCollectionFactory;

    protected $extensionAttributesJoinProcessor;

    protected $dataAttributeSplashFactory;

    private $collectionProcessor;

    protected $resource;

    private $storeManager;

    protected $extensibleDataObjectConverter;

    /**
     * @param ResourceAttributeSplash $resource
     * @param AttributeSplashFactory $attributeSplashFactory
     * @param AttributeSplashInterfaceFactory $dataAttributeSplashFactory
     * @param AttributeSplashCollectionFactory $attributeSplashCollectionFactory
     * @param AttributeSplashSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceAttributeSplash $resource,
        AttributeSplashFactory $attributeSplashFactory,
        AttributeSplashInterfaceFactory $dataAttributeSplashFactory,
        AttributeSplashCollectionFactory $attributeSplashCollectionFactory,
        AttributeSplashSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->attributeSplashFactory = $attributeSplashFactory;
        $this->attributeSplashCollectionFactory = $attributeSplashCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataAttributeSplashFactory = $dataAttributeSplashFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Kashyap\AttributeSplash\Api\Data\AttributeSplashInterface $attributeSplash
    ) {
        /* if (empty($attributeSplash->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $attributeSplash->setStoreId($storeId);
        } */
        
        $attributeSplashData = $this->extensibleDataObjectConverter->toNestedArray(
            $attributeSplash,
            [],
            \Kashyap\AttributeSplash\Api\Data\AttributeSplashInterface::class
        );
        
        $attributeSplashModel = $this->attributeSplashFactory->create()->setData($attributeSplashData);
        
        try {
            $this->resource->save($attributeSplashModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the Attribute Splash: %1',
                $exception->getMessage()
            ));
        }
        return $attributeSplashModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function get($attributeSplashId)
    {
        $attributeSplash = $this->attributeSplashFactory->create();
        $this->resource->load($attributeSplash, $attributeSplashId);
        if (!$attributeSplash->getId()) {
            throw new NoSuchEntityException(__('Attribute Splash with id "%1" does not exist.', $attributeSplashId));
        }
        return $attributeSplash->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->attributeSplashCollectionFactory->create();
        
        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \Kashyap\AttributeSplash\Api\Data\AttributeSplashInterface::class
        );
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \Kashyap\AttributeSplash\Api\Data\AttributeSplashInterface $attributeSplash
    ) {
        try {
            $attributeSplashModel = $this->attributeSplashFactory->create();
            $this->resource->load($attributeSplashModel, $attributeSplash->getAttributesplashId());
            $this->resource->delete($attributeSplashModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Attribute Splash: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($attributeSplashId)
    {
        return $this->delete($this->get($attributeSplashId));
    }
}

