<?php

/**
 * @author Kashyap Team
 * @copyright Copyright (c) 2018 Kashyap (http://kashyapsoftware.com/)
 * @package Kashyap_AttributeSplash
*/


namespace Kashyap\AttributeSplash\Api\Data;

/**
 * Interface AttributeSplashInterface
 *
 * @package Kashyap\AttributeSplash\Api\Data
 */
interface AttributeSplashInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const IMAGE = 'image';
    const META_KEYWORDS = 'meta_keywords';
    const META_DESCRIPTION = 'meta_description';
    const ATTRIBUTESPLASH_ID = 'attributesplash_id';
    const STORE_ID = 'store_id';
    const NAME = 'name';
    const STATUS = 'status';
    const THUMBNAIL = 'thumbnail';
    const POSITION = 'position';
    const CREATION_TIME = 'creation_time';
    const DESCRIPTION = 'description';
    const URL_KEY = 'url_key';
    const PAGE_TITLE = 'page_title';
    const UPDATE_TIME = 'update_time';

    /**
     * Get attributesplash_id
     * @return string|null
     */
    public function getAttributesplashId();

    /**
     * Set attributesplash_id
     * @param string $attributesplashId
     * @return \Kashyap\AttributeSplash\Api\Data\AttributeSplashInterface
     */
    public function setAttributesplashId($attributesplashId);

    /**
     * Get name
     * @return string|null
     */
    public function getName();

    /**
     * Set name
     * @param string $name
     * @return \Kashyap\AttributeSplash\Api\Data\AttributeSplashInterface
     */
    public function setName($name);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Kashyap\AttributeSplash\Api\Data\AttributeSplashExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \Kashyap\AttributeSplash\Api\Data\AttributeSplashExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Kashyap\AttributeSplash\Api\Data\AttributeSplashExtensionInterface $extensionAttributes
    );

    /**
     * Get url_key
     * @return string|null
     */
    public function getUrlKey();

    /**
     * Set url_key
     * @param string $urlKey
     * @return \Kashyap\AttributeSplash\Api\Data\AttributeSplashInterface
     */
    public function setUrlKey($urlKey);

    /**
     * Get description
     * @return string|null
     */
    public function getDescription();

    /**
     * Set description
     * @param string $description
     * @return \Kashyap\AttributeSplash\Api\Data\AttributeSplashInterface
     */
    public function setDescription($description);

    /**
     * Get image
     * @return string|null
     */
    public function getImage();

    /**
     * Set image
     * @param string $image
     * @return \Kashyap\AttributeSplash\Api\Data\AttributeSplashInterface
     */
    public function setImage($image);

    /**
     * Get thumbnail
     * @return string|null
     */
    public function getThumbnail();

    /**
     * Set thumbnail
     * @param string $thumbnail
     * @return \Kashyap\AttributeSplash\Api\Data\AttributeSplashInterface
     */
    public function setThumbnail($thumbnail);

    /**
     * Get page_title
     * @return string|null
     */
    public function getPageTitle();

    /**
     * Set page_title
     * @param string $pageTitle
     * @return \Kashyap\AttributeSplash\Api\Data\AttributeSplashInterface
     */
    public function setPageTitle($pageTitle);

    /**
     * Get meta_keywords
     * @return string|null
     */
    public function getMetaKeywords();

    /**
     * Set meta_keywords
     * @param string $metaKeywords
     * @return \Kashyap\AttributeSplash\Api\Data\AttributeSplashInterface
     */
    public function setMetaKeywords($metaKeywords);

    /**
     * Get meta_description
     * @return string|null
     */
    public function getMetaDescription();

    /**
     * Set meta_description
     * @param string $metaDescription
     * @return \Kashyap\AttributeSplash\Api\Data\AttributeSplashInterface
     */
    public function setMetaDescription($metaDescription);

    /**
     * Get creation_time
     * @return string|null
     */
    public function getCreationTime();

    /**
     * Set creation_time
     * @param string $creationTime
     * @return \Kashyap\AttributeSplash\Api\Data\AttributeSplashInterface
     */
    public function setCreationTime($creationTime);

    /**
     * Get update_time
     * @return string|null
     */
    public function getUpdateTime();

    /**
     * Set update_time
     * @param string $updateTime
     * @return \Kashyap\AttributeSplash\Api\Data\AttributeSplashInterface
     */
    public function setUpdateTime($updateTime);

    /**
     * Get status
     * @return string|null
     */
    public function getStatus();

    /**
     * Set status
     * @param string $status
     * @return \Kashyap\AttributeSplash\Api\Data\AttributeSplashInterface
     */
    public function setStatus($status);

    /**
     * Get position
     * @return string|null
     */
    public function getPosition();

    /**
     * Set position
     * @param string $position
     * @return \Kashyap\AttributeSplash\Api\Data\AttributeSplashInterface
     */
    public function setPosition($position);

    /**
     * Get store_id
     * @return string|null
     */
    public function getStoreId();

    /**
     * Set store_id
     * @param string $storeId
     * @return \Kashyap\AttributeSplash\Api\Data\AttributeSplashInterface
     */
    public function setStoreId($storeId);
}

