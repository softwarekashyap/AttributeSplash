<?php

/**
 * @author Kashyap Team
 * @copyright Copyright (c) 2018 Kashyap (http://kashyapsoftware.com/)
 * @package Kashyap_AttributeSplash
*/

namespace Kashyap\AttributeSplash\Plugin\Catalog\Block\Product\View;


class BlockHtmlTitlePlugin 
{
    /**
     * @var \Magento\Framework\Registry
    */
    private $_coreRegistry;
    
    
    public $request;

    public function __construct(
        \Magento\Framework\App\Request\Http $request,
        \Kashyap\AttributeSplash\Helper\Data $_helper,
        \Magento\Framework\Registry $_coreRegistry
    ) {
        $this->_coreRegistry = $_coreRegistry;
        $this->_helper = $_helper;
        $this->_request = $request;
    }


    /*public function afterGetPageHeading(\Magento\Theme\Block\Html\Title $subject, $title)
    {
        $attributeId = $this->_request->getParam('id');
        if ($attributeId) {
            $attributeClolection = $this->_helper->getAttributeCollection($attributeId);
            if ($attributeClolection->getName()) {
                $title = $attributeClolection->getName();
            }
        }

        return $title;
    }*/
    
    /*public function afterToHtml(
        \Magento\Theme\Block\Html\Title $original,
        $html
    ) {
        $attributeId = $this->_request->getParam('id');
        $image = '';
        if ($attributeId) {
            $attributeClolection = $this->_helper->getAttributeCollection($attributeId);
            if ($attributeClolection->getThumbnail()) {
                $image = $this->_helper->getAttributeSplashImageURL($attributeClolection->getThumbnail());
            }
        }
        if($image){
            $logoHtml = '<img src="'. $image .'" alt="Smiley face"/>';
            $html = str_replace('/h1>', '/h1>' . $logoHtml, $html);
        }


        return $html;
    }*/

}
