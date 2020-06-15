<?php

/**
 * @author Kashyap Team
 * @copyright Copyright (c) 2018 Kashyap (http://kashyapsoftware.com/)
 * @package Kashyap_AttributeSplash
*/

namespace Kashyap\AttributeSplash\Block\Navigation;

class State extends \Magento\LayeredNavigation\Block\Navigation\State
{
	public function __construct(
		\Magento\Framework\View\Element\Template\Context $context,
		\Kashyap\AttributeSplash\Model\Layer\Resolver $layerResolver,
		array $data = []
	) {
		parent::__construct($context, $layerResolver, $data);
    }
}