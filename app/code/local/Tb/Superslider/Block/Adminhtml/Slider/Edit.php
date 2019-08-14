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
?><?php
class Tb_Superslider_Block_Adminhtml_Slider_Edit 
	  extends Mage_Adminhtml_Block_Widget_Form_Container{
	
	
	public function __construct(){
		
		$this->_objectId = 'id';
        $this->_blockGroup = 'superslider';
        $this->_controller = 'adminhtml_slider';

        parent::__construct();
		$this->_updateButton('save', 'label', 
							Mage::helper('superslider')->__('Save'));
		$this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('superslider')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);
		
		$this->_formScripts[] = "
			function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
		";
		
	}
	
	public function getHeaderText()
    {
         if (Mage::registry('superslider_data') &&
		 		Mage::registry('superslider_data')->getId()
		 ){
		 	$headerText = Mage::helper('superslider')->__("Edit Side '%s'",
                $this->htmlEscape(Mage::registry('superslider_data')->getTitle()));
				return $headerText;
		 }else{
		 	return Mage::helper('superslider')->__('Add New Slide');
		 }
            
    }
}
?>