<?php

/**
 * @author Kashyap Team
 * @copyright Copyright (c) 2018 Kashyap (http://kashyapsoftware.com/)
 * @package Kashyap_AttributeSplash
*/

    namespace Kashyap\AttributeSplash\Ui\Component\Listing\Column;

    use Magento\Framework\Escaper;
    use Magento\Framework\View\Element\UiComponent\ContextInterface;
    use Magento\Framework\View\Element\UiComponentFactory;
    use Magento\Store\Model\System\Store as SystemStore;


    class StoreView extends \Magento\Store\Ui\Component\Listing\Column\Store
    {
        public function __construct(
            ContextInterface $context,
            UiComponentFactory $uiComponentFactory,
            SystemStore $systemStore,
            Escaper $escaper,
            array $components = [],
            array $data = []
        ) {
            parent::__construct($context, $uiComponentFactory, $systemStore, $escaper, $components, $data, 'store_ids');
        }

        protected function prepareItem(array $item)
        {
            $content = '';
            $origStores = $item['store_views'];

            if (!is_array($origStores)) {
                $origStores= explode(',', $origStores);
            }
            
            if (in_array(0, $origStores) && count($origStores) == 1) {
                return __('All Store Views');
            }

            $data = $this->systemStore->getStoresStructure(false, $origStores);

            foreach ($data as $website) {
                $content .= $website['label'] . "<br/>";
                foreach ($website['children'] as $group) {
                    $content .= str_repeat('&nbsp;', 3) . $this->escaper->escapeHtml($group['label']) . "<br/>";
                    foreach ($group['children'] as $store) {
                        $content .= str_repeat('&nbsp;', 6) . $this->escaper->escapeHtml($store['label']) . "<br/>";
                    }
                }
            }

            return $content;
        }
}