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

class Tb_Superslider_Block_Adminhtml_Slider_Edit_Tab_Info 
	  					extends Mage_Adminhtml_Block_Widget_Form{
    public function initForm()
    {
        $form = new Varien_Data_Form();
		$this->setForm($form);

        $fieldset = $form->addFieldset('slide_form', array('legend'=>Mage::helper('superslider')->__('Slide information')));
		
		$fieldset->addField('title', 'text', array(
          'label'     => Mage::helper('superslider')->__('Title'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'title',
        ));

        $fieldset->addField('status', 'select', array(
        'label'     => Mage::helper('superslider')->__('Status'),
        'name'      => 'status',
        'values'    => array(
          array(
              'value'     => 1,
              'label'     => Mage::helper('superslider')->__('Enabled'),
          ),

          array(
              'value'     => 0,
              'label'     => Mage::helper('superslider')->__('Disabled'),
          ),
        ),
        ));
		
		 if (!Mage::app()->isSingleStoreMode()) {
                $fieldset->addField('store_id', 'multiselect', array(
                    'name'      => 'stores[]',
                    'label'     => Mage::helper('superslider')->__('Store View'),
                    'title'     => Mage::helper('superslider')->__('Store View'),
                    'required'  => true,
                    'values'    => Mage::getSingleton('adminhtml/system_store')
											->getStoreValuesForForm(false, true),
            ));
        }

        $fieldset->addField('url', 'text', array(
          'label'     => Mage::helper('superslider')->__('Url'),
          'title'     => Mage::helper('superslider')->__('Url'),
          'required'  => false,
          'name'      => 'url',
          'after_element_html' => '<div class="hint"><p class="note">'.$this->__('e.g. http://magentocommerce.com/products.html').'</p></div>',
        ));
		
		//
        $fieldset->addField('image', 'image', array(
            'label'     => Mage::helper('superslider')->__('Slide image'),
			'title'     => Mage::helper('superslider')->__('Slide image'),
            'required'  => false,
            'name'      => 'image',
			'note' => '(*.jpg, *jpeg, *.png, *.gif)'
        ));
        
        $fieldset->addField('content', 'editor', array(
            'name'      => 'content',
            'label'     => Mage::helper('superslider')->__('Content'),
            'title'     => Mage::helper('superslider')->__('Content'),
            'style'     => 'height:20em',
			'after_element_html' => '<div class="hint"><p class="note">'.$this->__('HTML tags allowed. use {slide_url} to use above url in content hyper links').'</p></div>',
        ));

       
	   
		if ( Mage::getSingleton('adminhtml/session')->getSupersliderData() )
      {
          $data = Mage::getSingleton('adminhtml/session')->getSupersliderData();
          Mage::getSingleton('adminhtml/session')->setSupersliderData(null);
      } elseif ( Mage::registry('superslider_data') ) {
	  		
          $data = Mage::registry('superslider_data')->getData();
		   //	$p = $form->getElement('image')->getValue();
		 //	$form->getElement('image')->setValue('superslider/' . $p);
      }
      

       
		$form->setValues($data);
		if (Mage::app()->isSingleStoreMode()) {
            $fieldset->addField('store_id', 'hidden', array(
                            'name'      => 'stores[]',
                            'value'     => Mage::app()->getStore(true)->getId()
            ));
        }
		

        
        $this->setForm($form);
        return $this;
    }
}
