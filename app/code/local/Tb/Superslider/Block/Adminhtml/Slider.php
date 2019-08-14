<?php
class Tb_Superslider_Block_Adminhtml_Slider extends 
	  								Mage_Adminhtml_Block_Widget_Grid_Container{
			
	public function __construct(){
		$this->_controller = 'adminhtml_slider';
        $this->_blockGroup = 'superslider';
       	$this->_headerText = Mage::helper('superslider')->__('Slider Manager');
        $this->_addButtonLabel = Mage::helper('superslider')->__('Add New slide');
        parent::__construct();
    }							
										
									}
?>