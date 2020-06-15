<?php

/**
 * @author Kashyap Team
 * @copyright Copyright (c) 2018 Kashyap (http://kashyapsoftware.com/)
 * @package Kashyap_AttributeSplash
*/


namespace Kashyap\AttributeSplash\Controller\Adminhtml\AttributeSplash;

/**
 * Class Delete
 *
 * @package Kashyap\AttributeSplash\Controller\Adminhtml\AttributeSplash
 */
class Delete extends \Kashyap\AttributeSplash\Controller\Adminhtml\AttributeSplash
{

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('attributesplash_id');
        if ($id) {
            try {
                // init model and delete
                $model = $this->_objectManager->create(\Kashyap\AttributeSplash\Model\AttributeSplash::class);
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the Attribute Splash.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['attributesplash_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a Attribute Splas to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}

