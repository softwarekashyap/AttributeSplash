<?php

/**
 * @author Kashyap Team
 * @copyright Copyright (c) 2018 Kashyap (http://kashyapsoftware.com/)
 * @package Kashyap_AttributeSplash
*/

namespace Kashyap\AttributeSplash\Model\Source;

/**
 * Class TopmenuLink
 *
 * @package Kashyap\AttributeSplash\Model\Source
 */
class TopmenuLink implements \Magento\Framework\Option\ArrayInterface
{
    const DISPLAY_FIRST = 1;
    const DISPLAY_LAST = 2;

    public function toOptionArray()
    {
        return [
            ['value' => 0, 'label' => __('No')],
            ['value' => 1, 'label' => __('Display First')],
            ['value' => 2, 'label' => __('Display Last')]
        ];
    }

    public function toArray()
    {
        return [0 => __('No'), 1 => __('Display First'), 2 => __('Display Last')];
    }
}
