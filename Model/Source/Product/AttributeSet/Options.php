<?php

/**
 * @author Kashyap Team
 * @copyright Copyright (c) 2018 Kashyap (http://kashyapsoftware.com/)
 * @package Kashyap_AttributeSplash
*/

namespace Kashyap\AttributeSplash\Model\Source\Product\AttributeSet;

use Magento\Framework\Data\OptionSourceInterface;
use Magento\Catalog\Model\ResourceModel\Eav\Attribute;
use Magento\Framework\App\RequestInterface;

class Options implements OptionSourceInterface
{
       /**
     * @var Magento\Catalog\Model\ResourceModel\Eav\Attribute
     */
    protected $attribute;

    /**
     * @var RequestInterface
     */
    protected $request;


    /**
     * @param AttributeSplashFactory $attributeSplashFactory
     * @param RequestInterface $request
     */
    public function __construct(
        Attribute $attribute,
        \Kashyap\AttributeSplash\Helper\Data $attributeSplashHelper,
        RequestInterface $request
    ) {
        $this->_attribute = $attribute;
        $this->_attributeSplashHelper = $attributeSplashHelper;
        $this->request = $request;
    }

    /**
     * {@inheritdoc}
     */
    public function toOptionArray()
    {
        $attributeSplashCode = $this->_attributeSplashHelper->getAttributeSplashCode();
        return $this->getAttributeSplashCollection($attributeSplashCode);
    }

    /**
     * Retrieve categories tree
     *
     * @return array
     */
    protected function getAttributeSplashCollection($attributeSplashCode)
    {
        $storeId = $this->request->getParam('store');
        $model = $this->_attribute->loadByCode(\Magento\Catalog\Model\Product::ENTITY,$attributeSplashCode);
        $options = [];
        $options[] = ["label" => 'Select Attribute Option', 'value' => ''];
        foreach($model->getOptions() as $option)
        {
            if($option->getValue()) { 
                $attibuteIds[$option->getValue()] = $option->getLabel();
                $options[] = [
                    'label' => $option->getLabel(),
                    'value' => $option->getValue(),
                ];
            }
        }
        return $options;
    }
}