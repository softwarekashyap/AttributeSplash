<?php

/**
 * @author Kashyap Team
 * @copyright Copyright (c) 2018 Kashyap (http://kashyapsoftware.com/)
 * @package Kashyap_AttributeSplash
*/

namespace Kashyap\AttributeSplash\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Interface AttributeSplashRepositoryInterface
 *
 * @package Kashyap\AttributeSplash\Api
 */
interface AttributeSplashRepositoryInterface
{

    /**
     * Save AttributeSplash
     * @param \Kashyap\AttributeSplash\Api\Data\AttributeSplashInterface $attributeSplash
     * @return \Kashyap\AttributeSplash\Api\Data\AttributeSplashInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Kashyap\AttributeSplash\Api\Data\AttributeSplashInterface $attributeSplash
    );

    /**
     * Retrieve AttributeSplash
     * @param string $attributesplashId
     * @return \Kashyap\AttributeSplash\Api\Data\AttributeSplashInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($attributesplashId);

    /**
     * Retrieve AttributeSplash matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Kashyap\AttributeSplash\Api\Data\AttributeSplashSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete AttributeSplash
     * @param \Kashyap\AttributeSplash\Api\Data\AttributeSplashInterface $attributeSplash
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Kashyap\AttributeSplash\Api\Data\AttributeSplashInterface $attributeSplash
    );

    /**
     * Delete AttributeSplash by ID
     * @param string $attributesplashId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($attributesplashId);
}

