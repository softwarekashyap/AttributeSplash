<?php

/**
 * @author Kashyap Team
 * @copyright Copyright (c) 2018 Kashyap (http://kashyapsoftware.com/)
 * @package Kashyap_AttributeSplash
*/

namespace Kashyap\AttributeSplash\Plugin\Catalog\Block\Product\Listing;

use Kashyap\AttributeSplash\Plugin\Catalog\Block\Product\View\BlockHtmlTitlePlugin;
use Magento\Framework\Registry;


/**
 * Class ListProductPlugin
 *
 * @package Kashyap\AttributeSplash\Plugin\Catalog\Block\Product\Listing
 */
class ListProductPlugin
{
    /**
     * @var BlockHtmlTitlePlugin
     */
    private $blockHtmlTitlePlugin;

    /**
     * @var Registry
     */
    private $registry;

    /**
     * @var \Magento\Catalog\Model\Product
     */
    private $product;

    /**
     * @var \Kashyap\AttributeSplash\Helper\Data
     */
    private $brandHelper;

    /**
     * @var null|\Magento\Catalog\Model\Product
     */
    private $originalProduct = null;

    public function __construct(
        BlockHtmlTitlePlugin $blockHtmlTitlePlugin,
        Registry $registry,
        \Kashyap\AttributeSplash\Helper\Data $brandHelper
    ) {
        $this->blockHtmlTitlePlugin = $blockHtmlTitlePlugin;
        $this->registry = $registry;
        $this->brandHelper = $brandHelper;
    }

    /**
     * @param $original
     * @param \Magento\Catalog\Model\Product $product
     * @return array
     */
    public function beforeGetProductDetailsHtml($original, \Magento\Catalog\Model\Product $product)
    {
        $this->setProduct($product);

        return [$product];
    }

    /**
     * TODO: Unit
     * Add Brand Label to List Page
     *
     * @param $original
     * @param $html
     * @return string
     */
    public function afterGetProductDetailsHtml($original, $html)
    {
        return $html . $this->getLogoHtml();
    }


    /**
     * @return string
     */
    private function getLogoHtml()
    {
        $logoHtml = '';
        if ($this->isShowOnListing()) {
            $this->updateConfigurationData();

            $this->startEmulateProduct($this->getProduct());
            $logoHtml = $this->blockHtmlTitlePlugin->generateLogoHtml();
            $this->stopEmulateProduct();
        }

        return $logoHtml;
    }

    protected function updateConfigurationData()
    {
        //$data = $this->blockHtmlTitlePlugin->getData();
        $data['show_short_description'] = false;
        $data['width'] = 200;
        $data['height'] = 200;
        //$this->blockHtmlTitlePlugin->setData($data);
    }

    /**
     * @param \Magento\Catalog\Model\Product $product
     */
    protected function startEmulateProduct($product)
    {
        $this->originalProduct = $this->registry->registry('current_product') ?: null;
        $this->registry->unregister('current_product');
        $this->registry->register('current_product', $product);
    }

    protected function stopEmulateProduct()
    {
        $this->registry->unregister('current_product');
        if ($this->originalProduct) {
            $this->registry->register('current_product', $this->originalProduct);
            $this->originalProduct = null;
        }
    }

    /**
     * @return bool
     */
    protected function isShowOnListing()
    {
        return (bool) true;
    }


    /**
     * @return \Magento\Catalog\Model\Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param \Magento\Catalog\Model\Product $product
     */
    public function setProduct($product)
    {
        $this->product = $product;
    }
}
