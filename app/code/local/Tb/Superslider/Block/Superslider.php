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
class Tb_Superslider_Block_Superslider 
						extends Mage_Core_Block_Template{
	
	public function _construct(){
        $this->addData(array(
            'cache_lifetime'    => 21600,
            'cache_tags'        => array('Superslider_cache')
        ));		
	}
	
	public function setSlideParams(){
		$params = array();
		
		if(Mage::helper('superslider')->pagination()){
			$params['pagination'] = "true";
		}else{
			$params['pagination'] = "false";
		}
		
		if(Mage::helper('superslider')->navigation()){
			$params['navigation'] = "true";
		}else{
			$params['navigation'] = "false";
		}
		
		if(Mage::helper('superslider')->pauseOnHover()){
			$params['hover'] = "true";
		}else{
			$params['hover'] = "false";
		}
		
		if(Mage::helper('superslider')->SlideTime()){
			$params['time'] = Mage::helper('superslider')->SlideTime();
		}
		
		if(Mage::helper('superslider')->containerHeight()){
			$params['height'] = Mage::helper('superslider')->containerHeight();
		}else{
			$params['height'] = 400;
		}
		
		if(Mage::helper('superslider')->transitionTime()){
			$params['transPeriod'] = Mage::helper('superslider')->transitionTime();
		}
		
		return $params;
	}
	
	public function getSliderCollection(){
		
		$collection = array();
		$currentStoreView =	Mage::app()->getStore()->getId();
		$model = Mage::getModel('superslider/superslider')
						->getCollection()
						->addFieldToFilter('status', 1);
		foreach($model as $item){
			$itemStores = $item->getStoreId();
			$stores = explode(',', $itemStores);
			if(in_array($currentStoreView, $stores) || in_array(0, $stores)) {
				$collection[]  =  $item;
			}
		}
		
		return $collection;
	}
	
		
}
?>