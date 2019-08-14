<?php


class Tb_Superslider_Block_Adminhtml_Slider_Edit_Tabs 
	  extends Mage_Adminhtml_Block_Widget_Tabs{
    public function __construct()
    {
        parent::__construct();
        $this->setId('slider_edit_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('superslider')->__('Information'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('info', array(
            'label'     => Mage::helper('superslider')->__('Slide Information'),
            'content'   => $this->getLayout()->createBlock('superslider/adminhtml_slider_edit_tab_info')->initForm()->toHtml(),
        ));

        return parent::_beforeToHtml();
    }
}
