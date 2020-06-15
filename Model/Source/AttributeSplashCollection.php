<?php

/**
 * @author Kashyap Team
 * @copyright Copyright (c) 2018 Kashyap (http://kashyapsoftware.com/)
 * @package Kashyap_AttributeSplash
*/

namespace Kashyap\AttributeSplash\Model\Source;

use Magento\Catalog\Model\ResourceModel\Product\Attribute\CollectionFactory;
use Magento\Eav\Model\Entity\Attribute;

/**
 * Class AttributeSplashCollection
 *
 * @package Kashyap\AttributeSplash\Model\Source
 */
class AttributeSplashCollection implements \Magento\Framework\Option\ArrayInterface
{
    /** @var  CollectionFactory */
    protected $collectionFactory;

    public function __construct(CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options = [];
        foreach ($this->_getOptions() as $optionValue => $optionLabel) {
            $options[] = ['value' => $optionValue, 'label' => $optionLabel];
        }
        return $options;
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        return $this->_getOptions();
    }

    protected function _getOptions()
    {
        $collection = $this->collectionFactory->create();
        $collection->addIsFilterableFilter();
        $collection->addOrder('attribute_code', 'asc');

        $options = ['' => __('-- Empty --')];
        foreach ($collection->getItems() as $attribute) {
            /** @var Attribute $attribute */
            $options[$attribute->getAttributeCode()] = $attribute->getAttributeCode();
        }

        return $options;
    }
}
