<?php


/**
 * @author Kashyap Team
 * @copyright Copyright (c) 2018 Kashyap (http://kashyapsoftware.com/)
 * @package Kashyap_AttributeSplash
*/

namespaceKashyap\AttributeSplash\Plugin\Block\Html;

use Amasty\ShopbyBrand\Model\Source\TopmenuLink as TopmenuSource;

/**
 * Class TopmenuLast
 *
 * @package Amasty\ShopbyBrand\Plugin\Block\Html
 */
class TopmenuLast extends \Amasty\ShopbyBrand\Plugin\Block\Html\Topmenu
{
    /**
     * @return int
     */
    protected function getPosition()
    {
        return TopmenuSource::DISPLAY_LAST;
    }
}
