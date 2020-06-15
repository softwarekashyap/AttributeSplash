<?php

/**
 * @author Kashyap Team
 * @copyright Copyright (c) 2018 Kashyap (http://kashyapsoftware.com/)
 * @package Kashyap_AttributeSplash
*/

    namespace Kashyap\AttributeSplash\Ui\Component\Listing\Column;

    use Magento\Framework\View\Element\UiComponentFactory;
    use Magento\Framework\View\Element\UiComponent\ContextInterface;
    use Magento\Ui\Component\Listing\Columns\Column;
    use Magento\Store\Model\StoreManagerInterface;
    use Magento\Framework\Locale\CurrencyInterface;
    
    class Attribute extends Column
    {
        /**
         * @var \Magento\Store\Model\StoreManagerInterface
         */
        protected $storeManager;
    
        /**
         * @param ContextInterface $context
         * @param UiComponentFactory $uiComponentFactory
         * @param StoreManagerInterface $storeManager
         * @param array $components
         * @param array $data
         */
        public function __construct(
            ContextInterface $context,
            UiComponentFactory $uiComponentFactory,
            StoreManagerInterface $storeManager,
            \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
            CurrencyInterface $localeCurrency,
            array $components = [],
            array $data = []
        ) {
            $this->storeManager = $storeManager;
            $this->scopeConfig = $scopeConfig;
            $this->_localecurrency = $localeCurrency;
            parent::__construct($context, $uiComponentFactory, $components, $data);
        }
    
        public function prepareDataSource(array $dataSource)
        {
            if (isset($dataSource['data']['items'])) {
                foreach ($dataSource['data']['items'] as &$items) {
                    $optionValue = $items['attribute_id'];;
                    $items['attribute_id'] = $this->scopeConfig->getValue('attributesplash/general_settings/attribute_code', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);;
                }
            }
    
            return $dataSource;
        }
    }
