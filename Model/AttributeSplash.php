<?php

/**
 * @author Kashyap Team
 * @copyright Copyright (c) 2018 Kashyap (http://kashyapsoftware.com/)
 * @package Kashyap_AttributeSplash
*/

namespace Kashyap\AttributeSplash\Model;

use Kashyap\AttributeSplash\Api\Data\AttributeSplashInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;
use Kashyap\AttributeSplash\Api\Data\AttributeSplashInterface;

/**
 * Class AttributeSplash
 *
 * @package Kashyap\AttributeSplash\Model
 */
class AttributeSplash extends \Magento\Framework\Model\AbstractModel
{

    protected $_eventPrefix = 'kashyap_attributesplash_attributesplash';
    protected $dataObjectHelper;

    protected $attributesplashDataFactory;


    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param AttributeSplashInterfaceFactory $attributesplashDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \Kashyap\AttributeSplash\Model\ResourceModel\AttributeSplash $resource
     * @param \Kashyap\AttributeSplash\Model\ResourceModel\AttributeSplash\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        AttributeSplashInterfaceFactory $attributesplashDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Kashyap\AttributeSplash\Model\ResourceModel\AttributeSplash $resource,
        \Kashyap\AttributeSplash\Model\ResourceModel\AttributeSplash\Collection $resourceCollection,
        array $data = []
    ) {
        $this->attributesplashDataFactory = $attributesplashDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve attributesplash model with attributesplash data
     * @return AttributeSplashInterface
     */
    public function getDataModel()
    {
        $attributesplashData = $this->getData();
        
        $attributesplashDataObject = $this->attributesplashDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $attributesplashDataObject,
            $attributesplashData,
            AttributeSplashInterface::class
        );
        
        return $attributesplashDataObject;
    }
}

