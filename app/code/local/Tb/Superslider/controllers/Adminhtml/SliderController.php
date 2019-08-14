<?php
/**
 * Tb_Superslider
 * 
 /****************************************************************************
 *                      MAGENTO EDITION USAGE NOTICE                         *
 ****************************************************************************/
 /* This package designed for Magento Community edition. Author does not provide extension support in case of incorrect edition usage.
 /****************************************************************************
 * @category 	TB
 * @package 	Tb_Superslider
 * @copyright 	Copyright (c) 2014
 * @license 	http://opensource.org/licenses/OSL-3.0
 */
/**
 */
?>
<?php
class Tb_Superslider_Adminhtml_SliderController extends 
	  										Mage_Adminhtml_Controller_Action{
												
	public function preDispatch() {
        parent::preDispatch();
    }
	
	 public function indexAction() {
        	//$this->loadLayout();	
            $this->_initAction()->_addContent($this->getLayout()->createBlock('superslider/adminhtml_slider'));
			$this->getLayout()->getBlock('head')->setTitle('Manage Slides'); 
			$this->renderLayout();
			
    }
	
	protected function _initAction()
    {
        // active menu
       $this->loadLayout();
	   $this->_setActiveMenu('superslider/manageslide');
       return $this;
    }
	
	
	public function editAction() {
        $id = $this->getRequest()->getParam('id');
		$model = Mage::getModel('superslider/superslider')->load($id);
		//echo $model->getTitle().$model->getSlideId() ;
		if ($id) {
            $model->load($id);
			$data = Mage::getSingleton('adminhtml/session')->getFormData(true);
			if (!empty($data)) {
				    $model->setData($data);
					
                }
            if (! $model->getId()) {
                Mage::getSingleton('adminhtml/session')
                    ->addError(Mage::helper('superslider')->__('This slide is no longer exist'));
                $this->_redirect('*/*/');
                return;
            }
        }
					
						
		
		
		$data = Mage::register('superslider_data', $model);	
		$data = Mage::registry('superslider_data');
		$this->_initAction()
            ->_addContent(
				$this->getLayout()
					->createBlock('superslider/adminhtml_Slider_edit')
						)
            ->_addLeft(
				$this->getLayout()
					->createBlock('superslider/adminhtml_Slider_edit_tabs')
					)
            ->renderLayout();		
						
			}	
		public function saveAction(){
			if ($data = $this->getRequest()->getPost()) {
				if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
					$imageRename = time().rand().$_FILES['image']['name'];
				try{
					$uploader = new Varien_File_Uploader('image');
					// Any of these extention would work
	           		$uploader->setAllowedExtensions(array('jpg','jpeg','gif','png'));
					$uploader->setAllowRenameFiles(false);
					$uploader->setFilesDispersion(false);
					$path = Mage::getBaseDir('media') . DS . 'superslider';
					$uploader->save($path, $imageRename );
					}catch (Exception $e){
						}
					$data['image'] = "superslider/".$imageRename;
					}else {       
				        if(isset($data['image']['delete']) && $data['image']['delete'] == 1)
				            $data['image'] = '';
				        else
				            unset($data['image']);
				    }
					
					if(isset($data['stores'])) {
					    if(in_array('0',$data['stores'])){
					        $data['store_id'] = '0';
					    }
				    else{
				        $data['store_id'] = implode(",", $data['stores']);
				    	}
				   		unset($data['stores']);
					}
					$model = Mage::getModel('superslider/superslider');	
					$model->setData($data)
							->setId($this->getRequest()->getParam('id'));
							
					try{
						if ($model->getCreatedTime == NULL || 
							$model->getUpdateTime() == NULL) {
								$model->setCreatedTime(now())
										->setUpdateTime(now());
							} else {
								$model->setUpdateTime(now());
							}
						$model->save();
						
						Mage::getSingleton('adminhtml/session')
							->addSuccess(Mage::helper('superslider')
							->__('Slide was successfully saved.'));
						Mage::getSingleton('adminhtml/session')->setFormData(false);
						
						if ($this->getRequest()->getParam('back')) {
							$this->_redirect('*/*/edit', array('id' => $model->getId()));
							return;
						}
						
						$this->_redirect('*/*/');
						return;
						
					}catch(Exception $e){
						 Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
			             Mage::getSingleton('adminhtml/session')->setFormData($data);
			             $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
			             return;
						
					}
				}
			Mage::getSingleton('adminhtml/session')
						->addError(Mage::helper('superslider')
						->__('Unable to find slide to save'));
        	$this->_redirect('*/*/');	
		
		}	
		
		public function deleteAction() {
			if( $this->getRequest()->getParam('id') > 0 ) {
				try {
					$model = Mage::getModel('superslider/superslider');
					 
					$model->setId($this->getRequest()->getParam('id'))
						->delete();
						 
					Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Slide was successfully deleted.'));
					$this->_redirect('*/*/');
				} catch (Exception $e) {
					Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
					$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
				}
			}
			$this->_redirect('*/*/');
	}
	
	
	public function newAction() {
		$this->_forward('edit');
	}	
	
	public function massDeleteAction() {
        $slide_ids = $this->getRequest()->getParam('superslider');

        if (!is_array($slide_ids)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select item(s)'));
        } else {
            try {
                $model = Mage::getModel('superslider/superslider');
                foreach ($slide_ids as $slideId) {
                    $model->reset()
                        ->load($slideId)
                        ->delete();
                }
                Mage::getSingleton('adminhtml/session')
                    ->addSuccess(Mage::helper('adminhtml')
                    ->__('%d record(s) have been successfully deleted', count($slide_ids)));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }
	
		
	public function massStatusAction()
    {
        $slide_ids = $this->getRequest()->getParam('superslider');
        if (!is_array($slide_ids)) {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Please select item(s)'));
        } else {
            try {
                foreach ($slide_ids as $slideId) {
                    $model = Mage::getSingleton('superslider/superslider')
                        ->setId($slideId)
                        ->setStatus($this->getRequest()->getParam('status'))
                        ->save();
                }
                $this->_getSession()
                    ->addSuccess($this->__('%d record(s) have been successfully updated', count($slide_ids)));
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }
						
						
}
