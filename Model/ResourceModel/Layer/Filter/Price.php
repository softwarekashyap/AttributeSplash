<?php

/**
 * @author Kashyap Team
 * @copyright Copyright (c) 2018 Kashyap (http://kashyapsoftware.com/)
 * @package Kashyap_AttributeSplash
*/

namespace Kashyap\AttributeSplash\Model\ResourceModel\Layer\Filter;

use Magento\Framework\App\Http\Context;
use Magento\Framework\Indexer\DimensionFactory;
use Magento\Framework\Search\Request\IndexScopeResolverInterface;

class Price extends \Magento\Catalog\Model\ResourceModel\Layer\Filter\Price 
{
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context,
        \Magento\Framework\Event\ManagerInterface $eventManager,
        \Kashyap\AttributeSplash\Model\Layer\Resolver $layerResolver,
        \Magento\Customer\Model\Session $session,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        $connectionName = null,
        IndexScopeResolverInterface $priceTableResolver = null,
        Context $httpContext = null,
        DimensionFactory $dimensionFactory = null
    ) {
        parent::__construct($context, $eventManager, $layerResolver, $session, $storeManager, $connectionName, $priceTableResolver, $httpContext, $dimensionFactory);
    }
}
