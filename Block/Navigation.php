<?php

/**
 * @author Kashyap Team
 * @copyright Copyright (c) 2018 Kashyap (http://kashyapsoftware.com/)
 * @package Kashyap_AttributeSplash
*/

namespace Kashyap\AttributeSplash\Block;

class Navigation extends \Magento\LayeredNavigation\Block\Navigation
{
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Kashyap\AttributeSplash\Model\Layer\Resolver $layerResolver,
        \Magento\Catalog\Model\Layer\FilterList $filterList,
        \Magento\Catalog\Model\Layer\AvailabilityFlagInterface $visibilityFlag,
        array $data = []
    ) {
        parent::__construct($context, $layerResolver, $filterList,
            $visibilityFlag);
    }
}