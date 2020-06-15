<?php

/**
 * @author Kashyap Team
 * @copyright Copyright (c) 2018 Kashyap (http://kashyapsoftware.com/)
 * @package Kashyap_AttributeSplash
*/

namespace Kashyap\AttributeSplash\Model\ResourceModel\AttributeSplash;

/**
 * Class Collection
 *
 * @package Kashyap\AttributeSplash\Model\ResourceModel\AttributeSplash
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * @var string
     */
    protected $_idFieldName = 'attributesplash_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Kashyap\AttributeSplash\Model\AttributeSplash::class,
            \Kashyap\AttributeSplash\Model\ResourceModel\AttributeSplash::class
        );
    }
}

