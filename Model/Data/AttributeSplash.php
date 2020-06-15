<?php

/**
 * @author Kashyap Team
 * @copyright Copyright (c) 2018 Kashyap (http://kashyapsoftware.com/)
 * @package Kashyap_AttributeSplash
*/

namespace Kashyap\AttributeSplash\Model\Data;

use Kashyap\AttributeSplash\Api\Data\AttributeSplashInterface;

/**
 * Class AttributeSplash
 *
 * @package Kashyap\AttributeSplash\Model\Data
 */
class AttributeSplash extends \Magento\Framework\Api\AbstractExtensibleObject implements AttributeSplashInterface
{

    /**
     * Get attributesplash_id
     * @return string|null
     */
    public function getAttributesplashId()
    {
        return $this->_get(self::ATTRIBUTESPLASH_ID);
    }

    /**
     * Set attributesplash_id
     * @param string $attributesplashId
     * @return \Kashyap\AttributeSplash\Api\Data\AttributeSplashInterface
     */
    public function setAttributesplashId($attributesplashId)
    {
        return $this->setData(self::ATTRIBUTESPLASH_ID, $attributesplashId);
    }

    /**
     * Get name
     * @return string|null
     */
    public function getName()
    {
        return $this->_get(self::NAME);
    }

    /**
     * Set name
     * @param string $name
     * @return \Kashyap\AttributeSplash\Api\Data\AttributeSplashInterface
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Kashyap\AttributeSplash\Api\Data\AttributeSplashExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param \Kashyap\AttributeSplash\Api\Data\AttributeSplashExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Kashyap\AttributeSplash\Api\Data\AttributeSplashExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    /**
     * Get url_key
     * @return string|null
     */
    public function getUrlKey()
    {
        return $this->_get(self::URL_KEY);
    }

    /**
     * Set url_key
     * @param string $urlKey
     * @return \Kashyap\AttributeSplash\Api\Data\AttributeSplashInterface
     */
    public function setUrlKey($urlKey)
    {
        return $this->setData(self::URL_KEY, $urlKey);
    }

    /**
     * Get description
     * @return string|null
     */
    public function getDescription()
    {
        return $this->_get(self::DESCRIPTION);
    }

    /**
     * Set description
     * @param string $description
     * @return \Kashyap\AttributeSplash\Api\Data\AttributeSplashInterface
     */
    public function setDescription($description)
    {
        return $this->setData(self::DESCRIPTION, $description);
    }

    /**
     * Get image
     * @return string|null
     */
    public function getImage()
    {
        return $this->_get(self::IMAGE);
    }

    /**
     * Set image
     * @param string $image
     * @return \Kashyap\AttributeSplash\Api\Data\AttributeSplashInterface
     */
    public function setImage($image)
    {
        return $this->setData(self::IMAGE, $image);
    }

    /**
     * Get thumbnail
     * @return string|null
     */
    public function getThumbnail()
    {
        return $this->_get(self::THUMBNAIL);
    }

    /**
     * Set thumbnail
     * @param string $thumbnail
     * @return \Kashyap\AttributeSplash\Api\Data\AttributeSplashInterface
     */
    public function setThumbnail($thumbnail)
    {
        return $this->setData(self::THUMBNAIL, $thumbnail);
    }

    /**
     * Get page_title
     * @return string|null
     */
    public function getPageTitle()
    {
        return $this->_get(self::PAGE_TITLE);
    }

    /**
     * Set page_title
     * @param string $pageTitle
     * @return \Kashyap\AttributeSplash\Api\Data\AttributeSplashInterface
     */
    public function setPageTitle($pageTitle)
    {
        return $this->setData(self::PAGE_TITLE, $pageTitle);
    }

    /**
     * Get meta_keywords
     * @return string|null
     */
    public function getMetaKeywords()
    {
        return $this->_get(self::META_KEYWORDS);
    }

    /**
     * Set meta_keywords
     * @param string $metaKeywords
     * @return \Kashyap\AttributeSplash\Api\Data\AttributeSplashInterface
     */
    public function setMetaKeywords($metaKeywords)
    {
        return $this->setData(self::META_KEYWORDS, $metaKeywords);
    }

    /**
     * Get meta_description
     * @return string|null
     */
    public function getMetaDescription()
    {
        return $this->_get(self::META_DESCRIPTION);
    }

    /**
     * Set meta_description
     * @param string $metaDescription
     * @return \Kashyap\AttributeSplash\Api\Data\AttributeSplashInterface
     */
    public function setMetaDescription($metaDescription)
    {
        return $this->setData(self::META_DESCRIPTION, $metaDescription);
    }

    /**
     * Get creation_time
     * @return string|null
     */
    public function getCreationTime()
    {
        return $this->_get(self::CREATION_TIME);
    }

    /**
     * Set creation_time
     * @param string $creationTime
     * @return \Kashyap\AttributeSplash\Api\Data\AttributeSplashInterface
     */
    public function setCreationTime($creationTime)
    {
        return $this->setData(self::CREATION_TIME, $creationTime);
    }

    /**
     * Get update_time
     * @return string|null
     */
    public function getUpdateTime()
    {
        return $this->_get(self::UPDATE_TIME);
    }

    /**
     * Set update_time
     * @param string $updateTime
     * @return \Kashyap\AttributeSplash\Api\Data\AttributeSplashInterface
     */
    public function setUpdateTime($updateTime)
    {
        return $this->setData(self::UPDATE_TIME, $updateTime);
    }

    /**
     * Get status
     * @return string|null
     */
    public function getStatus()
    {
        return $this->_get(self::STATUS);
    }

    /**
     * Set status
     * @param string $status
     * @return \Kashyap\AttributeSplash\Api\Data\AttributeSplashInterface
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * Get position
     * @return string|null
     */
    public function getPosition()
    {
        return $this->_get(self::POSITION);
    }

    /**
     * Set position
     * @param string $position
     * @return \Kashyap\AttributeSplash\Api\Data\AttributeSplashInterface
     */
    public function setPosition($position)
    {
        return $this->setData(self::POSITION, $position);
    }

    /**
     * Get store_id
     * @return string|null
     */
    public function getStoreId()
    {
        return $this->_get(self::STORE_ID);
    }

    /**
     * Set store_id
     * @param string $storeId
     * @return \Kashyap\AttributeSplash\Api\Data\AttributeSplashInterface
     */
    public function setStoreId($storeId)
    {
        return $this->setData(self::STORE_ID, $storeId);
    }
}

