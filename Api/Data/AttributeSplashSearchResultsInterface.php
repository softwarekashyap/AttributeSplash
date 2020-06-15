<?php

/**
 * @author Kashyap Team
 * @copyright Copyright (c) 2018 Kashyap (http://kashyapsoftware.com/)
 * @package Kashyap_AttributeSplash
*/


namespace Kashyap\AttributeSplash\Api\Data;

/**
 * Interface AttributeSplashSearchResultsInterface
 *
 * @package Kashyap\AttributeSplash\Api\Data
 */
interface AttributeSplashSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get AttributeSplash list.
     * @return \Kashyap\AttributeSplash\Api\Data\AttributeSplashInterface[]
     */
    public function getItems();

    /**
     * Set name list.
     * @param \Kashyap\AttributeSplash\Api\Data\AttributeSplashInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

