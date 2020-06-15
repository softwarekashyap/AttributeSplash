<?php

/**
 * @author Kashyap Team
 * @copyright Copyright (c) 2018 Kashyap (http://kashyapsoftware.com/)
 * @package Kashyap_AttributeSplash
*/

namespace Kashyap\AttributeSplash\Model\ResourceModel;

/**
 * Class AttributeSplash
 *
 * @package Kashyap\AttributeSplash\Model\ResourceModel
 */
class AttributeSplash extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('kashyap_attributesplash_attributesplash', 'attributesplash_id');
    }
}

